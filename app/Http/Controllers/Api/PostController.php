<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Traits\MainTrait;
use App\Http\Requests\ApiRequest;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    //
    use MainTrait;
    public function get_all_posts()
    {
        $posts = Post::get();
        return response()->json($posts);
    }

    public function get_post_by_id(Request $request)
    {
        $post = Post::find($request->id);
        if (!$post) {
            return $this->returnError('401', 'there is no post with this id');
        }
        return $this->returnData('post', $post, 'that is the Post');
    }
    // only for admin
    public function get_five_posts(ApiRequest $request)
    {
        $posts = Post::whereIn('id', ['1', '2', '3']);
        return response()->json($posts, 200);
    }
}
