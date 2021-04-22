<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Post;
use Illuminate\Validation\ValidationExceptione;

class PostController extends Controller
{
    public function getPosts(Request $request)
    {
        $rules = [
            'page' => 'integer',
            'limit' => 'integer',
            'category' => 'string|max:50',
            'content' => 'string|max:100',
            'publishedAt' => 'string'
        ];
        $message = [
            'page.integer' => 'Date type has INT',
            'limit.integer' => 'Date type has INT',
            'category.max' => 'String to long, max limit 50',
            'content.max' => 'String to long, max limit 100',
        ];
        $v = Validator::make($request->all(), $rules, $message);
        if($v->fails()) {
            return response()->json($v->messages());
        }

        $queryString = $request->only([ 'user', 'category', 'content', 'publishedAt', 'limit' ]);
        $posts = new Post();
        foreach($queryString as $k => $v) {
            switch($k){
                case 'user':
                    $posts = $posts->where('user_id', '=', $v);
                    break;
                case 'category':
                    $posts = $posts->where('category', 'like', '%' . $v . '%');
                    break;
                case 'content':
                    $posts = $posts->where('content', 'like', '%' . $v . '%');
                    break;
                case 'publishedAt':
                    $times = explode('~',trim($v));
                    $posts = $posts->whereBetween('published_at', [strtotime($times[0]), strtotime($times[1])]);
                    break;
                case 'limit':
                    $limit = (is_int($v)? $v : 10);
                    break;
            }
        }
        $data = $posts->paginate($limit ?? 15)->withQueryString();
        return response()->json($data);
    }
}
