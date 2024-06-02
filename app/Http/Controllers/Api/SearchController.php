<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $word = $request->has('search') ? $request->search : null;

        $users = User::when($word != null, function ($query) use ($word) {
            $query->where('name', 'like', '%' . $word . '%');
        })->get();

        if (count($users)) {
            return   ApiResponse::sendResponse(200, 'users retrived successfully', UserResource::collection($users));
        }
        return   ApiResponse::sendResponse(200, 'no users found', []);
    }
}
