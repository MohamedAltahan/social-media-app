<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimeLineController extends Controller
{
    public function index($id)
    {
        $posts = Post::withCount('comments', 'likes')->where('user_id', $id)->get();
        $myLikes = Like::where('user_id', Auth::user()->id)->pluck('post_id')->toArray();
        // dd($myLikes);
        return view('frontend.pages.time-line', compact('posts', 'myLikes'));
    }
}
