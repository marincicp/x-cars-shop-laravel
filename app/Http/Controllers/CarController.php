<?php

namespace App\Http\Controllers;

use App\Constants\CarFeatures;
use App\Http\Repositories\CarRepository;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{

    private array $dropdownCachedData;


    public function __construct(protected CarRepository $carRepo)
    {
        $this->carRepo = $carRepo;
        $this->dropdownCachedData = DropdownController::getDropdownData();
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = $this->carRepo->getCurrentUserAddedCars();

        return view("car.index", ["cars" => $cars]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view("car.create", array_merge($this->dropdownCachedData, ["carFeatures" => CarFeatures::FEATURES]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarRequest $request)
    {
        $validatedData = $request->validated();

        $car = $this->carRepo->createCar($validatedData);

        return to_route("car.show", $car)->with([
            "message" => "Car successfully created.",
            "type" => "success"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {

        $isInWatchList = $this->carRepo->isFavoriteCar($car);
        return view("car.show", ["car" => $car, "isInWatchList" => $isInWatchList]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {

        $models = $car->maker->models;
        $currentStateCities = $car->city->state->cities;
        $currentMakerModels = $car->model->maker->models;
        $carFeatures = CarFeatures::FEATURES;

        return view("car.edit", array_merge(compact("car", "models", "currentStateCities", "currentMakerModels", "carFeatures"), $this->dropdownCachedData));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarRequest $request,  Car $car)
    {
        $validatedData = $request->validated();
        $this->carRepo->updateCar($car, $validatedData);

        return to_route("car.index")->with(["message" => "Car successfully updated.", "type" => "success"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $this->carRepo->deleteCar($car);

        session()->flash("message", "Car successfully deleted.");
        // return to_route("car.index")->with(["message" => "Car successfully deleted.", "type" => "success"]);
        return to_route("car.index");
    }

    public function search(Request $request)
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


    /**
     * Display a list  of the user favorite cars.
     */
    public function watchlist()
    {
        $cars = $this->carRepo->getCurrentUserFavoriteCars();

        return view("car.watchlist", ["cars" => $cars]);
    }


    public function addToWatchlist(Car $car)
    {

        $res =  $this->carRepo->addToWatchilst($car);
        if ($res) {
            // return to_route("home")->with("message", "Car successfully added to watchlist");
            return back()->with("message", "Car successfully added to watchlist");
        } else {
            return back();
        }
    }


    public function removeFromWatchlist(Car $car)
    {
        $res = $this->carRepo->removeFromWatchlist($car);

        if ($res) {
            // return to_route("home")->with("message", "Car successfully removed from watchlist");
            return back()->with("message", "Car successfully removed from watchlist");
        } else {
            return back();
        }
    }
}
