<?php
// database/seeders/WorldLocationSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WorldLocationSeeder extends Seeder
{
    public function run()
    {
        $this->command->info('Starting World Location Seeder...');
        
        // Method 1: Using REST Countries API (for countries only)
        $this->seedFromAPI();
        
        // Method 2: If API fails, use sample data
        if (Country::count() == 0) {
            $this->command->warn('API failed. Using sample data...');
            $this->seedSampleData();
        }
        
        $this->command->info('Location seeding completed!');
    }
    
    private function seedFromAPI()
    {
        try {
            // Fetch countries from REST Countries API
            $response = Http::get('https://restcountries.com/v3.1/all?fields=name,idd,cca2');
            
            if ($response->successful()) {
                $countries = $response->json();
                
                foreach ($countries as $countryData) {
                    // Extract phone code
                    $phonecode = '';
                    if (isset($countryData['idd'])) {
                        $root = $countryData['idd']['root'] ?? '';
                        $suffixes = $countryData['idd']['suffixes'] ?? [''];
                        $phonecode = $root . ($suffixes[0] ?? '');
                    }
                    
                    $country = Country::create([
                        'name' => $countryData['name']['common'] ?? $countryData['name']['official'] ?? 'Unknown',
                        'iso2' => $countryData['cca2'] ?? null,
                        'phonecode' => $phonecode ?: null,
                    ]);
                    
                    $this->command->info("Added country: {$country->name}");
                    
                    // For each country, add some major states/cities
                    // Note: Getting real state/city data requires another API
                    $this->addSampleStatesForCountry($country);
                }
            } else {
                throw new \Exception('API request failed');
            }
        } catch (\Exception $e) {
            Log::error('Country API failed: ' . $e->getMessage());
            $this->command->error('Failed to fetch from API: ' . $e->getMessage());
        }
    }
    
    private function addSampleStatesForCountry($country)
    {
        // Add sample states based on country
        $sampleStates = [
            'India' => [
                'Maharashtra' => ['Mumbai', 'Pune', 'Nagpur'],
                'Delhi' => ['New Delhi', 'North Delhi'],
                'Karnataka' => ['Bengaluru', 'Mysore'],
                'Tamil Nadu' => ['Chennai', 'Coimbatore'],
                'Gujarat' => ['Ahmedabad', 'Surat'],
            ],
            'United States' => [
                'California' => ['Los Angeles', 'San Francisco', 'San Diego'],
                'New York' => ['New York City', 'Buffalo'],
                'Texas' => ['Houston', 'Dallas', 'Austin'],
                'Florida' => ['Miami', 'Orlando'],
            ],
            'United Kingdom' => [
                'England' => ['London', 'Manchester', 'Birmingham'],
                'Scotland' => ['Edinburgh', 'Glasgow'],
                'Wales' => ['Cardiff', 'Swansea'],
            ],
        ];
        
        if (isset($sampleStates[$country->name])) {
            foreach ($sampleStates[$country->name] as $stateName => $cities) {
                $state = State::create([
                    'name' => $stateName,
                    'country_id' => $country->id,
                ]);
                
                foreach ($cities as $cityName) {
                    City::create([
                        'name' => $cityName,
                        'state_id' => $state->id,
                    ]);
                }
            }
        } else {
            // Add a default state for other countries
            $state = State::create([
                'name' => $country->name,
                'country_id' => $country->id,
            ]);
            
            City::create([
                'name' => $country->name,
                'state_id' => $state->id,
            ]);
        }
    }
    
    private function seedSampleData()
    {
        // Sample data as fallback
        $countries = [
            ['name' => 'India', 'phonecode' => '91'],
            ['name' => 'United States', 'phonecode' => '1'],
            ['name' => 'United Kingdom', 'phonecode' => '44'],
            ['name' => 'Canada', 'phonecode' => '1'],
            ['name' => 'Australia', 'phonecode' => '61'],
            ['name' => 'Germany', 'phonecode' => '49'],
            ['name' => 'France', 'phonecode' => '33'],
            ['name' => 'Japan', 'phonecode' => '81'],
            ['name' => 'China', 'phonecode' => '86'],
            ['name' => 'Singapore', 'phonecode' => '65'],
            ['name' => 'UAE', 'phonecode' => '971'],
            ['name' => 'Saudi Arabia', 'phonecode' => '966'],
            ['name' => 'South Africa', 'phonecode' => '27'],
            ['name' => 'Brazil', 'phonecode' => '55'],
            ['name' => 'Russia', 'phonecode' => '7'],
        ];
        
        foreach ($countries as $countryData) {
            $country = Country::create($countryData);
            
            // Add 2-3 states for each country
            for ($i = 1; $i <= 3; $i++) {
                $state = State::create([
                    'name' => $country->name . ' State ' . $i,
                    'country_id' => $country->id,
                ]);
                
                // Add 3-5 cities for each state
                for ($j = 1; $j <= 5; $j++) {
                    City::create([
                        'name' => $state->name . ' City ' . $j,
                        'state_id' => $state->id,
                    ]);
                }
            }
        }
    }
}