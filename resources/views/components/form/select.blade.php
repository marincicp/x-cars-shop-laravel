@props(['name', 'id', 'label' => '', 'class' => ''])

@php
    $defaults = [
        'id' => ($id ??= $name),
        'name' => $name,
        'class' => $class,
    ];
@endphp


@if ($label)
    <label class="mb-medium">{{ $label }}</label>
@endif
<select {{ $attributes($defaults) }}>

    {{ $slot }}
</select>
