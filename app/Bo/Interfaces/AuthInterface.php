<?php

namespace App\Bo\Interfaces;

interface AuthInterface
{
    public function login($credentials);
    public function register($credentials);
    public function logout();
}