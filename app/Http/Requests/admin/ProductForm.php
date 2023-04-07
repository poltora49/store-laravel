<?php

namespace App\Http\Requests\admin;

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
            "title" => ["required","min:3","max:150"],
            "price" => ["required"],
            "description" => ["required","min:6","max:500"],
            "category_id" => ["required"],
            "thumbnail" => ["nullable","image"],
            "hidden" => ["boolean"]
        ];
    }

    protected function  prepareForValidation(){
        if($this->has('hidden')){
            $this->merge([
                "hidden" => true,
            ]);
        }
        else {
            $this->merge([
                "hidden" => false,
            ]);
        }

    }
}
