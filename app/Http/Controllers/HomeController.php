<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $posts = Post::withCount(['images'])->orderBy('id', 'desc')->paginate(5);

        $last_comment =  Comment::orderBy('id', 'desc');
        if ($last_comment->first()) {
            $comments_count = $last_comment->first()->id;
        } else {
            $comments_count = 0;
        }

        // dd($comments_count);
        return view('home', ['posts' => $posts, 'comments_count' => $comments_count]);
    }
}
