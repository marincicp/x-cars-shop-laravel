<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

use Illuminate\Http\Request;

class EmailVerificationPromptController extends Controller
{


    /**
     * Show the email verification prompt page.
     */
    public function __invoke(Request $request): View
    {
        return view("auth.verify-email");
    }
}
