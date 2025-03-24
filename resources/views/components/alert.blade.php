@if (session()->has('message.success'))
    <div class="alert alert-success">
        <div>
            {{ session('message.success') }}
        </div>
    </div>
@endif
@if (session()->has('message.error'))
    <div class="alert alert-error">
        <div>
            {{ session('message.error') }}
        </div>
    </div>
@endif
