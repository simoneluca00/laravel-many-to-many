@extends('layouts.app')

@section('content')

   @include('admin.includes.validation.errors')

    <div class="container">

        <form action="{{route('admin.posts.store')}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group my-4">
                <label for="title">Inserisci il titolo del post:</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Titolo" value="{{old('title')}}" maxlength="255" required>
            </div>
            <div class="form-group my-4">
                <label for="category">Seleziona la categoria del post:</label>
                <select name="category_id" id="category" class="d-block">
                    <option value="">Nessuna Categoria</option>
                    @foreach ($categories as $category)
    
                    <option value="{{$category->id}}"
                        @if (old('category_id') == $category->id) selected @endif >
                        
                        {{$category->label}}
                           
                    </option>
    
                   @endforeach
                </select>
            </div>

            <div class="form-group my-4">
                <p class="mb-1">Seleziona i tag da abbinare al post:</p>
        
                @foreach ($tags as $tag)    
                    <div class="form-check form-check-inline">
                        {{-- passando "tags[]" nell'attributo 'name' viene generato un array con tutti i valori selezionati(id) --}}
                        <input 
                            class="form-check-input" type="checkbox" 
                            id="tag-{{$tag->id}}" name="tags[]" 
                            value="{{$tag->id}}"
                            @if( in_array($tag->id, old('tags', []) ) ) checked @endif
                        >
                        <label class="form-check-label" for="tag-{{$tag->id}}">{{$tag->label}}</label>
                    </div>
                @endforeach
            </div>

            <div class="form-group my-4">
                <label for="content">Inserisci la descrizione del post:</label>
                <textarea class="form-control" id="content" name="content" rows="3" placeholder="Descrizione" required>{{old('content')}}</textarea>
            </div>
            
            <div class="form-group">
                <label for="image">Inserisci l'immagine:</label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>

            <div class="mt-5 text-center">
                <button type="submit" class="btn btn-primary">Crea Post</button>
            </div>
        </form>

    </div>

@endsection