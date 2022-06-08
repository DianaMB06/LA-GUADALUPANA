<?php
if(!isset($_GET["id"])) exit();
$id = $_GET["id"];
include_once "../../conexion/base_de_datos.php";
$sentencia = $conexion->prepare("SELECT * FROM proveedores WHERE id = ?;");
$sentencia->execute([$id]);
$producto = $sentencia->fetch(PDO::FETCH_OBJ);
if($producto === FALSE){
	echo "¡No existe algún producto con ese ID!";
	exit();
}

?>

<?php include_once "../../template/encabezado.php" ?>
	<main class="todo">
		<br><br>
	<div class="col-xs-12">
		
		<form method="post" action="guardarProveedor.php">
		<h2>Editar proveedor <?php echo $producto->id; ?></h2>
		<br>
			<input type="hidden" name="id" value="<?php echo $producto->id; ?>">
	
			<label for="codigo">Proveedor:</label>
			<input value="<?php echo $producto->nombre ?>" class="form-control" name="nombre" required type="text" id="nombre" placeholder="Escribe el código"><br><br>

			<label for="precioVenta">Telefono:</label>
			<input max="10000000000" min="1000000000" value="<?php echo $producto->telefono ?>" class="form-control" name="telefono" required type="number" id="telefono" placeholder="Precio de venta">

			<br><br><input class="btn btn-info" type="submit" value="Guardar">
			<button class="btn" onclick="location.href='./proveedores.php';">
				Cancelar
			</button>
		</form>
	</div>
	</main>
<?php include_once "../../template/pie.php" ?>
