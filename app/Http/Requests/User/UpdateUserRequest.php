<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        $id = $this->route('id');
        return [
            'username' => ['required', 'string', Rule::unique('admin')->ignore($id, 'id')],
            'email' => ['required','email', 'string', Rule::unique('admin')->ignore($id, 'id')],
            'phone' => 'required|string'
        ];
    }
}
