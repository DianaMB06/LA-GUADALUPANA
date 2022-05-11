<?php

#Salir si alguno de los datos no está presente
if(
	!isset($_POST["codigo"]) ||
	!isset($_POST["precioCompra"]) || 
	!isset($_POST["precioVenta"]) || 
	!isset($_POST["compra"]) || 
	!isset($_POST["deuda"]) || 
	!isset($_POST["existencia"]) || 
	!isset($_POST["id"])
) exit();

#Si todo va bien, se ejecuta esta parte del código...

include_once "../../conexion/base_de_datos.php";
$id = $_POST["id"];
$codigo = $_POST["codigo"];
$precioCompra = $_POST["precioCompra"];
$precioVenta = $_POST["precioVenta"];
$compra = $_POST["compra"];
$deuda = $_POST["deuda"];
$existencia = $_POST["existencia"];

$sentencia = $conexion->prepare("UPDATE productos SET codigo = ?, precioCompra = ?, precioVenta = ?, totalCompra = ?, deuda = ?, existencia = ? WHERE id = ?;");
$resultado = $sentencia->execute([$codigo, $precioCompra, $precioVenta, $compra, $deuda, $existencia, $id]);

if($resultado === TRUE){
	header("Location: ./listar.php");
	exit;
}
else echo "Algo salió mal. Por favor verifica que la tabla exista, así como el ID del producto";
?>