<?php

namespace App\Bo\Auth;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;
use App\Resources\UserData;

class AuthBo implements AuthInterface
{
    protected UserRepository $userRepository;
    protected UserData $userData;
    public function __construct( UserRepository $userRepository, UserData $userData)
    {
        $this->userData = $userData;
        $this->userRepository = $userRepository;
    }


    public function login($credentials)
    {
        $user = $this->userRepository->findUserByEmail($credentials->email);
        dd('User', $user);
    }

    public function register($credentials)
    {
        DB::beginTransaction();
        try{
            teste;
            $user = $this->userRepository->register($credentials);
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