<?php
if(!isset($_GET["id"])) exit();
$id = $_GET["id"];
include_once "../../conexion/base_de_datos.php";
$sentencia = $conexion->prepare("SELECT * FROM productos WHERE id = ?;");
$sentencia->execute([$id]);
$producto = $sentencia->fetch(PDO::FETCH_OBJ);
if($producto === FALSE){
	echo "¡No existe algún producto con ese ID!";
	exit();
}

?>

<?php
include_once "../../conexion/base_de_datos.php";

$sentenciaSQL=$conexion->prepare("SELECT * FROM proveedores");
$sentenciaSQL->execute();
$valores=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include_once "../../template/encabezado.php" ?>
	<div class="col-xs-12">
		<h1>Editar producto con el ID <?php echo $producto->id; ?></h1>
		<form method="post" action="guardarDatosEditados.php">
			<input type="hidden" name="id" value="<?php echo $producto->id; ?>">
	
			<label for="codigo">producto:</label>
			<input value="<?php echo $producto->codigo ?>" class="form-control" name="codigo" required type="text" id="codigo" placeholder="Escribe el código">

			<label for="precioVenta">Precio de venta:</label>
			<input value="<?php echo $producto->precioVenta ?>" class="form-control" name="precioVenta" required type="number" id="precioVenta" placeholder="Precio de venta">

			<label for="precioCompra">Precio de compra:</label>
			<input value="<?php echo $producto->precioCompra ?>" class="form-control" name="precioCompra" required type="number" id="precioCompra" placeholder="Precio de compra">

			<label for="compra">Total de compra:</label>
			<input value="<?php echo $producto->totalCompra ?>" class="form-control" name="compra" required type="number" id="compra" placeholder="total de compra realizada">

			<label for="deuda">Deuda:</label>
			<input value="<?php echo $producto->deuda ?>" class="form-control" name="deuda" required type="number" id="deuda">

			<label for="existencia">Existencia:</label>
			<input value="<?php echo $producto->existencia ?>" class="form-control" name="existencia" required type="number" id="existencia" placeholder="Cantidad o existencia">

			<label for="Proveedor">Proveedor:</label>
			<select class="form-control" name="proveedor" id="proveedor">
			<?php foreach ($valores as $valor) { ?>
			<option value="<?php echo $valor['id'];?>"><?php echo $valor['nombre'];?></option>
			<?php } ?>
			</select>

			<br><br><input class="btn btn-info" type="submit" value="Guardar">
			<a class="btn btn-warning" href="./listar.php">Cancelar</a>
		</form>
	</div>
<?php include_once "../../template/pie.php" ?>
