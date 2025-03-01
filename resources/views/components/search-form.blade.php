@props(['makers', 'states', 'fuelTypes', 'carTypes'])

<!-- Find a car form -->
<section class="find-a-car">
    <div class="container">
        <form action="{{ route('car.search') }}" method="GET" class="find-a-car-form card flex p-medium">
            <div class="find-a-car-inputs">

                <div>
                    <x-selects.maker-select :$makers />
                </div>
                <div>
                    <x-selects.model-select />
                </div>
                <div>
                    <x-selects.state-select :$states />
                </div>
                <div>
                    <x-selects.city-select />
                </div>
                <div>
                    <x-selects.car-type-select :$carTypes />
                </div>
                <div>
                    <input type="number" placeholder="Year From" name="year_from" />
                </div>
                <div>
                    <input type="number" placeholder="Year To" name="year_to" />
                </div>
                <div>
                    <input type="number" placeholder="Price From" name="price_from" />
                </div>
                <div>
                    <input type="number" placeholder="Price To" name="price_to" />
                </div>
                <div>
                    <x-selects.fuel-type-select :$fuelTypes />
                </div>
            </div>
            <div>
                <button type="button" class="btn btn-find-a-car-reset">
                    Reset
                </button>
                <button class="btn btn-primary btn-find-a-car-submit">
                    Search
                </button>
            </div>
        </form>
    </div>
</section>
<!--/ Find a car form -->
