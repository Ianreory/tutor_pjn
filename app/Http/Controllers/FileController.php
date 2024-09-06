<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FileController extends Controller
{

    public function upload(Request $request)
    {
        $pictures = $request->file('picture');
        $pictures->storePubliclyAs('puctures', $pictures->getClientOriginalName(), 'public');

        return 'Ok'. $pictures->getClientOriginalName();
    }

    public function response (Request $request) : Response
    {
        return Response('hello Response');
    }

    
}
