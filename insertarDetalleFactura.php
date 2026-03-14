<?php
include("conexion.php");

$id_factura = $_POST['id_factura'];
$id_producto = $_POST['producto'];
$cantidad = $_POST['cantidad'];
$precio = $_POST['precio'];

// Verificar stock disponible
$sql_stock = "SELECT stock FROM producto WHERE id_producto=$id_producto";
$resultado = mysqli_query($enlace,$sql_stock);
$fila = mysqli_fetch_assoc($resultado);

if($fila['stock'] < $cantidad){
    echo "No hay suficiente stock disponible";
    exit();
}

// Guardar detalle de factura
$sql_detalle = "INSERT INTO detalle_factura 
(factura_cod_factura, producto_cod_producto, cantidad, precio)
VALUES ('$id_factura','$id_producto','$cantidad','$precio')";

mysqli_query($enlace,$sql_detalle);

// Descontar stock
$sql_actualizar = "UPDATE producto 
SET stock = stock - $cantidad 
WHERE id_producto = $id_producto";

mysqli_query($enlace,$sql_actualizar);

echo "Venta registrada correctamente";
?>