@props(['makers', 'carTypes', 'fuelTypes', 'states', 'carFeatures'])

<?php
if ($errors->any()) {
    dump($errors);
}
?>

<x-app-layout>
    <main>
        <div class="container-small">
            <h1 class="car-details-page-title">Add new car</h1>
            <form action="{{ route('car.store') }}" method="POST" enctype="multipart/form-data"
                class="card add-new-car-form">
                @csrf
                <div class="form-content">
                    <div class="form-details">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">

                                    <x-selects.maker-select :$makers label="Makers" />

                                    <label>Maker</label>
                                    <p class="error-message">This field is required</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <x-selects.model-select label="Model" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <x-selects.year-select />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Car Type</label>
                            <div class="row">

                                @foreach ($carTypes as $type)
                                    <div class="col">
                                        <label class="inline-radio">
                                            <input type="radio" name="car_type_id" value="{{ $type->id }} "
                                                {{ old('car_type') == $type->id ? 'checked' : '' }} />
                                            {{ $type->name }}
                                        </label>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <div class="row">
                            <div class="col">

                                <x-form.input marginB name="price" placeholder="Price" label="Price"
                                    type="number" />
                            </div>
                            <div class="col">


                                <x-form.input marginB name="vin" placeholder="Vin Code" label="Vin Code" />

                            </div>
                            <div class="col">


                                <x-form.input name="mileage" marginB placeholder="Mileage" label="Mileage (ml)" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Fuel Type</label>
                            <div class="row">
                                @foreach ($fuelTypes as $type)
                                    <div class="col">
                                        <label class="inline-radio">
                                            <input type="radio" name="fuel_type_id" value="{{ $type->id }}"
                                                {{ old('fuel_type') == $type->id ? 'checked' : '' }} />
                                            {{ $type->name }}
                                        </label>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">

                                    <x-selects.state-select label="State" :$states />

                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <x-selects.city-select label="City" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">


                                <x-form.input name="address" marginB placeholder="Address" label="Address" />
                            </div>
                            <div class="col">


                                <x-form.input name="phone" marginB placeholder="Phone" label="Phone" />

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">

                                <x-render-car-feature-checboxes :$carFeatures />
                            </div>

                        </div>
                        <div class="form-group">
                            <label>Detailed Description</label>
                            <textarea name="description" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="checkbox">
                                <input type="checkbox" name="published" />
                                Published
                            </label>
                        </div>
                    </div>
                    <div class="form-images">
                        <div class="form-image-upload">
                            <div class="upload-placeholder">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" style="width: 48px">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </div>
                            <input id="carFormImageUpload" name="images[]" type="file" multiple />
                        </div>
                        <div id="imagePreviews" class="car-form-images"></div>
                    </div>
                </div>
                <div class="p-medium" style="width: 100%">
                    <div class="flex justify-end gap-1">
                        <button type="button" class="btn btn-default">Reset</button>
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </main>

</x-app-layout>
