<?php

namespace Tests\Feature;

use App\Services\TodolistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Session;
use Tests\TestCase;

class TodolistServiceTest extends TestCase
{
    private TodolistService $todolistService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->todolistService = $this->app->make(TodolistService::class);
    }

    public function testGetTodolistNotNull()
    {
        self::assertNotNull($this->todolistService);
    }

    public function testSaveTodo()
    {
        $this->todolistService->saveTodo("1", "Belajar Laravel");

        $todolist = Session::get("todolist");
        foreach ($todolist as $key => $value) {
            self::assertEquals($value["id"], "1");
            self::assertEquals($value["todo"], "Belajar Laravel");
        }
    }

    public function testGetTodolist()
    {
        self::assertEquals([], $this->todolistService->getTodolist());
    }

    public function testGetTodolistNotEmpty()
    {
        $expected = [
            [
                "id" => "1",
                "todo" => "Belajar Laravel"
            ],
            [
                "id" => "2",
                "todo" => "Belajar PHP"
            ],
            [
                "id" => "3",
                "todo" => "Belajar Java"
            ]
        ];

        $this->todolistService->saveTodo("1", "Belajar Laravel");
        $this->todolistService->saveTodo("2", "Belajar PHP");
        $this->todolistService->saveTodo("3", "Belajar Java");

        self::assertEquals($expected, $this->todolistService->getTodolist());
    }

    public function testRemoveTodo()
    {
        $this->todolistService->saveTodo("1", "Belajar Laravel");
        $this->todolistService->saveTodo("2", "Belajar PHP");
        $this->todolistService->saveTodo("3", "Belajar Java");

        self::assertEquals(3, sizeof($this->todolistService->getTodolist()));

        $this->todolistService->removeTodo("2");

        self::assertEquals(2, sizeof($this->todolistService->getTodolist()));

        $this->todolistService->removeTodo("1");

        self::assertEquals(1, sizeof($this->todolistService->getTodolist()));
    }
    public function testAddTodo()
    {
        $this->withSession(["user" => "ian"])->post("/addtodo", [])->assertSeeText("Todo cannot be empty");
    }

    public function testAddTodoSukses()
    {
        $this->withSession([
            "user" => "ian",
        ])->post("/todolist", ["todo" => "Belajar Laravel"])->assertRedirect("/todolist");
    }
}
