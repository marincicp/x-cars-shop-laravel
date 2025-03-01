<x-guest-layout title="Signup" bodyClass="page-signup">


    <x-form action="{{ route('register') }}" method="post">
        <x-form.input type="email" name="email" placeholder="Your Email" marginB />

        <x-form.input type="password" name="password" placeholder="Your Password" marginB />

        <x-form.input type="password" name="password_confirmation" placeholder="Repeat Password" marginB />

        <x-form.input name="firstName" placeholder="First Name" marginB />
        <x-form.input name="lastName" placeholder="Last Name" marginB />
        <x-form.input name="phone" placeholder="Phone" marginB />

        <x-form.button>Register</x-form.button>

        <div class="grid grid-cols-2 gap-1 social-auth-buttons">
            <x-google-button />
            <x-fb-button />
        </div>
        <div class="login-text-dont-have-account">
            Already have an account? -
            <a href="{{ route('login') }}"> Click here to login </a>
        </div>
    </x-form>

</x-guest-layout>
