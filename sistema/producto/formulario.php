<?php include_once "../../template/encabezado.php" ?>

<?php
include_once "../../conexion/base_de_datos.php";

$sentenciaSQL=$conexion->prepare("SELECT * FROM proveedores");
$sentenciaSQL->execute();
$valores=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="col-xs-12">
	<h1>Nuevo producto</h1>
	<form method="post" action="nuevo.php">
		<label for="codigo">Producto:</label>
		<input class="form-control" name="codigo" required type="text" id="codigo" placeholder="Escribe el código">

		<label for="precioVenta">Precio de venta:</label>
		<input class="form-control" name="precioVenta" required type="number" id="precioVenta" placeholder="Precio de venta">

		<label for="precioCompra">Precio de compra:</label>
		<input class="form-control" name="precioCompra" required type="number" id="precioCompra" placeholder="Precio de compra">

		<label for="compra">Total de compra:</label>
		<input class="form-control" name="compra" required type="number" id="compra" placeholder="total de compra realizada">

		<label for="deuda">Deuda:</label>
		<input class="form-control" name="deuda" required type="number" id="deuda" value="0">

		<label for="existencia">Existencia:</label>
		<input class="form-control" name="existencia" required type="number" id="existencia" placeholder="Cantidad o existencia">
		<br>

		<label for="Proveedor">Proveedor:</label>
		<select class="form-control" name="proveedor" id="proveedor">
			<?php foreach ($valores as $valor) { ?>
			<option value="<?php echo $valor['id'];?>"><?php echo $valor['nombre'];?></option>
			<?php } ?>
		</select>

		<br><br><input class="btn btn-info" type="submit" value="Guardar">
	</form>
</div>
<?php include_once "../../template/pie.php" ?>