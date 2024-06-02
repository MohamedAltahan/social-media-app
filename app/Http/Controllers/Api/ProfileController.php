<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Traits\friendableTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    use friendableTrait;
    public function index($id)
    {
        $user = User::find($id);

        if ($user) {
            $friendship = $this->checkFriendship($id, 'sanctum');
            $posts = Post::where('user_id', $id)->orderBy('created_at', 'Desc')->paginate(1);
            return ApiResponse::sendResponse(
                200,
                'profile data returned successfully',
                [
                    'posts' => PostResource::collection($posts),
                    'user' => new UserResource($user),
                    'friendShip' => $friendship
                ]
            );
        }
    }
}
