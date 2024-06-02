<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Traits\fileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    use fileUploadTrait;
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
            'body' => ['string'],
            'post_image' => ['image', 'max:5000']
        ]);

        $post = Post::create([
            'user_id' => Auth::user()->id, 'body' => $request->body
        ]);


        if ($request->has('post_image')) {
            $imagePath =  $this->fileUplaod($request, 'myDisk', 'post', 'post_image');
            $post->image()->create([
                'name' => $imagePath,
            ]);
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $friendProfileId)
    {
        $post = Post::withCount('comments', 'likes')->findOrFail($friendProfileId);
        //my like on the posts
        $myLikes = Like::where('user_id', Auth::user()->id)->pluck('post_id')->toArray();
        return view('frontend.post.show', compact('post', 'myLikes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);

        if (!Gate::allows('update', $post)) {
            abort(403);
        }
        return view('frontend.post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'body' => ['string'],
            'post_image' => ['image', 'max:5000']
        ]);

        $post = Post::findOrFail($id);

        if (!Gate::allows('update', $post)) {
            abort(403);
        }

        $post->update([
            'body' => $request->body
        ]);

        if ($request->has('post_image')) {
            $oldImagePath = $post->image->name;
            $imagePath =  $this->fileUpdate($request, 'myDisk', 'post', 'post_image', $oldImagePath);
            $post->image()->updateOrCreate(['imageable_id' => $post->id], [
                'name' => $imagePath,
            ]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        if (!Gate::allows('update', $post)) {
            abort(403);
        }
        $post->delete();
        return 'deleted';
    }
}
