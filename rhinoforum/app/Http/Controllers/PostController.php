<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function getPosts(Request $request)
    {
        // TODO: 實作查詢貼文 API
        $posts = Post::all();
        return response()->json($posts);
    }
}
