@if (session()->has('message'))
    <div class="alert alert-{{ session('type', 'success') }}">
        <div>
            {{ session('message') }}
        </div>
    </div>
@endif
