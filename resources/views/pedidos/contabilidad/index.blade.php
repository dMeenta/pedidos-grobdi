@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content')
<div class="card mt-5">
    <h2 class="card-header">Pedidos</h2>
    <div class="card-body">
        <form action="{{ route('pedidoscontabilidad.index') }}" method="GET">
            <div class="row">
                <div class="col-xs-2 col-sm-2 col-md-2">
                    <label for="fecha_inicio">Fecha de inicio:</label>
                    <input class="form-control" type="date" name="fecha_inicio" id="fecha_inicio" required>
                </div>
                <div class="col-xs-2 col-sm-2 col-md-2">
                    <label for="fecha_fin">Fecha de fin:</label>
                    <input class="form-control" type="date" name="fecha_fin" id="fecha_fin" required>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">

                    <button type="submit" class="btn btn-outline-primary"><i class="fa fa-search"></i> Buscar</button>
                </div>
                <div class="col-xs-2 col-sm-2 col-md-2">
                    @if(request()->get('fecha_inicio'))
                        <a class="btn btn-outline-success btn-sm" href="{{ route('pedidoscontabilidad.downloadExcel',['fechainicio' => request()->get('fecha_inicio'),'fechafin' => request()->get('fecha_fin')]) }}"><i class="fa fa-file-word"></i> Descargar Excel</a>
                    @else
                        <a class="btn btn-outline-success btn-sm" href="{{ route('pedidoscontabilidad.downloadExcel',['fechainicio' => date('Y-m-d'),'fechafin' => date('Y-m-d')]) }}"><i class="fa fa-file-excel"></i> Descargar Excel</a>
                    @endif
                </div>
            </div>
            @error('message')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </form>
        @session('success')
            <div class="alert alert-success" role="alert"> {{ $value }} </div>
        @endsession
        <table class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th>Nro pedido</th>
                    <th>Cliente</th>
                    <th>Fecha de registro</th>
                    <th>Estado de pago</th>
                    <th>Estado Contabilidad</th>
                    <th>Voucher</th>
                    <th width="120px">Opciones</th>
                </tr>
            </thead>
  
            <tbody>
            @forelse ($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->orderId }}</td>
                    <td>{{ $pedido->customerName }}</td>
                    <td>{{ date('d-m-Y', strtotime($pedido->created_at)) }}  </td>
                    <td>{{ $pedido->paymentStatus }}</td>
                    @if ($pedido->accountingStatus === 0)
                    
                    <td><i class="fa fa-times" aria-hidden="true"></i> Sin revisar</td>
                    @else
                    <td><i class="fa fa-check" aria-hidden="true"></i> Revisado</td>
                    @endif
                    <td>
                        @if ( $pedido->voucher == 0)
                            <span class="badge rounded-pill bg-danger">Sin imagen</span>
                        @else
                            <span class="badge rounded-pill bg-success">Imagen</span>
                        @endif
                    </td>
                    <td>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#ModalPedido{{ $pedido->id }}">
                            <i class="fa fa-info"></i> Detalles
                        </button>
                    </td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="ModalPedido{{ $pedido->id }}" tabindex="-1" aria-labelledby="labelPedido{{ $pedido->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <form action="{{ route('pedidoscontabilidad.update', $pedido->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="labelPedido{{ $pedido->id }}">Editar Pedido</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-xs-4 col-sm-4 col-md-4">
                                            <div class="form-group">
                                                <strong>Nro del Pedido:</strong> <br/>
                                                {{ $pedido->orderId }}
                                            </div>
                                        </div>
                                        <div class="col-xs-8 col-sm-8 col-md-8">
                                            <div class="form-group">
                                                <strong>cliente:</strong> <br/>
                                                {{ $pedido->customerName }}
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-sm-4 col-md-4 mt-2">
                                            <div class="form-group">
                                                <strong>Fecha Entrega:</strong> <br/>
                                                {{ $pedido->deliveryDate }}
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-sm-4 col-md-4 mt-2">
                                            <div class="form-group">
                                                <strong>Estado de pago:</strong> <br/>
                                                {{ $pedido->paymentStatus }}
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-sm-4 col-md-4 mt-2">
                                            <div class="form-group">
                                                <strong>Metodo de pago:</strong> <br/>
                                                {{ $pedido->paymentMethod }}
                                            </div>
                                        </div>
                                        @if ($pedido->voucher)
                                            @php
                                                $images = explode(",",$pedido->voucher);
                                                $nro_operaciones = explode(",",$pedido->operationNumber);
                                                $array_voucher = [];
                                                foreach ($images as $key => $voucher) {
                                                    array_push($array_voucher,['nro_operacion'=>$nro_operaciones[$key],'voucher'=>$voucher]);
                                                }
                                            @endphp
                                            @foreach ($array_voucher as $voucher)
                                                <div class="col-xs-4 col-sm-4 col-md-4">
                                                    Nro de Operación: <strong>{{ $voucher['nro_operacion'] }}</strong><br>
                                                    <img src="{{ asset($voucher['voucher']) }}" alt="{{ $pedido->orderId }} width="400" height="400"">
                                                </div>
                                            @endforeach
                                        @endif
                                        <div class="col-xs-4 col-sm-4 col-md-4 mt-2">
                                            <label for="accountingStatus" class="form-select"><strong>Estado de contabilidad:</strong></label>
                                            <select class="form-control" name="accountingStatus" id="accountingStatus">
                                                <option disabled select>Selecciona una opción</option>
                                                <option value="0" {{ $pedido->accountingStatus === 0 ? 'selected' : '' }}>Sin revisar</option>
                                                <option value="1" {{ $pedido->accountingStatus === 1 ? 'selected' : '' }}>Revisado</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-4 col-sm-4 col-md-4 mt-2">
                                            <label>Banco Destino:</label>
                                            <input class="form-control" name="bancoDestino" value="{{ $pedido->bancoDestino }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Guardar cambios</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @empty
                <tr>
                    <td colspan="7">No hay información que mostrar</td>
                </tr>
            @endforelse
            </tbody>
  
        </table>
        

  </div>
</div> 

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script>
    $(document).ready(function () {
        $('.table').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
            },
        pageLength: 25,
        lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"] ],
            dom: '<"row mb-3"<"col-md-6"l><"col-md-6"Bf>>' +
                '<"row"<"col-md-12"tr>>' +
                '<"row mt-3"<"col-md-5"i><"col-md-7"p>>'
        });
    });
</script>
@stop