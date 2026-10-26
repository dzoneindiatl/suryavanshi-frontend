<?php

namespace App\Http\Controllers\Front;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\ProductVariantCombination;
use App\Models\ProductVariantCombinationImage;
use App\Models\PaymentMethod;
use Session;
use Ixudra\Curl\Facades\Curl;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Order;
use App\Services\PaymentCancellationService;
class PaymentController extends Controller

{
    public function createPaypalOrder(Request $request) 
    { 
        try 
        { 
            $request->validate([ 'order_id' => 'required|integer', ]); 
            $customer = Auth::guard('customer')->user(); 
            if (!$customer) 
            { 
                return response()->json([ 'success' => false, 'message' => 'Please login to continue.', ], 401); 
            } 
            $order = Order::where('id', $request->order_id) ->where('user_id', $customer->id) ->where('payment_method', 'paypal') ->where('payment_status', 'unpaid') ->first(); 
            if (!$order) 
            { 
                return response()->json([ 'success' => false, 'message' => 'Order not found or payment is already processed.', ], 404); 
            } 
            $clientId = config('services.paypal.client_id'); 
            $clientSecret = config('services.paypal.client_secret'); 
            $baseUrl = rtrim(config('services.paypal.base_url', 'https://api-m.sandbox.paypal.com'), '/'); 
            $currency = strtoupper(config('services.paypal.currency', 'USD')); 
            $amount = number_format((float) $order->total, 2, '.', ''); 
            if (empty($clientId) || empty($clientSecret)) { 
                Log::error('PayPal credentials are missing.'); 
                return response()->json([ 'success' => false, 'message' => 'PayPal configuration is missing. Please contact support.', ], 500);
             } 
            if ((float) $amount <= 0) 
            { 
                return response()->json([ 'success' => false, 'message' => 'Invalid order amount.', ], 422);
            } 
            Log::info('PayPal order request', [ 'order_id' => $order->id, 'currency' => $currency, 'amount' => $amount, 'base_url' => $baseUrl, ]); 
            // Step 1: Generate PayPal access token
            $tokenResponse = Http::asForm()->withBasicAuth($clientId, $clientSecret)->acceptJson() ->post($baseUrl . '/v1/oauth2/token', [ 'grant_type' => 'client_credentials', ]); 
            if (!$tokenResponse->successful()) 
            { 
                Log::error('PayPal token request failed', [ 'status' => $tokenResponse->status(), 'response' => $tokenResponse->json(), ]); 
                return response()->json([ 'success' => false, 'message' => 'Unable to connect to PayPal. Please try again.', ], 502); 
            } 
            $accessToken = $tokenResponse->json('access_token'); 
            if (empty($accessToken)) 
            { 
                Log::error('PayPal access token missing', [ 'response' => $tokenResponse->json(), ]); 
                return response()->json([ 'success' => false, 'message' => 'PayPal access token was not returned.', ], 502); 
            } // Step 2: Create PayPal order 

            info("=======comes for payment=========="); 
            $paypalResponse = Http::withToken($accessToken)->acceptJson()->post($baseUrl . '/v2/checkout/orders', 
            [ 
                'intent' => 'CAPTURE', 
                'purchase_units' => [ 
                    [ 
                        'reference_id' => (string) $order->id, 
                        'custom_id' => (string) $order->id, 
                        'amount' => [ 
                            'currency_code' => $currency, 
                            'value' => $amount,
                        ], 
                    ], 
                ], 
                'payment_source' => 
                [ 
                    'paypal' => [ 
                        'experience_context' => [ 
                            'return_url' => route('front-paypal.success'),
                            'cancel_url' => route('front-paypal.cancel', ['order_id' => $order->id]),
                            'user_action' => 'PAY_NOW', 
                            'landing_page' => 'LOGIN', 
                        ], 
                    ], 
                ], 
            ]); 
            $responseData = $paypalResponse->json(); 
           info('PayPal order request', [
                    'order_id' => $order->id,
                    'currency' => $currency,
                    'amount' => $amount,
                    'environment' => $baseUrl,
                ]);
            info("============response==============",[$responseData]); 
            if (!$paypalResponse->successful()) 
            { 
                Log::error('PayPal create order failed', [ 'status' => $paypalResponse->status(), 'response' => $responseData, 'order_id' => $order->id, ]); 
                return response()->json([ 'success' => false, 'message' => data_get( $responseData, 'message', 'PayPal order creation failed. Please try again.' ), ], 422);
            } 
            // Step 3: Find approval URL
             $approvalLink = collect($responseData['links'] ?? [])->first(function ($link) { 
                return in_array( $link['rel'] ?? '', ['approve', 'payer-action'], true ) && !empty($link['href']); 
            }); 
            if (empty($approvalLink['href'])) { 
                Log::error('PayPal approval URL missing', [ 'status' => $paypalResponse->status(), 'response' => $responseData, 'order_id' => $order->id, ]); 
                return response()->json([ 'success' => false, 'message' => 'PayPal approval URL was not returned. Check Laravel log.', ], 422); 
                } 
                // Step 4: Save PayPal order ID 
                $paypalOrderId = $responseData['id'] ?? null; 
                if (empty($paypalOrderId)) { 
                    Log::error('PayPal order ID missing', [ 'response' => $responseData, 'order_id' => $order->id, ]); 
                    return response()->json([ 'success' => false, 'message' => 'PayPal order ID was not returned.', ], 502); 
                } 
                $order->paypal_order_id = $paypalOrderId; 
                $order->save(); 

                info('PayPal order response', [
                    'http_status' => $paypalResponse->status(),
                    'order_id' => data_get($responseData, 'id'),
                    'status' => data_get($responseData, 'status'),
                    'links' => collect(data_get($responseData, 'links', []))
                        ->map(fn ($link) => [
                            'rel' => $link['rel'] ?? null,
                            'href' => $link['href'] ?? null,
                        ])->all(),
                    'debug_id' => data_get($responseData, 'debug_id'),
                ]);
                info("========approval link=============",[$approvalLink]); 
                return response()->json([ 'success' => true, 'order_id' => $order->id, 'paypal_order_id' => $paypalOrderId, 'approval_url' => $approvalLink['href'], ]); 
        } 
        catch (\Illuminate\Validation\ValidationException $e) { 
            throw $e; 
        } catch (\Throwable $e) { 
            Log::error('PayPal create order exception', [ 'message' => $e->getMessage(), 'file' => $e->getFile(), 'line' => $e->getLine(), ]); 
            return response()->json([ 'success' => false, 'message' => 'Something went wrong while connecting to PayPal. Check Laravel log.', ], 500);
        } 
    }
    public function success(Request $request)
    {   
        info("success tak aa gya ha"); 
        $paypalOrderId = $request->query('token');
        if (!$paypalOrderId) {
            info("=====invalid paypal response======="); 
            return redirect()->route('front-product.checkoutBag')->with('error', 'Invalid PayPal response.');
        }
        info("======order success ho gya========="); 
        $customer = Auth::guard('customer')->user();
        if (!$customer) {
            return redirect()->route('front-user.login')->with('error', 'Please login to continue.');
        }
        $order = Order::where('paypal_order_id', $paypalOrderId)
            ->where('user_id', $customer->id)
            ->where('payment_method', 'paypal')
            ->where('payment_status', 'unpaid')
            ->first();
        if (!$order) {
            info("order nhi mila"); 
            return redirect()->route('front-product.checkoutBag')->with('error', 'Order not found or already processed.');
        }
        $baseUrl = rtrim(config('services.paypal.base_url', 'https://api-m.sandbox.paypal.com'), '/');
        $tokenResponse = Http::asForm()->withBasicAuth(
            config('services.paypal.client_id'),
            config('services.paypal.client_secret')
        )->post($baseUrl.'/v1/oauth2/token', [
            'grant_type' => 'client_credentials',
        ]);
        if (!$tokenResponse->successful()) {
            Log::error('PayPal token failed', ['status' => $tokenResponse->status()]);
            return redirect()->route('front-product.checkoutBag')->with('error', 'Unable to verify PayPal payment.');
        }
        $accessToken = $tokenResponse->json('access_token');
        $captureResponse = Http::withToken($accessToken)
            ->withHeaders(['PayPal-Request-Id' => 'capture-order-'.$order->id])
            ->post($baseUrl.'/v2/checkout/orders/'.$paypalOrderId.'/capture', (object)[]);
        if (!$captureResponse->successful()) {
            Log::error('PayPal capture failed', [
                'order_id' => $order->id,
                'status' => $captureResponse->status(),
                'response' => $captureResponse->json(),
            ]);
            return redirect()->route('front-product.checkoutBag')->with('error', 'Payment capture failed. Please contact support before retrying.');
        }
        $captureData = $captureResponse->json();
        $captureStatus = data_get($captureData, 'purchase_units.0.payments.captures.0.status');
        $captureAmount = data_get($captureData, 'purchase_units.0.payments.captures.0.amount.value');
        $captureCurrency = data_get($captureData, 'purchase_units.0.payments.captures.0.amount.currency_code');
        if (($captureData['status'] ?? '') !== 'COMPLETED' || $captureStatus !== 'COMPLETED' || $captureCurrency !== config('services.paypal.currency', 'USD') || round((float) $captureAmount, 2) !== round((float) $order->total, 2)) {
            Log::error('PayPal capture verification failed', [
                'order_id' => $order->id,
                'paypal_response' => $captureData,
            ]);
            return redirect()->route('front-product.checkoutBag')->with('error', 'Payment could not be verified. Please contact support.');
        }
        $order->payment_status = 'paid';
        $order->save();
        session()->forget('buy_now');
        return view('front.paypal.success', [
            'paypalOrderId' => $paypalOrderId,
        ]);
    }

    public function cancel(Request $request, PaymentCancellationService $cancellationService)
    {
        $customer = Auth::guard('customer')->user();
        $orderId = $request->integer('order_id');
        $paypalOrderId = $request->query('token');
        if ($customer && ($orderId > 0 || $paypalOrderId)) {
            $order = Order::where('user_id', $customer->id)
                ->where('payment_method', 'paypal')
                ->where(function ($query) use ($orderId, $paypalOrderId) {
                    if ($orderId > 0) {
                        $query->where('id', $orderId);
                    }
                    if ($paypalOrderId) {
                        $method = $orderId > 0 ? 'orWhere' : 'where';
                        $query->{$method}('paypal_order_id', $paypalOrderId);
                    }
                })
                ->first();
            if ($order && $cancellationService->cancelUnpaidOrder((int) $order->id)) {
                return redirect()->route('front-product.checkoutBag')
                    ->with('error', 'Payment was cancelled. Your cart has been restored.');
            }
        }

        return redirect()->route('front-product.checkoutBag')
            ->with('error', 'PayPal payment was cancelled.');
    }

}
