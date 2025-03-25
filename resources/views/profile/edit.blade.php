<x-app-layout>
    <main>
        <x-alert />

        <div class="container-small mt-xl">

            <div class="flex justify-between items-center ">
                <h1 class="car-details-page-title">Edit your profile</h1>
                <a href="{{ route('password.edit') }}" class="auth-page-password-reset">Change Password</a>
            </div>


            <x-form.form method="POST" extraMethod="PUT" action="{{ route('user.update', $user) }}"
                class="card add-new-car-form mt-medium">
                <div class="form-content">

                    <div class="col">

                        <x-form.input label="Full Name" name="name" marginB defaultValue="{{ $user->name }}" />
                        <x-form.input label="Email" name="email" marginB defaultValue="{{ $user->email }}"
                            type="email" disabled="{{ (bool) $user->google_id }}" />
                        <x-form.input label="Phone" name="phone" marginB defaultValue="{{ $user->phone }}" />

                        <div class="flex justify-between ">
                            <div class=" mb-medium">
                                <button class="btn btn-primary btn-submit">Edit</button>
                            </div>


                        </div>
                    </div>

                </div>
            </x-form.form>
        </div>
    </main>



</x-app-layout>
