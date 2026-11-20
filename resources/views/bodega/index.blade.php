<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Proyecto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light">
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
                        <a class="nav-link" href="#">Categoria</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Empleado</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pedido</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Producto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <br>

    <div class="container">
        <div class="card p-3">
            <div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalBodega">
                    Agregar Bodega
                </button>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalBodega" tabindex="-1" aria-labelledby="modalBodegaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalBodegaLabel">Formulario Bodega</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('bodegas.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                value="{{ old('nombre') }}">
                        </div>

                        <div class="mb-3">
                            <label for="descripion" class="form-label">Descripion</label>
                            <input type="text" class="form-control" id="descripion" name="descripion"
                                value="{{ old('descripion') }}">
                        </div>

                        <div class="mb-3">
                            <label for="codigo" class="form-label">Codigo</label>
                            <input type="text" class="form-control" id="codigo" name="codigo"
                                value="{{ old('codigo') }}">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <br>


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
                        @foreach ($errors->all() as $error )
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
        </div>
    </div>

    <table class="table table-striped table-bordered border-success">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Codigo</th>
                <th scope="col">Botones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bodegas as $bodega)
                <tr>
                    <th scope="row">{{ $bodega->id }}</th>
                    <td>{{ $bodega->nombre }}</td>
                    <td>{{ $bodega->descripion }}</td>
                    <td>{{ $bodega->codigo }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                data-bs-target="#modalBodega{{ $bodega->id }}">
                                Actualizar
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modalBodega{{ $bodega->id }}" tabindex="-1"
                                aria-labelledby="modalBodegaLabel{{ $bodega->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="modalBodegaLabel {{ $bodega->id }}">
                                                Formulario Bodegas</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('bodegas.update', $bodega->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="nombre" class="form-label">Nombre</label>
                                                        <input type="text" class="form-control" id="nombreU"
                                                            name="nombre"
                                                            value="{{ old('nombre', $bodega->nombre) }}" required>
                                                    </div>
                                                    <div class="col">
                                                        <label for="descripion" class="form-label">Descripion</label>
                                                        <input type="text" class="form-control" id="descripionU"
                                                            name="descripion"
                                                            value="{{ old('descripion', $bodega->descripion) }}"
                                                            required>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="codigo" class="form-label">Codigo</label>
                                                        <input type="text" class="form-control" id="codigoU"
                                                            name="codigo"
                                                            value="{{ old('codigo', $bodega->codigo) }}">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Guardar
                                                        cambios</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <form action="{{ route('bodegas.destroy', $bodega->id) }}" method="POST">
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




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>
