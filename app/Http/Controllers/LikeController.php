<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Http\Requests\StoreLikeRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLikeRequest $request){
        $post = Post::where("id",$request->id);

        $request->user()->likes()->attach($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post) {
        $liker = Auth::user();
        $liker->likes()->detach($post);
    }
}
