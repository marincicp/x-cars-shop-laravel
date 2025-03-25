<x-guest-layout title="Login" bodyClass="page-login">

    <x-form action="{{ route('store') }}" method="POST">
        <x-form.input type="email" name="email" placeholder="Your Email" marginB />

        <x-form.input type="password" name="password" placeholder="Your Password" marginB />


        <div class="text-right mb-medium">
            <a href="{{ route('password.request') }}" class="auth-page-password-reset">Reset Password</a>
        </div>


        <x-form.button>Login</x-form.button>
        <div class="grid  gap-1 social-auth-buttons">
            <x-google-button />
        </div>
        <div class="login-text-dont-have-account">
            Don't have an account? -
            <a href="{{ route('signup') }}"> Click here to create one</a>
        </div>


    </x-form>

</x-guest-layout>
