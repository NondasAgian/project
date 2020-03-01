<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Session;
use Intervention\Image\Facades\Image;
use App\Category;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all()->sortByDesc('id');
        $categories = Category::all();
        return view('post.index')->withPosts($posts)->withCategories($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255|unique:posts',
            'body' => 'required|max:255',
            'image' => 'image'
        ]);
        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->category_id = $request->category;
        $post->user_id = Auth::user()->id;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.'. $image->getClientOriginalExtension();
            $location = public_path('/images/' . $filename);
            Image::make($image)->resize(800, 600)->save($location);
            $post->image = $filename;
        }
        $post->save();

        Session::flash('success', 'Post was created.');
        return redirect('/post');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('post.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if(Auth::user()->id != $post->user_id) {
            abort(404);
        }
        if ($post == null) {
            abort(404);
        }
        $categories = Category::all();
        return view('post.edit')->withPost($post)->withCategories($categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        if(Auth::user()->id != $post->user_id) {
            abort(404);
        }
        if ($post == null) {
            abort(404);
        }
        $this->validate($request, [
            'title' => "required|max:255|unique:posts,title,$id",
            'body' => 'required|max:255',
            'image' => 'image'
        ]);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->category_id = $request->category;
        $post->user_id = Auth::user()->id;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.'. $image->getClientOriginalExtension();
            $location = public_path('/images/' . $filename);
            Image::make($image)->resize(800, 600)->save($location);
            if ($post->image !=null) {
            Storage::delete($post->image);
            }
            $post->image = $filename;
        }
        $post->save();

        Session::flash('success', 'Post was created.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(Auth::user()->id != $post->user_id) {
            abort(404);
        }
        if ($post == null) {
            abort(404);
        }
        $post = Post::find($id);
        if ($post->image !=null ){
            Storage::delete($post->image);
        } 
        $post->delete();
        Session::flash('success', 'Post has been deleted');
        return redirect()->back();
    }
}
