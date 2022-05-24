<?php

namespace App\Http\Resources\api\v1;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\api\v1\AvailabilityResource;
use App\Models\Rental_availability;


class BillResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $dates = Rental_availability::where('id', '=', $this->rental_avalability)->get();

        return
        [
            'Id' => $this->id,
            'Property_id' => $this->property->id,
            'Rental_value' => $this->rental_value,
            'Cleaning_cost' => $this->cleaning_cost,
            'Service_cost' => $this->service_cost,
            'Paid_out' => $this->paid_out,
            'Dates_reserved' => AvailabilityResource::collection($dates),
        ];
    }
}