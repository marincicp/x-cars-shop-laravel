@props(['title' => '', 'bodyClass' => ''])
<x-base-layout :$title :$bodyClass>

    <main>
        <div class="container-small page-login">
            <div class="flex" style="gap: 5rem">
                <div class="auth-page-form">
                    <div class="text-center">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('/img/cars-logo.png') }}" alt="logo" />
                        </a>
                    </div>
                    <h1 class="auth-page-title">{{ $title }}</h1>


                    {{ $slot }}

                </div>
                <div class="auth-page-image">
                    <img src="/img/car-png-39071.png" alt="" class="img-responsive" />
                </div>
            </div>
        </div>
    </main>

</x-base-layout>
