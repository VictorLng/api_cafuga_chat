<?php

namespace App\Bo\Auth;

use App\Bo\UserBo;
use Illuminate\Support\Facades\DB;
use App\Bo\Interfaces\AuthInterface;
use App\Resources\UserData;
use Illuminate\Support\Facades\Hash;

class AuthBo implements AuthInterface
{
    protected UserBo $userBo;
    protected UserData $userData;
    public function __construct( UserBo $userBo, UserData $userData)
    {
        $this->userData = $userData;
        $this->userBo = $userBo;
    }


    public function login($credentials)
    {
        $user = $this->userBo->findUserByEmail($credentials->email);
        if(Hash::check($credentials->password, $user->password)) {
            $user->setRememberToken();
        } else {
            throw new \Exception('Invalid credentials');
        }
        dd('User', $user);
    }

    public function register($credentials)
    {
        DB::beginTransaction();
        try{

            $this->userData->setName($credentials->name);
            $this->userData->setEmail($credentials->email);
            $this->userData->setPassword(Hash::make($credentials->password));

            $user = $this->userBo->register($this->userData->toArray());

            $user->setRememberToken();
        } catch(\Exception $e) {
            dd($e);
            DB::rollBack();
            throw $e;
        }

    }
    public function logout()
    {

    }
}