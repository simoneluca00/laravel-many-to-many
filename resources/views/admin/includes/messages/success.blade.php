{{-- pop up di conferma eliminazione --}}
@if (session('message'))
    <div class="alert alert-success mb-0">
        {{ session('message') }}
    </div>
@endif