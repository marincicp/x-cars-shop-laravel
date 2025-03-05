<?php

namespace App\Http\Controllers;

use App\Constants\CarFeatures;
use App\Http\Repositories\CarRepository;
use App\Http\Requests\StoreCarRequest;
use App\Models\Car;
use Illuminate\Http\Request;

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

        return view("car.show", ["car" => $car]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return view("car.show", ["car" => $car]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        return view("car.edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        //
    }

    public function search(Request $request)
    {

        $cars = $this->carRepo->getCarsByQueryParams($request);

        return view(
            "car.search",
            array_merge(["cars" => $cars], $this->dropdownCachedData)
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
}