<?php

namespace App\Bo;
use App\Bo\Interfaces\UserInterface;
use App\Repositories\UserRepository;
use App\Resources\UserData;

class UserBo implements UserInterface
{
    protected UserRepository $userRepository;
    protected UserData $userData;
    public function __construct(UserRepository $userRepository, UserData $userData)
    {
        $this->userRepository = $userRepository;
        $this->userData = $userData;
    }

    public function getUserById($id)
    {
        return $this->userRepository->findUserById($id);
    }

    public function getUserByEmail($email)
    {
        return $this->userRepository->findUserByEmail($email);
    }

    public function register($data)
    {
        return $this->userRepository->register($data);
    }
}