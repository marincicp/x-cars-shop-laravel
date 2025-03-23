<x-app-layout>

    <div>
        <div class="container">
            <h1 class="car-details-page-title">
                Manage Images for: {{ $car->year }} - {{ $car->maker->name }} {{ $car->model->name }}
            </h1>

            <div class="car-images-wrapper">
                <div class="w-full images-container">
                    <div class="card mb-medium">
                        <p class="p-medium position-box">
                            Drag to reorder images ( The first one is primary ).
                        </p>

                    </div>
                    <form action="{{ route('car.update-images', $car) }}" method="POST" id="position-form"
                        class="card p-medium form-update-images">
                        @method('PUT')
                        @csrf
                        @foreach ($car->images as $image)
                            <div class="image-row card box" draggable="true">

                                <div class="position-box">
                                    {{ $loop->index + 1 }}.
                                </div>

                                <div class="image-icon-box">
                                    <img src="{{ asset('img/drag-icon.png') }}" alt="drag icon" width="28"
                                        class="drag-icon">

                                </div>
                                <div class="image-box">
                                    <div>
                                        <img src="{{ asset("storage/$image->image_path") }}" alt=""
                                            class="my-cars-img-thumbnail car-image" style="width: 120px" />

                                        <input type="hidden" name="images[{{ $image->id }}]"
                                            value="{{ $loop->index + 1 }}" />

                                    </div>
                                </div>
                                <div class="image-delete-box ">

                                    <button type="button" class="btn btn-delete delete-car-image-btn"
                                        data-car_id="{{ $image->car_id }}" data-image_id="{{ $image->id }}">
                                        Delete</button>
                                </div>


                            </div>
                        @endforeach

                        <button type="submit" class="btn btn-primary" form="position-form">Update Images</button>
                    </form>


                </div>

                <form action="" method="POST" enctype="multipart/form-data"
                    class="card form-images p-medium mb-large">
                    <div class="form-image-upload">
                        <div class="upload-placeholder">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" style="width: 48px">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <input id="carFormImageUpload" type="file" name="images[]" multiple accept="image/*" />
                    </div>
                    <div id="imagePreviews" class="car-form-images"></div>

                    <div class="p-medium" style="width: 100%">
                        <div class="flex justify-end gap-1">
                            <button class="btn btn-primary">Add Images</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @push('scripts')
        <script type="module" src="{{ asset('js/car/edit-images-dnd.js') }}"></script>

        <script type="module" src="{{ asset('js/car/delete-image.js') }}"></script>
    @endpush

</x-app-layout>
