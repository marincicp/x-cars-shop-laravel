<x-app-layout title="Home Page">
    <main>
        <x-alert />
        <!-- Find a car form -->
        <x-search-form :$states :$makers :$fuelTypes :$carTypes />
        <!--/ Find a car form -->

        <!-- New Cars -->
        <section>
            <div class="container">
                <h2>Latest Added Cars</h2>
                <div class="car-items-listing">

                    @foreach ($cars as $car)
                        <?php
                        $isInWatchList = in_array($car->id, $favCars);
                        ?>

                        <x-car-item :$car :$isInWatchList />
                    @endforeach


                </div>
            </div>

            {{ $cars->onEachSide(1)->links() }}

        </section>
        <!--/ New Cars -->
    </main>

</x-app-layout>
