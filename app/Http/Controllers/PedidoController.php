<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pedidos=Pedido::all();
        $clientes=Cliente::all();
        $empleados=Empleado::all();


        return view('pedidos.index', compact('pedidos', 'clientes', 'empleados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated=$request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'empleado_id'=> 'required|exists:empleados,id',
            'numero_pedido'=> 'required|string|max:100|min:3',
            'fecha_pedido'=> 'required|date',
            'fecha_entrega'=> 'required|date',
            'total'=> 'required|numeric',
            'estado'=> 'required|in:pendiente,completado,progreso',
            'observaciones'=> 'required|string|max:600|min:3'

        ], [
            'cliente_id.required'=> 'El id es obligatorio',
            'cliente_id.exists'=> 'Debe escoger una de las opciones',

            'empleado_id.required'=> 'El id es obligatorio',
            'empleado_id.exists'=> 'Debe escoger una de las opciones',

            'numero_pedido.required'=>'Debe ingresar el numero de pedido',
            'numero_pedido.max'=>'Maxima de caracteres es 100',
            'numero_pedido.min'=>'Minimo de caracteres es de 3',

            'fecha_pedido.required'=>'La fecha del pedido es obligatoria',
            'fecha_pedido.date'=>'Solo se acepta el formato fecha',

            'fecha_entrega.required'=>'La fecha de entrega es obligatoria',
            'fecha_entrega.date'=>'Solo formato fecha',

            'total.required'=>'Debe ingresar el total',
            'total.numeric'=>'Debe ingresar numeros',

            'estado.required'=>'El estado es obligatorio',
            'estado.in'=>'Debe escoger una de las opciones',

            'observaciones.required'=>'La observacion es obligatoria',
            'observaciones.max'=>'El maximo de caracteres es 600',
            'observaciones.min'=>'El minimo de caracteres es 3',

        ]);

        Pedido::create($validated);

        return redirect()->route('pedidos.index')->with('status', 'Pedido Agregado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $pedido)
    {
        $validated=$request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'empleado_id'=> 'required|exists:empleados,id',
            'numero_pedido'=> 'required|string|max:255|min:3',
            'fecha_pedido'=> 'required|date',
            'fecha_entrega'=> 'required|date',
            'total'=> 'required|numeric',
            'estado'=> 'required|in:pendiente,completado,progreso',
            'observaciones'=> 'required|string|max:600|min:3'

        ],[
            'cliente_id.required'=> 'El id es obligatorio',
            'cliente_id.exists'=> 'Debe escoger una de las opciones',

            'empleado_id.required'=> 'El id es obligatorio',
            'empleado_id.exists'=> 'Debe escoger una de las opciones',

            'numero_pedido.required'=>'Debe ingresar el numero de pedido',
            'numero_pedido.max'=>'Maxima de caracteres es 100',
            'numero_pedido.min'=>'Minimo de caracteres es de 3',

            'fecha_pedido.required'=>'La fecha del pedido es obligatoria',
            'fecha_pedido.date'=>'Solo se acepta el formato fecha',

            'fecha_entrega.required'=>'La fecha de entrega es obligatoria',
            'fecha_entrega.date'=>'Solo formato fecha',

            'total.required'=>'Debe ingresar el total',
            'total.numeric'=>'Debe ingresar numeros',

            'estado.required'=>'El estado es obligatorio',
            'estado.in'=>'Debe escoger una de las opciones',

            'observaciones.required'=>'La observacion es obligatoria',
            'observaciones.max'=>'El maximo de caracteres es 600',
            'observaciones.min'=>'El minimo de caracteres es 3',
        ]);

        $pedido->update($validated);

        return redirect()->route('pedidos.index')->with('status', 'Pedido actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $pedidos=Pedido::findOrFail($id);

        $pedidos->delete();

        return redirect()->route('pedidos.index')->with('status', 'Pedido Eliminado');
    }
}
