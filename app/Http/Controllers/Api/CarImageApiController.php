<?php

namespace App\Http\Controllers\Api;

use App\Http\Repositories\CarImageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteCarImageRequest;
use App\Models\Car;

class CarImageApiController extends Controller
{

    public function __construct(private CarImageRepository $carImageRepo) {}

    public function destroy(DeleteCarImageRequest $request, Car $car)
    {

        $validateData = $request->validated();

        $imageId = $validateData["image_id"];

        $res = $this->carImageRepo->deleteCarImage($car, $imageId);


        if (!$res) {
            return response()->json([
                'message' => "Car image could not be deleted"
            ], 400);
        }

        return response()->json([
            'message' => "Car image deleted successfully"
        ]);
    }
}
