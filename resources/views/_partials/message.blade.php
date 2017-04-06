@if (session('message'))
    <div class="alert alert-info">
        {{ session('status') }}
    </div>
@endif