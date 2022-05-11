<?php include_once "../../template/encabezado.php" ?>

<?php
include_once "../../conexion/base_de_datos.php";


$sentencia = $conexion->query("SELECT productos.id,productos.precioVenta,productos.codigo,productos.totalCompra,sum(cantidad) as cuantos FROM productos INNER JOIN productos_vendidos ON
productos.id = productos_vendidos.id_producto group by productos.id;");
$valores = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

<table class="table table-bordered">
			<thead>
				<tr>
					<th>id</th>
					<th>producto</th>
                    <th>cantidades</th>
                    <th>recuperacion</th>
                    <th>total</th>
                    <th>ganancia</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($valores as $valor){ 
                    $valor->subtotal = $valor->cuantos * $valor->precioVenta;
                    $valor->ganancia = $valor->subtotal - $valor->totalCompra;
                    ?>
				<tr>
					<td><?php echo $valor->id ?></td>
					<td><?php echo $valor->codigo ?></td>
                    <td><?php echo $valor->cuantos ?></td>
                    <td><?php echo $valor->subtotal ?></td>
                    <td>$<?php echo $valor->totalCompra ?></td>
                    <td>$<?php echo $valor->ganancia ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>

<?php include_once "../../template/pie.php" ?>