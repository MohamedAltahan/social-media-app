<?php

namespace App\Http\Controllers\Api;

use App\Events\CommentEvent;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use App\Notifications\CommentNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use PDO;

class CommentController extends Controller
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
            'postId' => ['integer'],
            'commentBody' => ['string']
        ]);

        $post = Post::find($request->postId);
        if (!$post) {
            return ApiResponse::sendResponse(200, 'no post found',  []);
        }

        $comment = Comment::create([
            'body' => $request->commentBody,
            'post_id' => $request->postId,
            'user_id' => $request->user()->id,
        ]);

        //prevent notification if owner comments its post
        if ($post->user->id != Auth::user()->id) {
            $postUser = $post->user;

            //send notification to user through a channel 'database'
            Notification::send($postUser, new CommentNotification($post->id));

            //send notification via broadcasting
            CommentEvent::dispatch($post);
        }
        if ($comment) {
            return ApiResponse::sendResponse(201, 'comment created successfully', new CommentResource($comment));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return ApiResponse::sendResponse(200, 'no post found',  []);
        }
        $comments = Comment::where('post_id', $post->id)->orderBy('created_at', 'DESC')->get();
        if (!$comments) {
            return ApiResponse::sendResponse(200, 'no comments found',  []);
        }
        return ApiResponse::sendResponse(200, 'comments retrived successfully',  CommentResource::collection($comments));
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
    public function destroy(Request $request, string $id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return ApiResponse::sendResponse(200, 'no content',  []);
        }

        if ($comment->user_id != $request->user()->id) {
            return ApiResponse::sendResponse(403, 'forbidden', []);
        }
        $deletedComment =  $comment->delete();
        if ($deletedComment) {
            return ApiResponse::sendResponse(200, 'deleted successfully',  []);
        } else {
            return ApiResponse::sendResponse(200, 'error of deleting comment',  []);
        }
    }
}
