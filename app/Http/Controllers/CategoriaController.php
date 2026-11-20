<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias=Categoria::all();

        return view('categorias.index', compact('categorias'));
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
            'nombre'=> 'required|string|max:255|min:3',
            'descripcion' =>'required|string|max:600|min:3',
            'estado'=> 'required|in:activo, inactivo',
        ],[
            'nombre.required'=> 'El nombre es obligatorio',
            'nombre.max'=> 'Limite maximo es de 600 caracteres',
            'nombre.min'=> 'Limite minimo es de 3 caracteres',

            'descripcion.required' =>'La descripcion es obligatoria',
            'descripcion.max' =>'Limite maximo es de 600 caracteres',
            'descripcion.min' =>'Limite minimo es de 3 caracteres',

            'estado.required'=> 'El estado es obligatorio',
            'estado.in'=> 'Debe escoger una de las opciones',
        ]);

        Categoria::create($validated);
        return redirect()->route('categorias.index')->with('status', 'Categoria agregada');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        $validated=$request->validate([
            'nombre'=> 'required|string|max:255|min:3',
            'descripcion' =>'required|string|max:600|min:3',
            'estado'=> 'required|in:activo,inactivo',
        ],[
            'nombre.required'=> 'El nombre es obligatorio',
            'nombre.max'=> 'Limite maximo es de 600 caracteres',
            'nombre.min'=> 'Limite minimo es de 3 caracteres',

            'descripcion.required' =>'La descripcion es obligatoria',
            'descripcion.max' =>'Limite maximo es de 600 caracteres',
            'descripcion.min' =>'Limite minimo es de 3 caracteres',

            'estado.required'=> 'El estado es obligatorio',
            'estado.in'=> 'Debe escoger una de las opciones'
        ]);

        $categoria->update($validated);

        return redirect()->route('categorias.index')->with('status', 'Categoria actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $categoria=Categoria::findOrFail($id);
        $categoria->delete();

        return redirect()->route('categorias.index')->with('status', 'Categoria Eliminada');

    }
}
