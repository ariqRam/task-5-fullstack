<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $categories = Category::all();

        return view('post.index', [
            'posts' => PostResource::collection($posts),
            'categories' => CategoryResource::collection($categories),
        ]);
    }

    /**
     * Routes to the form used to create a new Post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create', [
            'categories' => DB::table('categories')
                ->orderBy('name', 'asc')->get(),
        ]);
    }

    // public function store(Request $request)
    // {
    //     $accessToken = Auth::user()->createToken('New Token')->accessToken;
    //     error_log($accessToken);

    //     return Http::withHeaders(['Authorization' => 'Bearer ' . $accessToken])->post('http://localhost:8000/api/v1/posts', [

    //         'request' => $request
    //     ]);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => 'required',
            'category_id' => 'required',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return response([
                'error' => $validator->errors(),
                'Validation Error'
            ]);
        }

        if (isset($request->image)) {
            $image_name = $request->file('image')->getClientOriginalName();
            $data['image'] = $image_name;
            $request->file('image')->move(public_path('images'), $image_name);
        }

        $data['user_id'] = Auth::id();

        $post = Post::create($data);

        return view('post.show', [
            'post' => $post,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show', [
            'post' => new PostResource($post),
        ]);
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
        $data = $request->all();

        if (isset($request->image)) {
            $image_name = $request->file('image')->getClientOriginalName();
            $data['image'] = $image_name;
            $request->file('image')->move(public_path('images'), $image_name);
        } else if (isset($data['keep-image'])) {
            $data['image'] = $post->image;
        } else {
            $data['image'] = null;
        }

        $data['user_id'] = Auth::id();

        $post->update($data);

        return view('post.show', [
            'post' => $post,
        ]);
    }

    public function edit(Post $post)
    {
        return view('post.edit', [
            'post' => $post,
            'categories' => DB::table('categories')
                ->orderBy('name', 'asc')->get(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return $this->index();
    }
}
