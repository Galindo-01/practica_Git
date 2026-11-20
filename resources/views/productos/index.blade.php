<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/js/app.js'])
</head>
<br>

<div class="card">
    <div class="card-body">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalProducto">
            Agregar producto
        </button>

        <form action="{{ route('productos.store') }}" method="POST">
            @csrf
            <!-- Modal -->
            <div class="modal fade" id="modalProducto" tabindex="-1" aria-labelledby="modalProductoLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modalProductoLabel">Formulario Producto</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="">Categoria ID</label>
                                    <select class="form-select" aria-label="Default select example" id="categoria_id"
                                        name="categoria_id">
                                        <option selected>Seleccione una categoria</option>
                                        @foreach ($categorias as $categoria)
                                            <option value="{{ $categoria->id }}"
                                                {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                                {{ $categoria->id }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Codigo</label>
                                    <input type="text" class="form-control" id="codigo" name="codigo"
                                        value="{{ old('codgo') }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                        value="{{ old('nombre') }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="">Descripcion</label>
                                    <input type="text" class="form-control" id="descripcion" name="descripcion"
                                        value="{{ old('descripcion') }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="">Precio</label>
                                    <input type="text" class="form-control" id="precio" name="precio"
                                        value="{{ old('precio') }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Stock</label>
                                    <input type="text" class="form-control" id="stock" name="stock"
                                        value="{{ old('stock') }}">
                                </div>

                                <div class="col-md-7">
                                    <label for="">Estado</label>
                                    <select class="form-select" aria-label="Default select example" id="estado"
                                        name="estado">
                                        <option value="">Seleccione un Estado</option>
                                        <option value="activo" {{ old('estado') == 'activo' ? 'selected' : '' }}>Activo
                                        </option>
                                        <option value="inactivo" {{ old('estado') == 'inactivo' ? 'selected' : '' }}>
                                            Inactivo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<br>

@if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card">
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Errores encontrados</strong> 

                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
                
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
</div>



<br>

<body>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Categoria ID</th>
                <th scope="col">Codigo</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Precio</th>
                <th scope="col">Stock</th>
                <th scope="col">Estado</th>
                <th scope="col">Botones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($productos as $producto)
                <tr>
                    <th scope="row">{{ $producto->id }}</th>
                    <td>{{ $producto->categoria_id }}</td>
                    <td>{{ $producto->codigo }}</td>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->descripcion }}</td>
                    <td>{{ $producto->precio }}</td>
                    <td>{{ $producto->stock }}</td>
                    <td>{{ $producto->estado }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                data-bs-target="#modalEmpleadoUp{{ $producto->id }}">
                                Actualizar
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modalEmpleadoUp{{ $producto->id }}" tabindex="-1"
                                aria-labelledby="modalEmpleadoUpLabel{{ $producto->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5"
                                                id="modalEmpleadoUpLabel{{ $producto->id }}">Modal title</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('productos.update', $producto->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <label for="">Categoria ID</label>
                                                        <select class="form-select"
                                                            aria-label="Default select example" id="categoria_idU"
                                                            name="categoria_id">
                                                            <option selected>Seleccione una categoria</option>
                                                            @foreach ($categorias as $categoria)
                                                                <option value="{{ $categoria->id }}"
                                                                    {{ old('categoria_id', $producto->categoria_id) == $categoria->id ? 'selected' : '' }}>
                                                                    {{ $categoria->id }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="">Codigo</label>
                                                        <input type="text" class="form-control" id="codigoU"
                                                            name="codigo"
                                                            value="{{ old('codigo', $producto->codigo) }}">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="">Nombre</label>
                                                        <input type="text" class="form-control" id="nombreU"
                                                            name="nombre"
                                                            value="{{ old('nombre', $producto->nombre) }}">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="">Descripcion</label>
                                                        <input type="text" class="form-control" id="descripcionU"
                                                            name="descripcion"
                                                            value="{{ old('descripcion', $producto->descripcion) }}">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="">Precio</label>
                                                        <input type="text" class="form-control" id="precioU"
                                                            name="precio"
                                                            value="{{ old('precio', $producto->precio) }}">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="">Stock</label>
                                                        <input type="text" class="form-control" id="stockU"
                                                            name="stock"
                                                            value="{{ old('stock', $producto->stock) }}">
                                                    </div>

                                                    <div class="col-md-7">
                                                        <label for="">Estado</label>
                                                        <select class="form-select"
                                                            aria-label="Default select example" id="estadoU"
                                                            name="estado">
                                                            <option >Estado</option>
                                                            <option value="activo"
                                                                {{ old('estado', $producto->estado) == 'activo' ? 'selected' : '' }}>
                                                                Activo
                                                            </option>
                                                            <option value="inactivo"
                                                                {{ old('estado', $producto->estado) == 'inactivo' ? 'selected' : '' }}>
                                                                Inactivo</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary">Actualizar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>

            @empty
            @endforelse
        </tbody>
    </table>
</body>

</html>
