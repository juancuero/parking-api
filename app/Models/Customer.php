<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'placa',
        'place_id',
        'document_number',
        'leaving_date', 
    ];

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    /*
    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d H:i:s A');
    }*/

    
   

    public function gethoursAttribute()
    {
        $hours = 0;

        $date = Carbon::now();

        if($this->leaving_date != null){ 
            $date = $this->leaving_date;
        }

        $hours = $this->created_at->diffInMinutes($this->leaving_date);
        $hours =  ceil($hours / 60);

        if($hours == 0){
            $hours = 1;
        }

        return $hours;
    } 
    
    public function scopeBusqueda($query, $titulo)
    {
        $campos = [
        'name', 'placa', 'document_number'
        ];

        
        if (trim($titulo) != "") {
                foreach($campos as $attribute) {
                     $query->orWhere($attribute, 'LIKE', "%{$titulo}%");
                }

        }

    }

 

}

/**
 * @OA\Schema(
 * schema="CustomerCreate",
    * description="<b> Register Customer model</b> <br>",
    * @OA\Property(title="Name",property="name",description="Name of the customer",type="string" ,example="Pepito Perez"),
    * @OA\Property(title="Placa",property="placa",description="Placa",type="string",example="UTX-000"), 
    * @OA\Property(title="Document Number",property="document_number",description="Document Number",type="integer",example=123456), 
    * @OA\Property(title="Place",property="place_id",description="places",type="integer",example=1)
 * )
 */

 