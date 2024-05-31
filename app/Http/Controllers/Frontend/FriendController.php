<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        User::findOrFail($request->userId);

        //first check the status of the friendship
        $oldFriendship = Friend::where([
            'user_id' => Auth::user()->id,
            'friend_id' => $request->userId,
            'status' => 'pending'
        ])->first();

        //this if to toggle friendship(add/remove)
        if ($oldFriendship) {
            Friend::where([
                //delete for me
                'user_id' => Auth::user()->id,
                'friend_id' => $request->userId,
                'status' => 'pending'
            ])->orWhere([
                //delete for him
                'user_id' => $request->userId,
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
                    'friend_id' => $request->userId,
                    'created_at' => now()
                ], [
                    //add to him
                    'status' => 'pending',
                    'user_id' => $request->userId,
                    'friend_id' => Auth::user()->id,
                    'created_at' => now()
                ]
            ]);
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
