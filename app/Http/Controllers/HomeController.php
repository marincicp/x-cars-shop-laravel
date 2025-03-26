<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    protected array $dropdownCachedData;

    public function __construct()
    {
        $this->dropdownCachedData = DropdownController::getDropdownData();
    }

    public  function index(): View
    {
        $favoriteCars = [];
        $cars = Car::with(["carType", "fuelType", "maker", "model",  "city", "primaryImage"])->where("published_at", "<", now())->orderBy("published_at", "desc")->paginate(15);

        if (Auth::check()) {
            $favoriteCars = Auth::user()->favoriteCars()->pluck("car_id")->toArray();
        }

        return View("home.index",  array_merge(["cars" => $cars, "favCars" => $favoriteCars], $this->dropdownCachedData));
    }
}
