<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CookieController extends Controller
{
    public function setCookie(Request $request): Response
    {
        return response('Cookie set')
        ->cookie("user-id", "ian", 3600, "/")
        ->cookie("admin-id", "roery", 3600, "/");
    }
}
