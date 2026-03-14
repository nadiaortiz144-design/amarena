<?php
include('conexion.php');

// Consulta todos los productos
$productos = mysqli_query($enlace,"SELECT * FROM producto ORDER BY nombre ASC");
?>

<html>
<head>
<meta charset="utf-8">
<title>Reporte de Productos - Amarena</title>
<link rel="stylesheet" type="text/css" href="estilo.css" media="screen" />
</head>
<body>
<header>
    <div class="header-container">
        <h1>Heladería Amarena</h1>
    </div>
    <nav
        <ul class="menu">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="mostrarProducto.php">Stock de productos</a></li>
    <li><a href="mostrarCliente.php">Clientes Activos</a></li>
    <li><a href="clientesInactivos.php">Clientes Inactivos</a></li>
            <li><a href="mostrarFactura.php">Facturas (Activas)</a></li>
            <li><a href="facturasAnuladas.php">Facturas Anuladas</a></li>
        </ul>
    </nav>
</header>
<style>
table { border-collapse: collapse; width: 100%; }
th, td { border:1px solid #000; padding:5px; text-align:left; }
.red { color:red; font-weight:bold; }
.bt { padding:5px 10px; background:#0a7; color:#fff; text-decoration:none; display:inline-block; margin-bottom:10px;}
</style>
</head>
<body>

<h1>Reporte de Productos</h1><br>
<a href="#" onclick="window.print();" class="bt">Imprimir</a>
<br><br>

<table>
<tr>
<th>ID</th>
<th>Nombre</th>
<th>Descripción</th>
<th>Precio</th>
<th>Stock</th>
<th>Fecha de entrega</th>
</tr>

<?php
while($p = mysqli_fetch_assoc($productos)){
    echo "<tr>";
    echo "<td>{$p['id_producto']}</td>";
    echo "<td>{$p['nombre']}</td>";
    echo "<td>{$p['descripcion']}</td>";
    echo "<td>{$p['precio']}</td>";

    // Resaltar stock bajo
    if($p['stock'] <= 5){
        echo "<td class='red'>{$p['stock']}</td>";
    } else {
        echo "<td>{$p['stock']}</td>";
    }

    echo "<td>{$p['fecha_entrega']}</td>";
    echo "</tr>";
}
?>
</table>
</body>
</html>