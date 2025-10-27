@extends('adminlte::page')

@section('title', 'Crear mes de bonificaciones')

@section('content')
	<div class="bonificaciones-wrapper">
		<div class="card bonificaciones-hero-card shadow-sm border-0 mb-4">
			<div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
				<div>
					<h1 class="h3 text-dark mb-1">Crear mes de bonificaciones</h1>
					<p class="text-muted mb-0">Registra un nuevo periodo mensual y personaliza las bonificaciones para las visitadoras.</p>
				</div>
			</div>
		</div>

		<div class="card shadow-sm border-0 mb-4">
			<div class="card-body">
				<form>
					<div class="row g-3">
						<div class="col-12 col-md-6">
							<label for="bonificacionMes" class="form-label text-muted text-uppercase small mb-1">Mes</label>
							<input type="month" id="bonificacionMes" class="form-control form-control-lg">
						</div>
						<div class="col-12 col-md-6">
							<label for="bonificacionTipoMedico" class="form-label text-muted text-uppercase small mb-1">Tipo de médico</label>
							<select id="bonificacionTipoMedico" class="form-select form-select-lg">
								<option value="" selected>Selecciona un tipo</option>
								<option value="prescriptor">Prescriptor</option>
								<option value="comprador">Comprador</option>
							</select>
						</div>
					</div>

					<div class="mt-4">
						<div class="form-check form-switch">
                            <label class="form-check-label fw-semibold" for="aplicarGeneral">¿Aplicar porcentaje y monto de la meta para todas las visitadoras?</label>
							<input class="form-check-input" type="checkbox" role="switch" id="aplicarGeneral" data-trigger="generales">
						</div>

						<div class="row g-3 mt-3 bonificaciones-extra-fields d-none" data-target="generales">
							<div class="col-12 col-md-6 col-xl-4">
								<label for="porcentajeGeneral" class="form-label text-muted text-uppercase small mb-1">Porcentaje comisión</label>
								<div class="input-group">
									<input type="number" min="0" max="100" step="0.01" id="porcentajeGeneral" class="form-control form-control-lg" placeholder="Ej. 3.5">
									<span class="input-group-text">%</span>
								</div>
							</div>
							<div class="col-12 col-md-6 col-xl-4">
								<label for="montoGeneral" class="form-label text-muted text-uppercase small mb-1">Monto meta</label>
								<div class="input-group">
									<span class="input-group-text">S/</span>
									<input type="number" min="0" step="0.01" id="montoGeneral" class="form-control form-control-lg" placeholder="Ej. 15,000">
								</div>
							</div>
						</div>
					</div>

					<div class="mt-4">
						<h2 class="h6 text-uppercase text-muted mb-2">Bonificaciones por visitadora</h2>
						<div class="table-responsive">
							<table class="table table-striped align-middle table-grobdi">
								<thead>
									<tr>
										<th scope="col">Nombre</th>
										<th scope="col">Porcentaje comisión</th>
										<th scope="col">Monto meta</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Visitadora 1</td>
										<td>3.50%</td>
										<td>S/ 15,000</td>
									</tr>
									<tr>
										<td>Visitadora 2</td>
										<td>4.50%</td>
										<td>S/ 7,500</td>
									</tr>
									<tr>
										<td>Visitadora 3</td>
										<td>3.50%</td>
										<td>S/ 25,000</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>

					<div class="mt-4 d-flex justify-content-end gap-2">
						<a href="{{ route('bonificaciones.index') }}" class="btn btn-outline-secondary btn-lg">Cancelar</a>
						<button type="submit" class="btn btn-primary btn-lg px-4">Guardar mes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@stop

@section('css')
	<style>
		.bonificaciones-wrapper {
			background-color: #f7f7fb;
			border-radius: 16px;
			padding: 1.5rem;
		}

		.bonificaciones-hero-card {
			background-color: #f8efef;
			border-radius: 20px;
		}

		.bonificaciones-hero-card .card-body {
			padding: 1.75rem;
		}

		.bonificaciones-extra-fields {
			background-color: #fff8f3;
			border-radius: 14px;
			border: 1px dashed #f0c7a8;
			padding: 1rem 1.25rem;
		}

		.bonificaciones-visitadoras-table tbody tr:nth-child(even) {
			background-color: #f7f7fb;
		}
	</style>
@stop

@section('js')
	<script>
		$(function () {
			$('[data-trigger="generales"]').on('change', function () {
				const shouldShow = $(this).is(':checked');
				$('[data-target="generales"]').toggleClass('d-none', !shouldShow);
			});

			const $selectVisitadora = $('#filtroVisitadora');
			const $rowsVisitadora = $('#tablaVisitadoras tbody tr');
			const $badgeVisitadora = $('#badgeFiltroVisitadora');
			const $badgeNombre = $badgeVisitadora.find('[data-role="nombre"]');

			function aplicarFiltroVisitadora(nombre) {
				if (!nombre) {
					$rowsVisitadora.show();
					$badgeVisitadora.addClass('d-none');
					return;
				}

				$rowsVisitadora.each(function () {
					const coincide = $(this).data('visitadora') === nombre;
					$(this).toggle(coincide);
				});

				$badgeNombre.text(nombre);
				$badgeVisitadora.removeClass('d-none');
			}

			$selectVisitadora.on('change', function () {
				aplicarFiltroVisitadora($(this).val());
			});

			$('#limpiarFiltroVisitadora, #quitarFiltroVisitadora').on('click', function () {
				$selectVisitadora.val('');
				aplicarFiltroVisitadora('');
			});
		});
	</script>
@stop
