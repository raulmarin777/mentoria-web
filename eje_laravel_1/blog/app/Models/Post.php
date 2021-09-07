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
}
