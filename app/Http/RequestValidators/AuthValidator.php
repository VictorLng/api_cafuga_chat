<?php

namespace App\Http\RequestValidators;

use App\Http\RequestValidators\CustomRuleValidator;

class AuthValidator extends CustomRuleValidator
{

    public function validateLogin(){
        return [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ];
    }

    public function validateRegister(){
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];
    }


}