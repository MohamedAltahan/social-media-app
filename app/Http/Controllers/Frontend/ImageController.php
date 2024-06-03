<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Traits\fileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    use fileUploadTrait;

    public function deleteImage($imageId)
    {
        $image = Image::find($imageId);
        if (Auth::user()->id != $image->post->user_id) {
            abort(403);
        }
        $this->deleteFile('myDisk', $image->name);
        $image->delete();
        return redirect()->back();
    }
}
