<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    public function __construct()
    {
        // Constructor code if needed
    }

    public static function create(array $data)
    {
        return User::create($data);
    }

}