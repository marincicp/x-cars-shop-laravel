@props(['fuelTypes', 'label' => ''])




<x-form.select name="fuel_type_id" :$label>
    <option value="">Fuel Type</option>
    @foreach ($fuelTypes as $type)
        <option {{ old('fuel_type_id') == $type->id ? 'selected' : '' }} value="{{ $type->id }}">{{ $type->name }}
        </option>
    @endforeach

</x-form.select>
