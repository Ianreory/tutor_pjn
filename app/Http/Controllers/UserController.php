<?php

namespace App\Http\Controllers;

use App\Services\UserServis;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private UserServis $userServis;

    public function __construct(UserServis $userServis)
    {
        $this->userServis = $userServis;
    }
    public function login(): Response
    {
        return response()
            ->view("user.login", [
                "title" => "Login"
            ]);
    }
    public function dologin(Request $request): Response|RedirectResponse
    {
        $user = $request->input("user");
        $password = $request->input("password");

        if (empty($user) || empty($password)) {
            return response()->view(
                "user.login",
                [
                    "title" => "Login",
                    "error" => "Username or password cannot be empty"
                ]
            );
        }

        //Login Sukses
        if ($this->userServis->login($user, $password)) {
            $request->session()->put("user", $user);
            return redirect("/");
        }

        //Login Gagal
        return response()->view("user.login", [
            "title" => "Login",
            "error" => "Username or password is not correct"
        ]);
    }

    public function dologout(Request $request): RedirectResponse
    {
        $request->session()->forget("user");
        return redirect("/");
    }
    public function logout()
    {

    }

}
