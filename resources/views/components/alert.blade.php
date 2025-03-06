@props(['type' => 'success'])
<div class="alert alert-{{ $type }}">
    <div>
        {{ $slot }}
    </div>
</div>
