<?php

?>

<x-guest-layout title="Login" bodyClass="page-login">
    <form action="{{ route('store') }}" method="POST">
        @csrf
        <div class="form-group">
            <input name="email" type="email" placeholder="Your Email" />

            @if ($errors->has('email'))
                <p">{{ $errors->first('email') }}</p>
            @endif
        </div>
        <div class="form-group">
            <input name="password" type="password" placeholder="Your Password" />
            @if ($errors->has('password'))
                <p">{{ $errors->first('password') }}</p>
            @endif
        </div>
        <div class="text-right mb-medium">
            <a href="/password-reset.html" class="auth-page-password-reset">Reset Password</a>
        </div>

        <button class="btn btn-primary btn-login w-full" type="submit">Login</button>

        <div class="grid grid-cols-2 gap-1 social-auth-buttons">
            <x-google-button />
            <x-fb-button />
        </div>
        <div class="login-text-dont-have-account">
            Don't have an account? -
            <a href="{{ route('signup') }}"> Click here to create one</a>
        </div>
    </form>
</x-guest-layout>
