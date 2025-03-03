<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserLoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;

class LoginController extends Controller
{


    public function create(): View
    {
        return view("auth.login");
    }



    public function store(StoreUserLoginRequest $request)
    {

        $validatedData = $request->validated();

        if (! Auth::attempt($validatedData)) {
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



    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleLogin(Request $request)
    {
        $googleUser = Socialite::driver('google')->user();
        $user = User::where("email", $googleUser->email)->first();

        if (!$user) {
            $user = User::create(
                [
                    "name" => $googleUser->getName(),
                    "email" => $googleUser->getEmail(),
                    "google_id" => $googleUser->getId(),
                    "password" => bcrypt(uniqid()),
                ]
            );
        };

        Auth::login($user);
        $request->session()->regenerate();
        return redirect("/");
    }
}
