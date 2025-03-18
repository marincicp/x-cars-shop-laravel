@props(['makers', 'label' => '', 'defaultValue' => ''])

<x-form.select id="makerSelect" name="maker_id" :$label>
    <option value="">Maker</option>

    @foreach ($makers as $maker)
        <option {{ old('maker_id') == $maker->id || $defaultValue == $maker->id ? 'selected' : '' }}
            value="{{ $maker->id }}">{{ $maker->name }}
        </option>
    @endforeach
</x-form.select>
