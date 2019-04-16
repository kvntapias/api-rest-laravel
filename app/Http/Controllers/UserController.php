<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;

class UserController extends Controller
{
    public function pruebas(Request $req){
        return "PRUEBA DESDE USERController";
    }

    public function register(Request $req){
        //recoger datos del user por post
        $json = $req->input('json');
        $params = json_decode($json);
        $params_array = json_decode($json, true);
        
        if (!empty($params_array) && !empty($params)) {
            //limpiar datos
            $params_array = array_map('trim', $params_array);

             //validar datos 
             $validate = \Validator::make($params_array,[
                'name'      => "required|alpha",
                'surname'   => "required|alpha",
                'email'     => "required|email|unique:users",
                'password' => "required",
            ]);
            //Si falla la validación
            if ($validate->fails()) {
                $data = array(
                    'status' => "error",
                    'code' => "404",
                    'message' => "El usuario no esta creado correctamente",
                    'errors' => $validate->errors()
                );
            }else{
                //cifrar password
                $pwd = password_hash($params->password, PASSWORD_BCRYPT, ['cost' => 4]);
                //Setear valores al objeto usuario
                $user = new User();
                $user->name = $params_array['name'];
                $user->surname = $params_array['surname'];
                $user->email = $params_array['email'];
                $user->password = $pwd;
                $user->role = "ROLE_USER";
                //guadar el usuario
                $user->save();

                //si la Validacion es correcta
                $data = array(
                    'status' => "success",
                    'code' => "200",
                    'message' => "El usuario se ha creado correctamente"
                );
            }
        }else{
            $data = array(
                'status' => "error",
                'code' => "404",
                'message' => "Los datos son incorrectos"
            );
        }

        return response()->json($data, 400);
        die();

        /* $data = array(
            'status' => "error",
            'code' => "200",
            'message' => "El usuario no esta creado correctamente"
        ); */
        return response()->json($data, $data['code']);
    }

    public function login(Request $req){
        return "Login de usuario";
    }
}
