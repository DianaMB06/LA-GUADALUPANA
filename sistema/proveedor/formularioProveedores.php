<?php include_once "../../template/encabezado.php" ?>

<main class="todo">
	<br><br>
<div class="col-xs-12">
	<form method="post" action="nuevoProveedor.php">
		<h2>Nuevo proveedor</h2><br>

		<label for="codigo">Nombre Proveedor</label>
		<input class="form-control" name="nombre" required type="text" id="nombre" placeholder="Escribe el nombre del proveedor"><br><br>

		<label for="descripcion">Telefono</label>
		<input class="form-control" name="telefono" required type="number" max="10000000000" min="1000000000" id="telefono" placeholder="Escribe el numero del proveedor"><br>

		<br><br>
		
		<input class="btn btn-info" type="submit" value="Guardar">
		<button class="btn" onclick="location.href='./proveedores.php';">
		Cancelar
		</button>
		
	</form>
</div>
</main>
<?php include_once "../../template/pie.php" ?>