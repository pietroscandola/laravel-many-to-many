<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('updated_at', 'DESC')->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();
        $categories = Category::all();
        return view('admin.posts.create', compact('post', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'title' => ['required', 'string', Rule::unique('posts')->ignore($post->id), 'min:5'],
            'content' => 'string',
            'image' => 'nullable|url',
            'category_id' => 'nullable| exists:categories,id'
        ]);
        $data = $request->all();
        $data['slug'] = Str::slug($request->title, '-');
        $post = new Post();
        $post->fill($data);
        if (array_key_exists('is_published', $data)) {
            $post->is_published = 1;
        }
        $post->save();

        return redirect()->route('admin.posts.index')->with('message', 'Post creato con successo!!')->with('type', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
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
        $request->validate([
            'title' => ['required', 'string', Rule::unique('posts')->ignore($post->id), 'min:5'],
            'content' => 'string',
            'image' => 'nullable|url',
            'category_id' => 'nullable| exists:categories,id'
        ]);
        $data = $request->all();

        if (array_key_exists('is_published', $data)) {
            $data['is_published'] = 1;
        } else {
            $data['is_published'] = 0;
        }

        $data['slug'] = Str::slug($request->title, '-');
        $post->update($data);

        return redirect()->route('admin.posts.show', $post)->with('message', 'Post creato con successo!!')->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with("message", "il post $post->title è stato eliminato")->with("type", "success");
    }

    public function toggle(Post $post)
    {
        $post->is_published = !$post->is_published;
        $published = $post->is_published ? 'pubblicato' : 'rimosso';
        $post->save();

        return redirect()->route('admin.posts.index')->with("message", "il post $post->title è stato $published")->with("type", "success");
    }
}
