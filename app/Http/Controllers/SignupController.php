<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRegisterForm;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SignupController extends Controller
{


    public function create(): View
    {
        return view("auth.signup");
    }


    public function store(StoreUserRegisterForm $request): RedirectResponse
    {

        $userData = $request->validated();
        $userData["name"] = $userData["firstName"] . " " . $userData["lastName"];

        $user = User::create($userData);

        Auth::login($user);
        return redirect("/");
    }
}
