<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{   
    //Tabla a relacioonar
    protected $table = 'categories';

    //Relacion 1 - Muchos con la tabla posts
    public function posts(){
        //Indicamos el modelo a relacionar
        return $this->hasMany('App\Post');
    }
}
