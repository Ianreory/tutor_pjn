<?php

namespace App\Services;

class HelloServiceIndonesia implements HelloServis
{
    public function hello(string $name): string
    {
        return "Halo $name, Selamat Datang";
    }
}