<?php
 include ('conexion.php');//incluimos la conexion
 ?>
<html>
<head>
<meta charset="utf-8">
<title>Amarena_System</title>
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
                </ul>
            </nav>
    
    </header>
<main class="content">
    <h2>Productos</h2>

        <a class="bt" href="insertarProducto.php">Ingresar Datos</a>
        <a class="bt" href="ReporteProductos.php">Imprimir Datos</a>

    <form id="form1" method="post" action="">
        <input type="text" name="buscar" id="buscar" placeholder="Buscar código..."/>
        <input class="bt" type="submit" name="Aceptar" value="Buscar"/>
    </form>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Fecha de Entrega</th>
                <th>Stock</th>
                <th colspan="3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $consulta = mysqli_query($enlace,"SELECT * FROM producto");


            if (isset($_POST['Aceptar'])){
                $buscar = mysqli_real_escape_string($enlace,$_POST['buscar']);
                $consulta = mysqli_query($enlace,"SELECT * FROM producto WHERE cod_producto LIKE '%$buscar%'");
            }

            while($filas = mysqli_fetch_assoc($consulta)){
                ?>
                <tr>
                    <td><?php echo $filas['nombre']; ?></td>
                    <td><?php echo $filas['descripcion']; ?></td>
                    <td><?php echo $filas['precio']; ?></td>
                    <td><?php echo $filas['fecha_entrega']; ?></td>
                    <td><?php
                        if($filas['stock'] <= 5){
                            echo "<span style='color:red; font-weight:bold;'>{$filas['stock']}</span>";
                        }else{
                            echo $filas['stock'];
                        }
                        ?></td>
                    <td>
                        <a class="bt" href="modificarProducto.php?cod_p=<?php echo $filas['id_producto']; ?>">Modificar</a>
                    </td>
                    <td>
                        <a class="bt-eliminar" href="eliminarProducto.php?cod_p=<?php echo $filas['id_producto']; ?>" onclick="return confirm('¿Seguro que quieres eliminar este producto?');">Eliminar</a>
                    </td>
                </tr>
            <?php 
            } ?>
        </tbody>
    </table>

</main>

<?php mysqli_close($enlace); ?>

      </body>
	  
</html>