<?php include_once "../../template/encabezado.php" ?>

<?php
include_once "../../conexion/base_de_datos.php";


$sentencia = $conexion->query("SELECT ganancia.id, ganancia.producto, ganancia.cantidad, ganancia.total, productos.precioCompra, productos.precioVenta FROM productos
INNER JOIN ganancia ON ganancia.id_producto = productos.id GROUP BY ganancia.id ORDER BY ganancia.id;");
$valores = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

<main class="todo">
	<br><br>
	<table>
	<thead>
		<button onclick="location.href='./historial.php';">HISTORIAL</button>
				<tr>
					<th class="idGanancia">Id</th>
					<th class="productoGanancia">Producto</th>
                    <th class="cantidades">Cantidades</th>
                    <th class="recuperacion">Ganancias</th>
                    <th class="totalGanancia">Total</th>
                    <th class="ganancia">Recuperacion</th>
				</tr>
			</thead>
	</table>
	<div class="scroll">
	<table class="table table-bordered">
			<tbody>
				<?php foreach($valores as $valor){

                    $valor->mega = $valor->precioVenta - $valor->precioCompra;
					$valor->yamp = $valor->cantidad * $valor->mega;
					$valor->subtotal = $valor->cantidad * $valor->precioVenta;
                    $valor->ganancia = $valor->subtotal - $valor->total;
                ?>
				<tr>
					<td class="idGanancia"><?php echo $valor->id ?></td>
					<td class="productoGanancia"><?php echo $valor->producto ?></td>
                    <td class="cantidades"><?php echo $valor->cantidad ?> kg</td>
                    <td class="recuperacion">$ <?php echo $valor->yamp ?></td>
                    <td class="totalGanancia">$ <?php echo $valor->total ?></td>
					<?php
					echo"<td class='ganancia'>";
						if($valor->ganancia < 0){
							echo"<input type='button' class='tabla-boton' style='background-color:#e13b3b' value=".'$'.-$valor->ganancia.">";
						}
						if($valor->ganancia > 0){
							echo"<input type='button' class='tabla-boton' style='background-color:#27b23c' value=".'$'.$valor->ganancia.">";
						}
						echo"</td>";
					?>
                    
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>

</main>

<?php include_once "../../template/pie.php" ?>