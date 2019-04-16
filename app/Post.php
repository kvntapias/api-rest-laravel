<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    
    //Post pertenece a 1 usuario
    public function user(){
        //Indicamos la clase a relacionar y la llave foranea en tabla base(post)
        return $this->belongsTo('App\User', 'user_id');
    }

    //Post pertenece a 1 categoria
    public function category(){
        return $this->belongsTo('App\Category','category_id');
    }
}
