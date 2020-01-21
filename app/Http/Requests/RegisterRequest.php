<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegisterRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'fullname' => 'required|max:200',
            'email' => 'required|email|max:200',
            'password' => 'required|max:200',
          ];
          return $rules;
    }
}
