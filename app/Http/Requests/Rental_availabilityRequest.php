<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Rental_availabilityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'availability' => 'required',
            'start_date' => 'required|string|max:50',
            'departure_date' => 'required|min:1|max:1000'
        ];
    }
}
