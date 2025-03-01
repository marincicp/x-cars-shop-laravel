@props(['error' => false, 'name'])

@if ($error)
    <p class="text-error">{{ $error }}</p>
@endif
