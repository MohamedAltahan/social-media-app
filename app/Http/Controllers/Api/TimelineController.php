<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimelineController extends Controller
{
    public function index($friendProfileId)
    {
        // $user = User::find($friendProfileId);
        // if ($user) {
        //     return new UserResource($user);
        // }
        // $posts = Post::withCount('comments', 'likes')->where('user_id', $friendProfileId)->orderBy('created_at', 'Desc')->paginate(10);
        // //my like on the posts
        // $myLikes = Like::where('user_id', Auth::user()->id)->pluck('post_id')->toArray();
        // $friendship = $this->checkFriendship($friendProfileId);
    }
}
