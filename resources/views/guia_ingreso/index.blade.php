@extends('adminlte::page')
@section('title', 'Guías de Ingreso')
@section('content')
<div class="container mt-3">
    <h1 class="text-center">Guías de Ingreso</h1>
    <a href="{{ route('guia_ingreso.create') }}" class="btn btn_crear mb-3"><i class="fas fa-plus-circle"></i>  Registrar nueva Guía de Ingreso</a>
    @include('messages')
    <table class="table table-bordered table-responsive table-hover" id="guias">
        <thead>
            <tr>
                <th>N°</th>
                <th>Nombre</th>
                <th>Fecha</th>
                <th>Factura (Compra)</th>
                <th>Proveedor</th>
                <th>Detalles</th>
            </tr>
        </thead>
        <tbody>
            @forelse($guias as $index => $guia)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td  class="observaciones">{{ $guia->nombre }}</td>
                    <td>{{ $guia->fecha }}</td>
                    <td>{{ $guia->compra->serie ?? '' }}-{{ $guia->compra->numero ?? '' }}</td>
                    <td>{{ $guia->compra->proveedor->razon_social ?? '' }}</td>
                    <td>
                        <div class="w">
                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalShowGuia{{$guia->id}}">
                                <i class="fa fa-eye"></i> Ver
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalDeleteGuia{{$guia->id}}">
                                <i class="fa fa-trash"></i> Eliminar
                            </button>
                        </div>

                        <!-- Modal Confirmar Eliminar -->
                        <div class="modal fade" id="modalDeleteGuia{{$guia->id}}" tabindex="-1" role="dialog" aria-labelledby="modalDeleteGuiaLabel{{$guia->id}}" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="modalDeleteGuiaLabel{{$guia->id}}"><i class="fas fa-skull-crossbones mr-2"></i>Eliminar Guía de Ingreso</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body" style="overflow-wrap: break-word; white-space: normal;">
                                ¿Está seguro que desea eliminar la guía <strong>{{ $guia->nombre }}</strong> y revertir el stock de todos sus articulos?
                              </div>
                              <div class="modal-footer">
                                <form action="{{ route('guia_ingreso.destroy', $guia->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt mr-2"></i>Sí, eliminar</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-window-close mr-2"></i>Cancelar</button>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Modal Show Detalles y Generales -->
                        <div class="modal fade" id="modalShowGuia{{$guia->id}}" tabindex="-1" role="dialog" aria-labelledby="modalShowGuiaLabel{{$guia->id}}" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content" style="border-radius: 10px;">
                            <div class="modal-header" style="background-color:hsl(353, 100%, 69.6%); color: white;">
                                <h4 class="modal-title" id="modalShowGuiaLabel{{$guia->id}}"><strong><i class="fas fa-info-circle mr-2"></i>Detalle de Guía de Ingreso</strong></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="max-height: 65vh; overflow-y: auto;">
                                <dl class="row" style="overflow-wrap: break-word; white-space: normal;">
                                <dt class="u col-sm-3">Nombre</dt>
                                <dd class="col-sm-9">{{ $guia->nombre }}</dd>
                                <dt class="u col-sm-3">Fecha</dt>
                                <dd class="col-sm-9">{{ $guia->fecha }}</dd>
                                <dt class="u col-sm-3">Factura (Compra)</dt>
                                <dd class="col-sm-9">{{ $guia->compra->serie ?? '' }}-{{ $guia->compra->numero ?? '' }}</dd>
                                <dt class="u col-sm-3">Proveedor</dt>
                                <dd class="col-sm-9">{{ $guia->compra->proveedor->razon_social ?? '' }}</dd>
                                </dl>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-sm mb-0">
                                        <thead style="background-color:rgb(255, 175, 184); color: rgb(169, 68, 80);">
                                            <tr>
                                                <th>SKU</th>
                                                <th>Artículo</th>
                                                <th>Lote</th>
                                                <th>Unidad</th>
                                                <th>Cantidad compra</th>
                                                <th>Cantidad ingresada</th>
                                                <th>Pendiente</th>
                                                <th>Vencimiento</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($guia->detalles as $detalle)
                                                @php
                                                    $detalleCompra = $detalle->detalleCompra;
                                                    $articulo = $detalle->lote->articulo ?? null;
                                                    $unidad = $articulo->unidad ?? 'und';
                                                    if ($articulo && isset($articulo->tipo)) {
                                                        switch ($articulo->tipo) {
                                                            case 'insumo':
                                                                $unidad = optional($articulo->insumos->first()?->unidadMedida)->nombre_unidad_de_medida ?? $unidad;
                                                                break;
                                                            case 'util':
                                                            $unidad;
                                                            case 'merchandise':
                                                            $unidad;
                                                            case 'material':
                                                            case 'envase':
                                                                $empaque = $articulo->empaques->where('tipo', $articulo->tipo)->first();
                                                                $unidad = optional($empaque?->unidadMedida)->nombre_unidad_de_medida ?? $unidad;
                                                                break;
                                                            case 'empaque':
                                                                $unidad = optional($articulo->empaques->first()?->unidadMedida)->nombre_unidad_de_medida ?? $unidad;
                                                                break;
                                                        }
                                                    }
                                                    $totalIngresado = $detalleCompra->detalleGuiaIngresos->sum('cantidad');
                                                    $pendiente = $detalleCompra->cantidad - $totalIngresado;
                                                @endphp
                                                <tr>
                                                    <td>{{ $articulo->sku ?? '' }}</td>
                                                    <td class="observaciones">{{ $articulo->nombre ?? '' }}</td>
                                                    <td>{{ $detalle->lote->num_lote ?? '' }}</td>
                                                    <td>{{ $unidad }}</td>
                                                    <td>{{ $detalleCompra->cantidad }}</td>
                                                    <td>{{ $detalle->cantidad }}</td>
                                                    <td>
                                                        @php
                                                            // Calcular pendiente en el momento de registrar esta guía
                                                            $todasGuias = $detalleCompra->detalleGuiaIngresos()->orderBy('id')->get();
                                                            $acumuladoHastaEstaGuia = 0;
                                                            foreach ($todasGuias as $dgi) {
                                                                $acumuladoHastaEstaGuia += $dgi->cantidad;
                                                                if ($dgi->guia_ingreso_id == $detalle->guia_ingreso_id) break;
                                                            }
                                                            $pendienteAlMomento = $detalleCompra->cantidad - $acumuladoHastaEstaGuia;
                                                        @endphp
                                                        {{ $pendienteAlMomento }}
                                                    </td>
                                                    <td>{{ $detalle->fecha_vencimiento ? \Carbon\Carbon::parse($detalle->fecha_vencimiento)->format('d/m/Y') : '' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center">No hay guías de ingreso registradas.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('css/muestras/home.css') }}">
    <style>
        .u {color:rgb(224, 61, 80);}
    </style>
@stop
@section('js')
    <script>
         $(document).ready(function() {
                $('#guias').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json',
                    },
                    ordering: false,
                    responsive: true,
                    dom: '<"row"<"col-sm-12 col-md-12"f>>rt<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                    pageLength: 10,
                    initComplete: function() {
                        $('.dataTables_filter')
                            .appendTo('.header-tools')
                            .addClass('text-right ml-auto')
                            .find('input')  
                            .attr('placeholder', 'Buscar por nombre de la muestra')
                            .end()  
                            .find('label')
                            .contents().filter(function() {
                                return this.nodeType === 3;
                            }).remove()
                            .end()
                            .prepend('Buscar:');
                    }
                });
            });
  </script>
@stop