<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFastOrder extends FormRequest
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

    // public function messages() {
    //     return [
            
    //     ];
    // }

    public function attributes() {
        return [
            'name' => trans('app.name'),
            'phone' => trans('app.phone'),
            'box_count' => trans('app.box_count'),
            'cod_amount' => trans('app.cod_amount'),
            'valid_number' => trans('app.phone'),
            'vehicle_id'  => trans('app.vehicle'),
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
        ];
    }
}
