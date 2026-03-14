<?php
include('conexion.php'); // tu conexión a MySQL

if(isset($_GET['id_producto'])){
    $id = $_GET['id_producto'];

    // Opción segura: en lugar de borrar, podemos poner estado='inactivo'
    $sql = "UPDATE producto SET estado='inactivo' WHERE id_producto = $id";

    // Si realmente querés borrarlo:
    // $sql = "DELETE FROM producto WHERE id_producto = $id";

    if(mysqli_query($conexion, $sql)){
        echo "Producto eliminado correctamente.";
        header("Location: mostrarProductos.php"); // volver a la lista
        exit();
    } else {
        echo "Error al eliminar producto: " . mysqli_error($conexion);
    }
} else {
    echo "No se recibió el id del producto.";
}
?>