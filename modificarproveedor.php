
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
	<label> Código: </label>
	<input type='int' name='cod_proveedor' value="<?php echo $_POST['cod_proveedor'] ?>" /> 
	<br>
	<br>
	<label> Nombre: </label>
	<textarea name='nom_proveedor' rows=2 cols=16><?php echo $_POST['nom_proveedor'] ?> </textarea>
	<br>
	<br>
	<label> Direccion: </label>
	<input type='text' name='dir_proveedor' value="<?php echo $_POST['dir_proveedor'] ?>" />
	<br>
	<br>
	<label> Telefono: </label>
	<input type='text' name='tel_proveedor' value="<?php echo $_POST['tel_proveedor'] ?>"/>
	<br>
	<br>
	<input type='hidden' name='cod_proveedor' value="<?php echo $_POST['cod_proveedor'] ?>" />
	<input type='submit' value='Modificar' name='grabar' class="bt" /> 
	</form>
	 <?php
	 include ('cone.php');
	 if(isset($_POST["grabar"])){
		$cod_pro=$_POST['cod_proveedor'];
		$nom_pro=$_POST['nom_proveedor'];
		$dir_pro=$_POST['dir_proveedor'];
		$tel_pro=$_POST['tel_proveedor'];
 $q = "UPDATE proveedores SET cod_proveedor=$cod_pro,nom_proveedor='$nom_pro',dir_proveedor='$dir_pro',tel_proveedor='$tel_pro' WHERE cod_proveedor=$cod_pro";
 echo $q."<br>";
 $rs = mysqli_query($enlace,$q);//retorna verdadero si realiza la inserción
 if($rs == false) 
{ 
	echo '<p>Error al actualizar los campos en la tabla.</p>'.mysqli_error($enlace);
 }else{ 
	header("Location: mostrarproveedores.php");
 }  
 }
 ?>
 </div>
 </center>
 </font>
</body>
</html>