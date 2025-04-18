<?php

namespace App\Repositories;

use App\Models\User;
// use Illuminate\Support\Facades\DB;

class UserRepository
{
    public static function register(array $data)
    {

        return User::firstOrCreate([
            'email' => $data['email']
        ],
        [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }

    public static function findUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public static function findUserById($id)
    {
        return User::find($id);
    }

}