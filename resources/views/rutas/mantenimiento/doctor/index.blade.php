@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Doctores</h1>
@stop

@section('content')
<div class="card mt-2">
    <div class="card-header">
        <div class="d-grid gap-2 d-md-flex justify-content-md-medium">
            <a class="btn btn-success btn-sm" href="{{ route('doctor.create') }}"> <i class="fa fa-plus"></i> Registrar datos</a>
            <button class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#itemModal"> <i class="fa fa-file-excel"></i> Cargar Doctores</button>
        </div>
    </div>
    <div class="card-body">
        @session('success')
            <div class="alert alert-success" role="alert"> {{ $value }} </div>
        @endsession
        @error('archivo')
        <p style="color: red;">{{ $message }}</p>
        @enderror
        <form method="GET" action="{{ route('doctor.index') }}">
            <input type="text" name="search" placeholder="Buscar..." value="{{ request('search') }}" class="form-control">
            <!-- <button type="submit" class="btn btn-primary">Buscar</button> -->
        </form>
        <div class="card-body table-responsive p-0" style="height: 800px;">
            <table class="table table-head-fixed text-nowrap display" id="miTabla">
                <thead>

                    <tr>
                        <th>
                            <a href="{{ route('doctor.index', ['sort_by' => 'name', 'direction' => $ordenarPor == 'name' && $direccion == 'asc' ? 'desc' : 'asc']) }}">
                                Nombre 
                                @if ($ordenarPor == 'name')
                                    {{ $direccion == 'asc' ? '↑' : '↓' }}
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ route('doctor.index', ['sort_by' => 'lastname', 'direction' => $ordenarPor == 'lastname' && $direccion == 'asc' ? 'desc' : 'asc']) }}">
                                Apellidos 
                                @if ($ordenarPor == 'lastname')
                                    {{ $direccion == 'asc' ? '↑' : '↓' }}
                                @endif
                            </a>
                        </th>
                        <th>CMP</th>
                        <th>Telefono</th>
                        <th>Especialidad</th>
                        <th>Centro de salud</th>
                        <th>Distrito</th>
                        <th>Tipo Medico</th>
                        <th>Usuario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
    
                <tbody>
                @forelse ($doctores as $doctor)
                    <tr class={{ $doctor->state == 0 ? 'table-danger': ''}}>
                        <td>{{ $doctor->name }}</td>
                        <td>{{ $doctor->lastname }}</td>
                        <td>{{ $doctor->CMP }}</td>
                        <td>{{ $doctor->phone }}</td>
                        <td>{{ $doctor->especialidad->name }}</td>
                        <td>{{ $doctor->centrosalud->name }}</td>
                        <td>{{ $doctor->distrito? $doctor->distrito->name:"" }}</td>
                        <td>{{ $doctor->tipo_medico }}</td>
                        <td>{{ $doctor->user->name }}</td>
                        <td>
                            <form action="{{ route('doctor.destroy',$doctor->id) }}" method="POST">
                                <a class="btn btn-primary btn-sm" href="{{ route('doctor.edit',$doctor->id) }}"><i class="fa-solid fa-pen-to-square"></i> Actualizar</a>
                                @csrf
                                @method('DELETE')
                                @if($doctor->state == 1)
                                    <button type="submit" class="btn btn-danger btn-sm">Inhabilitar</button>
                                @else
                                    <button type="submit" class="btn btn-success btn-sm">Habilitar</button>
                                @endif
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12">No hay información que mostrar</td>
                    </tr>
                @endforelse
                </tbody>
    
            </table>
            {!! $doctores->appends(request()->except('page'))->links() !!}
        </div>
    </div>
</div>
<div class="modal fade" id="itemModal" tabindex="-1" aria-labelledby="itemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="itemModalLabel">Cargar Datos de Doctores</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('doctor.cargadata') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-5">
                        <label for="doctor_excel" class="form-label"><strong>Cargar target Doctores:</strong></label>
                        <input 
                            type="file" 
                            name="archivo" 
                            class="form-control"
                            accept=".xlsx, .csv,.xls" 
                            id="doctor_excel"
                            required
                        >
                    </div>
                    <button type="submit" class="btn btn-success">Importar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

@stop