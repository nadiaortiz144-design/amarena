
<?php 
include('conexion.php');
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
<h1> Proveedores </h1>
<form id="form1" name="form1" method="post" action="">
      <a id="button" href="insertarproveedores.php"> Ingresar Datos</a>
	  <a id="button" href="informes/usuario.php"> Imprimir Datos</a> 	  
	  <br><br>
	  <input class="bt" type="submit" name="Aceptar" value="Buscar" title="Buscar Usuarios" />
	  <input type="text" name="buscar" id="buscar" />
 </form>
   <table border=1>
    <tr>
      <th colspan=4 align=center>Proveedores</th>
    </tr>
    <tr>
      <td>Código:</td>
      <td>Nombre:</td>
      <td>Dirección:</td>
      <td>Teléfono:</td>
      <td colspan="2" align="center">ACCIONES</td>
    </tr>
	<?php 
	//realizamos la consulta, atencion con la variable de conexion
		$consulta=mysqli_query($enlace,"select * from proveedor");
	    if (isset($_POST['Aceptar'])){// si presionó el botón buscar
		$busqueda="select * from proveedor where nom_proveedor like '%".$_POST['buscar']."%'";
		$consulta=mysqli_query($enlace,$busqueda);
		}
			
		while($filas=mysqli_fetch_array($consulta)){
			$cod_proveedor=$filas[0];
			$nom_proveedor=$filas[1];
			$dir_proveedor=$filas[2];
			$tel_proveedor=$filas[3];
         ?>
    <tr>
      <td><?php echo $cod_proveedor ?></td>
      <td><?php echo $nom_proveedor ?></td>
      <td><?php echo $dir_proveedor ?></td>
      <td><?php echo $tel_proveedor ?></td>
	  <!-- boton eliminar--> 
      <td bgcolor="#FFFADD" align="center">
		<form action="mostrarproveedores.php" method="Post">
			<input name="codigo" type="hidden" value="<?php echo $cod_proveedor ?>" />
			<input class="bt" name="borrar" type="submit" value="Eliminar" title=" Eliminar los datos"/>
	<?php 
			if(isset($_POST["borrar"])){		
				$cod_proveedor=$_POST["codigo"];  
				echo $cod_proveedor.'hola';
					$q = "Delete from proveedor where cod_proveedor=$cod_proveedor;";
					$rs = mysqli_query($enlace,$q);
			
			if($rs == false){ 
				echo '<p>Error al borrar los campos en la tabla.</p>'.mysqli_error($enlace);
			}else{ 
				header("Location: mostrarproveedores.php");
			} 
		}	
 ?>
		</form>
      </td>
	   <!-- boton modificar--> 
	  <td bgcolor="#FFFADD" align="center">
		<form action="modificarproveedor.php" method="Post" >
			<input name="cod_proveedor" type="hidden" value="<?php echo $cod_proveedor ?>" />
			<input name="nom_proveedor" type="hidden" value="<?php echo $nom_proveedor ?>" />
			<input name="dir_proveedor" type="hidden" value="<?php echo $dir_proveedor ?>" />
			<input name="tel_proveedor" type="hidden" value="<?php echo $tel_proveedor ?>" />
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