<?php
#Salir si alguno de los datos no está presente
if(!isset($_POST["codigo"]) || !isset($_POST["precioVenta"]) || !isset($_POST["precioCompra"]) || !isset($_POST["compra"]) || !isset($_POST["deuda"]) || !isset($_POST["existencia"]) || !isset($_POST["proveedor"])) exit();

#Si todo va bien, se ejecuta esta parte del código...

include_once "../../conexion/base_de_datos.php";
$codigo = $_POST["codigo"];
$precioVenta = $_POST["precioVenta"];
$precioCompra = $_POST["precioCompra"];
$compra = $_POST["compra"];
$deuda = $_POST["deuda"];
$existencia = $_POST["existencia"];
$proveedor = $_POST["proveedor"];

$sentencia = $conexion->prepare("INSERT INTO productos(codigo, precioVenta, precioCompra, totalCompra, deuda, existencia, id_proveedor) VALUES (?, ?, ?, ?, ?, ?, ?);");
$resultado = $sentencia->execute([$codigo, $precioVenta, $precioCompra, $compra, $deuda, $existencia, $proveedor]);

if($resultado === TRUE){
	header("Location: ./listar.php");
	exit;
}
else echo "Algo salió mal. Por favor verifica que la tabla exista";


?>
<?php include_once "../../template/pie.php" ?>