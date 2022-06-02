<?php include_once "../../template/encabezado.php" ?>

<?php
include_once "../../conexion/base_de_datos.php";


$sentencia = $conexion->query("SELECT compras.id,compras.producto,compras.precioCompra,productos.precioVenta,compras.compraTotal FROM compras INNER JOIN productos ON compras.producto = productos.codigo GROUP BY compras.id;");
$valores = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

<main class="todo">
	<br><br>
	<table>
	<thead>
				<tr>
					<th>id</th>
					<th>producto</th>
                    <th>cantidades</th>
                    <th>Ganancias</th>
                    <th>total</th>
                    <th>Recuperacion</th>
				</tr>
			</thead>
	</table>
	<div class="scroll">
	<table class="table table-bordered">
			<tbody>
				<?php foreach($valores as $valor){

                    //$valor->mega = $valor->precioVenta - $valor->precioCompra;
					//$valor->yamp = $valor->cuantos * $valor->mega;
					//$valor->subtotal = $valor->cuantos * $valor->precioVenta;
                    //$valor->ganancia = $valor->subtotal - $valor->totalCompra;
                ?>
				<tr>
					<td class="idGanancia"><?php echo $valor->id ?></td>
					<td class="productoGanancia"><?php echo $valor->producto ?></td>
                    <td class="cantidades"><?php echo $valor->precioCompra ?></td>
                    <td class="recuperacion"><?php echo $valor->precioVenta ?></td>
                    <td class="totalGanancia">$<?php echo $valor->compraTotal ?></td>
					<?php
					//echo"<td class='ganancia'>";
						//if($valor->ganancia < 0){
						//	echo"<input type='button' class='tabla-boton' style='background-color:red' value=".$valor->ganancia.">";
						//}
						//if($valor->ganancia > 0){
							//echo"<input type='button' class='tabla-boton' style='background-color:green' value=".$valor->ganancia.">";
						//}
						//echo"</td>";
					?>
                    
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>

</main>

<?php include_once "../../template/pie.php" ?>