<?php

namespace App\Console\Commands;

use App\Models\Country;
use App\Models\District;
use App\Models\Region;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\Console\Command\Command as CommandAlias;

class GetAreas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:areas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get areas';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        try {
            $ask = $this->ask(
                'Do you have internet connection? (y/n)',
            );
            if ($ask === 'n') {
                $this->alert("Please find internet connection.");
                return CommandAlias::FAILURE;
            }
            if (connection_status() != 0) {
                $this->alert("You don't have internet connection");
                return CommandAlias::FAILURE;
            }
            if (is_null(config('services.hh_api_url'))) {
                $this->alert('Put HH_API_URL value to .env');
            }
            $data = Http::get(config('services.hh_api_url'))->json();
            $countries = array_column($data, 'name');
            $key = $this->choice('Which country?', $countries);
            $country = $data[array_search($key, $countries)];
            $country_id = Country::create([
                'name' => $country['name'],
                'code' => Str::slug($country['name']),
            ])->id;
            foreach ($country['areas'] as $region) {
                $region_id = Region::create([
                    'name' => $region['name'],
                    'code' => Str::slug($region['name']),
                    'country_id' => $country_id,
                ])->id;
                foreach ($region['areas'] as $district) {
                    District::create([
                        'name' => $district['name'],
                        'code' => Str::slug($district['name']),
                        'country_id' => $country_id,
                        'region_id' => $region_id,
                    ]);
                }
            }
            $this->alert('Areas saved!');
        } catch (\Exception $exception) {
            $this->alert('Error occurred! See logs!');
            Log::info('Error on command GetAreas',
                [
                    'message' => $exception->getMessage(),
                    'line' => $exception->getLine(),
                ]
            );
        }
        return CommandAlias::SUCCESS;
    }
}
