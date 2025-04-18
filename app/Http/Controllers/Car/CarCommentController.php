<?php

namespace App\Http\Controllers\Car;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\CarComment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarCommentController extends Controller
{

    /**
     * Store the newly created comment to the database.
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Car $car
     * @return RedirectResponse
     */
    public function store(
        Request $request,
        Car $car
    ): RedirectResponse {

        $data = $request->validate(["comment" => ["string", "required", "min:3", "max:200"]]);

        $car->comments()->create(["comment" => $data["comment"], "user_id" => Auth::user()->id]);

        return back()->with("message.success", "Comment successfully created.");
    }


    public function destroy(CarComment $comment): RedirectResponse
    {

        $comment->delete();

        return back()->with("message.success", "Comment successfuly deleted");
    }
}
