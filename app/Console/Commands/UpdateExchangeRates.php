<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\NewCountry; 
use Illuminate\Support\Facades\Http;
class UpdateExchangeRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-exchange-rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $response = Http::timeout(30)->get('https://open.er-api.com/v6/latest/INR');
            if (!$response->successful() || $response->json('result') !== 'success') {
                $this->error('Exchange rate API failed.');
                return self::FAILURE;
            }

            $rates = $response->json('rates', []);

            foreach (NewCountry::whereNotNull('currency_code')->get() as $country) {
                $currency = strtoupper(trim($country->currency_code));

                if (isset($rates[$currency])) {
                    $country->exchange_rates = $rates[$currency];
                    $country->save();
                }
            }

            $this->info('Country exchange rates updated successfully.');
            return self::SUCCESS;
        } catch (\Throwable $e) {
            report($e);
            $this->error('Update failed: '.$e->getMessage());
            return self::FAILURE;
        }
    }
}
