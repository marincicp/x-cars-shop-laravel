@props(['title' => 'Set a new password'])
<x-base-layout :$title>

    <main>
        <div class="container-xs page-login mt-large">
            <div class="text-center mb-large ">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('/img/cars-logo.png') }}" alt="logo" />
                </a>
            </div>
            <div class="flex" style="gap: 5rem">
                <div class="auth-page-form">
                    <h1 class="auth-page-title">Set a new password</h1>
                    <x-form.form action="{{ route('password.store') }}" method="POST">
                        <x-form.input type="email" name="email" placeholder="Your Email" marginB />

                        <x-form.input type="password" name="password" placeholder="Your Password" marginB />
                        <x-form.input type="password" name="password_confirmation" placeholder="Repeat Password"
                            marginB />

                        <x-form.input type="hidden" name="token" defaultValue="{{ $token }}" />

                        <x-form.button>Reset</x-form.button>

                    </x-form.form>
                </div>
            </div>
    </main>
    </x-guest-layout>
