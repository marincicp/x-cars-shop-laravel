<x-base-layout>
    <main>
        <div class="container-small page-login">
            <div class="flex" style="gap: 5rem">
                <div class="auth-page-form">
                    <div class="text-center">
                        <p>Hello <strong>{{ $car->owner->name }}</strong>,</p>
                        <p>Someone just added your car <strong>{{ $car->maker->name }} -
                                {{ $car->model->name }}</strong> to their watchlist.</p>
                        <p>Thank you for using X-cars!</p>
                    </div>

                </div>
                <div class="text-center">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('/img/cars-logo.png') }}" alt="logo" width="150" />
                    </a>
                </div>
            </div>
        </div>
    </main>
</x-base-layout>
