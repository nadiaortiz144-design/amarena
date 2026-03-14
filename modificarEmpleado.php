<html>
    <head>
	<meta charset="utf-8">
<title>Amarena System</title>
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
	<h1> Empleado</h1>
	<br>
	<br>
	<label> Codigo: </label>
	<input type='int' name='cod_empleado' value="<?php echo $_POST['cod_empleado'] ?>" /> 
	<br>
	<br>
	<label> Nombre-Apellido : </label>
	<textarea name='nom_empleado' rows=2 cols=16><?php echo $_POST['nom_empleado'] ?> </textarea>
	<br>
	<br>
	<label> Telefono:   </label>
	<input type='text' name='tel_empleado' value="<?php echo $_POST['tel_empleado'] ?>" />
	<br>
	<br>
	<input type='hidden' name='cod_empleado' value="<?php echo $_POST['cod_empleado'] ?>" />
	<input type='submit' value='Modificar' name='grabar' class="bt" /> 
	</form>
	 <?php
	 include ('conexion.php');
	 if(isset($_POST["grabar"])){
		$cod_emple=$_POST['cod_empleado'];
		$nom_emple=$_POST['nom_empleado'];
		$tel_emple=$_POST['tel_empleado'];
 $q = "UPDATE empleado SET cod_empleado=$cod_emple,nom_empleado='$nom_emple',tel_empleado='$tel_emple' WHERE cod_empleado=$cod_emple";
 echo $q."<br>";
 $rs = mysqli_query($enlace,$q);//retorna verdadero si realiza la inserción
 if($rs == false) 
{ 
	echo '<p>Error al actualizar los campos en la tabla.</p>'.mysqli_error($enlace);
 }else{ 
	header("Location: mostrarEmpleado.php");
 }  
 }
 ?>
 </div>
 </center>
 </font>
</body>
</html>