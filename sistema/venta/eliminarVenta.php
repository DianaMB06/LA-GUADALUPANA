<?php
if(!isset($_GET["id"])) exit();
$id = $_GET["id"];
include_once "../../conexion/base_de_datos.php";
$sentencia = $conexion->prepare("DELETE FROM ventas WHERE id = ?;");
$resultado = $sentencia->execute([$id]);
if($resultado === TRUE){
	header("Location: ./ventas.php");
	exit;
}
else echo "Algo salió mal";
?>