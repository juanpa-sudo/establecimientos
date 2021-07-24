<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Establecimiento;
use Illuminate\Http\Request;

class APIController extends Controller
{
    //
    public function categorias()
    {
        # code...
        $categorias = Categoria::all();

        return response()->json($categorias);
    }
    public function categoria(Categoria $categoria)
    {
        # code...
        // dd($categoria);
        $establecimiento = Establecimiento::where('categoria_id', $categoria->id)->with('categoria')->take(3)->get();
        // $establecimiento = $categoria->establecimientos;
        return response()->json($establecimiento);
    }

    public function show(Establecimiento $establecimiento)
    {
        # code...
        return response()->json($establecimiento);
    }
}
