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
            "name" => ["required","min:3","max:50"],
            "email" => ["required","email",\Illuminate\Validation\Rule::unique('users')->ignore($this->user()->id)],
            "thumbnail" => ["nullable","image","max:10240"],
            "password" => ["required","min:6"],
        ];
    }

}
