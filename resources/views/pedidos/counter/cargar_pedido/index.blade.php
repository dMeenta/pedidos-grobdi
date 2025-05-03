@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    
    <!-- <h1>Pedidos</h1> -->
@stop

@section('content')
<div class="card mt-2">
    <h2 class="card-header">Pedidos por día</h2>
    <div class="card-body">
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-success btn-sm" href="{{ route('cargarpedidos.create') }}"> <i class="fa fa-plus"></i> Registrar datos</a>
    </div>
    <br>
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6">
            <form action="{{ route('cargarpedidos.index') }}" method="GET">
            <div class="row">
                    <div class="col-xs-1 col-sm-1 col-md-1">
                        <label for="fecha_inicio">Fecha:</label>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <input class="form-control" type="date" name="fecha" id="fecha" required>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <button type="submit" class="btn btn-outline-success"><i class="fa fa-search"></i> Buscar</button>
                    </div>
            </div>
            </form>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <form action="{{ route('cargarpedidos.downloadWord') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <b>Seleccione Turno</b>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="turno" id="turno0" value=0 checked>
                            <label class="form-check-label" for="turno0">
                                Mañana
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="turno" id="turno1" value=1>
                            <label class="form-check-label" for="turno1">
                                Tarde
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2">
                        @if(request()->get('fecha'))
                            <input type="hidden" value={{ request()->get('fecha') }} name="fecha">
                        @else
                            <input type="hidden" value={{ date('Y-m-d') }} name="fecha">
                        @endif
                        <button class="btn btn-outline-primary" type="submit"><i class="fa fa-file-word"></i> Descargar Word</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
        @error('message')
            <p style="color: red;">{{ $message }}</p>
        @enderror
    
    <br>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <input class="form-control" type="text" id="myInput" onkeyup="searchTable()" placeholder="Buscar...">
    </div>
    <table class="table table-striped table-hover" id="myTable">
        <thead>
            <tr>
                <th>Nro</th>
                <th>
                    <a href="{{ route('cargarpedidos.index', ['sort_by' => 'orderId', 'direction' => $ordenarPor == 'orderId' && $direccion == 'asc' ? 'desc' : 'asc','fecha'=>request()->query('fecha')?request()->query('fecha'):date('Y-m-d')]) }}">
                        Id Pedido 
                        @if ($ordenarPor == 'orderId')
                            {{ $direccion == 'asc' ? '↑' : '↓' }}
                        @endif
                    </a>
                </th>
                <th>
                    <a href="{{ route('cargarpedidos.index', ['sort_by' => 'customerName', 'direction' => $ordenarPor == 'customerName' && $direccion == 'asc' ? 'desc' : 'asc','fecha'=>request()->query('fecha')?request()->query('fecha'):date('Y-m-d')]) }}">
                        Cliente
                        @if ($ordenarPor == 'customerName')
                            {{ $direccion == 'asc' ? '↑' : '↓' }}
                        @endif
                    </a>
                </th>
                <th>
                    <a href="{{ route('cargarpedidos.index', ['sort_by' => 'doctorName', 'direction' => $ordenarPor == 'doctorName' && $direccion == 'asc' ? 'desc' : 'asc','fecha'=>request()->query('fecha')?request()->query('fecha'):date('Y-m-d')]) }}">
                        Doctor
                        @if ($ordenarPor == 'doctorName')
                            {{ $direccion == 'asc' ? '↑' : '↓' }}
                        @endif
                    </a>
                </th>
                <th>Est. Pago</th>
                <th>Turno</th>
                <th>Est. Entrega</th>
                <th width="200px">distrito</th>
                <th width="200px">Voucher</th>
                <th width="200px">Receta</th>
                <th width="200px">Zona</th>
                <th width="220px">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedidos  as $arr)
                <tr>
                    <td>{{ $arr["nroOrder"] }}</td>
                    <td>{{ $arr["orderId"] }}</td>
                    <td>{{ $arr["customerName"] }}</td>
                    <td>{{ $arr["doctorName"] }}</td>
                    <td>{{ $arr["paymentStatus"] }}</td>
                    <form action="{{ route('cargarpedidos.actualizarTurno',$arr->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <td>
                        <select class="form-select form-select-sm" aria-label=".form-select-sm"  name="turno" id="turno" onchange="this.form.submit()">
                            <option disabled>Cambiar turno</option>
                            <option value=0 {{ $arr->turno ===  0  ? 'selected' : '' }}>Mañana</option>
                            <option value=1 {{ $arr->turno ===  1  ? 'selected' : '' }}>Tarde</option>
                        </select>
                    </td>
                    </form>
                    @if($arr->user->role->name == 'motorizado' && $arr["paymentStatus"] === "Reprogramado")
                        <td class="table-danger">{{ $arr["deliveryStatus"] }}</td>
                    @else
                        <td>{{ $arr["deliveryStatus"] }}</td>
                    @endif
                    <td>{{ $arr["district"] }}</td>
                    <td>
                        @if ( $arr["voucher"] == 0)
                            <span class="badge rounded-pill bg-danger">Sin imagen</span>
                        @else
                            <span class="badge rounded-pill bg-success">Imagen</span>
                        @endif
                    </td>
                    <td>
                        @if ( $arr["receta"] == 0)
                            <span class="badge rounded-pill bg-danger">Sin imagen</span>
                        @else
                            <span class="badge rounded-pill bg-success">Imagen</span>
                        @endif
                    </td>
                    <td>{{ $arr->zone->name }}</td>
                    <td>
                        <form action="{{ route('cargarpedidos.destroy',$arr->id) }}" method="POST">
                            <a class="btn btn-danger btn-sm" href="{{ route('cargarpedidos.uploadfile',$arr->id) }}"><i class="fa fa-upload"></i>Carga</a>
                            <a class="btn btn-info btn-sm" href="{{ route('cargarpedidos.show',$arr->id) }}"><i class="fa fa-eye"></i> Ver</a>

                            <a class="btn btn-primary btn-sm" href="{{ route('cargarpedidos.edit',$arr->id) }}"><i class="fa-pencil"></i> Editar</a>

                            @csrf
                            @method('DELETE')
                    
                            <!-- <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Delete</button> -->
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        
    @endif
    @if(session('danger'))
        <div class="alert alert-danger">
            {{ session('danger') }}
        </div>
    @endif
    </div>
</div> 
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style type="text/css">
    </style>
    
@stop

@section('js')
    <script>
    function searchTable() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById('myInput');
        filter = input.value.toUpperCase();
        table = document.getElementById('myTable');
        tr = table.getElementsByTagName('tr');

        // Iterar sobre las filas de la tabla
        for (i = 1; i < tr.length; i++) { // Empieza en 1 para no incluir el encabezado
            td = tr[i].getElementsByTagName('td');
            let found = false;
            
            // Iterar sobre las celdas de cada fila
            for (let j = 0; j < td.length; j++) {
                if (td[j]) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        found = true;
                    }
                }
            }
            
            // Si alguna celda de la fila contiene el texto, mostrarla, sino ocultarla
            tr[i].style.display = found ? "" : "none";
        }
    }
    </script>
@stop