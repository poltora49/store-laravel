<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductForm extends FormRequest
{

    public function authorize(): bool
    {
        return auth("admin")->check();
    }

    public function rules(): array
    {
        return [
            "title" => ["required|min:3|max:50"],
            "price" => ["required|email"],
            "description" => ["required|confirmed|min:6"],
            "thumbnail" => ["nullable|image"],
        ];
    }
}
