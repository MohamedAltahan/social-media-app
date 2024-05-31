<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Friend;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimeLineController extends Controller
{
    public function index($id)
    {
        $user = User::findOrFail($id);
        $posts = Post::withCount('comments', 'likes')->where('user_id', $id)->orderBy('created_at', 'Desc')->get();
        $myLikes = Like::where('user_id', Auth::user()->id)->pluck('post_id')->toArray();
        $friendship = Friend::where([
            'user_id' => Auth::user()->id,
            'friend_id' => $id,
        ])->first();
        return view('frontend.pages.time-line', compact('posts', 'myLikes', 'user', 'friendship'));
    }
}
