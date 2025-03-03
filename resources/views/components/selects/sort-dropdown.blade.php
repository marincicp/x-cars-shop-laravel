@props(['class' => '', 'name'])

<x-form.select :$class :$name>
    <option value="">Order By</option>
    <option value="priceasc">Price Asc</option>
    <option value="pricedesc">Price Desc</option>
</x-form.select>
