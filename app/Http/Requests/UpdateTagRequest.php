<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTagRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:50', 'unique:tags,name,' . $this->route('tag')->id],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
