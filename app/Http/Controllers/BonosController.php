<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\bonos;

class BonosController extends Controller
{
    public function bonos()
    {
        return view('bonos.bonos');
    }

    
}