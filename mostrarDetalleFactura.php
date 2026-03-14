<?php
include('conexion.php');

// =====================
// ELIMINAR DETALLE
// =====================
if(isset($_POST['borrar'])){
    $cant_vendida = (int)$_POST['cant_vendida'];
    $factura_cod_factura = (int)$_POST['factura_cod_factura'];
    $producto_cod_producto = (int)$_POST['producto_cod_producto'];

    $q = "DELETE FROM detalle_factura 
          WHERE cant_vendida=$cant_vendida 
          AND factura_cod_factura=$factura_cod_factura 
          AND producto_cod_producto=$producto_cod_producto";
    $rs = mysqli_query($enlace,$q);
    if(!$rs){
        echo "<p>Error al eliminar: ".mysqli_error($enlace)."</p>";
    }else{
        header("Location: mostrarDetalleFactura.php");
        exit();
    }
}

// =====================
// CONSULTA
// =====================
$consulta = "SELECT * FROM detalle_factura";

// Si se busca por producto
if(isset($_POST['Aceptar'])){
    $buscar = mysqli_real_escape_string($enlace, $_POST['buscar']);
    if($buscar != ""){
        $consulta .= " WHERE producto_cod_producto LIKE '%$buscar%'";
    }else{
        echo "<p>No ingresó ningún valor para buscar.</p>";
    }
}

$rs = mysqli_query($enlace,$consulta);
?>

<html>
<head>
<meta charset="utf-8">
<title>Amarena_System</title>
	<link rel="stylesheet" type="text/css" href="estilo.css" media="screen" />
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
<h1>  Detalle de Factura </h1>
<form id="form1" name="form1" method="post" action="">
      <input class="bt" type="button" value="Ingresar Detalles de la factura" onclick="window.location.href='DetalleFactura.php'" />
	  <input class="bt" type="button" value="Imprimir Datos" onclick="window.location.href='informes/usuario.php'" />
	  <br><br>
	  <input class="bt" type="submit" name="Aceptar" value="Buscar" title="Buscar Usuarios" />
	  <input type="text" name="buscar" id="buscar" />
 </form>
   <table border="1">
<tr>
    <th>Cantidad Vendida</th>
    <th>Codigo de Factura</th>
    <th>Codigo de Producto</th>
    <th>Eliminar</th>
    <th>Modificar</th>
</tr>

<?php
while($fila = mysqli_fetch_assoc($rs)){
    $cant_vendida = $fila['cant_vendida'];
    $factura_cod_factura = $fila['factura_cod_factura'];
    $producto_cod_producto = $fila['producto_cod_producto'];
    echo "<tr>
        <td>$cant_vendida</td>
        <td>$factura_cod_factura</td>
        <td>$producto_cod_producto</td>
        <td>
            <form method='post'>
                <input type='hidden' name='cant_vendida' value='$cant_vendida'>
                <input type='hidden' name='factura_cod_factura' value='$factura_cod_factura'>
                <input type='hidden' name='producto_cod_producto' value='$producto_cod_producto'>
                <input class='bt' type='submit' name='borrar' value='Eliminar'>
            </form>
        </td>
        <td>
            <form method='post' action='ModificarDetalleFactura.php'>
                <input type='hidden' name='cant_vendida' value='$cant_vendida'>
                <input type='hidden' name='factura_cod_factura' value='$factura_cod_factura'>
                <input type='hidden' name='producto_cod_producto' value='$producto_cod_producto'>
                <input class='bt' type='submit' name='mod' value='Modificar'>
            </form>
        </td>
    </tr>";
}
mysqli_close($enlace);
?>
</table>
	  </div>
      </body>
	  
</html>