<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Mail;

use App\Mail\CreatePostMail;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('updated_at', 'DESC')->get();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title'=> 'required|max:255|unique:posts',
                'content'=> 'required',
                'image'=> 'required',
                
            ],

            [
                'title.required' => "Il titolo è obbligatorio...",
                'content.required' => "La descrizione è obbligatoria...",
                'image.required' => "L'immagine è obbligatoria...",
                'title.unique' => "Modifica il titolo, quello scelto è già esistente...", 
            ]
        );

        $data = $request->all();

        $user = Auth::user();

        $newPost = new Post();

        if (array_key_exists('image', $data)) {
        
            $image_url = Storage::put('post_images', $data['image']);
    
            $data['image'] = $image_url;
            
        }

        $newPost->fill($data);
        $newPost->slug = Str::slug($newPost->title, '-');

        $newPost->save();

        if (array_key_exists('tags', $data)) {
            $newPost->tags()->sync($data['tags']);
        }

        $mail = new CreatePostMail($newPost);
        Mail::to($user->email)->send($mail);


        return redirect()->route('admin.posts.show', $newPost)->with('message', "$newPost->title è stato creato con successo.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        $post_tags_id = $post->tags->pluck('id')->toArray();

        return view('admin.posts.edit', compact('post', 'categories', 'tags', 'post_tags_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate(
            [
                'title'=> 'required|max:255',
                'content'=> 'required',
                'image'=> 'required',
            ],

            [
                'title.required' => "Il titolo è obbligatorio...",
                'content.required' => "La descrizione è obbligatoria...",
                'image.required' => "L'immagine è obbligatoria...",
            ]
        );
        
        $data = $request->all();
        $post->slug = Str::slug($post->title, '-');

        if (array_key_exists('image', $data)) {

            if ($post->image) {
                Storage::delete($post->image);
            }
            
            $image_url = Storage::put('post_images', $data['image']);
    
            $data['image'] = $image_url;
        }

        $post->update($data);

        if (array_key_exists('tags', $data)){
            $post->tags()->sync($data['tags']);
        }
        
        return redirect()->route('admin.posts.show', $post)->with('message', "$post->title è stato aggiornato con successo.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('message', "$post->title è stato eliminato correttamente.");
    }
}
