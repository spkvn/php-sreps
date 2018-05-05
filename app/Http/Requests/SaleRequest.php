<?php

namespace PHPSREPS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
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
            'customer' => 'required',
            'code' => 'required',
            'product_id' => 'required',
            'quantity' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'product_id.required' => 'At least one product is required',
            'quantity' => 'At least one quantity is required'
        ];
    }
}
