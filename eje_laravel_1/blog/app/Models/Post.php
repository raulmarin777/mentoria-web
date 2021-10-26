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

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeFilter($query){
        if (request('search')){
            return $query->where('title','like','%' . request('search') . '%' )
                        ->orWhere('resumen','like','%' . request('search') . '%' );
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
