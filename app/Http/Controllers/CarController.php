<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // TODO
        $cars = User::find(1)->cars()->with(["primaryImage", "model", "maker"])->orderBy("created_at", "desc")->paginate(15);

        return view("car.index", ["cars" => $cars]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("car.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

    public function search()
    {
        $query = Car::select("cars.*")->with("model", "maker", "carType", "primaryImage", "city", "fuelType")->where("published_at", "<", now())->orderBy("published_at", "desc");

        $cars = $query->paginate(15);

        return view(
            "car.search",
            ["cars" => $cars]
        );
    }


    /**
     * Display a list  of the user favorite cars.
     */
    public function watchlist()
    {
        // TODO user hardcoded
        $cars = User::find(5)->favoriteCars()->with(["carType", "fuelType", "maker", "model",  "city", "primaryImage"])->paginate(15);

        return view("car.watchlist", ["cars" => $cars]);
    }
}
