<?php
include_once "../../template/encabezado.php";

if(!isset($_POST["total"])) exit;
if(!isset($_POST["proveedor"])) exit;
if(!isset($_POST["tiene"])) exit;

$accion=(isset($_POST['accion']))?$_POST['accion']:"";
$total = $_POST["total"];
$vermo = $_POST["total"];
$proveedor = $_POST["proveedor"];
$deuda = $_POST["tiene"];
$vapor = $_POST["tiene"];
$sabemos = (float)$deuda - (float)$total;

include_once "../../conexion/base_de_datos.php";

$ahora = date("Y-m-d H:i:s");

switch ($accion) {
	case 'Confirmar':

		if(!isset($_POST["total"])) exit;
		if(!isset($_POST["proveedor"])) exit;
		if(!isset($_POST["tiene"])) exit;

session_start();

		$accion=(isset($_POST['accion']))?$_POST['accion']:"";
		$total = $_POST["total"];
		$vermo = $_POST["total"];
		$proveedor = $_POST["proveedor"];
		$deuda = $_POST["tiene"];
		$vapor = $_POST["tiene"];
		$sabemos = (float)$deuda - (float)$total;
		$sentencia = $conexion->prepare("INSERT INTO pendientes(fecha, total, pendiente) VALUES (?, ?, ?);");
		$sentencia->execute([$ahora, $total ,$sabemos]);

		$sentencia = $conexion->prepare("SELECT id FROM pendientes ORDER BY id DESC LIMIT 1;");
		$sentencia->execute();
		$valorado = $sentencia->fetch(PDO::FETCH_OBJ);

		$idpendiente = $valorado === false ? 1 : $valorado->id;

		$conexion->beginTransaction();
		$sentencia = $conexion->prepare("INSERT INTO deuda(id_proveedor, producto, cantidad, subtotal, id_pendiente) VALUES (?, ?, ?, ?, ?);");
		foreach ($_SESSION["compra"] as $producto) {
			$total += $producto->total;
			$sentencia->execute([$proveedor, $producto->codigo, $producto->cantidad ,$producto->total, $idpendiente]);
		}
		$conexion->commit();

		$sentencia = $conexion->prepare("INSERT INTO historial(fecha, total, pendiente) VALUES (?, ?, ?);");
		$sentencia->execute([$ahora, $vermo ,$vapor]);

		$sentencia = $conexion->prepare("SELECT id FROM historial ORDER BY id DESC LIMIT 1;");
		$sentencia->execute();
		$resultado = $sentencia->fetch(PDO::FETCH_OBJ);	

		$idhistorial = $resultado === false ? 1 : $resultado->id;

		$conexion->beginTransaction();
		$sentenciaExistencia = $conexion->prepare("UPDATE ganancia SET total = ?, cantidad = 0 WHERE id_producto = ?;");
		foreach ($_SESSION["compra"] as $producto) {
			$total += $producto->total;
			$sentenciaExistencia->execute([$producto->total, $producto->id]);
		}
		$conexion->commit();

		$conexion->beginTransaction();
		$sentencia = $conexion->prepare("INSERT INTO compras(id_proveedor, producto, precioCompra, stock, cantidad, compraTotal, id_historial) VALUES (?, ?, ?, ?, ?, ?, ?);");
		$sentenciaExistencia = $conexion->prepare("UPDATE productos SET existencia = existencia + ? WHERE id = ?;");
		foreach ($_SESSION["compra"] as $producto) {
			$total += $producto->total;
			$sentencia->execute([$proveedor, $producto->codigo, $producto->precioCompra, $producto->existencia ,$producto->cantidad ,$producto->total, $idhistorial]);
			$sentenciaExistencia->execute([$producto->cantidad, $producto->id]);
		}
		$conexion->commit();
		unset($_SESSION["compra"]);
		$_SESSION["compra"] = [];
		header("Location: comprar.php");
		break;
	
	default:
		# code...
		break;
}
?>

    <div class="ventana-proveedor" id="ventana-proveedor">
            <h3 class="termino">Confirmar compra</h3>
            <div class="ventana-proveedor__decorativa">
                <br>
                <br>
                <form action="" method="POST">
					<input type="hidden" name="total" value="<?php echo $total?>">
					<input type="hidden" name="proveedor" value="<?php echo $proveedor?>">
					<input type="hidden" name="tiene" value="<?php echo $deuda?>">
                    <input class="duracion" type="submit" name="accion" value="Confirmar">
                </form>
                <form action="comprando.php" method="POST">
					<input type="hidden" name="idProve" value="<?php echo $proveedor?>">
                    <input class="duraciones" type="submit" value="Cancelar">
				</form>
            </div>
        </div>


		<div class="caja-vista">
			<div class="caja-vista__compras">
				<h2 class="caja-vista__compras-modulo">Cobro $ <?php echo $total?> --- </h2>
				<h2 class="caja-vista__compras-modulo">Pagó $ <?php echo $deuda?> --- </h2>
				<?php
				if($sabemos > 0){
					echo"<h2 class='caja-vista__compras-modulo'>Cambio $ ".$sabemos."</h2>";
				}
				if($sabemos < 0){
					echo"<h2 class='caja-vista__compras-modulo'>Saldo pendiente $ ".-$sabemos."</h2>";
				}
				?>
			</div>
		</div>

<?php include_once "../../template/pie.php";?>




