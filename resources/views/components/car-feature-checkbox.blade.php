@props(['name', 'label', 'checked' => false])

<?php

// dd($checked);
?>
<label class="checkbox">
    <input type="checkbox" name="{{ $name }}" value={{ $checked ?? old($name, 1) }}
        {{ $checked ?? old($name) ? 'checked' : '' }} />
    {{ $label }}
</label>
