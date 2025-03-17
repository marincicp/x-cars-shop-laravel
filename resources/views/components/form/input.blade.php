@props(['marginB' => false, 'name' => '', 'label' => '', 'defaultValue' => null])

<?php

$defaults = [
    'id' => $name,
    'name' => $name,
    'type' => 'text',
    'value' => $defaultValue ?? old($name),
];

?>

<x-form.field :$marginB :$name>
    @if ($label)
        <label>{{ $label }}</label>
    @endif

    <input {{ $attributes($defaults) }} />
</x-form.field>
