<?php
#Salir si alguno de los datos no está presente
if(!isset($_POST["nombre"]) || !isset($_POST["telefono"])) exit();

#Si todo va bien, se ejecuta esta parte del código...

include_once "../../conexion/base_de_datos.php";
$nombre = $_POST["nombre"];
$telefono = $_POST["telefono"];

$sentencia = $conexion->prepare("INSERT INTO proveedores(nombre, telefono) VALUES (?, ?);");
$resultado = $sentencia->execute([$nombre, $telefono]);

if($resultado === TRUE){
	header("Location: ./proveedores.php");
	exit;
}
else echo "Algo salió mal. Por favor verifica que la tabla exista";


?>
<?php include_once "../../template/pie.php" ?>