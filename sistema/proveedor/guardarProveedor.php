<?php

#Salir si alguno de los datos no está presente
if(
	!isset($_POST["nombre"]) ||
	!isset($_POST["telefono"])
) exit();

#Si todo va bien, se ejecuta esta parte del código...

include_once "../../conexion/base_de_datos.php";
$id = $_POST["id"];
$nombre = $_POST["nombre"];
$telefono = $_POST["telefono"];

$sentencia = $conexion->prepare("UPDATE proveedores SET nombre = ?, telefono = ? WHERE id = ?;");
$resultado = $sentencia->execute([$nombre, $telefono, $id]);


if($resultado === TRUE){
	header("Location: proveedores.php");
	exit;
}
else echo "Algo salió mal. Por favor verifica que la tabla exista, así como el ID del producto";
?>