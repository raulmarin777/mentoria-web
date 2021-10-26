<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\Post;
use app\Models\Category;

class PostController extends Controller
{
    public function index(){
        /* $posts = Post::latest('published_at')
                ->with(['category','author']);

       if (request('search')){
            $posts->where('title','like','%' . request('search') . '%' )
                ->orWhere('resumen','like','%' . request('search') . '%' );
        }*/

        return view('posts', [
            'posts' => Post::latest('published_at')
                    ->filter(request(['search']))
                    ->get(),
            'categories' => Category::all(),
        ]);
    }

    public function show(Post $post){
        return view ('post', [
            'post' => $post,
        ]);
    }
}
