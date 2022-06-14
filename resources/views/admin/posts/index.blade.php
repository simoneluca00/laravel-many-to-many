@extends('layouts.app')

@section('content')

   @include('admin.includes.messages.success')

    <div class="container mt-4">
        <div class="text-center mb-4">
            <a class="btn btn-success" href="{{route('admin.posts.create')}}">Crea un nuovo post</a>
        </div>

        <table class="table table-dark">
            <thead>
            <tr>
                <th scope="col">Image</th>
                <th scope="col">Title</th>
                <th scope="col">Category</th>
                <th scope="col">Content</th>
                <th scope="col">Slug</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>

                @forelse ($posts as $post)
                    <tr>
                        <th scope="row" class="align-middle">
                            {{-- <img src="{{$post->image}}" alt="img di {{$post->title}}" width="50px"> --}}
                            <img src="{{asset("storage/$post->image")}}" alt="img di {{$post->title}}" width="50px">
                        </th>
                        <td class="align-middle">
                            {{$post->title}}
                        </td>
                        <td class="align-middle">
                            {{-- {{dd($post->Category)}} --}}
                            @if ($post->Category)
                                <span class="badge badge-pill badge-{{$post->Category->color}}">
                                    {{$post->Category->label}}
                                </span>
                            @else
                                <span class="text-center"> - </span>
                            @endif
                        </td>
                        <td class="align-middle">
                            <p>{{$post->content}}</p>
                        </td>
                        <td class="align-middle">{{$post->slug}}</td>

                        <td class="align-middle">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{route('admin.posts.show', $post->id)}}" class="btn btn-primary">View</a>
                                <a href="{{route('admin.posts.edit', $post->id)}}" class="btn btn-warning mx-1">Edit</a>
                               @include('admin.includes.deletePost')
                            </div>
                        </td>
                    </tr>

                @empty
                    <p>Non sono presenti post...</p>
                @endforelse

            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    {{-- js confirm quando si vuole eliminare un record --}}
    <script src="{{asset('/js/deleteConfirm.js')}}"></script>
@endsection
