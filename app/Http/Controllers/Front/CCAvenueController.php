<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CCAvenueController extends Controller
{
    public function pay(Request $request)
    {
        $merchantId = env('CCAVENUE_MERCHANT_ID');
        $accessCode = env('CCAVENUE_ACCESS_CODE');
        $workingKey = env('CCAVENUE_WORKING_KEY');

        $orderId = 'ORD' . time();
        $amount = $request->amount;
        $data = [
            'merchant_id' => $merchantId,
            'order_id' => $orderId,
            'currency' => 'INR',
            'amount' => number_format($amount, 2, '.', ''),
            'redirect_url' => route('ccavenue.response'),
            'cancel_url' => route('ccavenue.cancel'),
            'language' => 'EN',
            'billing_name' => $request->billing_name ?? '',
            'billing_address' => $request->billing_address ?? '',
            'billing_city' => $request->billing_city ?? '',
            'billing_state' => $request->billing_state ?? '',
            'billing_zip' => $request->billing_zip ?? '',
            'billing_country' => 'India',
            'billing_tel' => $request->billing_tel ?? '',
            'billing_email' => $request->billing_email ?? '',
        ];

        $merchantData = http_build_query($data);

        $encryptedData = $this->encrypt($merchantData, $workingKey);

        return view('front.ccavenue.payment', [
            'accessCode' => $accessCode,
            'encryptedData' => $encryptedData,
        ]);
    }

    public function response(Request $request)
    {
        $workingKey = env('CCAVENUE_WORKING_KEY');

        $encResponse = $request->encResp;

        if (!$encResponse) {
            return redirect('/checkout')
                ->with('error', 'Invalid payment response.');
        }

        $decryptedResponse = $this->decrypt(
            $encResponse,
            $workingKey
        );

        parse_str($decryptedResponse, $response);

        \Log::info('CCAvenue Response', $response);

        if (
            isset($response['order_status']) &&
            $response['order_status'] === 'Success'
        ) {
            // Payment successful
            // Yahan order ko paid/update karna hai

            return redirect('/checkout')
                ->with('success', 'Payment successful.');
        }

        if (
            isset($response['order_status']) &&
            $response['order_status'] === 'Aborted'
        ) {
            return redirect('/checkout')
                ->with('error', 'Payment was aborted.');
        }

        return redirect('/checkout')
            ->with('error', 'Payment failed.');
    }

    public function cancel(Request $request)
    {
        return redirect('/checkout')
            ->with('error', 'Payment cancelled.');
    }

    private function encrypt($plainText, $key)
    {
        $key = md5($key);

        $initVector = substr($key, 0, 16);

        $encrypted = openssl_encrypt(
            $plainText,
            'AES-128-CBC',
            hex2bin($key),
            OPENSSL_RAW_DATA,
            $initVector
        );

        return bin2hex($encrypted);
    }

    private function decrypt($encryptedText, $key)
    {
        $key = md5($key);

        $initVector = substr($key, 0, 16);

        $encryptedText = hex2bin($encryptedText);

        return openssl_decrypt(
            $encryptedText,
            'AES-128-CBC',
            hex2bin($key),
            OPENSSL_RAW_DATA,
            $initVector
        );
    }
}
