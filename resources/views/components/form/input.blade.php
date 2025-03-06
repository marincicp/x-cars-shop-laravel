@props(['marginB' => false, 'name' => '', 'label' => ''])

<?php
$defaults = [
    'id' => $name,
    'name' => $name,
    'type' => 'text',
    'value' => old($name),
];
?>

<x-form.field :$marginB :$name>
    @if ($label)
        <label>{{ $label }}</label>
    @endif

    <input {{ $attributes($defaults) }} />
</x-form.field>
