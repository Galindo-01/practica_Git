@vite(['resources/js/app.js'])
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Categoria</title>
</head>

<body>
    <br>
    <div class="card">
        <div class="card-body">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCategoria">
                Agregar categoria
            </button>

            <!-- Modal -->
            <div class="modal fade" id="modalCategoria" tabindex="-1" aria-labelledby="modalCategoriaLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modalCategoriaLabel">Formulario Categorias</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('categorias.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="formGroupExampleInput" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                        value="{{ old('nombre') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="formGroupExampleInput2" class="form-label">Descripcion</label>
                                    <input type="text" class="form-control" id="descripcion" name="descripcion"
                                        value="{{ old('descripcion') }}">
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
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                    </form>
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
                    <strong>Errores encontrados</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
        </div>
    </div>




    <br>


    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle ">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Botones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categorias as $categoria)
                    <tr>
                        <th scope="row">{{ $categoria->id }}</th>
                        <td>{{ $categoria->nombre }}</td>
                        <td>{{ $categoria->descripcion }}</td>
                        <td>{{ $categoria->estado }}</td>
                        <td>
                            <div class="d-flex gap-2">

                                <button type="button" class="btn btn-outline-primary flex-fill" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal{{ $categoria->id }}">
                                    Actualizar
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $categoria->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel{{ $categoria->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5"
                                                    id="exampleModalLabel{{ $categoria->id }}">Formulario Categoria
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('categorias.update', $categoria->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="mb-3">
                                                        <label for="nombre" class="form-label">Nombre</label>
                                                        <input type="text" class="form-control" id="nombreU"
                                                            name="nombre"
                                                            value="{{ old('nombre', $categoria->nombre) }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="descripcion"
                                                            class="form-label">Descripcion</label>
                                                        <input type="text" class="form-control" id="descripcionU"
                                                            name="descripcion"
                                                            value="{{ old('descripcion', $categoria->descripcion) }}">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="">Estado</label>
                                                        <select class="form-select"
                                                            aria-label="Default select example" id="estadoU"
                                                            name="estado">
                                                            <option>Estado</option>
                                                            <option value="activo"
                                                                {{ old('estado', $categoria->estado) == 'activo' ? 'selected' : '' }}>
                                                                Activo</option>
                                                            <option value="inactivo"
                                                                {{ old('estado',  $categoria->estado) == 'inactivo' ? 'selected' : '' }}>
                                                                Inactivo</option>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cerrar</button>
                                                        <button type="submit"
                                                            class="btn btn-primary">Actualizar</button>
                                                    </div>
                                                </form>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger ">Eliminar</button>
                                </form>
                            </div>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No hay cateogtias registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>

</html>
