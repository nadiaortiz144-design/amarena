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
					<li><a href="mostrarFactura.php">Facturas (Empezar a vender)</a></li>
                </ul>
				</ul>
			</nav>
	
	</header>
<main class="content">
    <h2>Clientes</h2>
<form id="form1" name="form1" method="post" action="">
      <a class="bt" href="insertarCliente.php"> Ingresar Nuevo Cliente</a>  
	  <br><br>
	  <input class="bt" type="submit" name="Aceptar" value="Buscar" title="Buscar Usuarios" />
	  <input type="text" name="buscar" id="buscar" />

 </form>
 </main>
<main>
    <table>
        <thead>
            <tr>
                <th>Id Cliente</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>DNI</th>
                <th>Telefono</th>
                <th>Email </th>
                <th colspan="2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $consulta = mysqli_query($enlace,"SELECT * FROM cliente WHERE estado = 1");

            if (isset($_POST['Aceptar'])){
                $buscar = mysqli_real_escape_string($enlace,$_POST['buscar']);
                $consulta = mysqli_query($enlace,"SELECT * FROM cliente WHERE id_cliente LIKE '%$buscar%' AND estado = 1");
            }

            while($filas = mysqli_fetch_assoc($consulta)){
                ?>
                <tr>
                    <td><?php echo $filas['id_cliente']; ?></td>
                    <td><?php echo $filas['nombre']; ?></td>
                    <td><?php echo $filas['apellido']; ?></td>
                    <td><?php echo $filas['dni']; ?></td>
                    <td><?php echo $filas['telefono']; ?></td>
                    <td><?php echo $filas['email']; ?></td>
                    <td>
                        <a class="bt" href="modificarCliente.php?cod_p=<?php echo $filas['id_cliente']; ?>">Modificar</a>
						  <td bgcolor="#FFFADD" align="center">
		<form action="modificarCliente.php" method="Post" >
			<input name="id_cliente" type="hidden" value="<?php echo $id_cliente ?>" />
			<input name="nom_cliente" type="hidden" value="<?php echo $nom_cliente ?>" />
			<input name="apellido_cliente" type="hidden" value="<?php echo $apellido_cliente ?>" />
            <input name="dni" type="hidden" value="<?php echo $dni ?>" />
			<input name="telefono" type="hidden" value="<?php echo $tel_cliente ?>" />
            <input name="email" type="hidden" value="<?php echo $email ?>" />

			<a class="bt bt-eliminar" 
                href="desactivarCliente.php?id_cliente=<?php echo $filas['id_cliente']; ?>" 
                onclick="return confirm('¿Seguro que quieres desactivar a este cliente?');">Desactivar cliente
            </a>
		</form>
      </td>
            <?php 
            } ?>
        </tbody>
    </table>

</main>
<main>
		</form>
<php
mysqli_close($enlace);
?>
</main>
      </table>
	  </div>	 
     </body>
</html>