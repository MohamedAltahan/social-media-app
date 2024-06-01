<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Friend;
use App\Models\FriendUser;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Traits\friendableTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TimeLineController extends Controller
{
    use friendableTrait;
    public function index($friendProfileId)
    {
        $user = User::findOrFail($friendProfileId);
        $posts = Post::withCount('comments', 'likes')->where('user_id', $friendProfileId)->orderBy('created_at', 'Desc')->paginate(10);
        //my like on the posts
        $myLikes = Like::where('user_id', Auth::user()->id)->pluck('post_id')->toArray();
        $friendship = $this->checkFriendship($friendProfileId);
        return view('frontend.pages.time-line', compact('posts', 'myLikes', 'user', 'friendship'));
    }
}
