<?php
include('conexion.php');

// Obtener clientes
$clientes = mysqli_query($enlace, "SELECT * FROM cliente");

// Obtener productos con stock > 0
$productos = mysqli_query($enlace, "SELECT * FROM producto WHERE stock>0");

// Guardar factura
if(isset($_POST['crear_factura'])){

    $cliente_id = (int)$_POST['cliente'];
    $fecha = date('Y-m-d');

    $total_factura = 0; // Inicializar total

    // Primero validamos si hay suficiente stock y calculamos total
    foreach($_POST['producto'] as $prod_id => $cantidad){
        $cantidad = (int)$cantidad;
        if($cantidad > 0){
            $res = mysqli_query($enlace, "SELECT precio, stock, nombre FROM producto WHERE id_producto=$prod_id");
            $fila = mysqli_fetch_assoc($res);

            if($cantidad > $fila['stock']){
                echo "<p style='color:red;'>Error: No hay suficiente stock para {$fila['nombre']}</p>";
                // No se detiene, pasa al siguiente producto
                continue;
            }

            $total_factura += $fila['precio'] * $cantidad;
        }
    }

    // Insertar factura con estado ACTIVA y total
    $empleado_id = (int)$_POST['empleado']; // si se selecciona en formulario
mysqli_query($enlace, "INSERT INTO factura (fecha, id_cliente, id_empleado, estado, total) VALUES ('$fecha', $cliente_id, $empleado_id, 'ACTIVA', $total_factura)");
$id_factura = mysqli_insert_id($enlace);
    // Recorrer productos seleccionados de nuevo para insertar detalle y descontar stock
    foreach($_POST['producto'] as $prod_id => $cantidad){
        $cantidad = (int)$cantidad;
        if($cantidad > 0){
            $res = mysqli_query($enlace, "SELECT precio, stock FROM producto WHERE id_producto=$prod_id");
            $fila = mysqli_fetch_assoc($res);

            if($cantidad > $fila['stock']){
                // Este producto ya dio error antes
                continue;
            }

            $precio = $fila['precio'];

            // Insert detalle
            mysqli_query($enlace,"INSERT INTO detalle_factura (factura_cod_factura, producto_cod_producto, cantidad, precio_unitario)
            VALUES ($id_factura, $prod_id, $cantidad, $precio)");

            // Descontar stock
            mysqli_query($enlace,"UPDATE producto SET stock = stock - $cantidad WHERE id_producto=$prod_id");
        }
    }

    header("Location: mostrarFactura.php");
    exit();
}
?>

<html>
<head>
<meta charset="utf-8">
<title>Crear Factura - Amarena</title>
<link rel="stylesheet" href="estilo.css">
</head>
<body>
<header>
<h1>Heladería Amarena</h1>
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
<h1>Crear Factura</h1>

<form method="POST">
<label>Cliente:</label>
<select name="cliente" required>
<option value="">Seleccione cliente</option>
<?php while($c=mysqli_fetch_assoc($clientes)){ ?>
<option value="<?php echo $c['id_cliente']; ?>"><?php echo $c['nombre']; ?></option>
<?php } ?>
</select><br><br>

<h3>Productos:</h3>
<table border="1">
<tr>
<th>Producto</th>
<th>Stock disponible</th>
<th>Cantidad a vender</th>
<label>Empleado:</label>
<select name="empleado" required>
<option value="">Seleccione empleado</option>
<?php
$empleados = mysqli_query($enlace,"SELECT * FROM empleado");
while($e=mysqli_fetch_assoc($empleados)){
    echo "<option value='{$e['id_empleado']}'>{$e['nombre']}</option>";
}
?>
</select><br><br>
</tr>
<?php while($p=mysqli_fetch_assoc($productos)){ ?>
<tr>
<td><?php echo $p['nombre']; ?></td>
<td>
<?php
if($p['stock']<=5){
    echo "<span style='color:red;font-weight:bold;'>".$p['stock']."</span>";
} else {
    echo $p['stock'];
}
?>
</td>
<td><input type="number" name="producto[<?php echo $p['id_producto']; ?>]" min="0" max="<?php echo $p['stock']; ?>"></td>
</tr>
<?php } ?>
</table><br>

<input type="submit" name="crear_factura" value="Crear Factura" class="bt">
</form>

</main>
</body>
</html>