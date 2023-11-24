<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Principal extends Controller
{
    function index()
    {
        if (Auth::user()->rol == -2) {
            return redirect()->route('materiales.index2');
        }else{
            return view('principallogo');
        }

    }

    function unauthorized()
    {
        return view('unauthorized');
    }




}
