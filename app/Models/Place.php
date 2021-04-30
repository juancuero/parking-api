<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    protected $fillable = [
        'lot',
        'type_vehicle_id',
        'active', 
    ];

    public function typeVehicle()
    {
        return $this->belongsTo(TypeVehicle::class);
    }
}


 