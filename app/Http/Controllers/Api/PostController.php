<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Traits\fileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    use fileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $myPosts = Post::where('user_id', $request->user()->id)->latest()->get();

        if (count($myPosts)) {
            return ApiResponse::sendResponse(200, 'posts retrived successfully',  PostResource::collection($myPosts));
        } else {
            return ApiResponse::sendResponse(200, 'no content',  []);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'body' => ['required_without_all', 'string'],
            'post_image' => ['image', 'max:5000'],
        ]);

        if ($validator->fails()) {
            return ApiResponse::sendResponse(422, 'data validation error', $validator->messages()->all());
        }

        $post = Post::create([
            'body' => $request->body,
            'user_id' => $request->user()->id,
        ]);

        if ($request->has('post_image')) {
            $imagePath =  $this->fileUplaod($request, 'myDisk', 'post', 'post_image');
            $post->image()->create([
                'name' => $imagePath,
            ]);
        }

        if ($post) {
            return ApiResponse::sendResponse(201, 'your post created successfully', new PostResource($post));
        } else {
            return ApiResponse::sendResponse(200, 'error of creating post', []);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);
        if ($post) {
            return ApiResponse::sendResponse(200, 'post retrived successfully',  new PostResource($post));
        } else {
            return ApiResponse::sendResponse(200, 'no content',  []);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $post = Post::find($id);
        if ($post) {

            if ($post->user_id != $request->user()->id) {
                return ApiResponse::sendResponse(403, 'forbidden', []);
            }

            $validator = Validator::make($request->all(), [
                'body' => ['required_without_all', 'string'],
                'post_image' => ['image', 'max:5000'],
            ]);

            if ($validator->fails()) {
                return ApiResponse::sendResponse(422, 'data validation error', $validator->messages()->all());
            }

            $updatedPost = $post->update($request->all());

            if ($request->has('post_image')) {
                $oldImagePath = $post->image->name;
                $imagePath =  $this->fileUpdate($request, 'myDisk', 'post', 'post_image', $oldImagePath);
                $post->image()->updateOrCreate(['imageable_id' => $post->id], [
                    'name' => $imagePath,
                ]);
            }

            if ($updatedPost) {
                return ApiResponse::sendResponse(201, 'your post updated successfully', new PostResource($post));
            } else {
                return ApiResponse::sendResponse(200, 'error of updating post', []);
            }
        } else {
            return ApiResponse::sendResponse(200, 'no content',  []);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $post = Post::find($id);
        if ($post) {

            if ($post->user_id != $request->user()->id) {
                return ApiResponse::sendResponse(403, 'forbidden', []);
            }
            $deletedPost = $post->delete();
            if ($deletedPost) {
                return ApiResponse::sendResponse(200, 'your post deleted successfully', []);
            } else {
                return ApiResponse::sendResponse(200, 'error of deleting post', []);
            }
        } else {
            return ApiResponse::sendResponse(200, 'no content',  []);
        }
    }
}
