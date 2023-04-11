<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordForm extends FormRequest
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
            "password" => ["required","min:6"],
            "new_password" => ["required","confirmed","min:6"],
        ];
    }
}
