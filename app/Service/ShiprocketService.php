<?php

namespace App\Service;

use Illuminate\Support\Facades\Http;

class ShiprocketService
{
    protected $baseUrl = "https://apiv2.shiprocket.in/v1/external";
    protected $token;

    public function __construct()
    {
        $this->authenticate();
    }

    private function authenticate()
    {
        $response = Http::post($this->baseUrl . '/auth/login', [
            'email' => config('services.shiprocket.email'),
            'password' => config('services.shiprocket.password'),
        ]);

        if ($response->successful()) {
            $this->token = $response->json('token');
        } else {
            throw new \Exception('Shiprocket authentication failed');
        }
    }

    public function checkServiceability($pickupPincode, $deliveryPincode, $weight = 1, $cod = 0, $is_return = 0)
    {
        $response = Http::withToken($this->token)
            ->get($this->baseUrl . '/courier/serviceability', [
                'pickup_postcode' => $pickupPincode,
                'delivery_postcode' => $deliveryPincode,
                'cod' => $cod,
                'is_return' => $is_return,
                'weight' => $weight,
            ]);

        return $response->json();
    }
}
