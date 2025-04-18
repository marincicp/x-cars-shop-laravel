@props(['defaultValue' => null])

<?php
$curYear = (int) date('Y');
?>


<x-form.select name="year" label="Year">
    <option value="">Year</option>

    @for ($startYear = 1990; $startYear <= $curYear; $startYear++)
        <option {{ old(key: 'year') == $startYear || $defaultValue == $startYear ? 'selected' : '' }}
            value="{{ $startYear }}">
            {{ $startYear }}
        </option>
    @endfor
</x-form.select>
<x-form.error :error="$errors->first("year")" />
