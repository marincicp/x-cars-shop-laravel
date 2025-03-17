<x-app-layout>

    <?php
    ?>
    <main>
        <div class="container-small">
            <h1 class="car-details-page-title">Add new car</h1>
            <form action="" method="POST" enctype="multipart/form-data" class="card add-new-car-form">
                <div class="form-content">
                    <div class="form-details">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <x-selects.maker-select defaultValue="{{ $car->maker_id }}" label="Makers"
                                        :$makers />
                                </div>



                            </div>
                            <div class="col">
                                <div class="form-group">

                                    <x-selects.model-select label="Model" :$models
                                        defaultValue="{{ $car->model_id }}" />

                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <x-selects.year-select defaultValue="{{ $car->year }}" />
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
                                                {{ ($car->car_type_id ?? old('car_type')) == $type->id ? 'checked' : '' }} />
                                            {{ $type->name }}
                                        </label>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <x-form.input marginB name="price" placeholder="Price" label="Price" type="number"
                                    defaultValue="{{ $car->price }}" />
                            </div>
                            <div class="col">
                                <x-form.input marginB name="vin" placeholder="Vin" label="Vin code"
                                    defaultValue="{{ $car->vin }}" />
                            </div>
                            <div class="col">
                                <x-form.input name="mileage" marginB placeholder="Mileage" label="Mileage (ml)"
                                    defaultValue="{{ $car->mileage }}" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Fuel Type</label>
                            <div class="row">
                                @foreach ($fuelTypes as $type)
                                    <div class="col">
                                        <label class="inline-radio">
                                            <input type="radio" name="fuel_type_id" value="{{ $type->id }}"
                                                {{ old('fuel_type') == $type->id || $car->fuel_type_id == $type->id ? 'checked' : '' }} />
                                            {{ $type->name }}
                                        </label>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">

                                    <x-selects.state-select label="State" :$states
                                        defaultValue="{{ $car->city->state->id }}" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>City</label>
                                    <select>
                                        <option value="">City</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <x-form.input name="address" marginB placeholder="Address" label="Address"
                                    defaultValue="{{ $car->address }}" />
                            </div>
                            <div class="col">

                                <x-form.input name="phone" marginB placeholder="Phone" label="Phone"
                                    defaultValue="{{ $car->phone }}" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <x-render-car-feature-checboxes :$carFeatures :defaultValue="$car->features?->toArray()" />

                            </div>

                        </div>

                        <div class="form-group">
                            <label>Detailed Description</label>
                            <textarea rows="10">{!! $car->description !!}</textarea>
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
                            {{-- <input id="carFormImageUpload" type="file" multiple /> --}}
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
