<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

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
                        ->filter(request(['search', 'category']))
                        ->paginate(6),
            'categories' => Category::all(),
            'currentCategory' =>
                            request('category') != null ? Category::where('slug', request('category'))->first() : null
        ]);
    }

    public function show(Post $post){
        return view ('post', [
            'post' => $post,
        ]);
    }
}
