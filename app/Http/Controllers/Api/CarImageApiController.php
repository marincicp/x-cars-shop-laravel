<?php

namespace App\Http\Controllers\Api;

use App\Http\Repositories\CarImageRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteCarImageRequest;
use App\Models\Car;
use Illuminate\Http\JsonResponse;

class CarImageApiController extends Controller
{

    public function __construct(private CarImageRepository $carImageRepo) {}


    /**
     * Delete car image
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DeleteCarImageRequest $request, Car $car): JsonResponse
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
