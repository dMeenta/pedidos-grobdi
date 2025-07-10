@extends('adminlte::page')
@section('title', 'Registrar Guía de Ingreso')
@section('content')
<div class="container mt-3">
     @include('messages')
     <div class="form-check mb-3">
            <div class="form-check mb-6">
                <a class="float-start text-secondary" title="Volver" href="{{ route('guia_ingreso.index') }}" style="position: absolute; left: 0; font-size: 2rem;">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-center">Registrar Guía de Ingreso</h1>
            </div>
        </div>
    <form method="POST" action="{{ route('guia_ingreso.store') }}" id="guiaIngresoForm">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" id="nombre" value="{{ old('nombre') }}" required>
                    @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input type="date" class="form-control @error('fecha') is-invalid @enderror" name="fecha" id="fecha" value="{{ old('fecha', date('Y-m-d')) }}" required>
                    @error('fecha') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="compra_id">Factura (Compra)</label>
                    <select class="form-control @error('compra_id') is-invalid @enderror" name="compra_id" id="compra_id" required>
                        <option value="">Seleccione una factura</option>
                        @foreach($compras as $compra)
                            <option value="{{ $compra->id }}" data-serie="{{ $compra->serie }}" data-numero="{{ $compra->numero }}" {{ old('compra_id') == $compra->id ? 'selected' : '' }}>
                                {{ $compra->serie }} - {{ $compra->numero }} ({{ $compra->proveedor->razon_social ?? '' }})
                            </option>
                        @endforeach
                    </select>
                    @error('compra_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
        <div class="mt-4">
            <h4>Articulos de la Factura Seleccionada</h4>
            <div id="tabla-detalles-container">
                <table class="table table-bordered table-responsive" id="tabla-detalles">
                    <thead>
                        <tr>
                            <th>SKU</th>
                            <th>Articulo</th>
                            <th>Unidad</th>
                            <th>Cantidad comprada</th>
                            <th>Pendiente</th>
                            <th>Cantidad a ingresar</th>
                            <th>Lote</th>
                            <th>Fecha de vencimiento</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-detalles">
                        <tr><td colspan="9" class="text-center">Seleccione una factura para ver los productos</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
        <button type="submit" class="btn btn_crear mt-3"><i class="fas fa-save mr-2"></i>Registrar Guía de Ingreso</button>
    </form>
</div>
@endsection
@section('css')
    <link href="{{ asset('css/muestras/home.css') }}" rel="stylesheet" />
    <style>
        h4{color: rgb(185, 79, 92);font-weight: bold;}
    </style>
@stop
@section('js')
<script>
    const compras = @json($compras);
    document.getElementById('compra_id').addEventListener('change', function() {
        let compraId = this.value;
        if (!compraId) {
            document.getElementById('tbody-detalles').innerHTML = '<tr><td colspan="8" class="text-center">Seleccione una factura para ver los productos</td></tr>';
            return;
        }
        fetch(`/guia_ingreso/detalles-compra/${compraId}`)
            .then(res => res.json())
            .then(detalles => {
                let rows = '';
                if (detalles.length === 0) {
                    rows = '<tr><td colspan="8" class="text-center">No hay productos en esta compra</td></tr>';
                } else {
                    detalles.forEach(function(det) {
                        let pendiente = det.cantidad;
                        if (det.detalle_guia_ingresos && det.detalle_guia_ingresos.length > 0) {
                            let ingresado = det.detalle_guia_ingresos.reduce((sum, dgi) => sum + dgi.cantidad, 0);
                            pendiente = det.cantidad - ingresado;
                        }
                        if (pendiente > 0) {
                            rows += `<tr>
                                <td>${det.articulo.sku || ''}</td>
                                <td class="observaciones">${det.articulo.nombre || ''}</td>
                                <td>${det.articulo.unidad || ''}</td>
                                <td>${det.cantidad}</td>
                                <td>${pendiente}</td>
                                <td><input type="number" name="detalles[${det.id}][cantidad]" class="form-control" min="1" max="${pendiente}" value="${pendiente}" ></td>
                                <td style="position:relative;min-width:200px;">
                                    <div class="lote-input-group" data-articulo-id="${det.articulo_id}" data-detalle-id="${det.id}">
                                        <input type="text" name="detalles[${det.id}][lote]" class="form-control lote-input" maxlength="50">
                                        <input type="hidden" name="detalles[${det.id}][lote_id]" class="lote-id-hidden">
                                        <button type="button" class="btn btn-sm btn-info tiene-lote-btn" style="position:absolute;top:0;right:0;z-index:2;">Tiene lote</button>
                                    </div>
                                </td>
                                <td><input type="date" name="detalles[${det.id}][fecha_vencimiento]" class="form-control" required></td>
                                <input type="hidden" name="detalles[${det.id}][detalle_compra_id]" value="${det.id}">
                                <td><button type="button" class="btn btn-danger btn-sm btn-eliminar-producto" title="Eliminar"><i class="fas fa-trash"></i></button></td>
                            </tr>`;
                        }
                    });
                }
                document.getElementById('tbody-detalles').innerHTML = rows;
            });
    });
    // Lógica para eliminar producto de la tabla
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-eliminar-producto')) {
            const fila = e.target.closest('tr');
            if (fila) fila.remove();
        }
        // Lógica para el botón Tiene lote
        if (e.target.classList.contains('tiene-lote-btn')) {
            let group = e.target.closest('.lote-input-group');
            let articuloId = group.getAttribute('data-articulo-id');
            let detalleId = group.getAttribute('data-detalle-id');
            let input = group.querySelector('.lote-input');
            let hidden = group.querySelector('.lote-id-hidden');
            // Si ya hay un select, volver al input
            if (group.querySelector('select')) {
                let select = group.querySelector('select');
                input.value = '';
                hidden.value = '';
                select.remove();
                input.style.display = '';
                hidden.value = '';
                // Habilita y limpia el input de fecha de vencimiento
                let fechaInput = group.parentElement.parentElement.querySelector('input[type="date"]');
                if (fechaInput) {
                    fechaInput.value = '';
                    fechaInput.readOnly = false;
                }
                e.target.innerText = 'Tiene lote';
                return;
            }
            // AJAX para obtener lotes
            fetch(`/lotes/por-articulo/${articuloId}`)
                .then(res => res.json())
                .then(lotes => {
                    let select = document.createElement('select');
                    select.className = 'form-control lote-select';
                    let option = document.createElement('option');
                    option.value = '';
                    option.innerText = 'Seleccione un lote';
                    select.appendChild(option);
                    lotes.forEach(function(lote) {
                        let opt = document.createElement('option');
                        opt.value = lote.id;
                        opt.innerText = lote.num_lote + (lote.fecha_vencimiento ? ' (Vence: ' + lote.fecha_vencimiento + ')' : '');
                        select.appendChild(opt);
                    });
                    select.addEventListener('change', function() {
                        let fechaInput = group.parentElement.parentElement.querySelector('input[type="date"]');
                        if (this.value) {
                            let selected = lotes.find(l => l.id == this.value);
                            input.value = selected ? selected.num_lote : '';
                            hidden.value = this.value;
                            if (selected && selected.fecha_vencimiento && fechaInput) {
                                // Formatea la fecha a yyyy-MM-dd
                                let fecha = selected.fecha_vencimiento;
                                if (fecha.includes('T')) {
                                    fecha = fecha.split('T')[0];
                                } else if (fecha.includes(' ')) {
                                    fecha = fecha.split(' ')[0];
                                }
                                fechaInput.value = fecha;
                                fechaInput.readOnly = true;
                            }
                        } else {
                            input.value = '';
                            hidden.value = '';
                            if (fechaInput) {
                                fechaInput.value = '';
                                fechaInput.readOnly = false;
                            }
                        }
                    });
                    group.appendChild(select);
                    input.style.display = 'none';
                    e.target.innerHTML = '<i class="fas fa-edit"></i>';
                });
        }
    });
    // Al enviar el formulario, si hay lote_id pero el input de lote está vacío, lo rellena automáticamente
    document.getElementById('guiaIngresoForm').addEventListener('submit', function(e) {
        document.querySelectorAll('.lote-input-group').forEach(function(group) {
            let input = group.querySelector('.lote-input');
            let hidden = group.querySelector('.lote-id-hidden');
            if (hidden.value && !input.value) {
                // Buscar el option seleccionado
                let select = group.querySelector('select');
                if (select) {
                    let selectedOption = select.options[select.selectedIndex];
                    if (selectedOption && selectedOption.text) {
                        // Extrae solo el número de lote antes del paréntesis (si existe)
                        let loteText = selectedOption.text.split(' (')[0];
                        input.value = loteText;
                    }
                }
            }
        });
    });
</script>
@endsection
