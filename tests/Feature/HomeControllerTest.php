<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    public function test_home(): void
    {
        $this->get('/')->assertRedirect('/login');
    }
    public function testMember(): void
    {
        $this->withSession(['user' => 'ian'])->get('/')
            ->assertRedirect('/todolist');
    }
}
