@props(['makers', 'label' => ''])

<x-form.select id="makerSelect" name="maker_id" :$label>
    <option value="">Maker</option>

    @foreach ($makers as $maker)
        <option value="{{ $maker->id }}">{{ $maker->name }}</option>
    @endforeach
</x-form.select>
