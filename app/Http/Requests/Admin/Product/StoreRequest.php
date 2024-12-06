<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|unique:products,name',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'required|mimes:jpg,bmp,png,jpeg'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter product name',
            'name.unique' => 'Product name is exist. Please choose other product name, my friend.',
            'price.required' => 'Please enter product price',
            'price.numeric' => 'Price is number',
            'description.required' => 'Please enter product description',
            'image.required' => 'Please enter product image',
            'image.mimes' => 'Images must jpg,bmp,png,jpeg'
        ];
    }
}
