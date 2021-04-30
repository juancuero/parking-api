<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'placa' => $this->placa,
            'document_number' => $this->document_number,
            'place' => $this->place->typeVehicle->acronym.'-'.$this->place->lot,
            'leaving_date' => $this->leaving_date,
            'hours' => $this->hours,
            'created_at' => $this->created_at->format('Y-m-d H:i:s A'),
            $this->mergeWhen($this->leaving_date == null, ['total_to_pay' => $this->hours *  $this->place->typeVehicle->price]),
            $this->mergeWhen($this->leaving_date != null, ['amount' => $this->amount])
        ];
    }
}

 