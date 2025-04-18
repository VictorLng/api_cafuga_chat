<?php

namespace App\Http\RequestValidators;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CustomRuleValidator extends FormRequest{
    public function rules()
    {
        $method = "Validate" . Str::ucfirst($this->route()->getActionMethod());
        return $this->$method();
    }
}