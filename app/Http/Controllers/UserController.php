<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Helpers\JwtAuth;

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
                $pwd = hash('SHA256', $params->password);
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
        $jwtAuth = new JwtAuth();
        
        //Recibir datos post
        $json = $req->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);
        //Validar datos
        $validate = \Validator::make($params_array,[
            'email'     => "required|email",
            'password' => "required",
        ]);
        //Si falla la validación
        if ($validate->fails()) {
            $signup = array(
                'status' => "error",
                'code' => "404",
                'message' => "Error login incorrecto",
                'errors' => $validate->errors()
            );
        }else{
            //Cifrar pass
            $pwd = hash('SHA256', $params->password);
            //retornar token  o datos
            $signup = $jwtAuth->signup($params->email, $pwd);
            if (isset($params->getToken)) {
                $signup = $jwtAuth->signup($params->email, $pwd, true);
            }
        }
        return response()->json($signup, 200);
    }

    //actualizar datos del usuario
    public function update(Request $req){
        $token = $req->header('Authorization');
        $jwtAuth = new JwtAuth();
        $checkToken = $jwtAuth->checkToken($token);

        if ($checkToken) {
            echo "Login correcto";
        }else{
            echo "Login incorrecto";
        }
        die();
    }
}
