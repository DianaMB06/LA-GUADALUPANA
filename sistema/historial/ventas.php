<?php include_once "../../template/encabezado.php" ?>
<?php
include_once "../../conexion/base_de_datos.php";
$sentencia = $conexion->query("SELECT ventas.total, ventas.fecha, ventas.id, GROUP_CONCAT(	productos.codigo, '..', productos_vendidos.cantidad, '..', productos_vendidos.subtotal SEPARATOR '__') AS productos FROM ventas INNER JOIN productos_vendidos ON productos_vendidos.id_venta = ventas.id INNER JOIN productos ON productos.id = productos_vendidos.id_producto GROUP BY ventas.id ORDER BY ventas.id;");
$ventas = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

	<main class="todo">
	<div>	
		<br>
		<br>
		<br>
		<button onclick="location.href='./historial.php';" >HISTORIAL</button>
		<table>
		<thead>
				<tr>
					<th>Fecha</th>
					<th>Productos vendidos</th>
					<th>Total</th>
				</tr>
			</thead>
		</table>
		<div class="scroll">
		<table class="table table-bordered">
			<tbody>
				<?php foreach($ventas as $venta){ ?>
				<tr>
					<td><?php echo $venta->id ?></td>
					<td><?php echo $venta->fecha ?></td>
					<td>
						<table class="table table-bordered sasha">
							<thead>
								<tr>
									<th>Producto</th>
									<th>Cantidad</th>
									<th>subtotal</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach(explode("__", $venta->productos) as $productosConcatenados){ 
								$producto = explode("..", $productosConcatenados)
								?>
								<tr>
									<td class="tuerca"><?php echo $producto[0] ?></td>
									<td class="tuerco"><?php echo $producto[1]." kg" ?></td>
									<td class="tuercu"><?php echo "$".$producto[2] ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</td>
					<td><?php echo "$".$venta->total ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		</div>
	</div>
	</main>
<?php include_once "../../template/pie.php" ?>