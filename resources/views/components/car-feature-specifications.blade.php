@props(['car'])
<ul class="car-specifications">
    <x-car-feature-specification-item :value="$car->features?->abs">ABS</x-car-feature-specification-item>
    <x-car-feature-specification-item :value="$car->features?->power_windows"> Power Windows</x-car-feature-specification-item>

    <x-car-feature-specification-item :value="$car->features?->power_door_lock"> Power Door Locks</x-car-feature-specification-item>

    <x-car-feature-specification-item :value="$car->features?->cruise_control">
        Cruise Control</x-car-feature-specification-item>

    <x-car-feature-specification-item :value="$car->features?->remote_start">
        Remote Start</x-car-feature-specification-item>

    <x-car-feature-specification-item :value="$car->features?->gps_navigation">
        GPS Navigation System</x-car-feature-specification-item>

    <x-car-feature-specification-item :value="$car->features?->heated_seats">
        Heated Seats</x-car-feature-specification-item>

    <x-car-feature-specification-item :value="$car->features?->climate_control">
        Climate Control</x-car-feature-specification-item>

    <x-car-feature-specification-item :value="$car->features?->rear_parking_sensors">
        Rear Parking Sensors</x-car-feature-specification-item>

    <x-car-feature-specification-item :value="$car->features?->leather_seats">
        Leather Seats</x-car-feature-specification-item>

</ul>
