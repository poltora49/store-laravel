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
            "email" => ["required","email","unique:users,email,". $this->user->id],
            "name" => ["required","min:3","max:50"],
            "thumbnail" => ["nullable","image","max:10240"],
        ];
    }

}
