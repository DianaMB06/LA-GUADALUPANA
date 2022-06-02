<?php include_once "../../template/encabezado.php" ?>

<?php


if(!isset($_POST["id"])) exit();
$id = $_POST["id"];
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

switch ($accion) {
    case 'Confirmar':
        if(!isset($_POST["id"])) exit();
		$id = $_POST["id"];
		include_once "../../conexion/base_de_datos.php";
		$sentencia = $conexion->prepare("DELETE FROM productos WHERE id = ?;");
		$resultado = $sentencia->execute([$id]);
		if($resultado === TRUE){
		header("Location: ./listar.php");
	exit;
}
else echo "Algo salió mal";
        break;
    
    default:
        # code...
        break;
}

?>


    <div class="ventana-proveedor" id="ventana-proveedor">
            <h3 class="termino">ELIMINAR producto</h3>
            <div class="ventana-proveedor__decorativa">
                <br>
                <br>
                <form action="" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id?>">
                    <input type="submit" class="btn btn-info dale" name="accion" value="Confirmar">
                </form>
                <button class="nuevo botones demos" onclick="location.href='./listar.php';">
		            Cancelar
	            </button>
            </div>
        </div>


<?php include_once "../../template/pie.php" ?>