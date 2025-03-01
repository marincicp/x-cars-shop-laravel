@props(['marginB' => false, 'name'])
<div @if ($marginB) class="form-group" @endif>
    {{ $slot }}

    <x-form.error :error="$errors->first($name)" />
</div>
