<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Maker;

class ModelApiController extends Controller
{
    /**
     * Get all models by maker
     */
    public function getModelsByMaker(string $id)
    {
        $maker = Maker::with("models")->find($id);

        if (!$maker) {
            return response()->json(['error' => 'Maker not found'], 404);
        }

        return response()->json($maker->models);
    }
}
