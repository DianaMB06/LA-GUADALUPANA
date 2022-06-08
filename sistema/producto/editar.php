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
	<main class="todo">
	<div class="col-xs-12">
		<br><br>
		<form method="post" action="guardarDatosEditados.php">
			<input type="hidden" name="id" value="<?php echo $producto->id; ?>">

			<h2>Editar Producto</h2><br>
	
			<label for="codigo">Producto:</label>
			<input value="<?php echo $producto->codigo ?>" class="form-control" name="codigo" required type="text" id="codigo" placeholder="Escribe el código"><br><br>

			<input value="<?php echo $producto->totalCompra ?>" name="compra" type="hidden" id="compra">

			<input value="<?php echo $producto->existencia ?>" name="existencia" type="hidden" id="existencia">

			<label for="precioCompra">Precio de compra por kilo:</label>
			<input value="<?php echo $producto->precioCompra ?>" class="form-control" name="precioCompra" required type="number" id="precioCompra" placeholder="Precio de compra"><br><br>

			<label for="precioVenta">Precio a vender por kilo:</label>
			<input value="<?php echo $producto->precioVenta ?>" class="form-control" name="precioVenta" required type="number" id="precioVenta" placeholder="Precio de venta"><br><br>

			<label for="Proveedor">Proveedor:</label>
			<select class="form-control" required name="proveedor" id="proveedor">
			<option value="">Elegir</option>
			<?php foreach ($valores as $valor) { ?>
			<option value="<?php echo $valor['id'];?>"><?php echo $valor['nombre'];?></option>
			<?php } ?>
			</select>

			<br><br>
			
			<input class="btn btn-info" type="submit" value="Guardar">
			<button class="btn" onclick="location.href='./listar.php';">
				Cancelar
			</button>
		</form>
	</div>
	</main>
<?php include_once "../../template/pie.php" ?>
