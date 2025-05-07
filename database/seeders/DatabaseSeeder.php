<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarFeatures;
use App\Models\CarImage;
use App\Models\CarType;
use App\Models\City;
use App\Models\FuelType;
use App\Models\Maker;
use App\Models\Model;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        CarType::factory()->sequence(
            ['name' => 'Sedan'],
            ['name' => 'Hatchback'],
            ['name' => 'Minivan'],
            ['name' => 'Jeep'],
            ['name' => 'Coupe'],
            ['name' => 'Sport Car'],
        )->count(6)->create();

        FuelType::factory()->sequence(
            ['name' => 'Gas'],
            ['name' => 'Diesel'],
            ['name' => 'Electric'],
            ['name' => 'Hybrid'],
        )->count(4)->create();

        /////////////////////////////////////////
        // STATES
        $states = [
            'California' => ['Los Angeles', 'San Diego'],
            'Texas' => ['Houston', 'Dallas'],
            'Florida' => ['Los Miami', 'Tampa'],
            'New York' => ['Buffalo', 'NY City'],
            'Illinois' => ['Chicago', 'Aurora'],
        ];

        foreach ($states as $stateName => $cities) {
            $citiesFormated = [];
            foreach ($cities as $city) {
                $citiesFormated[] = ['name' => $city];
            }

            $cityFactory = City::factory()->sequence(...$citiesFormated)->count(count($cities));

            State::factory()->has($cityFactory, 'cities')->create(['name' => $stateName]);
        }

        ///////////////////////////////////////////
        // MAKERS
        $makers = [
            'Toyota' => ['Camry', 'Corolla', 'RAV4'],
            'Ford' => ['Explorer', 'F150', 'Mustang'],
            'Honda' => ['Civic', 'Pilot', 'Accord'],
            'Nissan' => ['Maxima', 'Aktima', 'Sentra'],
            'Lexus' => ['RX400', 'RX450'],
        ];

        foreach ($makers as $maker => $models) {
            $modelsArr = [];
            foreach ($models as $car) {
                $modelsArr[] = ['name' => $car];
            }

            $modelFactory = Model::factory()->count(count($models))->sequence(...$modelsArr);

            Maker::factory()->has($modelFactory, 'models')->create(['name' => $maker]);
        }

        User::factory()->count(3)->create();

        $data = User::factory()->count(2)
            ->has(Car::factory()->count(50)->has(CarImage::factory()->count(5)->sequence(
                ['position' => 1],
                ['position' => 2],
                ['position' => 3],
                ['position' => 4],
                ['position' => 5],
            ), 'images')->has(CarFeatures::factory(), 'features'), 'favoriteCars')->create();
    }
}
