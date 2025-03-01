@props(['method' => 'GET'])

<form {{ $attributes }} method="{{ $method }}">

    @if (strtoupper($method) !== 'GET')
        @csrf
        @if ($attributes->has('extraMethod'))
            @method($attributes->get('extraMethod'))
        @endif
    @endif




    {{ $slot }}
</form>
