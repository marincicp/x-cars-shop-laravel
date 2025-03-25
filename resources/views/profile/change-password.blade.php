<x-app-layout>
    <main>
        <x-alert />
        <div class="container-small mt-xl">

            <div class="flex justify-between items-center ">
                <h1 class="car-details-page-title">Change password</h1>
                <a href="{{ route('user.edit', Auth::user()) }}" class="auth-page-password-reset">Edit your profile</a>
            </div>



            <x-form.form method="POST" extraMethod="PUT" action="{{ route('password.update') }}"
                class="card add-new-car-form mt-medium">
                <div class="form-content">

                    <div class="col">

                        <x-form.input type="password" label="Current password" name="current_password" marginB />
                        <x-form.input type="password" label="New password" name="password" marginB />

                        <div class="flex justify-between ">
                            <div class=" mb-medium">
                                <button class="btn btn-primary btn-submit">Change</button>
                            </div>
                        </div>
                    </div>

                </div>
            </x-form.form>
        </div>
    </main>
</x-app-layout>
