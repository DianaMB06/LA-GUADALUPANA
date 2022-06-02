<?php include_once "../../template/encabezado.php" ?>

<?php

if (!isset($_POST["pendiente"])) {
    return;
}

$pendiente=(isset($_POST['pendiente']))?$_POST['pendiente']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

include_once "../../conexion/base_de_datos.php";

$ahora = date("Y-m-d H:i:s");

switch ($accion) {

    case 'Confirmar':
        if(!isset($_POST["pendiente"])) exit();
        $id = $_POST["pendiente"];
        include_once "../../conexion/base_de_datos.php";
        $sentencia = $conexion->prepare("DELETE FROM pendientes WHERE id = ?;");
        $resultado = $sentencia->execute([$id]);
        if($resultado === TRUE){
	    header("Location: ./productoProveedor.php");

        break;

    //case 'nomo':

        //$sentencia = $conexion->prepare("INSERT INTO otras(fecha,total,otras) VALUE (?,?,?) ");
        //$sentencia->execute([$ahora, $teniente->total, $teniente->pendiente]);

        //$conexion->beginTransaction();
        //$sentencia = $conexion->prepare("INSERT INTO deuda(id_proveedor, producto, cantidad, subtotal, id_pendiente) VALUES (?, ?, ?, ?, ?);");
        //foreach ($teniente as $producto) {
	    //$total += $producto->total;
	    //$sentencia->execute([$proveedor, $producto->codigo, $producto->cantidad ,$producto->total, $idpendiente]);
        }
        //$conexion->commit();

        //$sentencia = $conexion->prepare("SELECT * FROM pendientes WHERE id=?");
        //$sentencia->execute([$valores]);
        //$teniente = $sentencia->fetch(PDO::FETCH_OBJ);

        //$sentencia = $conexion->prepare("DELETE FROM pendientes WHERE id=? ");
        //$sentencia->execute([$valores]);

        //header("Location: ./productoProveedor.php");
        //break;
    default:
        break;
}

?>

    <div class="ventana-proveedor" id="ventana-proveedor">
            <h3 class="termino">Comfirmar saldo a pagar</h3>
            <div class="ventana-proveedor__decorativa">
                <br>
                <br>
                <form action="enviandolo.php" method="POST">
                    <input type="text" name="pendiente" value="<?php echo $pendiente?>">
                    <br><br>
                    <input type="submit" class="btn btn-info dale" name="accion" value="Confirmar">
                </form>
                <button class="nuevo botones demos" onclick="location.href='./productoProveedor.php';">
		            Cancelar
	            </button>
            </div>
        </div>
<?php include_once "../../template/pie.php" ?>