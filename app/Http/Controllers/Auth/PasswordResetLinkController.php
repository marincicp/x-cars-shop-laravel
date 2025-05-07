<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
    /**
     * Show the password reset link page
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /***
     * Handle an icoming password link request
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate(['email' => ['email', 'required']]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT ?
            back()->with(['message.success' => __($status)]) :
            back()->withErrors(['email' => __($status)]);
    }
}
