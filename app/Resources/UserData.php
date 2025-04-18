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
        return $this;

    }
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;

    }
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;

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
        $array = [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'provider' => $this->provider,
            'provider_id' => $this->provider_id,
        ];

        return array_filter($array, function ($value) {
            return !is_null($value);
        });
    }
}