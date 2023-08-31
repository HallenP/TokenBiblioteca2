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

    $credentials = $r->only('email', 'password');
         
         $user = User::where('email', $credentials['email'])->first();
         
         if (!$user) {
             return redirect()->back()->with('error', 'Usuario no encontrado');
         }
         
         if (Hash::check($credentials['password'], $user->password)) {
             // Genera el token
             $token = JWTAuth::fromUser($user);
             
             $url = 'http://127.0.0.1:8000/token-login/' . $token;

             return respuesta(TRUE, '', [], $url);
             
             //return response()->json(compact('url'));
             return redirect()->away($url);
         } else {
             //return redirect()->back()->with('error', 'Contraseña incorrecta');
             return respuesta(FALSE, '', [], $token);
         }
     
     
         }
}
