<?php

namespace App\Http\Requests\Comment;

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
            'user_id' => 'required|integer',
            'product_id' => 'required|integer',
            'user_name' => 'required|string',
            'product_name' => 'required|string',
            'comments' => 'required|string',
        ];
    }

    public function attributes()
    {
        return [
            'user_id'          => __('languages.username'),
            'product_id'       => __('languages.product'),
            'user_name'        => __('languages.username'),
            'product_name'     => __('languages.product_name'),
            'comments'         => __('languages.review'),
        ];
    }
}
