<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use App\Models\Place;
use App\Http\Resources\CustomerResource; 
use App\Http\Resources\PlaceResource; 
use App\Http\Resources\TypeVehicleResource; 

class ParkingController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/parkings",
     *      tags={"Parking"},
     *      summary="List Vehiculos",
     *      description="<b>Info Vehiculos.</b> <br> 
                       Creation Date: 26/04/2021 06:00 PM <br> 
                       Create By: Juan Cuero <br>
                       Last Edit Date: 26/04/2021 06:00 PM <br> 
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
    public function index()
    {
        $customers =  Customer::all();
        return response()->json([
            'status'=> 200, 
            'customers'=> CustomerResource::collection($customers),
        ], 200);
    }

    /**
     * @OA\Post(
     *      path="/api/parkings",
     *      tags={"Parking"},
     *      summary="Registrar Vehiculo",
     *      description="<b> Retorna el vehiculo registrado.</b> <br> 
                       Creation Date: 26/04/2021 06:00 PM <br> 
                       Create By: Juan Cuero <br>
                       Last Edit Date: 26/04/2021 06:00 PM <br> 
            ",
     *      security={{"apiAuth":{}}},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/CustomerCreate")
     *      ),
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
    public function store(CustomerRequest $request)
    {

        $customer = Customer::create($request->all());


        return response()->json([
            'status'=> 201,     
            'customer'=> new CustomerResource( $customer),     
        ], 201);
    }

    /**
     * @OA\Get(
     *      path="/api/parkings/{parking}",
     *      tags={"Parking"},
     *      summary="Info Vehiculo",
     *      description="<b>Info Vehiculo.</b> <br> 
                       Creation Date: 26/04/2021 06:00 PM <br> 
                       Create By: Juan Cuero <br>
                       Last Edit Date: 26/04/2021 06:00 PM <br> 
            ",
     *      security={{"apiAuth":{}}},
     *         @OA\Parameter(
     *          name="parking",
     *          description="id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ), 
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
    public function show( $id)
    {
         
        return response()->json([
            'status'=> 200,        
             'customer'=> new CustomerResource(Customer::findorfail($id)),     
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * @OA\Post(
     *      path="/api/parkings/{customer}/checkout",
     *      tags={"Parking"},
     *      summary="Registrar Salida Vehiculo",
     *      description="<b>Registrar Salida Vehiculo.</b> <br> 
                       Creation Date: 26/04/2021 06:00 PM <br> 
                       Create By: Juan Cuero <br>
                       Last Edit Date: 26/04/2021 06:00 PM <br> 
            ",
     *      security={{"apiAuth":{}}},
     *         @OA\Parameter(
     *          name="customer",
     *          description="id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ), 
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
    public function checkout(Request $request, Customer $customer)
    {

        if($customer->leaving_date == null){


            $customer->leaving_date = Carbon::now()->toDateTimeString();
            $customer->amount = $customer->hours *  $customer->place->typeVehicle->price;
            $customer->save();

            return response()->json([
                'status'=> 200,     
                'customer'=> new CustomerResource( $customer),     
            ], 200);

        }
 
        return response()->json([
            'status'=> 200,     
            'message'=> "The leaving date of the vehicle has already been registered.",     
            'customer'=> new CustomerResource( $customer),     
        ], 200);
    }

    /**
     * @OA\Get(
     *      path="/api/parkings/types",
     *      tags={"Parking"},
     *      summary="List Types Vehicles Places",
     *      description="<b>Info Types.</b> <br> 
                       Creation Date: 26/04/2021 08:00 PM <br> 
                       Create By: Juan Cuero <br>
                       Last Edit Date: 26/04/2021 08:00 PM <br> 
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
    public function types()
    {
        $types =  TypeVehicle::all();
        return response()->json([
            'status'=> 200, 
            'types'=> TypeVehicleResource::collection($types),
        ], 200);
    }
}
