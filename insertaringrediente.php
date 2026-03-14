<?php
include('conexion.php');

if(isset($_POST['agregar'])){

    $nom = mysqli_real_escape_string($enlace, $_POST['nom']);
    $cos = (float)$_POST['cos'];
    $des = mysqli_real_escape_string($enlace, $_POST['des']);
    $cant = (int)$_POST['cant'];
    $codp = (int)$_POST['cod_proveedor'];

    // Validaciones
    if(empty($nom) || empty($cos) || empty($des) || empty($cant) || empty($codp)){
        echo "<p>Complete todos los campos obligatorios</p>";
        exit();
    }

    // Insert ingrediente (AUTO_INCREMENT)
    $q = "INSERT INTO ingrediente (nom_ingrediente, costo, descripcion, cantidad) 
          VALUES ('$nom', $cos, '$des', $cant)";
    $rs = mysqli_query($enlace,$q);

    if(!$rs){
        echo "<p>Error al insertar el ingrediente: ".mysqli_error($enlace)."</p>";
    } else {
        // Obtener ID generado
        $id_ingrediente = mysqli_insert_id($enlace);

        // Insert en ingrediente_x_proveedor
        $a = "INSERT INTO ingrediente_x_proveedor (ingrediente_id, proveedor_id) 
              VALUES ($id_ingrediente, $codp)";
        $rsa = mysqli_query($enlace,$a);

        if(!$rsa){
            echo "<p>Error al relacionar proveedor: ".mysqli_error($enlace)."</p>";
        } else {
            header("Location: mostraringredientes.php");
            exit();
        }
    }
}
?>

<html>
<head>
<meta charset="utf-8">
<title>Amarena_System - Ingredientes</title>
<link rel="stylesheet" type="text/css" href="estilo.css" />
</head>
<body>
<header>
    <div class="header-container">
        <h1>Heladería Amarena</h1>
    </div>
    <nav>
        <ul class="menu">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="mostrarProducto.php">Stock de productos</a></li>
    <li><a href="mostrarCliente.php">Clientes Activos</a></li>
    <li><a href="clientesInactivos.php">Clientes Inactivos</a></li>
					<li><a href="mostrarFactura.php">Facturas (Empezar a vender)</a></li>
        </ul>
    </nav>
</header>

<div id="principal">
<h1>Inserte sabor o ingrediente nuevo</h1>
<form action="" method="POST">
    <label>Nombre:</label>
    <input type="text" name="nom" required /><br><br>

    <label>Costo:</label>
    <input type="number" name="cos" step="0.01" required /><br><br>

    <label>Descripción:</label>
    <input type="text" name="des" required /><br><br>

    <label>Cantidad:</label>
    <input type="number" name="cant" required /><br><br>

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
    </select><br><br>

    <input type="submit" class="bt" name="agregar" value="Agregar" />
</form>
</div>
</body>
</html>