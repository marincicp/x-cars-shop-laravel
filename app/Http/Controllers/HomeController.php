<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\FuelType;
use App\Models\Maker;
use App\Models\Model;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Matcher\Not;

class HomeController extends Controller
{

    public function index()
    {
        $cars = Car::with(["carType", "fuelType", "maker", "model",  "city", "primaryImage"])->where("published_at", "<", now())->orderBy("published_at", "desc")->limit(39)->get();

        return view("home.index", ["cars" => $cars]);
    }
}
