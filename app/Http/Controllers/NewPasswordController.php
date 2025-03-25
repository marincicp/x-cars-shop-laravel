<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class NewPasswordController extends Controller
{

    /**
     * Show the password reset page.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        $token = $request->route("token");
        return view("auth.reset-password", ["token" => $token]);
    }




    /**
     * Handle an incoming new password request
     * 
     */
    public function store(Request $request): RedirectResponse
    {

        // todo change password validation
        $request->validate([
            "token" => ["required"],
            "email" => ["email", "required"],
            "password" => ["required", "min:3", "confirmed"]

        ]);

        $status = Password::reset(
            $request->only("email", "password", "password_confirmation", "token"),
            function (User $user, string $password) {
                $user->forceFill([
                    "password" => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }

        );

        if ($status === Password::PASSWORD_RESET) {
            return to_route("login")->with("message.success", __($status));
        }

        throw ValidationException::withMessages(["email" => __($status)]);
    }
}
