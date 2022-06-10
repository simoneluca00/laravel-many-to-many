<form action=" {{ route('admin.categories.destroy', $category->id) }} " method="POST" class="deleteForm" data-name="{{$category->label}}">
    @method('DELETE')
    @csrf
    <button type="submit" class="btn btn-danger">Delete</button>
</form>
