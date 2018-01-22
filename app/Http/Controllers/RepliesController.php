<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Thread;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store.
     *
     * @param [type] $channelId
     * @param Thread $thread
     * @return void
     */
    public function store($channelId, Thread $thread)
    {
        $thread->addReply([
            'user_id'   => auth()->id(),
            'body'      => request('body')
        ]);
    
        return back()->with('flash', 'Your reply has been left.');
    }

    public function destroy(Reply $reply)
    {
        if($reply->user_id != auth()->id()){
            return response([], 403);
        }

        $reply->delete();

        return back();
    }
}
