<?php
include('conexion.php');

// Obtener clientes inactivos
$clientes = mysqli_query($enlace, "SELECT * FROM cliente WHERE estado=0");
?>

<html>
<head>
<meta charset="utf-8">
<title>Clientes Inactivos - Amarena</title>
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
    <li><a href="mostrarFactura.php">Facturas</a></li>
</ul>
</nav>
</header>

<main class="content">
<h1>Clientes Inactivos</h1>

<table border="1">
<tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Apellido</th>
    <th>Email</th>
    <th>Teléfono</th>
</tr>

<?php
while($c = mysqli_fetch_assoc($clientes)){
    echo "<tr>";
    echo "<td>{$c['id_cliente']}</td>";
    echo "<td>{$c['nombre']}</td>";
    echo "<td>{$c['apellido']}</td>";
    echo "<td>{$c['email']}</td>";
    echo "<td>{$c['telefono']}</td>";
    echo "</tr>";
}
?>
</table>
</main>
</body>
</html>