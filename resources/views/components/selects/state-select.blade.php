@props(['states', 'label' => ''])

<x-form.select :$label id="stateSelect" name="state_id">
    <option value="">State/Region</option>

    @foreach ($states as $state)
        <option value="{{ $state->id }}">{{ $state->name }}</option>
    @endforeach
</x-form.select>
