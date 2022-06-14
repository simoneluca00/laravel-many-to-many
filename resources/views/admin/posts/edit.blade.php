@extends('layouts.app')

@section('content')

   @include('admin.includes.validation.errors')

    <div class="container">

        <h2 class="text-center text-primary">
            EDIT <a href="{{route('admin.posts.show', $post->id)}}">{{$post->title}}</a>
        </h2>

        <form action="{{route('admin.posts.update', $post->id)}}" method="POST" enctype="multipart/form-data">
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
                <h4>Seleziona i tag da abbinare al post:</h4>

                @foreach ($tags as $tag)    
                    <div class="form-check form-check-inline">
                        {{-- passando "tags[]" nell'attributo 'name' è in grado di generare un array con tutti i valori selezionati(id) --}}
                        <input 
                            class="form-check-input" type="checkbox" 
                            id="tag-{{$tag->id}}" name="tags[]" 
                            value="{{$tag->id}}"
                            @if( in_array($tag->id, old('tags', $post_tags_id) ) ) checked @endif
                        >
                        <label class="form-check-label" for="tag-{{$tag->id}}">{{$tag->label}}</label>
                    </div>
                @endforeach
            </div>

            <div class="form-group">
                <label for="content">Modifica la descrizione del post:</label>
                <textarea class="form-control" id="content" name="content" rows="3" placeholder="Descrizione" required>{{old('content', $post->content)}}</textarea>
            </div>
            
            <div class="form-group">
                <label for="image">Inserisci l'immagine:</label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>

            <button type="submit" class="btn btn-primary">Modifica post</button>
        </form>

    </div>

@endsection