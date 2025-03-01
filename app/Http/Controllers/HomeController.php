<?php

namespace App\Http\Controllers;

use App\Models\Car;
use View;

class HomeController extends Controller
{
    protected array $dropdownCachedData;

    public function __construct()
    {
        $this->dropdownCachedData = DropdownController::getDropdownData();
    }

    public  function index()
    {
        $cars = Car::with(["carType", "fuelType", "maker", "model",  "city", "primaryImage"])->where("published_at", "<", now())->orderBy("published_at", "desc")->paginate(15);

        return View("home.index",  array_merge(["cars" => $cars], $this->dropdownCachedData));
    }
}
