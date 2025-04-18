<?php

namespace App\Resources;

class UserData
{
    protected $name;
    protected $email;
    protected $password;


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
        ];

        return array_filter($array, function ($value) {
            return !is_null($value);
        });
    }
}