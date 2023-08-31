<?php

namespace App\Http\Controllers\GestionToken;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Routing\Redirector;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules;
use App\Models\User;
use App\Models\Libro;
use Log;
use Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Crypt;


class GestionTokenController extends Controller
{
    //ingresamos la funcion que nos genera el token
    public function generatetoken(Request $r){
        // creamos la variable credential la cual contendra el correo y la contraseña

    $credentials = $r->only('email', 'password');
        //creamos una variable $user la cual buscara el email ingresado en la tabla de User
         
         $user = User::where('email', $credentials['email'])->first();
         // creamos un condicional, en caso ese correo tiene la base de datos
         
         if (!$user) {
             return redirect()->back()->with('error', 'Usuario no encontrado');
         }
         
         //creamos un condicional donde el atributo del password se encriptara, para la respectiva generacion del token
         if (Hash::check($credentials['password'], $user->password)) {
             // Genera el token con el patron JWT, de la tabla de datos User
             $token = JWTAuth::fromUser($user);
             
             //enviamos la url junto al token
             $url = 'http://127.0.0.1:8000/token-login/' . $token;
            // retorna una resouesta verdadera con la variable url
             return respuesta(TRUE, '', [], $url);
             
             //return response()->json(compact('url'));
             return redirect()->away($url);
         } else {
             //return redirect()->back()->with('error', 'Contraseña incorrecta');
             
             // si no cumple el condicional, se enviara una respuesta de false y no se creara el token
             return respuesta(FALSE, '', [], $token);
         }
     
     
         }
}
