<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{

    /**
     * Send a new email verification notification
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return  redirect()->intended(route("home"));
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with("message.success", "Verficiation link sent!");
    }
}
