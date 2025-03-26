<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{


    /**
     * Show the change password form page
     * @return View
     */
    public function edit(): View
    {
        return view("profile.change-password");
    }


    /**
     * Update the user's password
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {

        $request->validate([
            "current_password" => ["required", "string", "current_password"],
            "password" => ["required", "string", Password::default()]
        ]);

        $request->user()->update(
            [
                "password" => Hash::make($request["password"])
            ]
        );

        return to_route("user.edit", $request->user())->with(["message.succes", "Password updated successfully"]);
    }
}
