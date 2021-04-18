<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Validation\ValidationExceptione;

class PostController extends Controller
{
    public function getPosts(Request $request)
    {
        // try {
        //     $rules = [
        //         'user' => 'integer',
        //         'limit' => 'integer',
        //     ];
        //     $message = [
        //         'user.integer' => 'Date type has INT',
        //         'limit.integer' => 'Date type has INT'
        //     ];
        //     dd($validResult = $request->validate($rules, $message));
        // } catch (ValidationException $exception) {
        //     dd($exception);
        //     // 取得 laravel Validator 實例
        //     $validatorInstance = $exception->validator;
        //     // 取得錯誤資料
        //     $errorMessageData = $validationInstance->getMessageBag();
        //     // 取得驗證錯誤訊息
        //     $errorMessages = $errorMessageData->getMessages();
        //     // $errorMessage = $exception->validator->getMessageBag()->getMessages();
        //     return response()->json($errorMessage);
        //     dd($errorMessage);
        // }

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
