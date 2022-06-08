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
				Nuevo
			</button>
			<button class="historial botones" onclick="location.href='./historial.php';">
				Historial de compra
			</button>
		</div>
		<br>
		<table>
		<thead class="flexi">
					<tr>
						<th class="dabi">ID</th>
						<th class="dabo">Código</th>
						<th class="dabu">Precio de compra</th>
						<th class="debo">Precio a vender</th>
						<th class="debi">Existencia</th>
						<th class="debe">Editar</th>
						<th class="debu">Eliminar</th>
					</tr>
				</thead>
		</table>
		<div class="scroll">
			<table class="table table-bordered">
				<tbody class="bajar">
					<?php foreach($productos as $producto){ ?>
					<tr>
						<td class="dabi"><?php echo $producto->id ?></td>
						<td class="dabo"><?php echo $producto->codigo ?></td>
						<td class="dabu">$ <?php echo $producto->precioCompra ?></td>
						<td class="debo">$ <?php echo $producto->precioVenta ?></td>
						<td class="debi"><?php echo $producto->existencia ?> kg</td>
						<td class="debe"><a class="btn btn-warning" href="<?php echo "editar.php?id=" . $producto->id?>"><img class="imajinece" src="../../img/editar.png" alt=""></a></td>
						<td class="debu">
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
