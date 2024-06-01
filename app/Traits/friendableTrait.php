<?php

namespace App\Traits;

use App\Models\Friendship;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait friendableTrait
{

    //add friend ________________________________________________________________
    public function addFriend($friendId)
    {
        $friendship =  Friendship::create([
            'user_id' => Auth::user()->id,
            'friend_id' => $friendId,
        ]);
        if ($friendship) {
            return response()->json('sent', 201);
        }
        return response()->json('fail', 501);
    }

    //accept friend ________________________________________________________________
    public function acceptFriend($requester)
    {
        $friendship = Friendship::where('user_id', $requester)
            ->where('friend_id', Auth::user()->id)->first();
        if ($friendship) {
            $friendship->update([
                'status' => 'accepted'
            ]);
            return response()->json('accepted', 200);
        }
        return response()->json('fail', 501);
    }

    //delete friend ________________________________________________________________
    public function deleteFriend($friendId)
    {
        //any of the can delete each other
        $friendshipdeleted = Friendship::where([
            'user_id' => Auth::user()->id,
            'friend_id' => $friendId
        ])->orwhere([
            'user_id' => $friendId,
            'friend_id' => Auth::user()->id
        ])->delete();

        if ($friendshipdeleted) {
            return response()->json('deleted', 200);
        }
        return response()->json('fail', 501);
    }

    // check Friendship ________________________________________________________________
    public function checkFriendship($friendProfileId)
    {
        $authUser = Auth::user()->id;

        if (Friendship::where([
            'friend_id' => $authUser,
            'user_id' => $friendProfileId,
            'status' => 'pending'
        ])->first()) {

            return 'accept';
        } elseif (Friendship::where([
            'friend_id' => $authUser,
            'user_id' => $friendProfileId,
            'status' => 'accepted'
        ])->first()) {

            return  'friend';
        } elseif (Friendship::where([
            'user_id' => $authUser,
            'friend_id' => $friendProfileId,
            'status' => 'pending'
        ])->first()) {

            return 'sent';
        } elseif (Friendship::where([
            'user_id' => $authUser,
            'friend_id' => $friendProfileId,
            'status' => 'accepted'
        ])->first()) {

            return 'friend';
        } else {

            return null;
        }
    }

    //get friends________________________________________________________________
    public function getFriends($userId)
    {

        //check if the user is in user_id column and get the value of the opposite column
        $friendshipGroup1 = Friendship::where(['user_id' => $userId, 'status' => 'accepted'])
            ->pluck('friend_id')->toArray();

        //check if the user is in friend_id column and get the value of the opposite column
        $friendshipGroup2 = Friendship::where(['friend_id' => $userId, 'status' => 'accepted'])
            ->pluck('user_id')->toArray();

        $friendsIds =  array_merge($friendshipGroup1, $friendshipGroup2);
        $allFriends = User::wherein('id', $friendsIds)->get();
        return $allFriends;
    }
}
