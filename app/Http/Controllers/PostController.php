<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function pruebas(Request $req){
        return "PRUEBA DESDE POSTController";
    }
}
