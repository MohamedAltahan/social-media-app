<?php

namespace App\Http\Controllers\Frontend;

use App\Events\FriendRequestEvent;
use App\Http\Controllers\Controller;
use App\Models\Friend;
use App\Models\User;
use App\Notifications\FriendRequestNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Notification;

class FriendController extends Controller
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
            'userId' => 'integer'
        ]);

        $friend =  User::findOrFail($request->userId);
        //first check the status of the friendship
        $oldFriendship = Friend::where([
            'user_id' => Auth::user()->id,
            'friend_id' => $friend->id,
            'status' => 'pending'
        ])->first();

        //toggle friendship(add/remove)_______________
        if ($oldFriendship) {
            Friend::where([
                //delete for me
                'user_id' => Auth::user()->id,
                'friend_id' => $friend->id,
                'status' => 'pending'
            ])->orWhere([
                //delete for him
                'user_id' => $friend->id,
                'friend_id' => Auth::user()->id,
                'status' => 'pending'
            ])->delete();
            return 0;
        } else {
            //add friend to each other
            Friend::insert([
                [
                    //add to me
                    'status' => 'pending',
                    'user_id' => Auth::user()->id,
                    'friend_id' => $friend->id,
                    'created_at' => now()
                ], [
                    //add to him
                    'status' => 'pending',
                    'user_id' => $friend->id,
                    'friend_id' => Auth::user()->id,
                    'created_at' => now()
                ]
            ]);

            //send notification through a channel (database)
            Notification::send($friend, new FriendRequestNotification);

            //send notification via broadcasting
            FriendRequestEvent::dispatch($friend->id);
            return 1;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        User::findOrFail($id);
        $friends = Friend::with('user')->where(['user_id' => $id, 'status' => 'accepted'])->get();
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
