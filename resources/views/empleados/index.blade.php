<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Empleados</title>
    @vite(['resources/js/app.js'])

</head>

<body>
    <br>
    <div class="card">
        <div class="card-body">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEmpleado">
                Agregar Empleado
            </button>

            <form action="{{ route('empleados.store') }}" method="POST">
                @csrf
                <!-- Modal -->
                <div class="modal fade" id="modalEmpleado" tabindex="-1" aria-labelledby="modalEmpleadoLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="modalEmpleadoLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="">Codigo</label>
                                        <input type="text" class="form-control" id="codigo" name="codigo"
                                            value="{{ old('codigo') }}" aria-label="First name">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre"
                                            value="{{ old('nombre') }}" aria-label="Last name">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="">Email</label>
                                        <input type="text" class="form-control" id="email" name="email"
                                            value="{{ old('email') }}" aria-label="Last name">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="">Cargo</label>
                                        <input type="text" class="form-control" id="cargo" name="cargo"
                                            value="{{ old('cargo') }}" aria-label="Last name">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="">Fecha Contratacion</label>
                                        <input type="date" class="form-control" id="fecha_contratacion"
                                            name="fecha_contratacion" value="{{ old('fecha_contratacion') }}"
                                            aria-label="Last name">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="">Estado</label>
                                        <select class="form-select" aria-label="Default select example" id="estado"
                                            name="estado">
                                            <option >Estado</option>
                                            <option value="activo" {{ old('estado') == 'activo' ? 'selected' : '' }}>
                                                Activo</option>
                                            <option value="inactivo"
                                                {{ old('estado') == 'inactivo' ? 'selected' : '' }}>
                                                Inactivo</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Agregar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <br>

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert"> {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Errores encontrados:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error )
                            <li>{{$error}}</li>                            
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>


    <br>
    <table class="table  table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Codgio</th>
                <th scope="col">Nombre</th>
                <th scope="col">Email</th>
                <th scope="col">Cargo</th>
                <th scope="col">Fecha Contratacion</th>
                <th scope="col">Estado</th>
                <th scope="col">Botontes</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($empleados as $empleado)
                <tr>
                    <th scope="row">{{ $empleado->id }}</th>
                    <td>{{ $empleado->codigo }}</td>
                    <td>{{ $empleado->nombre }}</td>
                    <td>{{ $empleado->email }}</td>
                    <td>{{ $empleado->cargo }}</td>
                    <td>{{ $empleado->fecha_contratacion }}</td>
                    <td>{{ $empleado->estado }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                data-bs-target="#EmpleadoUP{{ $empleado->id }}">
                                Actualizar
                            </button>


                            <!-- Modal -->
                            <div class="modal fade" id="EmpleadoUP{{ $empleado->id }}" tabindex="-1"
                                aria-labelledby="EmpleadoUPLabel{{ $empleado->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="EmpleadoUPLabel{{ $empleado->id }}">
                                                Actualizar</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <form action="{{ route('empleados.update', $empleado->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">

                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <label for="">Codigo</label>
                                                        <input type="text" class="form-control" id="codigoU"
                                                            name="codigo"
                                                            value="{{ old('codigo', $empleado->codigo) }}"
                                                            aria-label="First name">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="">Nombre</label>
                                                        <input type="text" class="form-control" id="nombreU"
                                                            name="nombre"
                                                            value="{{ old('nombre', $empleado->nombre) }}"
                                                            aria-label="Last name">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="">Email</label>
                                                        <input type="text" class="form-control" id="emailU"
                                                            name="email"
                                                            value="{{ old('email', $empleado->email) }}"
                                                            aria-label="Last name">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="">Cargo</label>
                                                        <input type="text" class="form-control" id="cargoU"
                                                            name="cargo"
                                                            value="{{ old('cargo', $empleado->cargo) }}"
                                                            aria-label="Last name">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="">Fecha Contratacion</label>
                                                        <input type="date" class="form-control"
                                                            id="fecha_contratacionU" name="fecha_contratacion"
                                                            value="{{ old('fecha_contratacion', $empleado->fecha_contratacion) }}"
                                                            aria-label="Last name">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="">Estado</label>
                                                        <select class="form-select"
                                                            aria-label="Default select example" id="estadoU"
                                                            name="estado">
                                                            <option >Estado</option>
                                                            <option value="activo"
                                                                {{ old('estado', $empleado->estado) == 'activo' ? 'selected' : '' }}>
                                                                Activo</option>
                                                            <option value="inactivo"
                                                                {{ old('estado', $empleado->estado) == 'inactivo' ? 'selected' : '' }}>
                                                                Inactivo</option>
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Actualizar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="8" class="text-center">No hay clientes registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>
