<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CommentlikeController extends Controller
{
    public function store(Request $request,)
    {
        try {
            $request->user()->commentLikes()->attach($request->id);
            return Response::json(array("mwssage"=>"","status"=>true));
        } catch (\Throwable $th) {
            return Response::json($th, 400);
        }   
    }

    public function destroy(Request $request) {
        try {
            $request->user()->commentLikes()->detach($request->id);
            return Response::json(['message' => 'Like detached successfully']); // Or appropriate success message
        } catch (\Throwable $e) {
            return Response::json(['error' => 'Failed to detach like'], 400); // Or appropriate error message and status code
        }
    }
}
