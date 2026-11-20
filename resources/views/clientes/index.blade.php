{{-- {{$clientes}}  teorciamente esto muestra todo los registos --}}

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

    <nav class="navbar navbar-expand-lg bg-light ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">TIENDA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Empleado</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pedido</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#">Producto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <br>
    <div class="card p-3">
        <div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Nuevo Cliene / {{$clientes_count}}
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Formulario Cliente</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <form action="{{ route('clientes.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">


                                <div class="mb-3">
                                    <label for="codigo" class="form-label">Código Cliente</label>
                                    <input type="text" class="form-control" id="codigo" name="codigo"
                                        value="{{ old('codigo') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                        value="{{ old('nombre') }}">
                                    @error('nombre')
                                        <p>{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label  class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        value="{{ old('email') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="telefono" class="form-label">Teléfono</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono"
                                        value="{{ old('telefono') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="direccion" class="form-label">Dirección</label>
                                    <input type="text" class="form-control" id="direccion" name="direccion"
                                        value="{{ old('direccion') }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="">Estado</label>
                                    <select class="form-select" aria-label="Default select example" id="estado"
                                        name="estado">
                                        <option>Estado</option>
                                        <option value="activo" {{ old('estado') == 'activo' ? 'selected' : '' }}>
                                            Activo</option>
                                        <option value="inactivo" {{ old('estado') == 'inactivo' ? 'selected' : '' }}>
                                            Inactivo</option>
                                    </select>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar cliente</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
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
                    <strong> Se encontraron los siguientes errores: </strong>

                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            {{-- la variable error solo va funcionar aqui --}}
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                    <button type="button" class="btn-close" data-bs-dismiss="alert">
                    </button>
                </div>
            @endif
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Codigo</th>
                <th scope="col">Nombre</th>
                <th scope="col">Email</th>
                <th scope="col">Telefono</th>
                <th scope="col">Direccion</th>
                <th scope="col">Estado</th>
                <th scope="col">Botones</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($clientes as $cliente)
                <tr>
                    <th scope="row">{{ $cliente->id }}</th>
                    <td>{{ $cliente->codigo }}</td>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>{{ $cliente->direccion }}</td>
                    <td>{{ $cliente->estado }}</td>
                    <td>

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#modalFormulario{{ $cliente->id }}">
                            Actualizar
                        </button>
                        <div class="modal fade @if ($errors->any() && session('modal_cliente') == $cliente->id) show @endif"
                            id="modalFormulario{{ $cliente->id }}" tabindex="-1"
                            aria-labelledby="modalFormularioLabel{{ $cliente->id }}" aria-hidden="true"
                            @if ($errors->any() && session('modal_cliente') == $cliente->id) style="display: block;" @endif>
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalFormularioLabel{{ $cliente->id }}">
                                            Formulario Cliente</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">

                                            <div class="mb-3">
                                                <label for="codigo" class="form-label">Código Cliente</label>
                                                <input type="text" class="form-control" id="codigoUp"
                                                    name="codigo" value="{{ old('codigo', $cliente->codigo) }}"
                                                    required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="nombre" class="form-label">Nombre</label>
                                                <input type="text" class="form-control" id="nombreUp"
                                                    name="nombre" value="{{ old('nombre', $cliente->nombre) }}"
                                                    required>
                                                @error('nombre')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label  class="form-label">Email</label>
                                                <input type="text" class="form-control" id="emailUp"
                                                    name="email" value="{{ old('email', $cliente->email) }}"
                                                    required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="telefono" class="form-label">Teléfono</label>
                                                <input type="text" class="form-control" id="telefonoUp"
                                                    name="telefono"
                                                    value="{{ old('telefono', $cliente->telefono) }}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="direccion" class="form-label">Dirección</label>
                                                <input type="text" class="form-control" id="direccionUp"
                                                    name="direccion"
                                                    value="{{ old('direccion', $cliente->direccion) }}">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="">Estado</label>
                                                <select class="form-select" aria-label="Default select example"
                                                    id="estadoUp" name="estado">
                                                    <option>Estado</option>
                                                    <option value="activo"
                                                        {{ old('estado', $cliente->estado) == 'activo' ? 'selected' : '' }}>
                                                        Activo</option>
                                                    <option value="inactivo"
                                                        {{ old('estado', $cliente->estado) == 'inactivo' ? 'selected' : '' }}>
                                                        Inactivo</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST">

                            @csrf

                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">Eliminar</button>

                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No hay clientes registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>




    {{-- {{$cliente->codigo}}
            <p>{{$cliente->nombre}}</p>
            <button type="button" class="btn btn-outline-success">{{$cliente->codigo}}</button> 
    
            {{$cliente->email}}
            {{$cliente->telefono}}
            {{$cliente->direccion}}
            {{$cliente->estado}}  --}}
</body>

</html>
