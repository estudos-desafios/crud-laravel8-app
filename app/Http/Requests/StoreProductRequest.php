<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'    => ['required', 'string', 'max:50', 'unique:products,name'],
            'tags'    => ['nullable', 'array'],
            'tags.*'  => ['integer', 'exists:tags,id'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
