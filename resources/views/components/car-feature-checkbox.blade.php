@props(['name', 'label'])


<label class="checkbox">
    <input type="checkbox" name="{{ $name }}" value={{ old($name, 1) }} {{ old($name) ? 'checked' : '' }} />
    {{ $label }}
</label>
