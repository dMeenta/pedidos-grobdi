<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre de la Muestra</th>
            <th>Observación</th>
            <th>Estado de laboratorio</th>
            <th>Comentarios de laboratorio</th>
            <th>Tipo de Frasco</th>
            <th>Tipo de Muestra</th>
            <th>Clasificación</th>
            <th>Unidad de medida</th>
            <th>Doctor</th>
            <th>Cantidad</th>
            @if (in_array($currentUserRole, $allowedRolesToSeePrices))
            <th>Precio Unitario</th>
            <th>Precio Total</th>
            @endif
            <th>Día de Entrega (Programado)</th>
            <th>Creado por</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($muestras as $muestra)
        <tr>
            <td>{{ $muestra->id }}</td>
            <td>{{ $muestra->nombre_muestra }}</td>
            <td>{{ $muestra->observacion }}</td>
            <td>{{ $muestra->lab_state }}</td>
            <td>{{ $muestra->comentarios }}</td>
            <td>{{ $muestra->tipo_frasco }}</td>
            <td>{{ optional($muestra->tipoMuestra)->nombre }}</td>
            <td>{{ optional($muestra->clasificacion)->nombre }}</td>
            <td>{{ optional($muestra->unidadDeMedida)->nombre }}</td>
            <td> {{ optional($muestra->doctor)->name ?? $muestra->name_doctor ?? 'No asignado' }}</td>
            <td>{{ $muestra->cantidad_de_muestra }}</td>
            @if (in_array($currentUserRole, $allowedRolesToSeePrices))
            <td>{{ $muestra->precio }}</td>
            <td>{{ $muestra->precio * $muestra->cantidad_de_muestra }}</td>
            @endif
            <td>{{ \Carbon\Carbon::parse($muestra->datetime_scheduled)->format('d/m/Y H:i') }}</td>
            <td>{{ $muestra->creator->name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>