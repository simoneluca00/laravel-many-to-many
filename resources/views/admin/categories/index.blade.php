@extends('layouts.app')

@section('content')
@include('admin.includes.messages.success')

<div class="container mt-4">


    <div class="text-center mb-4">
        <a href=" {{route('admin.categories.create')}} " class="btn btn-success">Aggiungi una nuova categoria</a>
    </div>

    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">Label</th>
                <th scope="col">Color</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>

            @forelse ( $categories as $category )
                <tr>
                    <th>{{ $category->label }}</th>
                    <td>
                        {{ $category->color }}
                    </td>
                    <td>
                        <div class="d-flex">
                            <a href=" {{ route('admin.categories.show', $category->id) }} " class="btn btn-primary">View</a>
    
                            <a href=" {{ route('admin.categories.edit', $category->id) }} " class="btn btn-warning mx-1">Edit</a>

                           @include('admin.includes.deleteCategory')
                        </div>

                    </td>
                </tr>
            @empty
                <h2>Non ci sono categorie</h2>
            @endforelse



        </tbody>
    </table>

   {{-- @if ($posts->hasPages())
       {{$post->links()}}
   @endif --}}
</div>


@endsection

@section('scripts')
    {{-- js confirm quando si vuole eliminare un record --}}
    <script src="{{asset('/js/deleteConfirm.js')}}"></script>
@endsection
