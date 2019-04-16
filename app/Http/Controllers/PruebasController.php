<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//usar modelos
use App\Post;
use App\Category;

class PruebasController extends Controller
{

    
    public function index(){
        $animales = ['perro', 'gato'];
        $titulo = "TITULO DE LA PAGINA";
        return view('pruebas.index', array(
            'titulo' => $titulo,
            'animales' => $animales
        ));
    }

    public function textOrm(){
        /* $posts = Post::all();
        foreach ($posts as $post) {
            echo "<p>";
            echo $post->title ."<br><br>";

            echo "<span>Creado por: ".$post->user->name."</span><br>";
            echo "<small>Categoria: ".$post->category->name."</small>";

            echo "</p>";
            echo "<hr>";
        } */
        $categories = Category::all();
        foreach ($categories as $category) {
            echo "<span> CATEGORIA: ".$category->name."</span><br>";
            foreach ($category->posts as $post) {
                echo "<p>";
                echo $post->title ."<br><br>";
    
                echo "<span>Creado por: ".$post->user->name."</span><br>";
                echo "<small>Categoria: ".$post->category->name."</small>";
    
                echo "</p>";
            }
            echo "<hr>";
        }
        die();
    }

    public function pruebas(Request $req){
        return "PRUEBA DESDE USERController";
    }
}
