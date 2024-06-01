<?php

namespace App\Http\Controllers\Frontend;

use App\Events\FriendRequestEvent;
use App\Http\Controllers\Controller;
use App\Models\Friend;
use App\Models\Friendship;
use App\Models\FriendUser;
use App\Models\User;
use App\Notifications\FriendRequestNotification;
use App\Traits\friendableTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Notification;

class FriendController extends Controller
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
            'userId' => 'integer'
        ]);

        $friend =  User::findOrFail($request->userId);

        $oldFriendship = $this->checkFriendship($friend->id);


        if ($oldFriendship == 'friend') {

            return  $this->deleteFriend($friend->id);
        } elseif ($oldFriendship == 'sent') {

            return  $this->deleteFriend($friend->id);
        } elseif ($oldFriendship == 'accept') {

            return  $this->acceptFriend($friend->id);
        } elseif ($oldFriendship == null) {

            $friendship =  $this->addFriend($friend->id);

            //send notification through a channel (database)
            Notification::send($friend, new FriendRequestNotification);

            //send notification via broadcasting
            FriendRequestEvent::dispatch($friend->id);
            return $friendship;
        }
        return 0;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        User::findOrFail($id);
        $friends = Friendship::with('user')->where(['user_id' => $id, 'status' => 'accepted'])->get();
        return view('frontend.pages.friends', compact('friends'));
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
