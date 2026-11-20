<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/js/app.js'])
    <title>Pedidos</title>
</head>

<body>
    <br>

    <div class="card">
        <div class="card-body">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPedido">
                Agregar Pedido
            </button>

            <form action="{{ route('pedidos.store') }}" method="POST">
                @csrf
                <!-- Modal -->
                <div class="modal fade" id="modalPedido" tabindex="-1" aria-labelledby="modalPedidoLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="modalPedidoLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="">Cliente ID</label>
                                        <select class="form-select" aria-label="Default select example" id="cliente_id"
                                            name="cliente_id">
                                            <option selected>Seleccione una opcion</option>
                                            @foreach ($clientes as $cliente)
                                                <option value="{{ $cliente->id }}"
                                                    {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                                    {{ $cliente->id }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Empleado ID</label>
                                        <select class="form-select" aria-label="Default select example" id="empleado_id"
                                            name="empleado_id">
                                            <option selected>Seleccione una opcion</option>
                                            @foreach ($empleados as $empleado)
                                                <option value="{{ $empleado->id }}""
                                                    {{ old('empleado_id') == $empleado->id ? 'selected' : '' }}>
                                                    {{ $empleado->id }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="">Numero pedido</label>
                                        <input type="text" class="form-control" aria-label="Last name"
                                            id="numero_pedido" name="numero_pedido" value="{{ old('numero pedido') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Fecha Pedido</label>
                                        <input type="date" class="form-control" aria-label="Last name"
                                            id="fecha_pedido" name="fecha_pedido" value="{{ old('fecha_pedido') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Fecha Entrega</label>
                                        <input type="date" class="form-control" aria-label="Last name"
                                            id="fecha_entrega" name="fecha_entrega" value="{{ old('fecha_entrega') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Total</label>
                                        <input type="text" class="form-control" aria-label="Last name" id="total"
                                            name="total" value="{{ old('total') }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="">Estado</label>
                                        <select class="form-select" aria-label="Default select example" id="estado"
                                            name="estado">
                                            <option>Estado</option>
                                            <option value="pendiente"
                                                {{ old('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                            <option value="completado"
                                                {{ old('estado') == 'completado' ? 'selected' : '' }}>Completado
                                            </option>

                                            <option value="progreso"
                                                {{ old('estado') == 'progreso' ? 'selected' : '' }}>Progreso</option>

                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="">Observaciones</label>
                                        <input type="text" class="form-control" aria-label="Last name"
                                            id="observaciones" name="observaciones" value="{{ old('observaciones') }}">
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
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Errorres encontrados</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>


    <br>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Cliente ID</th>
                <th scope="col">Empleado ID</th>
                <th scope="col">Numero Pedido</th>
                <th scope="col">Fecha Pedido</th>
                <th scope="col">Fecha Entrega</th>
                <th scope="col">Total</th>
                <th scope="col">Estado</th>
                <th scope="col">Observaciones</th>
                <th scope="col">Botones</th>

            </tr>
        </thead>
        <tbody>
            @forelse ($pedidos as $pedido)
                <tr>
                    <th scope="row">{{ $pedido->id }}</th>
                    <td>{{ $pedido->cliente_id }}</td>
                    <td>{{ $pedido->empleado_id }}</td>
                    <td>{{ $pedido->numero_pedido }}</td>
                    <td>{{ $pedido->fecha_pedido }}</td>
                    <td>{{ $pedido->fecha_entrega }}</td>
                    <td>{{ $pedido->total }}</td>
                    <td>{{ $pedido->estado }}</td>
                    <td>{{ $pedido->observaciones }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                data-bs-target="#modalPedidoUp{{ $pedido->id }}">
                                Actualizar
                            </button>

                            <div class="modal fade" id="modalPedidoUp{{ $pedido->id }}" tabindex="-1"
                                aria-labelledby="modalPedidoUpLabel{{ $pedido->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="modalPedidoUpLabel{{ $pedido->id }}">
                                                Modal title</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('pedidos.update', $pedido->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="modal-body">
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <label for="">Cliente ID</label>
                                                        <select class="form-select"
                                                            aria-label="Default select example" id="cliente_idU"
                                                            name="cliente_id">
                                                            <option selected>Seleccione una opcion</option>
                                                            @foreach ($clientes as $cliente)
                                                                <option value="{{ $cliente->id }}"
                                                                    {{ old('cliente_id', $pedido->cliente_id) == $cliente->id ? 'selected' : '' }}>
                                                                    {{ $cliente->id }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="">Empleado ID</label>
                                                        <select class="form-select"
                                                            aria-label="Default select example" id="empleado_idU"
                                                            name="empleado_id">
                                                            <option selected>Seleccione una opcion</option>
                                                            @foreach ($empleados as $empleado)
                                                                <option value="{{ $empleado->id }}"
                                                                    {{ old('empleado_id', $pedido->empleado_id) == $empleado->id ? 'selected' : '' }}>
                                                                    {{ $empleado->id }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="">Numero pedido</label>
                                                        <input type="text" class="form-control"
                                                            aria-label="Last name" id="numero_pedidoU"
                                                            name="numero_pedido"
                                                            value="{{ old('numero_pedido', $pedido->numero_pedido) }}">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="">Fecha Pedido</label>
                                                        <input type="date" class="form-control"
                                                            aria-label="Last name" id="fecha_pedidoU"
                                                            name="fecha_pedido"
                                                            value="{{ old('fecha_pedido', $pedido->fecha_pedido) }}">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="">Fecha Entrega</label>
                                                        <input type="date" class="form-control"
                                                            aria-label="Last name" id="fecha_entregaU"
                                                            name="fecha_entrega"
                                                            value="{{ old('fecha_entrega', $pedido->fecha_entrega) }}">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="">Total</label>
                                                        <input type="text" class="form-control"
                                                            aria-label="Last name" id="totalU" name="total"
                                                            value="{{ old('total', $pedido->total) }}">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="">Estado</label>
                                                        <select class="form-select"
                                                            aria-label="Default select example" id="estadoU"
                                                            name="estado">
                                                            <option>Estado</option>
                                                            <option value="pendiente"
                                                                {{ old('estado', $pedido->estado) == 'pendiente' ? 'selected' : '' }}>
                                                                Pendiente</option>
                                                            <option value="completado"
                                                                {{ old('estado', $pedido->estado) == 'completado' ? 'selected' : '' }}>
                                                                Completado
                                                            </option>
                                                            <option value="progreso"
                                                                {{ old('estado', $pedido->estado) == 'progreso' ? 'selected' : '' }}>
                                                                Progreso</option>

                                                        </select>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="">Observaciones</label>
                                                        <input type="text" class="form-control"
                                                            aria-label="Last name" id="observacionesU"
                                                            name="observaciones"
                                                            value="{{ old('observaciones', $pedido->observaciones) }}">
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary">Actualizat</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('pedidos.destroy', $pedido->id) }}" method="POST">
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
