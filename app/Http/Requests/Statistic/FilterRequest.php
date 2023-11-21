<?php

namespace App\Http\Requests\Statistic;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
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
            'start-date-product' => [($this->input('end-date-product')) ? 'required' : 'nullable', 'date'],
            'end-date-product' => [($this->input('start-date-product')) ? 'required' : 'nullable', 'date', 'after:start-date-product'],
            'start-date-order' => [($this->input('end-date-order')) ? 'required' : 'nullable', 'date'],
            'end-date-order' => [($this->input('start-date-order')) ? 'required' : 'nullable', 'date', 'after:start-date-order'],
            'paginate-order' => 'nullable|integer',
            'paginate-item' => 'nullable|integer',
            'paginate-product' => 'nullable|integer',
        ];
    }

    public function attributes()
    {
        return [
            'start-date-product' => __('languages.start_date'),
            'end-date-product'   => __('languages.end_date'),
            'start-date-order'   => __('languages.start_date'),
            'end-date-order'     => __('languages.end_date'),
            'paginate-order'     => __('languages.paginate'),
            'paginate-item'      => __('languages.paginate'),
            'paginate-product'   => __('languages.paginate'),
        ];
    }
}
