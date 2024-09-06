<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->input('name', 'World');
        return "hello $name";
    }


    public function store(Request $request)
    {
        $name = $request->only('name.first', 'name.last');
        return json_encode($name);
    }


    public function request(Request $request)
    {
        $user = $request->except('admin');
        return json_encode($user);
    }

    public function merge(Request $request)
    {
        $user = $request->merge(['admin' => false]);
        $user = $request->input();
        return json_encode($user);
    }

    public function upload(Request $request): string
    {
        $file = $request->file('file');
        $file->store('public');
        return $file->hashName();
    }
}
