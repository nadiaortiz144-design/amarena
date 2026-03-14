<?php
include ('conexion.php');
?>
<html>
    <head>
	<title>Agenda</title>
	<meta charset="UTF-8">
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
            </nav>
    
    </header>
		<h1> Proveedores</h1>
	<form action="insertarproveedores.php" method="POST">
              <label>Còdigo:</label><input type="int" name="cod_proveedor" required /> <br><br>
              <label>Nombre:</label><input type="text" name="nom" /> <br><br>
			  <label>Direcciòn:</label><input type="text" name="dic" /> <br><br>
              <label>Telefono:</label>  <input type="text" name="tel" /> <br><br>
			  <?php 
	
    		$q = "SELECT Nombre,nom FROM proveedor ORDER BY Nombre DESC  ";//consulta a la base de datos 
		$rs = mysqli_query($enlace,$q);//retornará un objeto mysqli_result.


 echo "</select>";
		?>		
<br>	
<br>	
  			 <input type="submit" class="bt" value="Agregar" name="agregar" />
        </form>
        
<?php
if((isset($_POST["agregar"]))){
$cod_proveedor=$_POST['cod_proveedor'];
$nom=$_POST['nom'];
$dic=$_POST['dic'];
$tel=$_POST['tel'];

include ('conexion.php');
 $q = "INSERT INTO proveedor VALUES ($cod_proveedor,'$nom','$dic','$tel')"; 
 echo $q;
 $rs = mysqli_query($enlace,$q);//retorna verdadero si realiza la inserción
 if($rs == false) 
{ 
echo '<p>Error al insertar los campos en la tabla.</p>'.mysqli_error($enlace);
 }else{ 
header("Location: mostrarproveedores.php");
 } 
 }
 
?>
<br>
<br>
<div>
 </body>
</html>
