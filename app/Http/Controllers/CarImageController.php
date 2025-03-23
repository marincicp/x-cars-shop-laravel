<?php

namespace App\Http\Controllers;

use App\Http\Repositories\CarImageRepository;
use App\Http\Requests\UpdateCarImagesRequest;
use App\Models\Car;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CarImageController extends Controller
{


    public function __construct(protected CarImageRepository $carImageRepo) {}

    /**
     * Display car image form.
     * @return View
     */
    public function editImages(Car $car): View
    {
        return view("car.edit-images", ["car" => $car]);
    }



    /**
     * Change the order of car images
     * @return RedirectResponse
     */
    public function updateImages(UpdateCarImagesRequest $request, Car $car): RedirectResponse
    {

        $validatedData = $request->validated();

        $this->carImageRepo->updateCarImageOrder($car, $validatedData);


        return to_route("car.index")->with([
            "message" => "Car images successfully updated.",
            "type" => "success"
        ]);
    }
}
