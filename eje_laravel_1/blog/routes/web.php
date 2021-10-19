<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // crea cache
    // $posts = cache()->rememberForever('posts_all',  fn () => Post::all()  );

    Illuminate\Support\Facades\DB::listen(function($query){
        logger($query->sql, $query->bindings);
    });

    //$posts = Post::all();
    // al usa Post:: se puede accedero al metodo sin necesidad de creaar un onbeto (new)
    return view('posts', [
        'posts' => Post::latest('published_at')
                       ->with(['category','author'])
                       ->get(),
        'categories' => Category::all(),
    ]);
    
});

Route::get('/post/{post}', function (Post $post) {
    return view ('post', [
        'post' => $post,
    ]);
}); // validacion de caracteres en url-> where('post', '[A-Za-z\_-]+');



Route::get('/category/{category:slug}', function (Category $category) {
    return view ('posts', [
        'posts' => $category->posts->load(['category','author']),
        'categories' => Category::all()
        /*'posts' =>  Post::join('categories','categories.id','=','posts.category_id')
                    ->where('posts.category_id',  $category->id)
                    ->latest('published_at')
                    ->with(['category','author'])
                    ->get()*/
                    /* el load se usa para variable y el with para estaticos :: */
    ]);
}); // validacion de caracteres en url-> where('post', '[A-Za-z\_-]+');



Route::get('/author/{author}', function (User $author) {
    //ddd($author->posts);
    return view ('posts', [
        //eager loading (load, with)
        //por defecto es lazy loading
        //load es para variables with para llamados metodos estaticos (::)
        //(carga automaticamente las relaciones de la BD)
        'posts' => $author->posts->load(['category','author']),
        'categories' => Category::all()
    ]);
});

//Route::get('/', fn () => view ('welcome'));
//Route::get('/', fn () => 'Hola Segic');
//Route::get('/', fn () => ['id' => 7, 'url' => 'http://www.segic.cl']);