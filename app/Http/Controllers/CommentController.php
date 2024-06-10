<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Response;
use Inertia\Inertia;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $post = request()->id;
        $comments = Comment::withCount("likes")->with(["commenter"])->where("post_id","=",$post)->paginate(10,["id","content","created_at","user_id"]);
        foreach ($comments as $comment) {
            $comment->isliked = $comment->isliked();
        }
        return Inertia::render("Comment",compact("comments"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request){
        try {
            $user_id = $request->user()->id;
            $content = $request->content;
            $post_id = $request->id;
    
            $comment = Comment::Create(compact("user_id","content","post_id"));
            $status = true;
            return Response::json(compact(["comment","status"]));

        } catch (\Throwable $th) {
            return Response::json($th,400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
