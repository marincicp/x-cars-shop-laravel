<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class LoginController extends Controller
{


    public function create(): View
    {
        return view("auth.login");
    }



    public function store(StoreUserLoginRequest $request)
    {
        $userData = $request->validated();

        if (! Auth::attempt($userData)) {
            throw ValidationException::withMessages(
                ["email" => "Sorry, those crendentials do not match."]
            );
        }

        $request->session()->regenerate();

        return redirect("/");
    }

    public function destroy()
    {
        Auth::logout();
        return redirect("/");
    }
}
