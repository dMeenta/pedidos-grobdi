<table style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif; width:100%;">
    <thead>
        <tr>
            @foreach($headers as $header)
                <th style="background:#004085; color:#fff; border:1px solid #003366; padding:10px 8px; text-align:left; font-size:15px;">{{ $header }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($muestras as $index => $muestra)
            <tr>
                <td style="border:1px solid #ddd; padding:8px; font-size:13px;">{{ $index + 1 }}</td>
                <td style="border:1px solid #ddd; padding:8px; font-size:13px;">{{ $muestra->nombre_muestra }}</td>
                <td style="border:1px solid #ddd; padding:8px; font-size:13px;">{{ $muestra->clasificacion->nombre_clasificacion ?? 'Sin clasificación' }}</td>
                <td style="border:1px solid #ddd; padding:8px; font-size:13px;">{{ $muestra->tipo_frasco ?? 'No asignado' }}</td>
                <td style="border:1px solid #ddd; padding:8px; font-size:13px; text-align:center;">
                    @if(isset($muestra->aprobado_jefe_comercial))
                        {{ $muestra->aprobado_jefe_comercial ? 'Sí' : 'No' }}
                    @else
                        -
                    @endif
                </td>
                <td style="border:1px solid #ddd; padding:8px; font-size:13px; text-align:center;">
                    @if(isset($muestra->aprobado_coordinadora))
                        {{ $muestra->aprobado_coordinadora ? 'Sí' : 'No' }}
                    @else
                        -
                    @endif
                </td>
                <td style="border:1px solid #ddd; padding:8px; font-size:13px;">{{ $muestra->cantidad_de_muestra }}</td>
                <td style="border:1px solid #ddd; padding:8px; font-size:13px;">{{ $muestra->estado ?? '-' }}</td>
                <td style="border:1px solid #ddd; padding:8px; font-size:13px;">{{ $muestra->creator->name ?? $muestra->created_by }}</td>
                <td style="border:1px solid #ddd; padding:8px; font-size:13px;">{{ $muestra->name_doctor ?? '-' }}</td>
                <td style="border:1px solid #ddd; padding:8px; font-size:13px;">
                    @if($muestra->fecha_hora_entrega)
                        {{ \Carbon\Carbon::parse($muestra->fecha_hora_entrega)->format('d/m/Y H:i') }}
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
