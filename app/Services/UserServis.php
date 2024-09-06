<?php

namespace App\Services;

interface UserServis
{
    function login(string $name, string $password): bool;
}