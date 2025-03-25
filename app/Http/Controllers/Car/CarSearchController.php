<?php

namespace App\Http\Controllers\Car;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DropdownController;
use App\Http\Repositories\CarRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarSearchController extends Controller
{

    private array $dropdownCachedData;


    public function __construct(protected CarRepository $carRepo)
    {
        $this->dropdownCachedData = DropdownController::getDropdownData();
    }


    /**
     * Handle the car search request based on user-provided filters.
     */
    public function __invoke(Request $request)
    {

        $favoriteCars = [];

        $cars = $this->carRepo->getCarsByQueryParams($request);


        if (Auth::check()) {
            $favoriteCars = Auth::user()->favoriteCars()->pluck("car_id")->toArray();
        }

        return view(
            "car.search",
            array_merge(["cars" => $cars, "favCars" => $favoriteCars], $this->dropdownCachedData)
        );
    }
}
