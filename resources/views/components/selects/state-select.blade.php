@props(['states', 'label' => '', 'defaultValue' => null])

<x-form.select :$label id="stateSelect" name="state_id">
    <option value="">State/Region</option>

    @foreach ($states as $state)
        <option {{ ($defaultValue ?? old('state_id')) == $state->id ? 'selected' : '' }} value="{{ $state->id }}">
            {{ $state->name }}
        </option>
    @endforeach
</x-form.select>
