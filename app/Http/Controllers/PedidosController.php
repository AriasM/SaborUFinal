<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PedidosController extends Controller
{
    public function historial(){
    	return view('services.historial');
    }

    public function reporte(){
    	return view('services.reporte');
    }

    public function homeDep(){
    	return view('dep.home');
    }
}
