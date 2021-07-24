<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Establecimiento;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class EstablecimientoController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categorias = Categoria::all();
        return view('establecimiento.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validacion
        $data = $request->validate([
            'nombre' => 'required|min:10',
            'categoria_id' => 'required|exists:categorias,id',
            'imagen_principal' => 'required|max:5000',
            'direccion' => 'required',
            'barrio' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'telefono' => 'required|numeric',
            'descripcion' => 'required|min:50',
            'apertura' => 'date_format:H:i',
            'cierre' => 'date_format:H:i|after:apertura',
            'uuid' => 'required'
        ]);

        // Guardar Imagen
        // Asignando la ruta
        $imagen_ruta = $data['imagen_principal']->store('principal', 'public');

        $imagen = Image::make(public_path("/storage/{$imagen_ruta}"))->fit(800, 600);
        $imagen->save();


        $establecimiento = new Establecimiento;
        $establecimiento->nombre = $data['nombre'];
        $establecimiento->categoria_id = $data['categoria_id'];
        $establecimiento->imagen_principal = $imagen_ruta;
        $establecimiento->direccion = $data['direccion'];
        $establecimiento->barrio = $data['barrio'];
        $establecimiento->lat = $data['lat'];
        $establecimiento->lng = $data['lng'];
        $establecimiento->telefono = $data['telefono'];
        $establecimiento->descripcion = $data['descripcion'];
        $establecimiento->apertura = $data['apertura'];
        $establecimiento->cierre = $data['cierre'];
        $establecimiento->uuid = $data['uuid'];
        $establecimiento->user_id = auth()->user()->id;

        $establecimiento->save();


        // Forma de guarda los datos a traves de relacion usuraio=>establecimientos
        // auth()->user()->establecimiento()->create([
        //     'nombre' => $data['nombre'], 'categoria_id' => $data['categoria_id'],
        //     'imagen_principal' => $imagen_ruta,
        //     'direccion' => $data['direccion'],
        //     'barrio' => $data['barrio'],
        //     'lat' => $data['lat'],
        //     'lng' => $data['lng'],
        //     'telefono' => $data['telefono'],
        //     'descripcion' => $data['descripcion'],
        //     'apertura' => $data['apertura'],
        //     'cierre' => $data['cierre'],
        //     'uuid' => $data['uuid']
        // ]);

        return "save DB...";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function show(Establecimiento $establecimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Establecimiento $establecimiento)
    {
        //
        return 'desde edit';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Establecimiento $establecimiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Establecimiento $establecimiento)
    {
        //
    }
}
