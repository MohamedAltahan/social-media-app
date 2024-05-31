<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function markAllRead()
    {
        Auth::user()->notifications->markAsRead();
        return redirect()->back();
    }
    public function clearAll()
    {
        Auth::user()->notifications()->delete();
        return redirect()->back();
    }
}
