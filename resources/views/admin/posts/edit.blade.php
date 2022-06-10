@extends('layouts.app')

@section('content')

   @include('admin.includes.validation.errors')

    <div class="container">

        <h2 class="text-center text-primary">
            EDIT <a href="{{route('admin.posts.show', $post->id)}}">{{$post->title}}</a>
        </h2>

        <form action="{{route('admin.posts.update', $post->id)}}" method="POST">
            @method('PUT')

            @csrf

            <div class="form-group">
                <label for="title">Modifica il titolo del post:</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Titolo" value="{{old('title', $post->title)}}" maxlength="255" required>
            </div>
            <div class="form-group">
                <label for="category">Modifica la categoria del post:</label>
                <select name="category_id" id="category">
                    <option value="">Nessuna Categoria</option>
                    @foreach ($categories as $category)
    
                    <option value="{{$category->id}}"
                        @if (old('category_id', $post->category_id) == $category->id) selected @endif >
                        
                        {{$category->label}}
                           
                    </option>
    
                   @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="content">Modifica la descrizione del post:</label>
                <textarea class="form-control" id="content" name="content" rows="3" placeholder="Descrizione" required>{{old('content', $post->content)}}</textarea>
            </div>
            <div class="form-group">
                <label for="image">Modifica l'URL dell'immagine:</label>
                <input type="text" name="image" class="form-control" id="image" placeholder="https://example.com" value="{{old('image', $post->image)}}" pattern="https://.*" maxlength="255" required>
            </div>

            <button type="submit" class="btn btn-primary">Modifica post</button>
        </form>

    </div>

@endsection