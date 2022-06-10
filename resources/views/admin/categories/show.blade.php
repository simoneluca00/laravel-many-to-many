@extends('layouts.app')

@section('content')

@include('admin.includes.messages.success')

<div class="container d-flex justify-content-between align-items-center mt-4">
    <div>
        <h2>{{ $category->label }}</h2>
        <h4 class="badge badge-pill badge-{{$category->color}}">{{$category->label}}</h4>
    </div>

    @include('admin.includes.deleteCategory')
</div>

@endsection

@section('scripts')
    <script src="{{ asset('/js/deleteConfirm.js') }}"></script>
@endsection