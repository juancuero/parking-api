<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


/**
     * @OA\Info(
     *      version="1.0.0",
     *      title="API Documentation",
     *      description="L5 Swagger OpenApi description",
     *      @OA\Contact(
     *          email="juan.cuero@unillanos.edu.co,juan.camacho@unillanos.edu.co"
     *      ),
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )
     *
     * @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST,
     *      description="Demo API Server"
     * )
     * 
     * /**
    * @OA\SecurityScheme(
    *     type="http",
    *     description="Login with email and password to get the authentication token",
    *     name="Token based Based",
    *     in="header",
    *     scheme="bearer",
    *     bearerFormat="JWT",
    *     securityScheme="apiAuth",
    * )
    
    *@OA\Tag(
    *     name="Auth",
    *     description="API Endpoints of Auth"
    * )

    *@OA\Tag(
    *     name="Parking",
    *     description="API Endpoints of Parking"
    * )

    
*/
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
