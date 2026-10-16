<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CCAvenueController extends Controller
{
    public function pay(Request $request)
    {
        $request->validate(['order_id' => ['required', 'string']]);
        $customer = Auth::guard('customer')->user();

        $order = Order::where('order_number', $request->input('order_id'))
            ->where('user_id', $customer->id)
            ->where('payment_method', 'ccavenue')
            ->where('payment_status', 'unpaid')
            ->first();

        if (!$order) {
            abort(404, 'The order could not be found or has already been paid.');
        }

        $merchantId = config('services.ccavenue.merchant_id');
        $accessCode = config('services.ccavenue.access_code');
        $workingKey = config('services.ccavenue.working_key');
        $gatewayUrl = config('services.ccavenue.gateway_url');

        if (!$merchantId || !$accessCode || !$workingKey || !$gatewayUrl) {
            Log::error('CCAvenue payment configuration is incomplete.');
            abort(500, 'CCAvenue payment is not configured. Please contact support.');
        }
        if (strpos($gatewayUrl, 'command=') === false) {
            $gatewayUrl .= (strpos($gatewayUrl, '?') === false ? '?' : '&') . 'command=initiateTransaction';
        }

        if ((float) $order->total <= 0) {
            abort(422, 'The order amount is invalid.');
        }

        $billing = json_decode($order->billing_address ?? '', true) ?: [];
        $merchantData = [
            'merchant_id' => $merchantId,
            'order_id' => $order->order_number,
            'currency' => config('services.ccavenue.currency', 'INR'),
            'amount' => number_format((float) $order->total, 2, '.', ''),
            'redirect_url' => config('services.ccavenue.redirect_url') ?: route('front-ccavenue.response'),
            'cancel_url' => config('services.ccavenue.cancel_url') ?: route('front-ccavenue.cancel'),
            'language' => 'EN',
            'billing_name' => $billing['name'] ?? $order->user->name ?? '',
            'billing_address' => $billing['address'] ?? '',
            'billing_city' => $billing['city'] ?? '',
            'billing_state' => $billing['state'] ?? '',
            'billing_zip' => $billing['postal_code'] ?? $billing['pincode'] ?? '',
            'billing_country' => $order->country_name ?? '',
            'billing_tel' => $billing['phone_number'] ?? $billing['phone'] ?? '',
            'billing_email' => $order->user->email ?? '',
        ];

        $encryptedData = $this->encrypt(http_build_query($merchantData), $workingKey);
        if ($encryptedData === false) {
            Log::error('CCAvenue request encryption failed.', ['order_id' => $order->order_number]);
            abort(500, 'Unable to prepare the CCAvenue payment request.');
        }

        return response()->view('front.ccavenue.payment', [
            'encryptedData' => $encryptedData,
            'accessCode' => $accessCode,
            'gatewayUrl' => $gatewayUrl,
        ]);
    }

    public function response(Request $request)
    {
        return $this->handleGatewayResponse($request);
    }

    public function cancel(Request $request)
    {
        return $this->handleGatewayResponse($request, true);
    }

    private function handleGatewayResponse(Request $request, bool $cancelled = false)
    {
        $encryptedResponse = $request->input('encResp');
        $workingKey = config('services.ccavenue.working_key');
        if (!$encryptedResponse || !$workingKey) {
            Log::warning('CCAvenue returned an empty or unconfigured response.');
            return view('front.ccavenue.result', [
                'success' => false,
                'message' => 'We could not verify the payment response. Please contact support before trying again.',
                'order' => null,
            ]);
        }

        $decryptedResponse = $this->decrypt($encryptedResponse, $workingKey);
        if ($decryptedResponse === false) {
            Log::warning('CCAvenue response decryption failed.');
            return view('front.ccavenue.result', [
                'success' => false,
                'message' => 'We could not verify the payment response. Please contact support before trying again.',
                'order' => null,
            ]);
        }

        parse_str($decryptedResponse, $responseData);
        $orderNumber = $responseData['order_id'] ?? null;
        $order = $orderNumber
            ? Order::where('order_number', $orderNumber)->where('payment_method', 'ccavenue')->first()
            : null;

        if (!$order) {
            Log::warning('CCAvenue response references an unknown order.', ['order_id' => $orderNumber]);
            return view('front.ccavenue.result', [
                'success' => false,
                'message' => 'The payment response could not be matched to an order. Please contact support.',
                'order' => null,
            ]);
        }

        $isSuccess = !$cancelled
            && isset($responseData['order_status'], $responseData['amount'], $responseData['currency'])
            && strcasecmp($responseData['order_status'], 'Success') === 0
            && is_numeric($responseData['amount'])
            && strcasecmp($responseData['currency'], config('services.ccavenue.currency', 'INR')) === 0
            && abs((float) $responseData['amount'] - (float) $order->total) < 0.01;

        if ($isSuccess) {
            if ($order->payment_status !== 'paid') {
                $order->payment_status = 'paid';
                $order->save();
            }

            return view('front.ccavenue.result', [
                'success' => true,
                'message' => 'Your payment was successful.',
                'order' => $order,
            ]);
        }

        Log::info('CCAvenue payment was not completed.', [
            'order_id' => $order->order_number,
            'gateway_status' => $responseData['order_status'] ?? ($cancelled ? 'Cancelled' : 'Unknown'),
        ]);

        return view('front.ccavenue.result', [
            'success' => false,
            'message' => $cancelled
                ? 'The payment was cancelled. Your order is still unpaid.'
                : 'The payment was not successful. Your order is still unpaid.',
            'order' => $order,
        ]);
    }

    private function encrypt(string $plainText, string $workingKey)
    {
        $key = hex2bin(md5($workingKey));
        $initialVector = pack('C*', 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $encrypted = openssl_encrypt(
            $plainText,
            'AES-128-CBC',
            $key,
            OPENSSL_RAW_DATA,
            $initialVector
        );

        return $encrypted === false ? false : strtoupper(bin2hex($encrypted));
    }

    private function decrypt(string $encryptedText, string $workingKey)
    {
        if (!ctype_xdigit($encryptedText) || strlen($encryptedText) % 2 !== 0) {
            return false;
        }

        $encrypted = hex2bin($encryptedText);
        $key = hex2bin(md5($workingKey));
        if ($encrypted === false || $key === false) {
            return false;
        }

        $initialVector = pack('C*', 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        return openssl_decrypt(
            $encrypted,
            'AES-128-CBC',
            $key,
            OPENSSL_RAW_DATA,
            $initialVector
        );
    }
}
