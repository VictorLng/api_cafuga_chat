<?php

namespace App\Bo\Interfaces;

interface AuthInterface
{
    public function login();
    public function register();
    public function logout();
}