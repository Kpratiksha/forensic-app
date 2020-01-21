<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class BookTableSubmitRequest extends Request
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'datetime' => 'required|max:200',
            'number_of_guests' => 'required|max:2',
            'fullname' => 'required|max:200',
            'email' => 'required|email|max:200',
            'phone' => 'required|max:20',
          ];
          return $rules;
    }
}
