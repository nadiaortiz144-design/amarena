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
            <li><a href="mostrarProducto.php">Productos</a></li>
    <li><a href="mostrarCliente.php">Clientes Activos</a></li>
    <li><a href="clientesInactivos.php">Clientes Inactivos</a></li>
			<li><a href="DetalleFactura.php">Facturas</a></li>
        </ul>
    </nav>
    
    </header>
		<h1> Empleados</h1>
	<form action="insertarEmpleado.php" method="POST">
              <label>Còdigo:</label><input type="int" name="cod" required /> <br><br>
              <label>Nombre-Apellido:</label><input type="text" name="nomap" /> <br><br>
              <label>Telefono:</label>  <input type="text" name="tel" /> <br><br>
			  <?php 

    		$q = "SELECT Nombre-Apellido,cod FROM empleado ORDER BY Nombre-Apellido DESC  ";//consulta a la base de datos 
		$rs = mysqli_query($enlace,$q);//retornará un objeto mysqli_result.

 echo "</select>";
		?>		
<br>	
<br>	
  			 <input type="submit" class="bt" value="Agregar" name="agregar" />
        </form>
        
<?php
if((isset($_POST["agregar"]))){
$cod=$_POST['cod'];
$nomap=$_POST['nomap'];
$tel=$_POST['tel'];

include ('conexion.php');
 $q = "INSERT INTO empleado VALUES ($cod,'$nomap','$tel')"; 
 echo $q;
 $rs = mysqli_query($enlace,$q);//retorna verdadero si realiza la inserción
 if($rs == false) 
{ 
echo '<p>Error al insertar los campos en la tabla.</p>'.mysqli_error($enlace);
 }else{ 
header("Location: mostrarEmpleado.php");
 } 
 }
 
?>
<br>
<br>
<div>
 </body>
</html>