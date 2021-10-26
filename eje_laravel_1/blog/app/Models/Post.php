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

        /*$query->when(
            isset($filters['search']),
            fn($query, $search) =>
            $query->where('title','like',"%$search%")
                  ->orWhere('resumen','like',"%$search%")
        );*/

        if ($filters['search'] ?? false) {
            return $query->where('title','like','%' . $filters['search'] . '%' )
                        ->orWhere('resumen','like','%' . $filters['search'] . '%' );
        }
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
