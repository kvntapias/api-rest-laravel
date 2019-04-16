<?php 
    
namespace App\Helpers;
//Libreria jwt
use Firebase\JWT\JWT;
//Objeto de la base de datos
use Illuminate\Support\Facades\DB;
//Modelo usuario
use App\User;

class JwtAuth{
    public $key;
    public function __construct(){
        $this->key = "SYSTEMKEY-*33Llm2_**1";
    }

    public function signup($email, $password, $getToken = null){
        //Verificar si existe credenciales de usuario
        $user = User::where([
            'email' => $email,
            'password' => $password
        ])->first(); 
        //Comprobar si las credenciales son correctas
        $signup = false;
        if (is_object($user)) {
            $signup = true;
        }

        if ($signup){
            //Generar el token con el usuario indeificado
            $token = array(
                'sub' => $user->id,
                'email' => $user->email,
                'name' => $user->name,
                'surname' => $user->surname,
                'iat' => time(),
                'exp' => time() + (7*24*60*60)
            );
            //Codificar token
            $jwt = JWT::encode(
                $token,
                $this->key,
                'HS256'
            );

            $decoded = JWT::decode($jwt, $this->key, ['HS256']);

            if (is_null($getToken)) {
                $data = $jwt;
            }else{
                $data = $decoded;
            }
        }else{
            //Si falla la autenticacion
            $data = array(
                'status' => 'error',
                'message' => 'Login incorrecto'
            );
        }

        return $data;
    }

    public function checkToken($jwt, $getIdentity = false){
        $auth = false;
        try {
            $jwt = str_replace('"', '', $jwt);
            $decoded = JWT::decode($jwt, $this->key, ['HS256']);
        } 
        catch (\UnexpectedValueException $e) {
            $auth = false;
        }
        catch (\DomainException $e) {
            $auth = false;
        }
        if (!empty($decoded) && is_object($decoded) && isset($decoded->sub)) {
            $auth = true; 
        }
        if ($getIdentity) {
            return $decoded;
        }
        return $auth;
    }
}
