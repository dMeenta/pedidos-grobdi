<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Frasco Muestra</title>
    <style>
        :root {
            --primary: #d6254d;
            --secondary: #ff5475;
            --accent: #fff1be;
            --text-dark: #333;
            --text-light: #fff;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: var(--text-dark);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            color: var(--primary);
            margin-bottom: 5px;
            font-size: 1.8rem;
        }

        .header .mes {
            font-size: 1.2rem;
            color: var(--secondary);
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* Tablas */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: var(--primary);
            color: var(--text-light);
            font-weight: 600;
            text-align: center;
        }

        td:first-child {
            text-align: left;
        }

        td {
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: var(--accent);
        }

        /* Tabla de totales */
        .tabla-totales {
            width: 100%;
            max-width: 450px;
            margin: 30px auto 0;
        }

        .tabla-totales th {
            background-color: var(--secondary);
            padding: 12px;
            font-size: 1.1rem;
        }

        .tabla-totales tr:last-child {
            background-color: var(--accent);
            font-weight: bold;
        }

        /* Estilos para el logo (si lo agregas después) */
        .logo {
            text-align: center;
            margin-bottom: 15px;
        }

        .logo img {
            max-height: 80px;
        }

        /* Fecha de generación */
        .fecha-generacion {
            text-align: right;
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Opcional: Logo de la empresa -->
    <!-- <div class="logo">
        <img src="{{ asset('ruta/a/tu/logo.png') }}" alt="Logo">
    </div> -->

    <div class="fecha-generacion">
        Generado el: {{ now()->format('d/m/Y H:i') }}
    </div>

    <div class="header">
        <h1>Reporte de Muestras - Frasco Muestra</h1>
        <div class="mes">Mes: {{ \Carbon\Carbon::parse($mesSeleccionado)->translatedFormat('F Y') }}</div>
    </div>

    <!-- Tabla de Muestras -->
    <h3>Tabla de Muestras</h3>
    <table>
        <thead>
            <tr>
                <th>Nombre de Muestra</th>
                <th>Cantidad</th>
                <th>Precio Unitario (S/)</th>
                <th>Precio Total (S/)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($muestrasData as $data)
                <tr>
                    <td>{{ $data['nombre_muestra'] }}</td>
                    <td>{{ $data['cantidad'] }}</td>
                    <td>{{ number_format($data['precio_unidad'], 2) }}</td>
                    <td>{{ number_format($data['precio_total'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tabla de Totales -->
    <table class="tabla-totales">
        <thead>
            <tr>
                <th colspan="2">Resumen de Totales</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Total de Muestras</td>
                <td>{{ $totalCantidad }}</td>
            </tr>
            <tr>
                <td>Total de Precio</td>
                <td>S/ {{ number_format($totalPrecio, 2) }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>