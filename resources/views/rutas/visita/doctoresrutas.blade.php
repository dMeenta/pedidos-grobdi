@extends('adminlte::page')

@section('title', 'Rutas Visitadora')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    <p></p>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <label>Lista de Doctores de: {{ $semana_ruta->lista->name }} ({{ $fecha_inicio }} al {{ $fecha_fin }})</label>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#crearDoctor">Agregar Doctor</button>
                    </div>
                    <div class="table table-responsive">
                        <table class="table" id="miTabla">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Estado</th>
                                    <th>Fecha Visita</th>
                                    <th>Turno</th>
                                    <th>Ver Doctores</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($visitadoctores as $visitadoctor)
                                <tr>
                                    <td>{{ $visitadoctor->doctor->name }}</td>
                                    @if ( $visitadoctor->estado_visita->id  == 1)
                                        <td><span class="badge bg-warning">{{ $visitadoctor->estado_visita->name }}</span></td>
                                    @elseif($visitadoctor->estado_visita->id == 5)
                                        <td><span class="badge bg-secondary">{{ $visitadoctor->estado_visita->name }}</span></td>
                                    @elseif($visitadoctor->estado_visita->id == 3)
                                        <td><span class="badge bg-danger">{{ $visitadoctor->estado_visita->name }}</span></td>
                                    @elseif($visitadoctor->estado_visita->id == 4)
                                        <td><span class="badge bg-primary">{{ $visitadoctor->estado_visita->name }}</span></td>
                                    @else
                                        <td><span class="badge bg-primary">{{ $visitadoctor->estado_visita->name }}</span></td>
                                    @endif
                                    <td>{{ $visitadoctor->fecha }}</td>
                                    <td>{{ $visitadoctor->turno?'Tarde':'Mañana' }}</td>
                                    @if ($visitadoctor->estado_visita_id == 1)
                                        <td>
                                            <button class="btn btn-success btn-asignar" 
                                                data-id="{{ $visitadoctor->id }}" 
                                                data-nombre="{{ $visitadoctor->doctor->name }}">
                                                Asignar
                                            </button>
                                        </td>
                                    @else
                                        <td></td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Modal -->
<div class="modal fade" id="modalAsignar" tabindex="-1" aria-labelledby="modalAsignarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formAsignar">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAsignarLabel">Asignar Visita</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="visitadoctor_id" name="visitadoctor_id">
                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha de Visita</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" min="{{ $fecha_inicio }}" max="{{ $fecha_fin }}" required>
                </div>
                <div class="mb-3">
                    <label for="turno" class="form-label">Turno</label>
                    <select class="form-control" name="turno" id="turno" required>
                        <option value="0">Mañana</option>
                        <option value="1">tarde</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
        </form>
    </div>
</div>
<!-- Modal crear doctor -->
 <!-- Modal -->
<div class="modal fade" id="crearDoctor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear Doctor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group row">
                        <label class="form-label col-2">CMP:</label>
                        <div class="col-8">
                            <input type="text" class="form-control" name="CMP" placeholder="Ingresar CMP">
                        </div>
                        <button type="button" id="btnBuscarCMP" class="btn btn-primary col-2">Validar</button>
                    </div>
                    <div class="form-group row">
                        <label class="col-2">Apellido Paterno:</label>
                        <div class="col-4">
                            <input type="text" class="form-control" name="first_lastname" placeholder="apellido paterno del doctor" disabled>
                        </div>
                        <label class="col-2">Apellido Materno:</label>
                        <div class="col-4">
                            <input type="text" class="form-control" name="second_lastname" placeholder="apellido materno del doctor" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2">Nombre:</label>
                        <div class="col-10">
                            <input type="text" class="form-control" name="name" placeholder="Nombre del doctor" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2">Telefono:</label>
                        <div class="col-4">
                            <input type="text" class="form-control" name="phone" placeholder="Ingresar telefono celular" required>
                        </div>
                        <label class="col-2">Fecha de nacimiento:</label>
                        <div class="col-4">
                            <input type="date" class="form-control" name="birthdate" placeholder="Ingresar fecha de nacimiento">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2">Especialidad:</label>
                        <div class="col-4">
                            <select class="form-control" name="especialidad_id">
                                @foreach ( $especialidades as $especialidad)
                                <option value="{{ $especialidad->id }}">{{ $especialidad->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label class="col-2">Distrito:</label>
                        <div class="col-4">
                            <select class="form-control" name="distrito_id">
                                @foreach ($distritos as $distrito)
                                <option value="{{ $distrito->id }}">{{ $distrito->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="id_enrutamientolista" value="{{ $semana_ruta->id }}">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="btnGuardarDoctor" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#miTabla').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
                },
                pageLength: 25, // 👈 Número por defecto (puedes cambiar a 25, 50, etc.)
                lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "Todos"] ] // Opciones de cantidad
            });

            // Abre modal y pasa el ID
            $('.btn-asignar').on('click', function () {
                let id = $(this).data('id');
                $('#visitadoctor_id').val(id);
                $('#modalAsignar').modal('show');
            });
            // Envía formulario por AJAX
            $('#formAsignar').on('submit', function (e) {
                e.preventDefault();

                let formData = {
                    _token: '{{ csrf_token() }}',
                    id: $('#visitadoctor_id').val(),
                    fecha: $('#fecha').val(),
                    turno: $('#turno').val()
                };

                $.ajax({
                    url: '{{ route("rutasvisitadora.asignar") }}', // Ruta backend
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        $('#modalAsignar').modal('hide');

                        Swal.fire({
                            icon: 'success',
                            title: 'Asignado correctamente',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        // Opcional: recargar tabla o actualizar solo esa fila
                        setTimeout(() => location.reload(), 1500);
                    },
                    error: function (xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseText || 'Ocurrió un error al guardar.'
                        });
                    }
                });
            });

            $("#btnBuscarCMP").click(function(){
                let cmp = $("input[name='CMP']").val();

                if(cmp.trim() === ""){
                    alert("Ingrese un CMP");
                    return;
                }

                $.ajax({
                    url: `/rutasvisitadora/buscardoctor/${cmp}`,
                    method: 'GET',
                    success: function(response){
                        if(response.success){
                            $("input[name='first_lastname']").val(response.data[2]);
                            $("input[name='second_lastname']").val(response.data[3]);
                            $("input[name='name']").val(response.data[4]);
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr){
                        alert(xhr.responseJSON?.message || "Error al buscar el CMP");
                    }
                });
            });
            // Botón guardar doctor
            $("#btnGuardarDoctor").click(function(){
                let formData = {
                    CMP: $("input[name='CMP']").val(),
                    first_lastname: $("input[name='first_lastname']").val(),
                    second_lastname: $("input[name='second_lastname']").val(),
                    name: $("input[name='name']").val(),
                    phone: $("input[name='phone']").val(),
                    birthdate: $("input[name='birthdate']").val(),
                    id_enrutamientolista: $("input[name='id_enrutamientolista']").val(),
                    _token: "{{ csrf_token() }}" // Para Laravel
                };

                $.ajax({
                    url: '/rutasvisitadora/doctores',
                    method: 'POST',
                    data: formData,
                    success: function(response){
                        if(response.success){
                            alert(response.message);
                            $("#crearDoctor").modal('hide');
                        } else {
                            alert("No se pudo guardar el doctor");
                        }
                    },
                    error: function(){
                        alert("Error al guardar");
                    }
                });
            });
        });
    </script>
    
@stop