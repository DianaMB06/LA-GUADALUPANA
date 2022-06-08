<?php include_once "../../template/encabezado.php" ?>

<?php
include_once "../../conexion/base_de_datos.php";


$sentencia = $conexion->query("SELECT dia.id, dia.fecha, GROUP_CONCAT(histoG.producto, '..', histoG.cantidad, '..', histoG.ganancia, '..', histoG.total, '..', histoG.recuperacion SEPARATOR '__') AS histo FROM dia INNER JOIN histoG ON histoG.id_dia = dia.id GROUP BY dia.id ORDER BY dia.id;");
$ventas = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

<main class="todo">
	<div>	
		<br>
		<br>
        <button onclick="location.href='./ganancias.php';">Regresar</button>
		<table>
		<thead>
				<tr>
					<th>Fecha</th>
					<th>Productos</th>
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
									<th>Ganancia</th>
                                    <th>Total</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach(explode("__", $venta->histo) as $productosConcatenados){ 
								$producto = explode("..", $productosConcatenados)
								?>
								<tr>
									<td class="tuerca"><?php echo $producto[0] ?></td>
									<td class="tuerco"><?php echo $producto[1]." kg" ?></td>
									<td class="tuercu"><?php echo "$".$producto[2] ?></td>
                                    <td class="tuercu"><?php echo "$".$producto[3] ?></td>
                                    <td>
                                    <?php
                                        echo"<td class='tuercu'>";
                                        if($producto[4] < 0){
                                            echo"<input type='button' class='tabla-boton' style='background-color:#e13b3b' value=".'$'.-$producto[4].">";
                                        }
                                        if($producto[4] > 0){
                                            echo"<input type='button' class='tabla-boton' style='background-color:#27b23c' value=".'$'.$producto[4].">";
                                        }
                                        echo"</td>";
                                    ?>
                                    </td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		</div>
	</div>
	</main>

<?php include_once "../../template/pie.php" ?>