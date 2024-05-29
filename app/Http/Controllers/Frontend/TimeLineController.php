<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TimeLineController extends Controller
{
    public function index($id)
    {
        return view('frontend.pages.time-line');
    }
}
