<?php include_once "../../template/encabezado.php" ?>
<?php
include_once "../../conexion/base_de_datos.php";
$sentencia = $conexion->query("SELECT * FROM productos;");
$productos = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

	<main class="todo">
	<div>
		<div class="menudes">
			<button class="compra botones" onclick="location.href='./comprar.php';">
				Comprar
			</button>
			<button class="nuevo botones" onclick="location.href='./formulario.php';">
				nuevo
			</button>
			<button class="historial botones" onclick="location.href='./historial.php';">
				historial de compra
			</button>
		</div>
		<br>
		<table>
		<thead class="flexi">
					<tr>
						<th>ID</th>
						<th>Código</th>
						<th>Precio de compra</th>
						<th>Precio a vender</th>
						<th>Existencia</th>
						<th>Editar</th>
						<th>Eliminar</th>
					</tr>
				</thead>
		</table>
		<div class="scroll">
			<table class="table table-bordered">
				<tbody class="bajar">
					<?php foreach($productos as $producto){ ?>
					<tr>
						<td><?php echo $producto->id ?></td>
						<td><?php echo $producto->codigo ?></td>
						<td>$<?php echo $producto->precioCompra ?></td>
						<td>$<?php echo $producto->precioVenta ?></td>
						<td><?php echo $producto->existencia."kg" ?></td>
						<td><a class="btn btn-warning" href="<?php echo "editar.php?id=" . $producto->id?>"><img class="imajinece" src="../../img/editar.png" alt=""></a></td>
						<td>
							<form action="eliminar.php" method="POST">
								<input type="hidden" name="id" value="<?php echo $producto->id?>">
								<input type="image" src="../../img/quitar.png" alt="">
							</form>
					</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>

	</main>
<?php include_once "../../template/pie.php" ?>
