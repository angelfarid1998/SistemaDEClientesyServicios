<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servicios = Servicio::all();

        return view('servicios.index', ['servicios' => $servicios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('servicios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'nombre' => 'required|string|max:100',
            'imagen' =>  'required|max:10000|mimes:jpg,jpeg,bmp,png',
            'tipo' => 'required',
            'fecha_ini' => 'required',
            'fecha_fin' => 'required',
            'observaciones' => 'required|max:250'
        ]);
        
        $nombreimagen = time(). '.' . $request->imagen->extension();

        $request->imagen->move(public_path('imagenes/servicios'), $nombreimagen);

        $servicio = new Servicio();

        $servicio->nombre          = $request->nombre;
        $servicio->imagen          = $nombreimagen;
        $servicio->tipo            = $request->tipo;
        $servicio->fecha_ini       = $request->fecha_ini;
        $servicio->fecha_fin       = $request->fecha_fin;
        $servicio->observaciones   = $request->observaciones;
        $servicio->save();

        Session::flash('guardado');
        return redirect()->route('servicios.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Servicio  $Servicio
     * @return \Illuminate\Http\Response
     */
    public function show(Servicio $servicio)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Servicio  $Servicio
     * @return \Illuminate\Http\Response
     */
    public function edit(Servicio $servicio, $id)
    {
        $servicio = Servicio::where('id', $id)->first();
        return view('servicios.edit', ['servicio' => $servicio]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Servicio  $Servicio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'tipo' => 'required',
            'fecha_ini' => 'required',
            'fecha_fin' => 'required',
            'observaciones' => 'required|max:250'
        ]);
        $imgrep = Servicio::where('imagen', $request->imagen)->first();
        
        if (!empty($imgrep)) {

            $datosServicio = request()->except(['_token', '_method']);
    
            Servicio::where('id', '=', $id)->update($datosServicio);
    
            Session::flash('actualizado');
            return redirect()->route('servicios.index');
            
        }else{

            $request->validate([
                'imagen' =>  'required|max:10000|mimes:jpg,jpeg,bmp,png',
            ]);
            $nombreimagen = time() . '.' . $request->imagen->extension();

            $request->imagen->move(public_path('imagenes/servicios'), $nombreimagen);

            $servicio = Servicio::where('id', $id)->first();

            $servicio->nombre          = $request->nombre;
            $servicio->imagen          = $nombreimagen;
            $servicio->tipo            = $request->tipo;
            $servicio->fecha_ini       = $request->fecha_ini;
            $servicio->fecha_fin       = $request->fecha_fin;
            $servicio->observaciones   = $request->observaciones;
            
            $servicio->update();

            Session::flash('actualizado');
            return redirect()->route('servicios.index');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Servicio  $Servicio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Servicio $Servicio)
    {
        //
    }

    public function eliminarObjetivo($id)
    {
        $servicio = Servicio::find($id);
        $servicio->delete();
        return response()->json([
            'message' => 'Servicio Eliminado'
        ]);
    }
}
