<?php
include("conexion.php"); // usa la misma variable de conexion que en tu sistema

// Validar que venga el ID
if (!isset($_GET['id'])) {
    die("No se recibió el ID de la factura");
}

$id = (int)$_GET['id']; // seguridad: convertir a entero

$sql = "SELECT * FROM factura WHERE id_factura='$id'";
$resultado = mysqli_query($enlace, $sql); // usa $enlace si tu conexion lo define así

if (!$fila = mysqli_fetch_assoc($resultado)) {
    die("Factura no encontrada");
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Modificar Factura</title>
<link rel="stylesheet" href="estilo.css">
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
					<li><a href="mostrarFactura.php">Facturas (Empezar a vender)</a></li>
                </ul>
                </ul>
            </nav>
    
    </header>
<main class="content">
<h2>Modificar Factura</h2>

<form action="actualizar_factura.php" method="POST">
    <input type="hidden" name="id_factura" placeholder="id_factura*" value="<?php echo htmlspecialchars($fila['id_factura']); ?>">

    <label>Cliente</label><br>
    <input type="text" name="cliente" placeholder="Id_Cliente*" value="<?php echo htmlspecialchars($fila['id_cliente']); ?>"><br><br>

    <label>Fecha</label><br>
    <input type="date" name="fecha" placeholder="Fecha*" value="<?php echo htmlspecialchars($fila['fecha']); ?>"><br><br>

    <label>Id Empleado</label><br>
    <input type="text" name="id_empleado" placeholder="Id_empleado*" value="<?php echo htmlspecialchars($fila['id_empleado']); ?>"><br><br>

    <input type="submit" value="Actualizar Factura" class="bt">
</form>
</main>
</body>
</html>