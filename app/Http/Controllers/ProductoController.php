<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos=Producto::all();
        $categorias=Categoria::all();

        return view('productos.index', compact('productos', 'categorias'));
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
            'categoria_id'=> 'required|exists:categorias,id',
            'codigo'=>'required|string|max:100|min:3',
            'nombre'=>'required|string|max:100|min:3',
            'descripcion'=>'required|string|max:255|min:3',
            'precio'=>'required|numeric',
            'stock'=>'required|numeric',
            'estado'=>'required|in:activo,inactivo',
        ],[
            'categoria_id.exists'=>'Debe seleccionar una de las categorias',
            'categoria_id.required'=>'Es obligatorio',

            'codigo.required'=>'El codigo es obligatorio',
            'codigo.max'=>'Numero maximo de caracteres es 100',
            'codigo.min'=>'Numero minimo de caracteres es de 3',

            'nombre.required'=>'El nombre es obligatorio',
            'nombre.max'=>'Numero maximo de caracteres es 100',
            'nombre.min'=>'Numero minimo de caracteres es de 3',

            'descripcion.required'=>'La descripcion es obligatoria',
            'descripcion.max'=>'Numero maximo de caracteres es 100',
            'descripcion.min'=>'Numero minimo de caracteres es de 3',

            'precio.required'=>'El precio es obligatorio',
            'precio.numeric'=>'El precio debe ser un valor',
            
            'stock.required'=>'El stock es obligatorio',
            'stock.numeric'=>'El stock debe ser un valor',

            'estado.required'=>'El estado es obligatorio',
            'estado.exists'=>'Debe seleccionar uno de los estados',


        ]);

        Producto::create($validated);

        return redirect()->route('productos.index')->with('status', 'Producto Agregado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        $validated=$request->validate([
            'categoria_id'=> 'required|exists:categorias,id',
            'codigo'=>'required|string|max:100|min:3',
            'nombre'=>'required|string|max:100|min:3',
            'descripcion'=>'required|string|max:255|min:3',
            'precio'=>'required|numeric',
            'stock'=>'required|numeric',
            'estado'=>'required|in:activo,inactivo',
        ],[
            'categoria_id.exists'=>'Debe seleccionar una de las categorias',
            'categoria_id.required'=>'Es obligatorio',

            'codigo.required'=>'El codigo es obligatorio',
            'codigo.max'=>'Numero maximo de caracteres es 100',
            'codigo.min'=>'Numero minimo de caracteres es de 3',

            'nombre.required'=>'El nombre es obligatorio',
            'nombre.max'=>'Numero maximo de caracteres es 100',
            'nombre.min'=>'Numero minimo de caracteres es de 3',

            'descripcion.required'=>'La descripcion es obligatoria',
            'descripcion.max'=>'Numero maximo de caracteres es 100',
            'descripcion.min'=>'Numero minimo de caracteres es de 3',

            'precio.required'=>'El precio es obligatorio',
            'precio.numeric'=>'El precio debe ser un valor',
            
            'stock.required'=>'El stock es obligatorio',
            'stock.numeric'=>'El stock debe ser un valor',

            'estado.required'=>'El estado es obligatorio',
            'estado.in'=>'Debe seleccionar uno de los estados',

        ]);

        $producto->update($validated);

        return redirect()->route('productos.index')->with('status', 'Producto Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $producto=Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('productos.index')->with('status', 'Producto eliminado');
    }
}
