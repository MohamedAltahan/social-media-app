<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{

    public function deleteImage($imageId)
    {
        $image = Image::find($imageId)->first();
        $image->delete();
        return redirect()->back();
    }
}
