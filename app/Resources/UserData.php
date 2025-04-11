<?php

namespace App\Resources;

class UserData
{
    public $name;
    public $email;
    public $password;
    public $provider;
    public $provider_id;

    public function setName($name)
    {
        $this->name = $name;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function toArray()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'provider' => $this->provider,
            'provider_id' => $this->provider_id,
        ];
    }
}