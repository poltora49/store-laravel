<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileForm extends FormRequest
{

    public function authorize(): bool
    {
        if(auth("web")->check()||auth("admin")->check()){
            return true;
        }
        return false;
    }

    public function rules(): array
    {
        return [
            "name" => ["sometimes","min:3","max:50"],
            "thumbnail" => ["sometimes","nullable","image","max:9140"],
        ];
    }

}
