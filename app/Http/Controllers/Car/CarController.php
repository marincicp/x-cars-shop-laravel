<?php

namespace App\Http\Controllers\Car;

use App\Constants\CarFeatures;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DropdownController;
use App\Http\Repositories\CarRepository;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Models\Car;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
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
     * Show all cars added by authenticated user
     * @return View
     */
    public function index(): View
    {
        $cars = $this->carRepo->getCurrentUserAddedCars();

        return view("car.index", ["cars" => $cars]);
    }

    /**
     * Show the create car page.
     */
    public function create(Request $request): View
    {
        return view("car.create", array_merge($this->dropdownCachedData, ["carFeatures" => CarFeatures::FEATURES]));
    }

    /**
     * Store a newly created car in the database
     */
    public function store(StoreCarRequest $request)
    {
        $validatedData = $request->validated();

        $car = $this->carRepo->createCar($validatedData);

        return to_route("car.show", $car)->with([
            "message.success" => "Car successfully created."
        ]);
    }

    /**
     *  Display the car details
     * @param \App\Models\Car $car
     * @return View
     */
    public function show(Car $car)
    {

        $isInWatchList = $this->carRepo->isFavoriteCar($car);
        return view("car.show", ["car" => $car, "isInWatchList" => $isInWatchList]);
    }



    /**
     * Show the form for editing the car
     * @param \App\Models\Car $car
     * @return View
     */
    public function edit(Car $car): View
    {

        $models = $car->maker->models;
        $currentStateCities = $car->city->state->cities;
        $currentMakerModels = $car->model->maker->models;
        $carFeatures = CarFeatures::FEATURES;

        return view("car.edit", array_merge(compact("car", "models", "currentStateCities", "currentMakerModels", "carFeatures"), $this->dropdownCachedData));
    }

    /**
     * Handle the request to update a car in the database
     * @param \App\Http\Requests\UpdateCarRequest $request
     * @param \App\Models\Car $car
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCarRequest $request,  Car $car): RedirectResponse
    {
        $validatedData = $request->validated();
        $this->carRepo->updateCar($car, $validatedData);

        return to_route("car.index")->with(["message.success" => "Car successfully updated."]);
    }

    /**
     * Handle the request to delete a car in the database
     * @param \App\Models\Car $car
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Car $car): RedirectResponse
    {
        $this->carRepo->deleteCar($car);

        session()->flash("message", "Car successfully deleted.");
        // return to_route("car.index")->with(["message" => "Car successfully deleted.", "type" => "success"]);
        return to_route("car.index");
    }
}
