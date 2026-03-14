<?php 
include('conexion.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Factura - Amarena System</title>
<link rel="stylesheet" type="text/css" href="estilo.css" media="screen" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            </nav>
    
    </header>

<!-- Formulario -->
    <main class="content">
    <h2>Detalle de Factura</h2>
    <form action="DetalleFactura.php" method="POST">
        <label>Cantidad Vendida:</label>
        <input type="number" placeholder="cant_vendida*" name="cant_vendida" required/>
        <br>
        <label>Código de Factura:</label>
        <input type="number" placeholder="factura_cod_factura*" name="factura_cod_factura" required/>
        <br>
        <label>Código de Producto:</label>
        <input type="number" placeholder="producto_cod_producto*" name="producto_cod_producto" required/>
        <br>
        <br>
        <input class="bt" type="submit" value="Agregar" name="agregar"/>
        <br>
        
    </form>
</main>


<?php
if(isset($_POST["agregar"])){
    $cant_vendidaa=$_POST["cant_vendida"];
    $factura_cod_facturaa=$_POST["factura_cod_factura"];
    $producto_cod_productoo=$_POST["producto_cod_producto"];
    
    $datos = "INSERT INTO detalle_factura VALUES ($cant_vendidaa,$factura_cod_facturaa,$producto_cod_productoo);";
    $insertar = mysqli_query($enlace,$datos);
    
    if(!$insertar){
        echo '<p style="color:red;">Error al insertar los campos: '.mysqli_error($enlace).'</p>';
    } else { 
        header("Location: mostrarDetalleFactura.php");
        exit();
    }
}
?>

</body>
</html>