<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function createPost(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $postData = [
            'title' => $request->get('title'),
            'content' => $request->get('content'),
        ];

        $post = Post::create($postData);

        return response()->json($post);
    }



    public function getAllPosts()
    {
        $posts =  Post::all();
        return response()->json($posts);
    }

    public function updatePost(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        $postId = $request->route()->parameter('id');
        $postData = [
            'title' => $request->get('title'),
            'content' => $request->get('content'),
        ];

        $post = Post::where('id', $postId)->update($postData);
        return response()->json($post);
    }

    public function deletePost(Request $request)
    {
        $postId = $request->route()->parameter('id');
        $post = Post::find($postId)->delete();
        return response()->json($post);
    }
}
