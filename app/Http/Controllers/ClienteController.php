<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //nombre de la variable es clientes
        /* $clientes=Cliente::where('estado', 'inactivo')->get(); */
        /* $clientes=Cliente::all(); */
        //dd($clientes);

        /* $clientes=Cliente::withoutTrashed()->get(); //la funcion withoutTrashed devuelve los registros que han sido elimandos y los que no estan eliminados. */
        /* $clientes=Cliente::withTrashed()->get(); */

        /* $clientes=Cliente::whereIn('id', [6,4,5])->get();// muestra los registros con esos ID */
       /*  $clientes=Cliente::whereNotIn('id', [2,3,4])->get();// muestra los registros con esos ID */

       /* $clientes=Cliente::whereDate('created_at', '<=', '2026-11-10 02:26:19'); */

       
       $clientes=Cliente::all();
       $clientes_count=Cliente::all()->count();
       /* $clientes_count=Cliente::exists(); */ //si existen registros si es 1 y si no 0

       return view('clientes.index', compact(['clientes', 'clientes_count']));

        /* return view('clientes.index', compact('clientes')); */
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
    public function store(Request $request) // el request es todo lo que lleva el formulaio
    { // en la variable validated es la que guarda los registros ya validados
        $validated=$request->validate([
            'codigo' => 'required|string|max:255|min:3',
            'nombre'=>'required|string|max:255|min:3',
            'email'=>'required|string|max:255|min:3|email',
            'telefono'=>'required|string|max:255|min:3',
            'direccion'=> 'required|string|max:255|min:3',
            'estado'=>'required|in:activo,inactivo',
        ], [
            'codigo.required' => 'El codigo es obligatorio',
            'codigo.max' => 'Limite máximo es de 255 caracteres',
            'codigo.min' => 'Limite minimo es de 3 caracteres',

            'nombre.required' => 'El nombre es obligatorio',
            'nombre.max' => 'El nombre es obligatorio',
            'nombre.min' => 'Limite minimo es de 3 caracteres',
            'nombre.string' => 'El nombre es obligatorio',

            'email.required' => 'El email es obligatorio',
            'email.max' => 'Limite máximo es de 255 caracteres',
            'email.min' => 'Limite minimo es de 3 caracteres',
            'email.email' => 'Debe ser formato email',

            'telefono.required' => 'El telefono es obligatorio',
            'telefono.max' => 'Limite máximo es de 255 caracteres',
            'telefono.min' => 'Limite minimo es de 3 caracteres',

            'direccion.required' => 'El direccion es obligatorio',
            'direccion.max' => 'Limite máximo es de 255 caracteres',
            'direccion.min' => 'Limite minimo es de 3 caracteres',

            'estado.required' => 'El estado es obligatorio',
            'estado.in' => 'Debe seleccionar una de las opciones',


        ]);

        Cliente::create($validated);

        return redirect()->route('clientes.index')->with('status', 'Cliente creado');

    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        $validated=$request->validate([
            'codigo' => 'required|string|max:255|min:3',
            'nombre'=>'required|string|max:255|min:3',
            'email'=>'required|string|max:255|min:3|email',
            'telefono'=>'required|string|max:255|min:3',
            'direccion'=> 'required|string|max:255|min:3',
            'estado'=>'required|in:activo,inactivo',
        ], [
            'codigo.required' => 'El codigo es obligatorio',
            'codigo.max' => 'Limite máximo es de 255 caracteres',
            'codigo.min' => 'Limite minimo es de 3 caracteres',

            'nombre.required' => 'El nombre es obligatorio',
            'nombre.max' => 'El nombre es obligatorio',
            'nombre.min' => 'Limite minimo es de 3 caracteres',
            'nombre.string' => 'El nombre es obligatorio',

            'email.required' => 'El email es obligatorio',
            'email.max' => 'Limite máximo es de 255 caracteres',
            'email.min' => 'Limite minimo es de 3 caracteres',
            'email.email' => 'El formato debe ser email',

            'telefono.required' => 'El telefono es obligatorio',
            'telefono.max' => 'Limite máximo es de 255 caracteres',
            'telefono.min' => 'Limite minimo es de 3 caracteres',

            'direccion.required' => 'El direccion es obligatorio',
            'direccion.max' => 'Limite máximo es de 255 caracteres',
            'direccion.min' => 'Limite minimo es de 3 caracteres',

            'estado.required' => 'El estado es obligatorio',
            'estado.in' => 'Debe seleccionar una de las opciones',
        ]);

        $cliente->update($validated);

        return redirect()->route('clientes.index')->with('status', 'Cliente actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('clientes.index')->with('status', 'CLIENTE ELIMINADO CORRECTAMENTE');
    }
}
