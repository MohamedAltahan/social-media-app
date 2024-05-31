<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Post;
use App\Notifications\LikePostNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'postId' => ['integer']
        ]);

        $post = Post::findOrFail($request->postId);

        //check the status of the like first
        $oldLike = Like::where(['post_id' => $request->postId, 'user_id' => Auth::user()->id])->first();

        if ($oldLike) {
            $oldLike->delete();
            return 0;
        } else {
            Like::create([
                'user_id' => Auth::user()->id,
                'post_id' => $request->postId,
            ]);
            $postUser = $post->user;

            // $postUserId->notify(new LikePostNotification());
            //can send notify to more than one person (one step)
            Notification::send($postUser, new LikePostNotification());
            return 1;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        Post::findOrFail($id);
        $postLikes = Like::with('user')->where('post_id', $id)->get();
        return view('frontend.layout.sections.post-likes-modal', compact('postLikes'));
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
        //
    }
}
