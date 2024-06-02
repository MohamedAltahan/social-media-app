<?php

namespace App\Http\Controllers\Api;

use App\Events\FriendRequestEvent;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Friendship;
use App\Models\User;
use App\Notifications\FriendRequestNotification;
use App\Traits\friendableTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class FriendshipController extends Controller
{
    use friendableTrait;
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
            'userId' => 'integer'
        ]);

        //the other side user
        $friend =  User::find($request->userId);

        if (!$friend) {
            return ApiResponse::sendResponse(200, 'friend not found',  []);
        }
        //before add check our relation
        $oldFriendship = $this->checkFriendship($friend->id, 'sanctum');

        if ($oldFriendship == 'friend') {

            $this->deleteFriend($friend->id, 'sanctum');
            return ApiResponse::sendResponse(200, 'friend has remove',  []);
        } elseif ($oldFriendship == 'sent') {

            $this->deleteFriend($friend->id, 'sanctum');
            return ApiResponse::sendResponse(200, 'request has remove',  []);
        } elseif ($oldFriendship == 'accept') {

            $this->acceptFriend($friend->id, 'sanctum');
            return ApiResponse::sendResponse(200, 'request accepted',  []);
        } elseif ($oldFriendship == null) {

            $friendship =  $this->addFriend($friend->id, 'sanctum');

            //send notification through a channel (database)
            Notification::send($friend, new FriendRequestNotification);

            //send notification via broadcasting
            FriendRequestEvent::dispatch($friend->id);

            return ApiResponse::sendResponse(201, 'request has sent',  []);
        }
        return ApiResponse::sendResponse(200, 'something wrong',  []);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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

        $deletedRequest = $this->deleteFriend($id, 'sanctum');
        if (!$deletedRequest) {
            return ApiResponse::sendResponse(200, 'something worng',  []);
        }
        return ApiResponse::sendResponse(200, 'request deleted successfully',  []);
    }
}
