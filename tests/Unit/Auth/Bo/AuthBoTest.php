<?php

namespace Tests\Unit\Auth\Bo;
use Tests\TestCase;
use App\Bo\AuthBo;

class AuthBoTest extends TestCase
{
    protected $authBo;

    public function setUp(): void
    {
        parent::setUp();
        $this->authBo = new AuthBo();
    }

    public function testLogin()
    {
        $credentials = [
            'email' => 'totoalggpvp@gmail.com',
            'password' => 'password_test',
        ];

        $expectedResponse = (object) [
            "token" => "qualquer bosta",
            "user"  => (object)[
                'name'  => 'teste',
                'email' => "teste@gmail.com",
                "id"    => 5,
            ]
        ];

        $response = $this->authBo->login($credentials);

        $this->assertObjectEquals($expectedResponse ,$response);
    }
    public function testRegister()
    {
        $expectedResponse = (object) [
            "token" => "qualquer bosta",
            "user" => (object)[
                'name' => 'teste',
                'email' => "teste@gmail.com",
                "id"   => 5,
            ]
        ];
        $response = $this->authBo->register();
        $this->assertTrue($response);
    }
    public function testLogout()
    {
        $response = $this->authBo->logout();
        $this->assertTrue($response);
    }
    public function testGetUser()
    {
        $response = $this->authBo->getUser();
        $this->assertNotNull($response);
    }
    public function testGetUserById()
    {
        $response = $this->authBo->getUserById(1);
        $this->assertNotNull($response);
    }
}