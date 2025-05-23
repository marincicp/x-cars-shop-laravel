<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserLoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /**
     * Show the login page
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * * Handle an incoming authentication request
     */
    public function store(StoreUserLoginRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        if (! Auth::attempt($validatedData)) {
            throw ValidationException::withMessages(
                ['email' => 'Sorry, those crendentials do not match.']
            );
        }

        $request->session()->regenerate();

        return redirect('/');
    }

    /**
     * Destroy an authenticated session
     */
    public function destroy(): RedirectResponse
    {
        Auth::logout();

        return redirect('/');
    }

    /**
     * Redirect the user to the Google authentication page
     *
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle the callback from Google after authentication
     */
    public function handleGoogleCallback(Request $request): RedirectResponse
    {
        $googleUser = Socialite::driver('google')->user();
        $user = User::where('email', $googleUser->email)->first();

        if (! $user) {
            $user = User::create(
                [
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => bcrypt(uniqid()),
                ]
            );
        }

        Auth::login($user);

        $request->session()->regenerate();

        if (! $user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        return redirect('/');
    }
}
