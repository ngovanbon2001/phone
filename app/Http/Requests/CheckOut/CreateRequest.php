<?php

namespace App\Http\Requests\CheckOut;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'items'                      => 'required|array',
            'items.*.product_id'         => 'required|integer',
            'items.*.product_name'       => 'required|string',
            'items.*.product_price'      => 'required',
            'items.*.product_quantity'   => 'required|integer|min:0',
        ];
    }
}
