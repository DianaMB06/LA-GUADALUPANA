<?php include_once "../../template/encabezado.php" ?>
<?php

if(!isset($_POST["id"])) exit();

include_once "../../conexion/base_de_datos.php";

$id = $_POST["id"];

$sentencia = $conexion->prepare("SELECT medianoche.id,medianoche.fecha,medianoche.total,medianoche.id_noche,GROUP_CONCAT(productos.codigo, '..',malas.cantidad,'..',malas.subtotal SEPARATOR '__') AS barbara FROM medianoche INNER JOIN malas ON malas.id_medianoche = medianoche.id INNER JOIN productos ON productos.id = malas.id_producto WHERE medianoche.id_noche = ? GROUP BY medianoche.id ORDER BY medianoche.id;");
$sentencia->execute([$id]);
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
								<?php foreach(explode("__", $venta->barbara) as $productosConcatenados){ 
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