<?php

namespace App\Http\Requests\Image;

use App\Rules\ImageRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateImageRequest extends FormRequest
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
            "image_url" => ["required", "array", new ImageRule()],
            "image_url.*" => "mimes:jpeg,jpg,png,gif,svg|max:8000",
        ];
    }
}
