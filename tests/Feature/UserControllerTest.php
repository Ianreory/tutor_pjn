<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use SebastianBergmann\Type\VoidType;
use Tests\TestCase;

class UserControllertest extends TestCase
{
    public function test_login(): void
    {
        $this->get('/login')->assertSeeText("Login")->assertSeeText("by Programmer");
    }

    public function testLoginSusccess(): void
    {
        $this->post('/login', [
            'user' => 'ian',
            'password' => 'rahasia'
        ])->assertRedirect('/')
            ->assertSessionHas('user', 'ian');
    }

    public function testLoginValidasiError()
    {
        $this->post('/login', [])->assertSeeText("Username or password cannot be empty");
    }

    public function failedLogin(): void
    {
        $this->post('/login', [
            'user' => 'ians',
            'password' => 'rahasia1'
        ])->assertSeeText("Username or password is not correct");
    }

    // public function test_logout(): void
    // {
    //     $this->withSession(['user' => 'ian'])->post('/dologout')->assertRedirect('/')
    //         ->assertSessionMissing('user');
    // }

    public function test_loginpageforemember(): void
    {
        $this->withSession(['user' => 'ian'])->get('/login')->assertRedirect('/');
    }

    public function testLoginForUserAlreadiLogin()
    {
        $this->withSession(['user' => 'ian'])->post('/login', [
            "user" => "ian",
            "password" => "rahasia"
        ])->assertRedirect('/');
    }
    public function testMember(): void
    {
        $this->post('/dologout')
            ->assertRedirect('/');
    }

}
