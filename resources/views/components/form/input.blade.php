@props(['marginB' => false, 'name'])

<?php
$defaults = [
    'id' => $name,
    'name' => $name,
    'type' => 'text',
];
?>

<x-form.field :$marginB :$name>
    <input {{ $attributes($defaults) }} />
</x-form.field>
