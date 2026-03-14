<?php 
include('conexion.php');

if(isset($_POST["agregar"])){

    $nom_pr = mysqli_real_escape_string($enlace, $_POST['nom_p']);
    $descrip_pr = mysqli_real_escape_string($enlace, $_POST['descrip_p']);
    $costoo = (float)$_POST['costo'];
    $fechaa = $_POST['fecha'];
    $tama = mysqli_real_escape_string($enlace, $_POST['tam']);
    $canti = (int)$_POST['cant'];
    $codp = (int)$_POST['cod_proveedor'];

    // Validación
    if($nom_pr=="" || $descrip_pr=="" || $fechaa=="" || $tama=="" || $canti=="" || $codp==""){
        echo "<p>Complete todos los campos obligatorios</p>";
        exit();
    }

    // Insertar producto
    $q = "INSERT INTO producto 
    (nom_producto, descrip_producto, costo_producto, fecha_entrega, tam_producto, cant_producto) 
    VALUES 
    ('$nom_pr', '$descrip_pr', $costoo, '$fechaa', '$tama', $canti)";

    $rs = mysqli_query($enlace, $q);

    if(!$rs){
        echo "<p>Error al insertar el producto: ".mysqli_error($enlace)."</p>";
    } 
    else{

        // Obtener ID del producto
        $id_producto = mysqli_insert_id($enlace);

        // Relacionar producto con proveedor
        $a = "INSERT INTO producto_x_proveedor (producto_id, proveedor_id) 
              VALUES ($id_producto, $codp)";

        $rsa = mysqli_query($enlace, $a);

        if(!$rsa){
            echo "<p>Error al relacionar proveedor: ".mysqli_error($enlace)."</p>";
        }
        else{
            header("Location: mostrarProducto.php");
            exit();
        }
    }
}
?>

<html>
<head>
<meta charset="utf-8">
<title>Amarena System - Productos</title>
<link rel="stylesheet" href="estilo.css">
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


<main class="content">

<h1>Agregar Producto Nuevo</h1>

<section class="productos">

<form action="" method="POST">

<label>Nombre:</label>
<input type="text" name="nom_p" required><br><br>
<label>Descripción:</label>
<input type="text" name="descrip_p" required><br><br>
<label>Costo:</label>
<input type="number" name="costo" step="0.01" required><br><br>
<label>Fecha de Entrega:</label>
<input type="date" name="fecha" required><br><br>
<label>Tamaño:</label>
<input type="text" name="tam" required><br><br>
<label>Cantidad:</label>
<input type="number" name="cant" required><br><br>
<label>Proveedor:</label>
<select name="cod_proveedor" required>
<option value="">Seleccione proveedor</option>
<?php 
$q = "SELECT id_proveedor, nombre FROM proveedor";
$rs = mysqli_query($enlace, $q);
while($fila = mysqli_fetch_assoc($rs)){
echo "<option value='".$fila['id_proveedor']."'>".$fila['nombre']."</option>";
}

?>

</select>

<br><br>
<input type="submit" class="bt" name="agregar" value="Agregar">

</form>

</section>

</main>

</body>
</html>