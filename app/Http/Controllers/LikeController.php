<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Http\Requests\StoreLikeRequest;
use App\Models\Post;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class LikeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLikeRequest $request){
        $request->user()->likes()->attach($request->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StoreLikeRequest $request) {
        try {
            $request->user()->likes()->detach($request->id);
            return Response::json(['message' => 'Like detached successfully']); // Or appropriate success message
        } catch (Exception $e) {
            return Response::json(['error' => 'Failed to detach like'], 400); // Or appropriate error message and status code
        }
    }
}
