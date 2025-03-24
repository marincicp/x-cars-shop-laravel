<x-app-layout>
    <main>
        <x-alert />

        <div class="container-small">
            <h1 class="car-details-page-title">Edit your profile</h1>
            <x-form.form method="POST" extraMethod="PUT" action="{{ route('user.update', $user) }}"
                class="card add-new-car-form ">
                <div class="form-content">

                    <div class="col">

                        <x-form.input label="Full Name" name="name" marginB defaultValue="{{ $user->name }}" />

                        <x-form.input label="Email" name="email" marginB defaultValue="{{ $user->email }}"
                            type="email" disabled="{{ (bool) $user->google_id }}" />

                        <x-form.input label="Phone" name="phone" marginB defaultValue="{{ $user->phone }}" />


                        <div class="flex justify-between ">

                            <div class=" mb-medium">
                                <button class="btn btn-primary btn-submit">Submit</button>
                            </div>

                            <div class=" mb-medium">
                                <a href="" class="auth-page-password-reset">Reset Password</a>
                            </div>
                        </div>
                    </div>

                </div>




            </x-form.form>
        </div>

    </main>



</x-app-layout>
