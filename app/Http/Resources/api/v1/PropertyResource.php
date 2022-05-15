<?php

namespace App\Http\Resources\api\v1;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\api\v1\characteristic_of_propertyResource;
use App\Http\Resources\api\v1\PhotographResource;

class PropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return
        [
            'id' => $this->id,
            'name' => $this->name,
            'city' => $this->city,
            'description' => $this->description,
            'area' => $this->area,
            'capacity' => $this->capacity,
            'Daily Lease Value' => "falta",
            'Cleaning cost daily value' => "falta",
            'Service cost daily value' => "falta",
            'Owners name' => $this->user->name,
            'Features list' =>   characteristic_of_propertyResource::collection($this->characteristic_of_property),
            'List of photographs' =>  PhotographResource::collection($this->photograph),
            
        ];
    }
}
