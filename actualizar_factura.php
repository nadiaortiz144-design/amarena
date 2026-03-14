<?php
include("conexion.php"); // conexión con $enlace

if (!isset($_POST['id_factura'])) {
    die("No se recibió el ID de la factura");
}

$id = (int)$_POST['id_factura'];
$cliente = mysqli_real_escape_string($enlace, $_POST['cliente']);
$fecha = mysqli_real_escape_string($enlace, $_POST['fecha']);

// Solo incluimos id_empleado si ya agregaste la columna
if (isset($_POST['id_empleado'])) {
    $id_empleado = mysqli_real_escape_string($enlace, $_POST['id_empleado']);
    $sql = "UPDATE factura 
            SET id_cliente='$cliente', fecha='$fecha', id_empleado='$id_empleado'
            WHERE id_factura='$id'";
} else {
    $sql = "UPDATE factura 
            SET id_cliente='$cliente', fecha='$fecha'
            WHERE id_factura='$id'";
}

if (mysqli_query($enlace, $sql)) {
    header("Location: mostrarFactura.php");
    exit();
} else {
    echo "Error al actualizar factura: " . mysqli_error($enlace);
}
?>