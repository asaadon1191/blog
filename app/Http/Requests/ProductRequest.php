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
        return 
        [
            'name'          => 'required|unique:products,name,'.$this->id,
            'price'         => 'required|integer',
            'category_id'   => 'required|exists:categories,id',
            'desc'          => 'required'
        ];
    }
}
