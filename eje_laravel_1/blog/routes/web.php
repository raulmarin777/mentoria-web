<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Illuminate\Support\Facades\File;

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
    $posts = Post::all();

    /* foreach ($files as $file){
        $document=YamlFrontMatter::parseFile($file);
        $posts[] = new Post(
                        $document->title,
                        $document->resumen,
                        $document->date,
                        $document->body()
                        );
    }*/

    /*$posts = array_map(function($file){
        $document=YamlFrontMatter::parseFile($file);
        return new Post(
                        $document->title,
                        $document->resumen,
                        $document->date,
                        $document->body()
                        );
    }, $files);*/

   /* $posts = collect(File::files(resource_path("posts/")))
        ->map(fn($file) => YamlFrontMatter::parseFile($file)); // arreglo de documentos
        ->map(fn($document) => Post::createFromDocument($document));
    */
    //ddd ($document);
    //ddd ($document->title);

    return view ('posts', [
        'posts' => $posts
    ]);
});

Route::get('/post/{post}', function ($slug) {
    return view ('post', [
        'post' => Post::find($slug),
    ]);
})-> where('post', '[A-Za-z\_-]+');
     


//Route::get('/', fn () => view ('welcome'));
//Route::get('/', fn () => 'Hola Segic');
//Route::get('/', fn () => ['id' => 7, 'url' => 'http://www.segic.cl']);