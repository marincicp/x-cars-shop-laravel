@props(['class' => '', 'name'])

<x-form.select :$class :$name>
    <option value="">Order By</option>
    <option value="price">Price Asc</option>
    <option value="-price">Price Desc</option>
</x-form.select>
