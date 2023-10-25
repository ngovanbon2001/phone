<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'category_id' => 'required',
            'brand_id' => 'required',
            'name' => 'required|string',
            'price' => 'required|numeric' . ($this->input("old_price") ? "|max:" . $this->input("old_price") : ""),
            'sort_order' => 'required|numeric|min:0',
            'amount' => 'required|numeric|min:0',
            "specifications" => 'required|array',
            "specifications.screen" => 'required|string',
            "specifications.operating_system" => 'required|string',
            "specifications.rear_camera" => 'required|string',
            "specifications.front_camera" => 'required|string',
            "specifications.cpu" => 'required|string',
            "specifications.ram" => 'required|string',
            "specifications.memory_stick" => 'required|string',
            "specifications.internal_memory" => 'required|string',
            "specifications.battery" => 'required|string',
            'color' => 'required|numeric',
        ];
    }

    public function attributes()
    {
        return [
            'category_id'                     => __('languages.category'),
            'brand_id'                        => __('languages.brand'),
            'name'                            => __('languages.name'),
            'price'                           => __('languages.price'),
            'sort_order'                      => __('languages.sort'),
            'amount'                          => __('languages.amount'),
            'specifications.screen'           => __('languages.screen'),
            'specifications.operating_system' => __('languages.operating_system'),
            'specifications.rear_camera'      => __('languages.rear_camera'),
            'specifications.front_camera'     => __('languages.front_camera'),
            'specifications.cpu'              => __('languages.cpu'),
            'specifications.ram'              => __('languages.ram'),
            'specifications.memory_stick'     => __('languages.memory_stick'),
            'specifications.internal_memory'  => __('languages.internal_memory'),
            'specifications.battery'          => __('languages.battery'),
            'color'                           => __('languages.color'),
        ];
    }
}
