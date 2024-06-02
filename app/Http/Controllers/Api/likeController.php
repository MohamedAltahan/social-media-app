<?php

namespace App\Http\Controllers\Api;

use App\Events\LikeEvent;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\LikeResource;
use App\Models\Like;
use App\Models\Post;
use App\Notifications\LikePostNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class likeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'postId' => ['integer']
        ]);

        $authUser = $request->user()->id;

        $post = Post::find($request->postId);
        if (!$post) {
            return ApiResponse::sendResponse(200, 'no post found',  []);
        }
        //check the status of the like first
        $oldLike = Like::where(['post_id' => $request->postId, 'user_id' =>  $authUser])->first();

        if ($oldLike) {

            $oldLike->delete();
            return ApiResponse::sendResponse(200, 'like removed',  []);
        } else {

            //store like in database
            Like::create([
                'user_id' => $authUser,
                'post_id' => $request->postId,
            ]);

            //prevent notification if owner likes its post
            if ($post->user->id != $authUser) {
                $postUser = $post->user;

                //this can send notify to more than one person (one step)
                Notification::send($postUser, new LikePostNotification($post->id));

                //send notification via broadcasting
                LikeEvent::dispatch($post);
            }

            return ApiResponse::sendResponse(200, 'like add to post',  []);;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);
        if ($post) {
            $postLikes = Like::with('user')->where('post_id', $id)->get();
            return ApiResponse::sendResponse(200, 'post likes retrived successfully',   LikeResource::collection($postLikes));
        } else {
            return ApiResponse::sendResponse(200, 'no content',  []);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
