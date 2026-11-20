<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empleados=Empleado::all();

        return view('empleados.index', compact('empleados'));
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
            'codigo'=>'required|string|max:255|min:3',
            'nombre'=>'required|string|max:255|min:3',
            'email'=>'required|email|max:255|unique:empleados,email',
            'cargo'=>'required|string|max:255|min:3',
            'fecha_contratacion'=>'required|date',
            'estado'=>'required|in:activo,inactivo',
        ],[
            'codigo.required'=>'El codigo es obligatorio',
            'codigo.max'=>'Maximo de caracteres es 255',
            'codigo.min'=>'Min de caracteres es de 3',

            'nombre.required'=>'El nombre es obligatorio',
            'nombre.max'=>'Maximo de caracteres es 255',
            'nombre.min'=>'Min de caracteres es de 3',

            'email.required'=>'El email es obligatorio',
            'email.max'=>'Maximo de caracteres es 255',
            'email.email'=>'El formato debe ser email',
            'email.unique'=>'El correo que ingreso ya existe',

            'cargo.required'=>'El cargo es obligatorio',
            'cargo.max'=>'Maximo de caracteres es 255',
            'cargo.min'=>'Min de caracteres es de 3',

            'fecha_contratacion.required'=>'La fecha es obligatorio',
            'fecha_contratacion.date'=>'El formato debe ser fecha',

            'estado.required'=>'El estado es obligatorio',
            'estado.in'=>'Debe seleccionar una de las opciones',

        ]);

        Empleado::create($validated);

        return redirect()->route('empleados.index')->with('status', 'Empleado agregado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empleado $empleado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empleado $empleado)
    {
        $validated=$request->validate([
            'codigo'=>'required|string|max:255|min:3',
            'nombre'=>'required|string|max:255|min:3',
            'email'=>'required|email|max:255|', #quite el unique:empleados,email ya que con eso no me dejaba actualizar como debe ser unico creoo yoo.
            'cargo'=>'required|string|max:255|min:3',
            'fecha_contratacion'=>'required|date',
            'estado'=>'required|in:activo,inactivo',
        ], [
            'codigo.required'=>'El codigo es obligatorio',
            'codigo.max'=>'Maximo de caracteres es 255',
            'codigo.min'=>'Min de caracteres es de 3',

            'nombre.required'=>'El nombre es obligatorio',
            'nombre.max'=>'Maximo de caracteres es 255',
            'nombre.min'=>'Min de caracteres es de 3',

            'email.required'=>'El email es obligatorio',
            'email.max'=>'Maximo de caracteres es 255',
            'email.email'=>'El formato debe ser email',
            'email.unique'=>'El correo que ingreso ya existe',

            'cargo.required'=>'El cargo es obligatorio',
            'cargo.max'=>'Maximo de caracteres es 255',
            'cargo.min'=>'Min de caracteres es de 3',

            'fecha_contratacion.required'=>'La fecha es obligatorio',
            'fecha_contratacion.date'=>'El formato debe ser fecha',

            'estado.required'=>'El estado es obligatorio',
            'estado.in'=>'Debe seleccionar una de las opciones',
        ]);

        $empleado->update($validated);

        return redirect()->route('empleados.index')->with('status', 'EMPLEADO ACTUALIZADO');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $empleado=Empleado::findOrFail($id);

        $empleado->delete();

        return redirect()->route('empleados.index')->with('status','EMPLEADO ELIMINADO');
    }
}
