<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\productos;

class ControlinventarioController extends Controller
{
    public function index(){
        $tienda = 5;
        $productos = productos::where('id_tienda', $tienda)->get();

    }

}
