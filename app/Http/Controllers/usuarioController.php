<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;

class usuarioController extends Controller
{


    public function registrar(Request $request) {
 // $credentials = $request->only('name','email', bcrypt('password'));
   try {
       $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);
   } catch (Exception $e) {
       return response()->json(['error' => 'User already exists.'], HttpResponse::HTTP_CONFLICT);
   }

   $token = JWTAuth::fromUser($user);

   return response()->json(compact('token'));


    }

public function login(Request $request) {
   $credentials = $request->only('email', 'password');
        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Usuario / Contraseña incorrectos'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        // all good so return the token
         return response()->json(compact('token'));
}

// /**
//      * Return the authenticated user
//      *
//      * @return Response
//      */
//     public function getAuthenticatedUser()
//     {
//         try {

//             if (! $user = JWTAuth::parseToken()->authenticate()) {
//                 return response()->json(['user_not_found'], 404);
//             }

//         } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

//             return response()->json(['token_expired'], $e->getStatusCode());

//         } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

//             return response()->json(['token_invalid'], $e->getStatusCode());

//         } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

//             return response()->json(['token_absent'], $e->getStatusCode());

//         }

//         // the token is valid and we have found the user via the sub claim
//         return response()->json(compact('user'));
//     }

}
