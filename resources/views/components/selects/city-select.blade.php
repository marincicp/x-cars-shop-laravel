@props(['label' => '', 'currentStateCities' => [], 'defaultValue' => null])

<x-form.select id="citySelect" name="city_id" :$label>
    <option value="">City</option>

    @if ($currentStateCities)

        @foreach ($currentStateCities as $city)
            <option @if ($defaultValue == $city['id']) selected @endif value="{{ $city['id'] }}">
                {{ $city['name'] }}</option>
        @endforeach

    @endif

</x-form.select>
