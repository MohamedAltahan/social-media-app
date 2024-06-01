<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::withCount('comments', 'likes')->paginate(10);
        //my like on the posts
        $myLikes = Like::where('user_id', Auth::user()->id)->pluck('post_id')->toArray();
        return view('frontend.pages.home', compact('posts', 'myLikes'));
    }
}
