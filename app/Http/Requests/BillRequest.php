<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillRequest extends FormRequest
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
            'rental_value' => 'required|min:0|max:1000',
            'cleaning_cost' => 'required|min:0|max:1000',
            'service_cost' => 'required|min:0|max:1000',
            'paid_out' => 'required',
        ];
    }
}