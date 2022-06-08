<?php
include_once "../../template/encabezado.php";
if(!isset($_POST["total"])) exit;
if(!isset($_POST["tiene"])) exit;

$accion=(isset($_POST['accion']))?$_POST['accion']:"";
$total = $_POST["total"];
$deuda = $_POST["tiene"];
$sabemos = (float)$deuda - (float)$total;



switch ($accion) {
	case 'Confirmar':

		if(!isset($_POST["total"])) exit;

		session_start();

		$total = $_POST["total"];
		include_once "../../conexion/base_de_datos.php";


		$ahora = date("Y-m-d H:i:s");


		$sentencia = $conexion->prepare("INSERT INTO ventas(fecha, total) VALUES (?, ?);");
		$sentencia->execute([$ahora, $total]);

		$sentencia = $conexion->prepare("SELECT id FROM ventas ORDER BY id DESC LIMIT 1;");
		$sentencia->execute();
		$resultado = $sentencia->fetch(PDO::FETCH_OBJ);	

		$idVenta = $resultado === false ? 1 : $resultado->id;

		$conexion->beginTransaction();
		$sentencia = $conexion->prepare("INSERT INTO productos_vendidos(id_producto, id_venta, cantidad, subtotal) VALUES (?, ?, ?, ?);");
		$sentenciaExistencia = $conexion->prepare("UPDATE productos SET existencia = existencia - ? WHERE id = ?;");
		$sentenciaGanancia = $conexion->prepare("UPDATE ganancia SET cantidad = cantidad + ? WHERE id_producto = ?;");
		foreach ($_SESSION["carrito"] as $producto) {
			$total += $producto->total;
			$sentencia->execute([$producto->id, $idVenta, $producto->cantidad, $producto->total]);
			$sentenciaExistencia->execute([$producto->cantidad, $producto->id]);
			$sentenciaGanancia->execute([$producto->cantidad, $producto->id]);
		}
		$conexion->commit();
		unset($_SESSION["carrito"]);
		$_SESSION["carrito"] = [];
		header("Location: ./vender.php?status=1");
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
					<input type="hidden" name="tiene" value="<?php echo $deuda?>">
                    <input class="duracion" type="submit" name="accion" value="Confirmar">
                </form>
                    <input class="duraciones" onclick="location.href='./vender.php'" type="submit" value="Cancelar">
            </div>
        </div>


		<div class="caja-vista">
			<div class="caja-vista__compras">
				<h2 class="caja-vista__compras-modulo">Cobro $ <?php echo $total?> --- </h2>
				<h2 class="caja-vista__compras-modulo">Pagó $ <?php echo $deuda?> --- </h2>
				<h2 class='caja-vista__compras-modulo'>Cambio $ <?php echo $sabemos?></h2>
			</div>
		</div>

<?php include_once "../../template/pie.php";?>