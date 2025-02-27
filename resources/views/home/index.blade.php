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

                    @foreach ($cars as $car)
                        <x-car-item :$car />
                    @endforeach


                </div>
            </div>
        </section>
        <!--/ New Cars -->
    </main>

</x-app-layout>
