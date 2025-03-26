<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRegisterForm;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SignupController extends Controller
{



    /**
     * Show the signup page
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        return view("auth.signup");
    }


    /**
     * Handle an incoming registration request 
     * @param \App\Http\Requests\StoreUserRegisterForm $request
     * @return RedirectResponse
     */
    public function store(StoreUserRegisterForm $request)
    {

        $userData = $request->validated();
        $userData["name"] = $userData["firstName"] . " " . $userData["lastName"];
        $user = User::create($userData);

        Auth::login($user);

        event(new Registered($user));

        return to_route("verification.notice");
    }
}
