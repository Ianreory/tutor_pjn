<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    public function testGetTodolist()
    {
        $this->withSession([
            "user" => "ian",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "Belajar Laravel"
                ],
                [
                    "id" => "2",
                    "todo" => "Belajar PHP"
                ]
            ]
        ])->get("/todolist")->assertSeeText("1")
            ->assertSeeText('1')
            ->assertSeeText("Belajar Laravel")
            ->assertSeeText('2')
            ->assertSeeText("Belajar PHP");

    }
    public function testRemoveTodo()
    {
        $this->withSession([
            "user" => "ian",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "Belajar Laravel"
                ],
            ]
        ])->post("/todolist/1/delete")->assertRedirect("/todolist");
    }
}
