<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'sku' => 'required|unique:products,sku',
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'sku.required' => 'sku is empty',
            'sku.unique' => 'sku is unique',
            'name.required' => 'name is empty',
            'name.max' => 'name length must not more than 255 characters',
            'price.min' => 'price must not negative',
        ];
    }
}
