<?php

namespace App\Http\Controllers;

use App\Services\TodolistService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TodolistController extends Controller
{
    private TodolistService $todolistService;

    public function __construct(TodolistService $todolistService)
    {
        $this->todolistService = $todolistService;
    }
    public function todolist(Request $request)
    {
        $todolist = $this->todolistService->getTodolist();
        return response()->view(
            "todolist.todolist",
            [
                "title" => "Todolist",
                "todolist" => $todolist
            ]
        );
    }


    public function addtodo(Request $request)
    {
        $todo = $request->input("todo");

        if (empty($todo)) {
            $todolist = $this->todolistService->getTodolist();
            return response()->view("todolist.todolist", [
                "title" => "Todolist",
                "todolist" => $todolist,
                "error" => "Todo cannot be empty"
            ]);
        }

        $this->todolistService->saveTodo(uniqid(), $todo);

        return redirect()->action([TodolistController::class, 'todolist']);
    }

    public function deletetodo(Request $request, string $id): RedirectResponse
    {
        $this->todolistService->removeTodo($id);
        return redirect()->action([TodolistController::class, 'todolist']);
    }
}
