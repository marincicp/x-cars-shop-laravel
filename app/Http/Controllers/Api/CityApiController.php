<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\State;

class CityApiController extends Controller
{
    /**
     * Get all citites by state
     */
    public function getCitiesByState(string $id)
    {
        $state = State::with('cities')->find($id);

        if (! $state) {
            return response()->json(['message' => 'State not found'], 404);
        }

        return response()->json($state->cities);
    }
}
