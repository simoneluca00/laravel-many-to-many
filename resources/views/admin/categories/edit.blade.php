@extends('layouts.app')

@section('content')
<div class="container">
    <form action=" {{route('admin.categories.update', $category->id)}}" method="POST">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="title">Label</label>
            <input type="text" class="form-control" id="label" placeholder="Label della categoria" name="label" value="{{old('label', $category->label)}}">
        </div>
        <div class="form-group">
            <label for="category">Seleziona il colore di sfondo per la categoria:</label>
            <select name="color" id="category" class="d-block">
                <option value="">Nessuna Categoria</option>
                @foreach ($categories as $singleCategory)

                <option value="{{$singleCategory->color}}"
                    @if ($singleCategory->color == $category->color) selected @endif >
                    
                    {{$singleCategory->color}}
                       
                </option>

               @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Modifica</button>

    </form>
</div>

@endsection