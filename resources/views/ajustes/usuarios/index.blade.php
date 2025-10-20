@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>👥 Gestión de Usuarios</h1>
@stop

@section('content')
<div class="card shadow-sm mt-2">
    <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-md-center">
        <h2 class="mb-2 mb-md-0">📋 Lista de usuarios</h2>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-success" href="{{ route('usuarios.create') }}">➕ Crear Usuario</a>
        </div>
    </div>
    <div class="card-body">
        @session('success')
            <div class="alert alert-success" role="alert"> {{ $value }} </div>
        @endsession
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover table-grobdi mb-0">
                <thead>
                    <tr>
                        <th>👤 Nombre</th>
                        <th>✉️ Email</th>
                        <th>🛡️ Rol</th>
                        <th>🗺️ Zonas</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Editar</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($usuarios as $usuario)
                    <tr class="{{ $usuario->active == 0 ? 'table-danger' : '' }}">
                        <td class="align-middle">{{ $usuario->name }}</td>
                        <td class="align-middle">{{ $usuario->email }}</td>
                        <td class="align-middle">{{ $usuario->role->name }}</td>
                        <td class="align-middle">
                            @forelse($usuario->zones as $zonas)
                                <span class="badge badge-info mr-1 mb-1">{{ $zonas->name }}</span>
                            @empty
                                <span class="text-muted">Sin zonas asignadas</span>
                            @endforelse
                        </td>
                        <td class="align-middle text-center">
                            @if($usuario->active == 1)
                                <span class="badge badge-success">Activo</span>
                            @else
                                <span class="badge badge-secondary">Inactivo</span>
                            @endif
                        </td>
                        <td class="align-middle text-center">
                            <a class="btn btn-primary btn-sm" href="{{ route('usuarios.edit', $usuario) }}">✏️ Actualizar</a>
                        </td>
                        <td class="align-middle text-center">
                            <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                @if($usuario->active == 1)
                                    <button type="submit" class="btn btn-danger btn-sm">🚫 Inhabilitar</button>
                                @else
                                    <button type="submit" class="btn btn-success btn-sm">✅ Habilitar</button>
                                @endif
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">No hay información que mostrar.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-between align-items-center flex-column flex-md-row">
        <span class="text-muted mb-2 mb-md-0">Total: {{ $usuarios->total() }} usuarios</span>
        {{ $usuarios->links() }}
    </div>
</div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stop