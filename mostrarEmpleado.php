<?php
 include ('conexion.php');//incluimos la conexion
 ?>
<html>
<head>
<meta charset="utf-8">
<title>Amarena_System</title>
		<link rel="stylesheet" type="text/css" href="estilo.css" media="screen" />
	</head>
<body></body>
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
<h1> Empleados: </h1>
<form id="form1" name="form1" method="post" action="">
      <a id="button" href="insertarEmpleado.php"> Ingresar Datos</a>
	  <a id="button" href="informes/usuario.php"> Imprimir Datos</a> 	  
	  <br><br>
	  <input class="bt" type="submit" name="Aceptar" value="Buscar" title="Buscar Usuarios" />
	  <input type="text" name="buscar" id="buscar" />
 </form>
   <table border=1>
    <tr>
      <th colspan=3 align=center>Empleados</th>
    </tr>
    <tr>
      <td>Codigo</td>
      <td>Nombre</td>
      <td>Telefono</td>
      <td colspan="2" align="center">ACCIONES</td>
    </tr>
	<?php 
	//realizamos la consulta, atencion con la variable de conexion
		$consulta=mysqli_query($enlace,"select * from empleado");
	    if (isset($_POST['Aceptar'])){// si presionó el botón buscar
		$busqueda="select * from empleado where cod_empleado like '%".$_POST['buscar']."%'";
		$consulta=mysqli_query($enlace,$busqueda);
		}
			
		while($filas=mysqli_fetch_array($consulta)){
			$cod_empleado=$filas[0];
			$nom_empleado=$filas[1];
			$tel_empleado=$filas[2];
         ?>
    <tr>
      <td bgcolor=""><?php echo $cod_empleado ?></td>
      <td><?php echo $nom_empleado ?></td>
      <td><?php echo $tel_empleado ?></td>
	  <!-- boton eliminar--> 
      <td bgcolor="" align="center">
		<form action="mostrarEmpleado.php" method="Post">
			<input name="codigo" type="hidden" value="<?php echo $cod_empleado ?>" />
			<input class="bt" name="borrar" type="submit" value="Eliminar" title=" Eliminar los datos"/>
	<?php 
			if(isset($_POST["borrar"])){		
				$cod_p=$_POST["codigo"];  
				echo $cod_empleado.'hola';
					$q = "Delete from empleado where cod_empleado=$cod_empleado;";
					$rs = mysqli_query($enlace,$q);
			
			if($rs == false){ 
				echo '<p>Error al borrar los campos en la tabla.</p>'.mysqli_error($enlace);
			}else{ 
				header("Location: mostrarEmpleado.php");
			} 
		}	
 ?>
		</form>
      </td>
	   <!-- boton modificar--> 
	  <td bgcolor="#FFFADD" align="center">
		<form action="modificarEmpleado.php" method="Post" >
			<input name="cod_empleado" type="hidden" value="<?php echo $cod_empleado ?>" />
			<input name="nom_empleado" type="hidden" value="<?php echo $nom_empleado ?>" />
			<input name="tel_empleado" type="hidden" value="<?php echo $tel_empleado ?>" />
			<input class="bt" name="mod" type="submit" value="Modificar" title=" Modificar los datos"/>
		</form>
      </td>
    </tr>
         <?php }
	  mysqli_close($enlace);//cerramos la conexion
	  ?>
      </table>
	  </div>
	 </center>
</font>	 
      </body>
	  
</html>