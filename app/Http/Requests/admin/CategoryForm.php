<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryForm extends FormRequest
{

    public function authorize(): bool
    {
        return auth("admin")->check();
    }


    public function rules(): array
    {
        return [
            "title" => ["required","min:3","max:50",\Illuminate\Validation\Rule::unique('categories', 'title')->ignore($this->category)],
            "thumbnail" => ["nullable","image"],
        ];
    }
}
