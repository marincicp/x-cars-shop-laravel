<?php

$curYear = (int) date('Y');

?>


<x-form.select name="year" label="Year">
    <option value="">Year</option>

    @for ($startYear = 1990; $startYear <= $curYear; $startYear++)
        <option {{ old('year') == $startYear ? 'selected' : '' }} value="{{ $startYear }}">{{ $startYear }}
        </option>
    @endfor

</x-form.select>
