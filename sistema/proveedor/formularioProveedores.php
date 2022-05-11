<?php include_once "../../template/encabezado.php" ?>

<div class="col-xs-12">
	<h1>Nuevo proveedor</h1>
	<form method="post" action="nuevoProveedor.php">
		<label for="codigo">Nombre Proveedor</label>
		<input class="form-control" name="nombre" required type="text" id="nombre" placeholder="Escribe el nombre del proveedor">

		<label for="descripcion">Telefono</label>
		<input class="form-control" name="telefono" required type="number" max="10000000000" min="1000000000"id="telefono" placeholder="Escribe el numero del proveedor">

		<br><br><input class="btn btn-info" type="submit" value="Guardar">
	</form>
</div>
<?php include_once "../../template/pie.php" ?>