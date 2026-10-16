<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\NewCountry;

class AddCountryWiseSymbolInDb extends Command
{
    protected $signature = 'app:add-countryWiseSymbol';
    protected $description = 'Import country and currency data into database';

    public function handle()
    {
        try {
            $offset = 0;
            $limit = 100;
            $total = 0;

            do {
                $ch = curl_init(
                    "https://api.restcountries.com/countries/v5?limit={$limit}&offset={$offset}"
                );

                curl_setopt_array($ch, [
                    CURLOPT_HTTPHEADER => [
                        'Authorization: Bearer ' . config('services.restcountries.key')
                    ],
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_TIMEOUT => 60,
                ]);

                $response = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                if ($response === false || $httpCode < 200 || $httpCode >= 300) {
                    $error = curl_error($ch);
                    curl_close($ch);
                    $this->error("API request failed. HTTP: {$httpCode} {$error}");
                    return self::FAILURE;
                }

                curl_close($ch);
                $result = json_decode($response, true);

                if (isset($result['errors'])) {
                    $this->error(json_encode($result['errors']));
                    return self::FAILURE;
                }

                $countries = $result['data']['objects'] ?? [];
                $meta = $result['data']['meta'] ?? [];

                foreach ($countries as $item) {
                    $iso2 = $item['codes']['alpha_2'] ?? null;
                    $name = $item['names']['common'] ?? null;

                    if (!$iso2 || !$name) {
                        continue;
                    }

                    $callingCodes = $item['calling_codes'] ?? [];
                    $currencies = $item['currencies'] ?? [];
                    info("===============currencies================",[$currencies]); 
                    $currency = (is_array($currencies) && isset($currencies[0]) && is_array($currencies[0])) ? $currencies[0] : [];
                    $currencyCode = $currency['code'] ?? null;
                    $currencySymbol = $currency['symbol'] ?? null;
                    $currencySymbolName = $currency['name'] ?? null;
                    info("======symbol name========",[$currencySymbolName]); 

                    NewCountry::updateOrCreate(
                        ['iso2' => $iso2],
                        [
                            'name' => $name,
                            'iso3' => $item['codes']['alpha_3'] ?? null,
                            'phone_code' => is_array($callingCodes) ? implode(',', $callingCodes) : $callingCodes,
                            'currency_symbol_name'=>$currencySymbolName,
                            'currency_code' => $currencyCode,
                            'currency_symbol' => $currencySymbol ?? null,
                            'flag' => $item['flag']['url_png'] ?? null,
                        ]
                    );

                    $total++;
                }

                $offset += $limit;
                $more = $meta['more'] ?? false;

            } while ($more);

            $this->info("Country import completed. Processed: {$total}");
            return self::SUCCESS;

        } catch (\Throwable $e) {
            $this->error($e->getMessage());
            return self::FAILURE;
        }
    }
}