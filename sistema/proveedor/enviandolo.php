<?php include_once "../../template/encabezado.php" ?>

<?php

if (!isset($_POST["pendiente"])) {
    return;
}
if (!isset($_POST["nombre"])) {
    return;
}
if (!isset($_POST["deuda"])) {
    return;
}

$deuda=(isset($_POST['deuda']))?$_POST['deuda']:"";
$nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
$pendiente=(isset($_POST['pendiente']))?$_POST['pendiente']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";


switch ($accion) {

    case 'Confirmar':
        if(!isset($_POST["pendiente"])) exit();
        $id = $_POST["pendiente"];

        $ahora = date("Y-m-d H:i:s");
        include_once "../../conexion/base_de_datos.php";
        
        $sentencia = $conexion->prepare("SELECT * FROM pendientes WHERE id = ?;");
        $sentencia->execute([$id]);
        $vista=$sentencia->fetch(PDO::FETCH_LAZY);
        $total=$vista["total"];
        $otras=$vista["pendiente"];

        $sentencia = $conexion->prepare("INSERT INTO otras (fecha,total,otras) VALUE (?,?,?)");
        $valor = $sentencia->execute([$ahora, $total, $otras]);

        $sentencia = $conexion->prepare("SELECT * FROM deuda WHERE id_pendiente = ?");
        $sentencia->execute([$id]);
        $pagados=$sentencia->fetchAll(PDO::FETCH_OBJ);

        $sentencia = $conexion->prepare("SELECT id FROM otras ORDER BY id DESC LIMIT 1;");
        $sentencia->execute();
        $negocio = $sentencia->fetch(PDO::FETCH_OBJ);	

        $polo = $negocio === false ? 1 : $negocio->id;

        $conexion->beginTransaction();
        $sentencia = $conexion->prepare("INSERT INTO sabes (id_proveedor, producto, cantidad, subtotal, id_otras) VALUES (?, ?, ?, ?, ?);");
        foreach ($pagados as $pagado) {
	    $sentencia->execute([$pagado->id_proveedor, $pagado->producto, $pagado->cantidad, $pagado->subtotal, $polo]);
        }
        $conexion->commit();

        $sentencia = $conexion->prepare("DELETE FROM pendientes WHERE id = ?;");
        $resultado = $sentencia->execute([$id]);
        if($resultado === TRUE){
	    header("Location: ./productoProveedor.php");

        break;
}
}

?>

    <div class="ventana-proveedor" id="ventana-proveedor">
            <h3 class="termino">Confirmar saldo a pagar</h3>
            <div class="ventana-proveedor__decorativa">
                <br>
                <br>
                <form action="enviandolo.php" method="POST">
                    <input type="hidden" name="pendiente" value="<?php echo $pendiente?>">
                    <br><br>
                    <input type="submit" class="btn btn-info dale" name="accion" value="Confirmar">
                </form>
                <button class="nuevo botones demos" onclick="location.href='./productoProveedor.php';">
		            Cancelar
	            </button>
            </div>
        </div>

        <div class="caja-vista">
			<div class="caja-vista__compras">
				<h2 class="caja-vista__compras-modulo"><?php echo $nombre?> --- </h2>
				<h2 class="caja-vista__compras-modulo">Saldo a Pagar $ <?php echo $deuda?></h2>
			</div>
		</div>

<?php include_once "../../template/pie.php" ?>