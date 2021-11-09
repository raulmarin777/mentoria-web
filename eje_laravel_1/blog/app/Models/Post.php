<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public $fillable = ['title','resumen','body']; //permite el ingreso por tinker (massivo)
    //protected $guarded = [];// no protege nada al ingreso masivo por tinker
    //protected $guarded = ['id'];// no protege nada al ingreso masivo por tinker excepto el id

    public $with = ['category','author'];
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeFilter($query, array $filters){

          $query->when(
            $filters['search'] ?? false,
            fn($query, $search) =>
                $query->where('title','like',"%$search%")
                      ->orWhere('resumen','like',"%$search%")
        );

       /* return $query->when(
            $filters['category'] ?? false,
            fn($query, $category) =>
                $query->whereExists(function ($query){
                $query->from ('categories')
                      ->whereColumn('categoies.id','posts.category_id')
                      ->where('categories.slug', $category)
                })
        );*/


        /*if ($filters['search'] ?? false) {
            return $query->where('title','like','%' . $filters['search'] . '%' )
                        ->orWhere('resumen','like','%' . $filters['search'] . '%' );
        }*/

        $query->when(
            $filters['category'] ?? false,
            fn($query, $category) =>
               $query->whereHas('category', fn($query)=>
                                               $query->where('slug', $category))
        );
/* metodo antiguo
        return $query->when(
            $filters['category'] ?? false,
            function($query, $category){
                $query->whereHas('category', function($query) use ($category){
                    $query->where('slug', $category);
                }
            }
        );*/
        return $query;
    }

    //hasOne, hasMany, belongsTo, belongsToMany
    public function category()
    {
        return $this->belongsTo(Category::class);
    } 

    public function author()
    {
        return $this->belongsTo(User::class,'user_id');
    } 
}
