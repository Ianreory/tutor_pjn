<?php

namespace App\Http\Controllers;

use App\Services\HelloServis;
use Illuminate\Http\Request;

class HelloController extends Controller
{

    private HelloServis $helloServis;

    public function __construct(HelloServis $helloServis)
    {
        $this->helloServis = $helloServis;
    }
    public function index(Request $request, string $name = 'World')
    {
        return $this->helloServis->hello($name);
    }
    public function request(Request $request)
    {

        return $request->all() . PHP_EOL .
            $request->url() . PHP_EOL .
            $request->method() . PHP_EOL .
            $request->fullUrl() . PHP_EOL .
            $request->header('Accept') . PHP_EOL;
    }


}
