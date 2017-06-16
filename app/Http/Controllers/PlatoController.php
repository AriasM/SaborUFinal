<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlatoController extends Controller
{
    public function nuevoPlato(){
    	return view('services.nuevoPlato');
    }

    public function modificarPlato(){
    	return view('services.modificarPlato');
    }

    public function eliminarPlato(){
    	return view('services.eliminarPlato');
    }

    public function menu(){
    	return view('services.menu');
    }

    public function menuDep(){
        return view('dep.menu');
    }
}
