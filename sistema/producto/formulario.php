<?php include_once "../../template/encabezado.php" ?>

<?php

include_once "../../conexion/base_de_datos.php";

$sentenciaSQL=$conexion->prepare("SELECT * FROM proveedores");
$sentenciaSQL->execute();
$valores=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>


<main class="todo">
	<br><br>

<div>
	<form method="post" action="nuevo.php">
		<h2>Nuevo producto</h2><br>
		<label for="codigo">Producto:</label><br>
		<input class="form-control" name="codigo" required type="text" id="codigo" placeholder="Escribe el producto"><br><br>

		<input class="form-control" name="compra" required type="hidden" id="compra" value="0">

		<input class="form-control" name="existencia" required type="hidden" id="existencia" value="0">

		<label for="precioCompra">Precio de compra por kilo:</label><br>
		<input class="form-control" name="precioCompra" required type="number" id="precioCompra" placeholder="Precio de compra" step="0.001"><br><br>

		<label for="precioVenta">Precio a vender por kilo:</label><br>
		<input class="form-control" name="precioVenta" required type="number" id="precioVenta" placeholder="Precio de venta" step="0.001"><br><br>

		<label for="Proveedor">Proveedor:</label><br>
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