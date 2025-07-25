<div class="modal fade" id="modalEditar{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form action="{{ route('insumos.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h1 class="modal-title" id="modalLabel{{ $item->id }}">
                        <i class="fas fa-vial"></i> Editar Insumo
                    </h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" style="max-height: 60vh; overflow-y: auto;">
                    <div class="form-group">
                        <label for="nombre{{ $item->id }}">Nombre</label>
                        <input type="text" name="nombre" class="form-control" id="nombre{{ $item->id }}"
                            value="{{ old('nombre', $item->articulo->nombre) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="precio{{ $item->id }}">Precio</label>
                        <input type="number" name="precio" class="form-control" id="precio{{ $item->id }}"
                            value="{{ old('precio', $item->precio) }}" step="0.0001" min="0" required>
                    </div>

                    <div class="form-group">
                        <label for="unidad_de_medida_id{{ $item->id }}">Unidad de Medida</label>
                        <select name="unidad_de_medida_id" class="form-control" id="unidad_de_medida_id{{ $item->id }}" required>
                            <option value="">Seleccione una unidad</option>
                            @foreach($unidades as $id => $nombre)
                                <option value="{{ $id }}" {{ $item->unidad_de_medida_id == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    @if($item->articulo->estado === 'inactivo')
                        <div class="form-group">
                            <label for="estado">Estado del Insumo</label>
                            <div class="custom-control custom-checkbox">
                                <label for="estado{{ $item->id }}">
                                <input type="checkbox"  name="estado" id="estado{{ $item->id }}"
                                    value="activo" {{ $item->articulo->estado === 'activo' ? 'checked' : '' }} required>
                                <span style="color:rgb(57, 161, 48); margin-left:6px;">Activo</span>
                                </label>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn_crear">
                        <i class="fa fa-floppy-disk"></i> Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
