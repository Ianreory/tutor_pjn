<?php

namespace Tests\Feature;

use App\Services\UserServis;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Contoh2Test extends TestCase
{
    private UserServis $userServis;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userServis = $this->app->make(UserServis::class);
    }

    public function testSample()
    {
        self::assertTrue(true);
    }
    public function testLogin()
    {
        self::assertTrue($this->userServis->login("ian", "rahasia"));
    }
    public function testLoginFailed()
    {
        self::assertFalse($this->userServis->login("ian", "rahasia2"));
    }
    public function testLoginFailed2()
    {
        self::assertFalse($this->userServis->login("ian2", "rahasia"));
    }

}
