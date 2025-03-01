<?php

namespace App\Http\Controllers;

use App\Models\CarType;
use App\Models\FuelType;
use App\Models\Maker;
use App\Models\State;
use Illuminate\Support\Facades\Cache;

class DropdownController extends Controller
{


    public static function getDropdownData()
    {
        return Cache::remember("dropdownData", now()->addHour(), function (): array {
            return [
                "makers" => Maker::all(),
                "states" => State::all(),
                "fuelTypes" => FuelType::all(),
                "carTypes" => CarType::all()
            ];
        });
    }
}
