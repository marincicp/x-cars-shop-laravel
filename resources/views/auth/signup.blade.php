<x-guest-layout title="Signup" bodyClass="page-signup">


    <form action="{{ route('register') }}" method="post">
        @csrf
        <div class="form-group">
            <input name="email" type="email" placeholder="Your Email" />
        </div>
        <div class="form-group">
            <input name="password" type="password" placeholder="Your Password" />
        </div>
        <div class="form-group">
            <input name="password_confirmation" type="password" placeholder="Repeat Password" />
        </div>
        <hr />
        <div class="form-group">
            <input name="firstName" type="text" placeholder="First Name" />
        </div>
        <div class="form-group">
            <input name="lastName" type="text" placeholder="Last Name" />
        </div>
        <div class="form-group">
            <input name="phone" type="text" placeholder="Phone" />
        </div>
        <button class="btn btn-primary btn-login w-full">Register</button>

        <div class="grid grid-cols-2 gap-1 social-auth-buttons">
            <x-google-button />
            <x-fb-button />
        </div>
        <div class="login-text-dont-have-account">
            Already have an account? -
            <a href="{{ route('login') }}"> Click here to login </a>
        </div>
    </form>

</x-guest-layout>
