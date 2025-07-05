<div class="modal fade" id="modalEditar{{ $item->articulo_id }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $item->articulo_id }}" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form action="{{ route('merchandise.update', $item->articulo_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h1 class="modal-title" id="modalLabel{{ $item->articulo_id }}">
                        <i class="fa fa-tape"></i> Editar Merchandise
                    </h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" style="max-height: 60vh; overflow-y: auto;">
                    <div class="form-group">
                        <label for="nombre{{ $item->articulo_id }}">Nombre</label>
                        <input type="text" name="nombre" class="form-control" id="nombre{{ $item->articulo_id }}"
                            value="{{ old('nombre', $item->articulo->nombre) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="descripcion{{ $item->articulo_id }}">Descripción</label>
                        <textarea name="descripcion" class="form-control" id="descripcion{{ $item->articulo_id }}" required>{{ old('descripcion', $item->articulo->descripcion) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="precio{{ $item->articulo_id }}">Precio</label>
                        <input type="number" name="precio" class="form-control" id="precio{{ $item->articulo_id }}"
                            value="{{ old('precio', $item->precio) }}" step="0.0001" min="1" required>
                    </div>

                    @if($item->articulo->estado === 'inactivo')
                        <div class="form-group">
                            <label for="estado">Estado del Merchandise</label>
                            <div class="custom-control custom-checkbox">
                                <label for="estado{{ $item->articulo_id }}">
                                <input type="checkbox"  name="estado" id="estado{{ $item->articulo_id }}"
                                    value="activo" {{ $item->articulo->estado === 'activo' ? 'checked' : '' }} required>
                                <span style="margin-left:6px;">Activo</span>
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
