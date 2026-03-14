<?php include('conexion.php'); ?>
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
<main class="content">
		<h2>Modificar Cliente</h2>
<form method="POST">
		<label>Nombre:  </label>
		<input type="text" name="nombre" value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : ''; ?>">
		<br>
		<label>Apellido: </label>
		<input type="text" name="apellido" value="<?php echo isset($_POST['apellido']) ? $_POST['apellido'] : ''; ?>">
		<br>
		<label>DNI:   </label>
		<input type="text" name="dni" value="<?php echo isset($_POST['dni']) ? $_POST['dni'] : ''; ?>">
		<br>
		<label>Telefono: </label>
		<input type="text" name="telefono" value="<?php echo isset($_POST['telefono']) ? $_POST['telefono'] : ''; ?>">
		<br>
		<label>Email: </label>
		<input type="text" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
		<br>
		<br>
		<input type="submit" name="grabar" value="Modificar" class="bt">

</form>

</main>

<?php

if(isset($_POST["grabar"])){
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$dni = $_POST['dni'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];

$q = "UPDATE cliente 
SET nombre='$nombre',
apellido='$apellido',
dni='$dni',
telefono='$telefono',
email='$email'
WHERE id_cliente=$id_cliente";

$rs = mysqli_query($enlace,$q);

if(!$rs){

echo "Error: ".mysqli_error($enlace);

}else{

header("Location: mostrarCliente.php");

}

}

?>

</body>
</html>