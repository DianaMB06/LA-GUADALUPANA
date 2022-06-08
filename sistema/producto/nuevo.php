<?php
#Salir si alguno de los datos no está presente
if(!isset($_POST["codigo"]) || !isset($_POST["precioVenta"]) || !isset($_POST["precioCompra"]) || !isset($_POST["compra"]) || !isset($_POST["existencia"]) || !isset($_POST["proveedor"])) exit();

#Si todo va bien, se ejecuta esta parte del código...

include_once "../../conexion/base_de_datos.php";
$codigo = $_POST["codigo"];
$precioVenta = $_POST["precioVenta"];
$precioCompra = $_POST["precioCompra"];
$compra = $_POST["compra"];
$existencia = $_POST["existencia"];
$proveedor = $_POST["proveedor"];
$ahora = date("Y-m-d H:i:s");

$sentencia = $conexion->prepare("INSERT INTO productos( codigo, precioVenta, precioCompra, totalCompra, existencia, id_proveedor) VALUES (?, ?, ?, ?, ?, ?);");
$verbo = $sentencia->execute([$codigo, $precioVenta, $precioCompra, $compra, $existencia, $proveedor]);

$sentencia = $conexion->prepare("SELECT id FROM productos ORDER BY id DESC LIMIT 1;");
$sentencia->execute();
$bacante = $sentencia->fetch(PDO::FETCH_OBJ);	

$id = $bacante === false ? 1 : $bacante->id;

$sentencia = $conexion->prepare("INSERT INTO ganancia( producto, cantidad, total, id_producto) VALUES (?, ?, ?, ?);");
$resultado = $sentencia->execute([$codigo, $existencia, $compra, $id]);

if($resultado === TRUE){
	header("Location: ./listar.php");
	exit;
}
else echo "Algo salió mal. Por favor verifica que la tabla exista";


?>
<?php include_once "../../template/pie.php" ?>