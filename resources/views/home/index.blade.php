<x-app-layout title="Home Page">
    <main>
        <!-- Find a car form -->
        <x-search-form />
        <!--/ Find a car form -->

        <!-- New Cars -->
        <section>
            <div class="container">
                <h2>Latest Added Cars</h2>
                <div class="car-items-listing">
                    @php
                        $car = [
                            'location' => 'New York',
                            'price' => '30,000',
                            'type' => 'SUV',
                            'year' => 2020,
                            'model' => 'Mazda',
                        ];
                    @endphp
                    @for ($i = 1; $i < 12; $i++)
                        <x-car-item :$car />
                    @endfor
                </div>
            </div>
        </section>
        <!--/ New Cars -->
    </main>

</x-app-layout>
