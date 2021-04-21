<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Http\Resources\UserResource; 

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *      path="/api/auth/login",
     *      tags={"Auth"},
     *      summary="Login",
     *      description="<b> Retorna el usuario logueado y el token </b> <br> 
     *                  Creation Date: 19/04/2021 05:40 PM <br> 
     *                  Create By: Juan Cuero <br>
     *                   Last Edit Date: 19/04/2021 05:40 PM <br> 
     *       ",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Login")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(@OA\Property(property="data",type="object", ref="#/components/schemas/User"))
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="These credentials do not match our records.",
     *      )
     * )
     */
    public static function login(Request $request){
  
        $login = $request->validate([
            'email_or_username' => 'required|string',
            'password' => 'required|string'
        ]);

        $field = filter_var(request('email_or_username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';


        if (!Auth::attempt([$field => request('email_or_username'), 'password' => request('password')])){

            return response()->json([
                'status'=> 401, 
                'message' =>'These credentials do not match our records.', 
            ], 200);

            
        }
        
        $user = Auth::user();
        $token = $user->createToken($user->email.'-'.now(), []); 

        return response()->json([
            'status'=> 200, 
            'token'=> $token->accessToken ,
            'user'=> new UserResource(Auth::user())
            
        ], 200);

    }


    /**
     * @OA\Get(
     *      path="/api/auth/current",
     *      tags={"Auth"},
     *      summary="Usuario logueado",
     *      description="<b> Returns el usuario logueado. Se debe enviar el token Bearer </b> <br> 
                       Creation Date: 19/04/2021 06:00 PM <br> 
                       Create By: Juan Cuero <br>
                       Last Edit Date: 19/04/2021 06:00 PM <br> 
            ",
     *      security={{"apiAuth":{}}},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *         @OA\JsonContent(@OA\Property(property="data",type="object", ref="#/components/schemas/User"))
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
    */
    public function current(){
 
        return response()->json([
            'status'=> 200, 
            'user'=> new UserResource(Auth::user())
        ], 200);
         
    }

    /**
     * @OA\Get(
     *      path="/api/auth/logout",
     *      tags={"Auth"},
     *      summary="Eliminar token",
     *      description="<b> Se cierra la sesión en el backend eliminando el token</b> <br> 
                       Creation Date: 19/02/2021 08:00 PM <br> 
                       Create By: Juan Cuero <br>
                       Last Edit Date: 19/02/2021 08:40 PM <br> 
            ",
     *      security={{"apiAuth":{}}},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
    */
    public function logout(){
        $token = Auth::user()->token();
        $token->revoke();

        return response()->json([
            'status'=> 200, 
            'message'=> "User Logout" 
            
        ], 200);
    }
}
