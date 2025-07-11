<table>
    <thead>
        <tr>
            <th>Nombre de la Muestra</th>
            <th>Clasificación</th>
            <th>Tipo de Muestra</th>
            <th>Día y Hora de Entrega</th>
            <th>Doctor</th>
            <th>Creado por</th>
        </tr>
    </thead>
    <tbody>
        @foreach($muestras as $muestra)
            <tr>
                <td>{{ $muestra->nombre_muestra }}</td>
                <td>{{ $muestra->clasificacion->nombre_clasificacion ?? '' }}</td>
                <td>{{ $muestra->tipo_muestra }}</td>
                <td>
                    @if($muestra->fecha_hora_entrega)
                        {{ \Carbon\Carbon::parse($muestra->fecha_hora_entrega)->format('d/m/Y H:i') }}
                    @endif
                </td>
                <td>{{ $muestra->name_doctor }}</td>
                <td>{{ $muestra->creator->name ?? $muestra->created_by }}</td>
            </tr>
        @endforeach
    </tbody>
</table>