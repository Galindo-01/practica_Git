<?php

namespace App\Http\Controllers;

use App\Models\Bodega;
use Illuminate\Http\Request;

class BodegaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bodegas=Bodega::all();

        return view('bodega.index', compact('bodegas'));
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
            'nombre' => 'required|string|max:255|min:3',
            'descripion' => 'required|string|max:255|min:3',
            'codigo' => 'required|string|max:255|min:3',
        ],[
            'nombre.required'=>'El nombre es obligatorio',
            'nombre.max'=>'el maximo de caracteres es de 255',
            'nombre.min'=>'El minimo de caracteres es de 3',

            'descripion.required'=>'La descripcion es obligatoria',
            'descripion.max'=>'el maximo de caracteres es de 255',
            'descripion.min'=>'El minimo de caracteres es de 3',

            'codigo.required'=>'El codigo es obligatorio',
            'codigo.max'=>'el maximo de caracteres es de 255',
            'codigo.min'=>'El minimo de caracteres es de 3',

        ]);

            Bodega::create($validated);

            return redirect()->route('bodegas.index')->with('status', 'BODEGA AGREGADA');

    }

    /**
     * Display the specified resource.
     */
    public function show(Bodega $bodega)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bodega $bodega)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bodega $bodega)
    {
        $validated=$request->validate([
            'nombre' => 'required|string|max:255|min:3',
            'descripion' => 'required|string|max:255|min:3',
            'codigo' => 'required|string|max:255|min:3',
        ],[
            'nombre.required'=>'El nombre es obligatorio',
            'nombre.max'=>'el maximo de caracteres es de 255',
            'nombre.min'=>'El minimo de caracteres es de 3',

            'descripion.required'=>'La descripcion es obligatoria',
            'descripion.max'=>'el maximo de caracteres es de 255',
            'descripion.min'=>'El minimo de caracteres es de 3',

            'codigo.required'=>'El codigo es obligatorio',
            'codigo.max'=>'el maximo de caracteres es de 255',
            'codigo.min'=>'El minimo de caracteres es de 3',
        ]
        );

        $bodega->update($validated);
        return redirect()->route('bodegas.index')->with('status', 'BODEGA ACTUALIZADA');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $bodega=Bodega::findOrFail($id);
        $bodega->delete();

        return redirect()->route('bodegas.index')->with('status', 'BODEGA ELIMINADA');

    }   
}
