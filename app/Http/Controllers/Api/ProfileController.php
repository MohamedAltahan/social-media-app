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
    public function index($profileId)
    {
        $user = User::find($profileId);

        if ($user) {
            $friendship = $this->checkFriendship($profileId, 'sanctum');
            $posts = Post::where('user_id', $profileId)->orderBy('created_at', 'Desc')->paginate(1);
            if ($posts->total() >= $posts->perPage()) {
                $data = [
                    'posts' => PostResource::collection($posts),
                    'paginationLinks' => [
                        'currentPage' => $posts->currentPage(),
                        'perPage' => $posts->perPage(),
                        'totatPages' => $posts->total(),
                        'links' => [
                            'first' => $posts->url(1),
                            'last' => $posts->url($posts->lastPage())
                        ],
                    ],
                ];
            } else {
                $data =  PostResource::collection($posts);
            }
            return ApiResponse::sendResponse(
                200,
                'profile data returned successfully',
                [
                    'friendShip' => $friendship,
                    'user' => new UserResource($user),
                    'paginatePosts' => $data,
                ]
            );
        }

        return ApiResponse::sendResponse(200, 'user not found', []);
    }
}
