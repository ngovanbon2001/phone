<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class FilterProductRequest extends FormRequest
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
            "name" => "nullable|string",
            "brand" => "nullable|numeric",
            "category" => "nullable|numeric",
            "isNew" => "nullable|numeric",
            "bestSell" => "nullable|numeric",
        ];
    }
}
