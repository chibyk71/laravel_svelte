<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Inertia\Inertia;

class PostController extends Controller
{
    public function show(Request $request) {
        if ($request->user()->isAdmin()) {
            return Inertia::render("Create");
        }

        return Redirect::to('/');
    }

    public function store(Request $req) {

        $validated = $req->validate([
            'text' => 'required|string',
            'files' => 'required|array',
            'files.*' => 'file|max:30720',
        ]);

        $files =  $req->file('files');
        $path = "";

        $post =  Post::Create(["caption"=>$req->text]);
        foreach ($files as $file) {
            $path = $file->store("medias","public");
            $type = explode("/",$file->getMimeType())[0];

            Media::Create(["path"=>$path,"type"=>$type,"post_id"=>$post->id]);

        }
        return Response::json(["message"=>$req->text,"status"=>true]);
    }
}
