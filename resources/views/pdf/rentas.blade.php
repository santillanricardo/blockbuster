<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #1a1a2e; }
    h1 { color: #c4622d; margin-bottom: 4px; }
    p  { color: #555; margin: 0 0 16px; }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    th { background: #1a1a2e; color: #d4a853; padding: 8px; text-align: left; }
    td { border-bottom: 1px solid #ddd; padding: 7px 8px; }
    tr:nth-child(even) td { background: #f9f6f0; }
</style>
</head>
<body>
    <h1>🎬 Blockbuster — Reporte de Rentas</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Película</th>
                <th>Fecha Renta</th>
                <th>Fecha Devolución</th>
                <th>Estatus</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rentas as $renta)
            <tr>
                <td>{{ $renta->id }}</td>
                <td>{{ $renta->cliente->nombre }}</td>
                <td>{{ $renta->pelicula->titulo }}</td>
                <td>{{ $renta->fecha_renta }}</td>
                <td>{{ $renta->fecha_devolucion }}</td>
                <td>{{ ucfirst($renta->estatus) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>