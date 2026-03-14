<?php
include('conexion.php');

$facturas = mysqli_query($enlace,"
SELECT f.id_factura, f.fecha, f.estado, c.nombre as cliente
FROM factura f
LEFT JOIN cliente c ON f.id_cliente=c.id_cliente
ORDER BY f.fecha DESC
");
?>

<html>
<head>
<meta charset="utf-8">
<title>Reporte de Facturas - Amarena</title>
<style>
table { border-collapse: collapse; width: 100%; }
th, td { border:1px solid #000; padding:5px; text-align:left; }
.bt { padding:5px 10px; background:#0a7; color:#fff; text-decoration:none; }
</style>
</head>
<body>

<h1>Reporte de Facturas</h1>
<a href="#" onclick="window.print();" class="bt">Imprimir</a>
<br><br>

<table>
<tr>
<th>ID</th>
<th>Fecha</th>
<th>Cliente</th>
<th>Estado</th>
<th>Productos</th>
</tr>

<?php
while($f = mysqli_fetch_assoc($facturas)){
    echo "<tr>";
    echo "<td>{$f['id_factura']}</td>";
    echo "<td>{$f['fecha']}</td>";
    echo "<td>{$f['cliente']}</td>";
    echo "<td>{$f['estado']}</td>";

    // Obtener productos de la factura
    $productos = mysqli_query($enlace,"
        SELECT p.nom_producto, d.cantidad
        FROM detalle_factura d
        JOIN producto p ON d.producto_cod_producto = p.id_producto
        WHERE d.factura_cod_factura={$f['id_factura']}
    ");

    $lista = "";
    while($prod = mysqli_fetch_assoc($productos)){
        $lista .= $prod['nom_producto']." (".$prod['cantidad'].")<br>";
    }

    echo "<td>$lista</td>";
    echo "</tr>";
}
?>
</table>
</body>
</html>