<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Thread $thread, Request $request)
    {
        $thread->addReply([
            'body'    => $request->input('body'),
            'user_id' => auth()->user()->id
        ]);

        return back();
    }
}
