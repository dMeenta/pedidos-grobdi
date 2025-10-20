@extends('adminlte::page')

@section('title', 'Vistas')

@section('content_header')
    <h1>Gestión de Vistas</h1>
@stop

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3">
        <a href="{{ route('views.create') }}" class="btn btn-primary">+ Nueva Vista</a>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('views.index') }}" class="w-100">
                <div class="row align-items-end">
                    <div class="form-group col-12 col-md-6 col-lg-5 mb-3 mb-md-0">
                        <label for="module_id" class="mb-1">Filtrar por módulo</label>
                        <select name="module_id" id="module_id" class="form-control">
                            <option value="">Todos los módulos</option>
                            @foreach($modules as $module)
                                <option value="{{ $module->id }}" {{ (string)($selectedModule ?? '') === (string)$module->id ? 'selected' : '' }}>
                                    {{ $module->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-6 col-lg-7">
                        <div class="d-flex flex-column flex-sm-row justify-content-center align-items-stretch">
                            <button type="submit" class="btn btn-primary btn-block mb-2 mb-sm-0 mr-sm-3">🔍 Filtrar</button>
                            <a href="{{ route('views.index') }}" class="btn btn-outline-secondary btn-block">♻️ Limpiar</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover table-grobdi mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Ruta</th>
                    <th>Módulo</th>
                    <th>Menú</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($views as $view)
                    <tr>
                        <td class="text-center">{{ $view->id }}</td>
                        <td>{{ $view->description }}</td>
                        <td>{{ $view->url }}</td>
                        <td>{{ $view->module->name }}</td>
                        <td>
                            @if($view->is_menu)
                                <span class="badge badge-success">Sí</span>
                            @else
                                <span class="badge badge-secondary">No</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('views.edit', $view) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('views.destroy', $view) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">No se encontraron vistas para el filtro seleccionado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $views->links() }}
    </div>
@stop
