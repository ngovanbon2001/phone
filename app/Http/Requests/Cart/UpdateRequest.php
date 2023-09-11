<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
            'data.*.product_id' => 'required|integer',
            'data.*.name'       => 'required|string',
            'data.*.price'      => 'required',
            'data.*.quantity'   => 'required|integer|min:0',
        ];
    }
}
