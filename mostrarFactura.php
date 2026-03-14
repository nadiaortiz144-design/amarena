<?php
include('conexion.php'); // conexión con $enlace

// --- Anular factura ---
if (isset($_POST['anular']) && isset($_POST['id_factura'])) {
    $id_factura = (int)$_POST['id_factura'];

    // Opcional: si querés borrar detalles al anular, podés hacerlo
    // $sql_detalle = "DELETE FROM detalle_factura WHERE factura_cod_factura = $id_factura";
    // mysqli_query($enlace, $sql_detalle);

    $sql_anular = "UPDATE factura SET estado='0' WHERE id_factura = $id_factura";
    if (mysqli_query($enlace, $sql_anular)) {
        echo "<p>Factura $id_factura anulada correctamente.</p>";
    } else {
        echo "<p>Error al anular factura: " . mysqli_error($enlace) . "</p>";
    }
}

// --- Buscar facturas ACTIVAS ---
$consulta_sql = "SELECT * FROM factura WHERE estado='1'";
if (isset($_POST['Aceptar'])) { 
    $buscar = mysqli_real_escape_string($enlace, $_POST['buscar']);
    $consulta_sql = "SELECT * FROM factura WHERE estado='1' AND id_factura LIKE '%$buscar%'";
}
$consulta = mysqli_query($enlace, $consulta_sql);
?>

<html>
<head>
<meta charset="utf-8">
<title>Facturas Activas - Amarena</title>
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

<h1>Facturas Activas</h1>

<form method="POST" action="">
    <a class="bt" href="insertarFactura.php">Registrar Ventas</a><br><br>
    <input class="bt" type="submit" name="Aceptar" value="Buscar" />
    <input type="text" name="buscar" placeholder="Buscar por Id de factura" />
</form>

<table border="1">
<tr>
    <th>Id de Factura</th>
    <th>Fecha</th>
    <th>Codigo del Cliente</th>
    <th>Codigo del Empleado</th>
    <th>Acción</th>
    <th>Modificar</th>
</tr>

<?php 
while ($filas = mysqli_fetch_array($consulta)) {
    $id_factura = $filas['id_factura'];
    $fecha = $filas['fecha'];
    $id_cliente = $filas['id_cliente'];
    $id_empleado = isset($filas['id_empleado']) ? $filas['id_empleado'] : '';
?>
<tr>
    <td><?php echo $id_factura; ?></td>
    <td><?php echo $fecha; ?></td>
    <td><?php echo $id_cliente; ?></td>
    <td><?php echo $id_empleado; ?></td>

    <!-- botón anular -->
    <td align="center">
        <form method="POST" action="" onsubmit="return confirm('¿Seguro que quieres anular esta factura?');">
            <input type="hidden" name="id_factura" value="<?php echo $id_factura; ?>" />
            <input class="bt" type="submit" name="anular" value="Anular" />
        </form>
    </td>

    <!-- botón modificar -->
    <td align="center">
        <a class="bt" href="editarFactura.php?id=<?php echo $id_factura; ?>">Modificar</a>
    </td>
</tr>
<?php
}
mysqli_close($enlace);
?>
</table>
</body>
</html>