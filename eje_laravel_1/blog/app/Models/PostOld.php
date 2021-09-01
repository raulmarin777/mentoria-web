<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;


class Post
{

    public string $title;
    public string $resumen;
    public string $date;
    public string $slug;
    public string $body;

    public function __construct( $title, $resumen, $date, $slug, $body ){
        $this->title = $title;
        $this->resumen = $resumen;
        $this->date = $date;
        $this->slug = $slug;
        $this->body = $body; 
    }

    public static function createFromDocument($document){
        return new self(
            $document->title,
            $document->resumen,
            $document->date,
            $document->slug,
            $document->body()
        );
    }

    public static function all(){
        return collect(File::files(resource_path("posts/")))
        ->map(fn ($file) => YamlFrontMatter::parseFile($file)) // arreglo de documentos
        ->map(fn ($document) => Post::createFromDocument($document));

    }

    public static function find($slug)
    {
        /*cache()->remember("indice", "caducidad", "callback" => lo que se guarda*/
        /*fn () => 5
        function fn(){
            return 5;
        }*/
        return cache()->remember("post.{$slug}", now()->addDays(1), fn() => static::all()->firstWhere('slug', $slug));
    }
}
