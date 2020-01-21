<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ContactUsSubmitRequest extends Request
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
            'phone' => 'required|max:20',
            'message' => 'required|max:500',
          ];
          return $rules;
    }


}
