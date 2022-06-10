@extends('layouts.app')

@section('content')
<div class="container">
    <form action=" {{route('admin.categories.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Label</label>
            <input type="text" class="form-control" id="label" placeholder="Label della categoria" name="label">
        </div>
        <div class="form-group">
            <label for="category">Seleziona il colore di sfondo per la categoria:</label>
            <select name="color" id="category" class="d-block">
                <option value="">Nessuna Categoria</option>
                @foreach ($categories as $category)

                <option value="{{$category->color}}"
                    @if (old('color') == $category->color) selected @endif >
                    
                    {{$category->color}}
                       
                </option>

               @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Crea</button>

    </form>
</div>

@endsection