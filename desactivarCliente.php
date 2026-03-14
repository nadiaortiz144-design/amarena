<?php
include('conexion.php');

if(isset($_GET['id_cliente'])){

$id = $_GET['id_cliente'];

$sql = "UPDATE cliente SET activo=0 WHERE id_cliente='$id'";

$resultado = mysqli_query($enlace,$sql);

if(!$resultado){
echo "Error: ".mysqli_error($enlace);
}else{
header("Location: mostrarCliente.php");
exit();
}

}
?>