<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'verified'])->except(['show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'post_caption' => 'string',
            'img_path' => ['required', 'image'],
        ]);
        $imgpath = request('img_path')->store('uploads', 'public');
            // auth()->user()->posts()->create([
            //     'post_caption' => $data['post_caption'],
            //     'img_path' => $imgpath,
            // ]);
            // return redirect()->route('user_profile', ['username' => auth()->user()->username]);
            return view('applyFilters',['post_caption' => $data['post_caption'], 'img_path' => $imgpath]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if ($post == null) {
            abort(404);
        }
        if (auth()->user() !=null || $post->user->status == "private")
        {$this->authorize('view',$post);}

        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if ($post == null) {
            abort(404);
        }
        $this->authorize('update', $post);
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if ($post == null) {
            abort(404);
        }
        $this->authorize('update', $post);
        $data = request()->validate([
            'post_caption' => 'string',
            'img_path' => ['nullable', 'image'],
        ]);
        $imgpath = null;
        if(request('img_path')!=null){
            $imgpath = request('img_path')->store('uploads', 'public');
        }
        else if ($post->img_path !=null){
            $imgpath = $post->img_path;
        }
        else{
            abort(401);
        }
        $post->update([
            'post_caption' => $data['post_caption'],
            'img_path' => $imgpath,
        ]);
        return redirect(auth()->user()->username);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post == null) {
            abort(404);
        }
        $this->authorize('delete', $post);

        $post->delete();
        Storage::delete("public/".$post->img_path);

        return redirect(auth()->user()->username);

    }
}
