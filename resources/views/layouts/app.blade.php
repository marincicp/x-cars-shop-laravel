@props(['title' => '', 'footerLinks' => ''])

<x-base-layout :$title>

    <x-layouts.header />

    {{ $slot }}
    <footer>
        <a href="#">linka </a>
        {{ $footerLinks }}☻
    </footer>

</x-base-layout>
