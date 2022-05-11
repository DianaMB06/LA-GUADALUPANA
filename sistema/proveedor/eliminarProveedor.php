<?php
if(!isset($_GET["id"])) exit();
$id = $_GET["id"];
include_once "../../conexion/base_de_datos.php";
$sentencia = $conexion->prepare("DELETE FROM proveedores WHERE id = ?;");
$resultado = $sentencia->execute([$id]);
if($resultado === TRUE){
	header("Location: ./proveedores.php");
	exit;
}
else echo "Algo salió mal";
?>