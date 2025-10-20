@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <h1>Sistema de control de roles</h1>
@stop

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3">
        <a href="{{ route('roles.create') }}" class="btn btn-primary">➕ Nuevo Rol</a>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('roles.index') }}" class="w-100">
                <div class="row align-items-end">
                    <div class="form-group col-12 col-md-6 col-lg-5 mb-3 mb-md-0">
                        <label for="role_id" class="mb-1">Filtrar por rol</label>
                        <select name="role_id" id="role_id" class="form-control">
                            <option value="">Todos los roles</option>
                            @foreach($roleOptions as $roleOption)
                                <option value="{{ $roleOption->id }}" {{ (string)($selectedRole ?? '') === (string)$roleOption->id ? 'selected' : '' }}>
                                    {{ $roleOption->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-6 col-lg-7">
                        <div class="d-flex flex-column flex-sm-row justify-content-center align-items-stretch">
                            <button type="submit" class="btn btn-primary btn-block mb-2 mb-sm-0 mr-sm-3">🔍 Filtrar</button>
                            <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary btn-block">♻️ Limpiar</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span class="mb-0 font-weight-bold">Lista de roles</span>
            <span class="badge badge-primary">{{ $roles->total() }} registros</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-grobdi mb-0">
                    <thead>
                        <tr>
                            <th>Rol</th>
                            <th>Descripción</th>
                            <th>Permisos</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $role)
                            <tr>
                                <td class="font-weight-bold">{{ $role->name }}</td>
                                <td>{{ $role->description }}</td>
                                <td>
                                    @if ($role->views->isEmpty() && $role->modules->isEmpty())
                                        <span class="text-muted">Sin permisos asignados</span>
                                    @else
                                        <button type="button" class="btn btn-sm btn-outline-info" data-toggle="modal" data-target="#role-permissions-{{ $role->id }}">
                                            👁️ Ver permisos
                                        </button>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('roles.edit', $role) }}" class="btn btn-sm btn-warning mb-1">✏️ Editar</a>
                                    <a href="{{ route('roles.permissions', $role) }}" class="btn btn-sm btn-info mb-1">🛡️ Permisos</a>
                                    <form action="{{ route('roles.destroy', $role) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')">🗑️ Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">No se encontraron roles para el filtro seleccionado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            {{ $roles->links() }}
        </div>
    </div>

    @foreach ($roles as $role)
        @include('ajustes.roles.partials.permissions-modal', ['role' => $role])
    @endforeach
@stop

@section('css')
@stop

@section('js')

    <script>
    </script>
    
@stop