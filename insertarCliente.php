<?php 
include('conexion.php');
?>
<html>
<head>
<title> </title>	<link rel="stylesheet" type="text/css" href="estilo.css" media="screen" />
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
       <form action="insertarCliente.php" method="POST">
	   <div id="principal">
<main class="content">
    <h2>Clientes</h2>
       Nombre:    <input type="text" placeholder="nombre*" name="nombre" required /> <br>
       Apellido:  <input type="text" placeholder="apellido*" name="apellido" required/><br>
        DNI:       <input type="text" placeholder="dni*" name="dni" required/><br>
       Direccion:  <input type="text" placeholder="direccion*" name="direccion" required/> <br>
       Telefono:  <input type="text" placeholder="telefono*" name="telefono" required/><br> 
       Email:    <input type="text" placeholder="email*" name="email" required/><br> 
	 <br>
		 <input class="bt" type="submit" value="Agregar" name="agregar" required/>
        </form>
</main>
<?php
include('conexion.php');
if(isset($_POST["agregar"])){
    if(empty($nombre) || empty($apellido) || empty($dni)){
    echo "Complete todos los campos obligatorios";
    exit();
}
if(!is_numeric($dni)){
    echo "El DNI debe ser numérico";
    exit();
}else{
$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$dni=$_POST['dni'];
$direccion=$_POST['direccion'];
$telefono=$_POST['telefono'];
$email=$_POST['email'];
$activo=$_POST['activo'];
 $datos = "INSERT INTO cliente (nombre,apellido,dni,telefono,email,activo) 
VALUES ('$nombre','$apellido','$dni','$telefono','$email',1);";
 $insertar = mysqli_query($enlace,$datos);//retorna verdadero si realiza la inserción
$insertar = mysqli_query($enlace, $sql);
if(!$insertar){
    die("Error al insertar: ".mysqli_error($enlace));
}else{
    // redirige inmediatamente y detiene ejecución
    header("Location: mostrarCliente.php");
    exit();
}
}

}
?>

</div>
 </body>
</html>