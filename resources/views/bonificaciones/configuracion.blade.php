@extends('adminlte::page')

@section('title', 'Configuración de Meta No Cumplida')

@section('content')
	<div class="bonificaciones-wrapper">
		<div class="card bonificaciones-hero-card shadow-sm border-0 mb-4">
			<div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
				<div>
					<h1 class="h3 text-dark mb-1">Configuración de Meta No Cumplida</h1>
					<p class="text-muted mb-0">Define los porcentajes de comisión aplicables cuando las visitadoras no alcanzan la meta mensual.</p>
				</div>
				<div class="bonificaciones-action-group d-flex gap-2">
					<button class="btn btn-primary btn-lg px-4" data-toggle="modal" data-target="#configuracionModal">Crear Rango</button>
				</div>
			</div>
		</div>

		<div class="card bonificaciones-config-card shadow-sm border-0 mb-4">
			<div class="bonificaciones-config-header text-white">
				<div>
					<h2 class="h5 mb-1">Rangos de Porcentaje Configurados</h2>
					<p class="small mb-0 text-white-50">Lista de rangos disponibles para aplicar cuando la meta no se cumple totalmente.</p>
				</div>
			</div>
			<div class="card-body p-0">
				<div class="table-responsive">
					<table class="table table-striped mb-0 align-middle table-grobdi">
						<thead>
							<tr>
								<th scope="col">Porcentaje inicial</th>
								<th scope="col">Porcentaje final</th>
								<th scope="col">comision</th>
								<th scope="col" class="text-end">Acciones</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>0%</td>
								<td>79%</td>
								<td>0%</td>
								<td class="text-end">
									<a href="#" class="text-primary fw-semibold me-3">editar</a>
									<a href="#" class="text-danger fw-semibold">eliminar</a>
								</td>
							</tr>
							<tr>
								<td>80%</td>
								<td>89%</td>
								<td>1%</td>
								<td class="text-end">
									<a href="#" class="text-primary fw-semibold me-3">editar</a>
									<a href="#" class="text-danger fw-semibold">eliminar</a>
								</td>
							</tr>
							<tr>
								<td>90%</td>
								<td>99%</td>
								<td>1.50%</td>
								<td class="text-end">
									<a href="#" class="text-primary fw-semibold me-3">editar</a>
									<a href="#" class="text-danger fw-semibold">eliminar</a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="card bonificaciones-info-card shadow-sm border-0">
			<div class="card-body">
				<h3 class="h6 fw-semibold text-dark mb-2">Información Importante</h3>
				<p class="mb-0 text-muted">Estas reglas se aplican automáticamente cuando el avance de una meta mensual es menor al 100%. Ajusta cuidadosamente para mantener consistencia con el modelo de comisiones.</p>
			</div>
		</div>
	</div>
    @include('bonificaciones.partials.configModal')
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

		.bonificaciones-action-group {
			margin-left: auto;
			margin-top: 1.25rem;
		}

		.bonificaciones-config-card {
			border-radius: 20px;
		}

		.bonificaciones-range-group {
			background-color: #fdf9f9;
			border-radius: 14px;
			border: 1px solid #f1e2e2;
		}

		.bonificaciones-range-group .remove-range-row {
			padding: 0;
		}

		.bonificaciones-config-header {
			background: linear-gradient(90deg, #2f6bd7, #2c8bff);
			border-top-left-radius: 20px;
			border-top-right-radius: 20px;
			padding: 1.5rem;
		}
		.bonificaciones-info-card {
			border-radius: 20px;
			background-color: #bceff7;
		}

		.bonificaciones-info-card .card-body {
			padding: 1.5rem 1.75rem;
		}

		@media (max-width: 767.98px) {
			.bonificaciones-wrapper {
				padding: 1rem;
			}
		}
	</style>
@stop

@section('js')
	<script>
		$(function () {
			const $rangeContainer = $('#rangeFields');
			const $prototype = $rangeContainer.find('.bonificaciones-range-group').first().clone();

			function updateGroup($group, index) {
				$group.attr('data-index', index);
				$group.find('[data-field]').each(function () {
					const field = $(this).data('field');
					const inputId = 'rango_' + field + '_' + index;
					$(this).attr('name', 'rangos[' + index + '][' + field + ']').attr('id', inputId);
				});
				$group.find('[data-label-for]').each(function () {
					const field = $(this).data('label-for');
					$(this).attr('for', 'rango_' + field + '_' + index);
				});
				$group.find('.remove-range-row').toggleClass('d-none', index === 0);
			}

			function rebuildIndexes() {
				$rangeContainer.find('.bonificaciones-range-group').each(function (idx) {
					updateGroup($(this), idx);
				});
			}

			rebuildIndexes();

			$('#addRangeRow').on('click', function (event) {
				event.preventDefault();
				const $clone = $prototype.clone();
				$clone.find('input').val('');
				$rangeContainer.append($clone);
				rebuildIndexes();
			});

			$(document).on('click', '.remove-range-row', function (event) {
				event.preventDefault();
				$(this).closest('.bonificaciones-range-group').remove();
				rebuildIndexes();
			});

			$('#configuracionModal').on('hidden.bs.modal', function () {
				const $groups = $rangeContainer.find('.bonificaciones-range-group');
				$groups.slice(1).remove();
				rebuildIndexes();
			});
		});
	</script>
@stop
