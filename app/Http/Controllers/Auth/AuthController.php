<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Bo\Auth\AuthBo;

class AuthController extends Controller
{
    protected $authBo;

    public function __construct( AuthBo $authBo)
    {
        $this->authBo = $authBo;
    }

    public function login()
    {
        try {
            return $this->authBo->login();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to login'], 500);
        }
    }

    public function register()
    {
        try {
            return $this->authBo->register();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to register'], 500);
        }
    }

    public function logout()
    {
        try {
            return $this->authBo->logout();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to logout'], 500);
        }
    }
}