@extends('layouts.app')

@section('content')

@include('admin.includes.messages.success')

    <div class="container mt-4 d-flex justify-content-center align-items-center">
        <div class="mr-5">
            <img src="{{$post->image}}" alt="{{$post->title}}" width="250">
    
            <h2>
                {{$post->title}}
            </h2>

            @if ($post->Category)
                <h4 class="badge badge-pill badge-{{$post->Category->color}}">{{$post->Category->label}}</h4>
                @else
                <h5>Non esiste una categoria associata</h5>
            @endif
    
            <p class="mb-0">
                {{$post->content}}
            </p>
        </div>

        <div class="d-flex justify-content-center align-self-end">
            <a href="{{route('admin.posts.edit', $post->id)}}" class="btn btn-warning mr-1 h-100">Edit</a>
            @include('admin.includes.deletePost')
        </div>
    </div>

@endsection

@section('scripts')
    {{-- js confirm quando si vuole eliminare un record --}}
    <script src="{{asset('/js/deleteConfirm.js')}}"></script>
@endsection