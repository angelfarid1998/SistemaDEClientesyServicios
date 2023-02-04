<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::all();

        return view('clientes.index', ['clientes' => $clientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.create');
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
            'cedula' => 'required|unique:clientes',
            'correo' => 'required|unique:clientes',
            'telefono' => 'required',
            'observaciones' => 'required|max:250'
        ]);
        
        $nombreimagen = time() . '.' . $request->imagen->extension();

        $request->imagen->move(public_path('imagenes/clientes'), $nombreimagen);

        $cedularep = Cliente::where('cedula', $request->cedula)->get();
        $correorep = Cliente::where('correo', $request->correo)->get();

        if (count($cedularep) == 1 or count($correorep) == 1) {

            Session::flash('duplicado');
            return back();
        } else {

            $cliente = new Cliente();

            $cliente->nombre         = $request->nombre;
            $cliente->imagen         = $nombreimagen;
            $cliente->cedula         = $request->cedula;
            $cliente->correo         = $request->correo;
            $cliente->telefono       = $request->telefono;
            $cliente->observaciones  = $request->observaciones;
            $cliente->save();

            // $clientes = Cliente::all();
            Session::flash('guardado');
            return redirect()->route('clientes.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente, $id)
    {
        $cliente = Cliente::where('id', $id)->first();

        $serviciosAsignados = Servicio::whereIn('id', json_decode($cliente->servicio_id))->get();

        $clientes = Cliente::all();
        $servicios = Servicio::all();

        return view('clientes.show', ['cliente' => $cliente, 'servicios' => $servicios, 'serviciosAsignados' => $serviciosAsignados]);
    }

    public function AsignarServicios(Request $request)
    {

        $servicio_id = $request->servicio_id;

        $ids = [];
        foreach ($servicio_id as $key => $value) {
            $id = intval($value);

            array_push($ids, $id);
        }

        $cliente = Cliente::find($request->cliente_id);
        $cliente->servicio_id = json_encode($ids);
        $cliente->save();

        Session::flash('guardado');
        return redirect()->route('clientes.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente, $id)
    {
        $cliente = Cliente::where('id', $id)->first();
        return view('clientes.edit', ['cliente' => $cliente]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'cedula' => 'required',
            'correo' => 'required',
            'telefono' => 'required',
            'observaciones' => 'required|max:250'
        ]);
        $imgrep = Cliente::where('imagen', $request->imagen)->first();
        
        if (!empty($imgrep)) {

            $datosCliente = request()->except(['_token', '_method', 'imagenup']);
    
            Cliente::where('id', '=', $id)->update($datosCliente);
    
            Session::flash('actualizado');
            return redirect()->route('clientes.index');
            
        }else{

            $request->validate([
                'imagen' =>  'required|max:10000|mimes:jpg,jpeg,bmp,png',
            ]);
            $nombreimagen = time() . '.' . $request->imagen->extension();

            $request->imagen->move(public_path('imagenes/clientes'), $nombreimagen);

            $cliente = Cliente::where('id', $id)->first();

            $cliente->nombre         = $request->nombre;
            $cliente->imagen         = $nombreimagen;
            $cliente->cedula         = $request->cedula;
            $cliente->correo         = $request->correo;
            $cliente->telefono       = $request->telefono;
            $cliente->observaciones  = $request->observaciones;

            $cliente->update();

            Session::flash('actualizado');
            return redirect()->route('clientes.index');

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        //
    }

    public function eliminarObjetivo($id)
    {
        $cliente = Cliente::find($id);
        $cliente->delete();
        return response()->json([
            'message' => 'Cliente Eliminado'
        ]);
    }
}
