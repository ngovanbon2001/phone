<?php

namespace App\Http\Requests;

use App\Rules\CurrentPassword;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'curpassword'   => new CurrentPassword,
            'password'      => 'required|string|confirmed',
        ];
    }

    public function attributes()
    {
        return [
            'password' => __('languages.password'),
        ];
    }
}
