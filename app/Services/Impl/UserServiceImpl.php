<?php

namespace App\Services\Impl;

use App\Services\UserServis;


class UserServiceImpl implements UserServis
{
    private array $users =
        [
            "ian" => "rahasia",
        ];

    function login(string $name, string $password): bool
    {
        if (!isset($this->users[$name])) {
            return false;
        }

        $correctPassword = $this->users[$name];
        return $correctPassword === $password;
    }
}