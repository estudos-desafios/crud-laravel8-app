<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTagRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:50', 'unique:tags,name'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
