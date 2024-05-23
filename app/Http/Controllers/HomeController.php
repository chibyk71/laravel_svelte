<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller{
    function show(): Response {
        $user = auth()->user();
        $posts = Post::withCount("likes")->with("medias")->orderBy("created_at","DESC")->paginate(10);

        foreach($posts as $post) {
            $post->isLiked = $post->isLiked();
        }

        return Inertia::render("Home",["data"=>$posts]);
    }

    
    public function fetch() {
        $posts = Post::with(["medias","likes"])->orderBy("created_at","DESC")->paginate(10);

        foreach($posts as $post) {
            $post->isLiked = $post->isLiked();
        }
        return FacadesResponse::json(["data"=>$posts,"status"=>true]);
    }
}
