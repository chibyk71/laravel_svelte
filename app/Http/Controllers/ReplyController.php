<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Http\Requests\StoreReplyRequest;
use App\Http\Requests\UpdateReplyRequest;
use Illuminate\Support\Facades\Response;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comment = request()->id;
        $replies = Reply::withCount("likes")->with(["replier"])->where("comment_id","=",$comment)->paginate(10,["id","content","created_at","user_id"]);
        foreach ($replies as $reply) {
            $reply->isliked = $reply->isliked();
        }
        return Response::json(compact("replies"));
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
    public function store(StoreReplyRequest $request) {
        try {
            $user_id = $request->user()->id;
            $content = $request->content;
            $comment_id = $request->id;
    
            $reply = Reply::Create(compact("user_id","content","comment_id"));
            $status = true;
            return Response::json(compact(["reply","status"]));

        } catch (\Throwable $th) {
            return Response::json($th,400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Reply $reply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reply $reply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReplyRequest $request, Reply $reply)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reply $reply)
    {
        //
    }
}
