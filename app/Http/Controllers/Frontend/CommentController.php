<?php

namespace App\Http\Controllers\Frontend;

use App\Events\CommentEvent;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Notifications\CommentNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
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

        $post = Post::findOrFail($request->postId);

        $comment = Comment::create([
            'body' => $request->commentBody,
            'post_id' => $request->postId,
            'user_id' => Auth::user()->id,
        ]);

        //prevent notification if owner comments on its post
        if ($post->user->id != Auth::user()->id) {
            $postUser = $post->user;

            //send notification to user through a channel 'database'
            Notification::send($postUser, new CommentNotification($post->id));

            //send notification via broadcasting
            CommentEvent::dispatch($post);
        }
        return $comment;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $postId)
    {
        $comments = Comment::with('user')->where('post_id', $postId)->orderBy('created_at', 'DESC')->get();
        return view('frontend.layout.sections.comment-modal', compact('comments', 'postId'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
        $comment = Comment::findOrFail($id);
        if (Auth::user()->id != $comment->user_id) {
            abort(403);
        }
        $comment->delete();
    }
}
