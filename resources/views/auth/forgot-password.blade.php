<x-app-layout>

    <main>
        <div class="container-small page-login">
            <div class="flex" style="gap: 5rem">
                <div class="auth-page-form">

                    <h1 class="auth-page-title">Request Password Reset</h1>

                    <x-form.form action="{{ route('password.email') }}" method="POST">


                        <div class="form-group">
                            <input type="email" placeholder="Your Email" name="email" old("email") />
                        </div>

                        <button type="submit" class="btn btn-primary btn-login w-full">
                            Request password reset
                        </button>

                        <div class="login-text-dont-have-account">
                            Already have an account? -
                            <a href=""> Click here to login </a>
                        </div>
                    </x-form.form>
                </div>
                <div class="auth-page-image">
                    <img src="/img/car-png-39071.png" alt="" class="img-responsive" />
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
