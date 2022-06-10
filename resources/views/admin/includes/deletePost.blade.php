<form action=" {{ route('admin.posts.destroy', $post->id) }} " method="POST" class="deleteForm" data-name="{{$post->title}}">
    @method('DELETE')
    @csrf
    <button type="submit" class="btn btn-danger">Delete</button>
</form>
