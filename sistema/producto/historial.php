<?php include_once "../../template/encabezado.php" ?>
<?php
include_once "../../conexion/base_de_datos.php";
$sentencia = $conexion->query("SELECT historial.id,historial.fecha,historial.total,proveedores.nombre, GROUP_CONCAT(compras.producto, '..' , compras.precioCompra, '..', compras.stock, '..' , compras.cantidad, '..' ,compras.compraTotal SEPARATOR '__') as compras FROM historial INNER JOIN compras ON compras.id_historial = historial.id INNER JOIN proveedores ON proveedores.id = compras.id_proveedor GROUP BY historial.id ORDER BY historial.id;");
$ventas = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

	<main class="todo">
	<br>
	<br>
	<!--<form class="acomodalo" action="" method="GET">
		<input type="date" name="fecha" id="fecha">
		<input type="submit" name="enviar" value="buscar">
	</form>-->
	<button class="regre" onclick="location.href='./listar.php';">Regresar</button>
	<button class="actu" onclick="location.href='./historial.php';">Actualizar</button>

	<?php
    //llamando a la conexion para el envio de datos
    include "../../conexion/prov.php";
    
    //uso de la condicion if, preduntando con ISSET si el envio de datos $_GET tiene un valor, y si tiene un valor entra en la condicion
    if(isset($_GET['enviar'])){
        //el valor $_GET se guarda en la variable $BUSQUEDA
        $fecha = $_GET['fecha'];
        
        //llamando a el comando SELECT para imprimir la busqueda que se guardo en $BUSQUEDA
        $consulta = $con->query("SELECT historial.id,historial.fecha,productos.codigo,productos.totalCompra FROM productos INNER JOIN historial ON productos.id = historial.id_producto WHERE fecha LIKE '%$fecha%'");

        //uso de la condicion while, guardando nuestra consulta en $row para su impresion de los datos, imprimiendolos con fetch_array() para imprimirlos ordenada
			
			echo "<div class='tabla'>";
				echo"<table>";
					echo"<thead>";
						echo"<tr>";
							echo"<th>id</th>";
							echo"<th>Fecha</th>";
							echo"<th>Productos</th>";
							echo"<th>Total</th>";
						echo"</tr>";
					echo"</thead>";
				echo"</table>";
				echo"<div class='scroll'>";
				echo"<table class='table table-bordered'>";
					echo"<tbody>";
					while ($row = $consulta->fetch_array()){
						echo"<tr>";
							echo"<td>".$row['id']."</td>";
							echo"<td>".$row['fecha']."</td>";
							echo"<td>".$row['codigo']."</td>";
							echo"<td>".$row['totalCompra']."</td>";
						echo"</tr>";
						}
					echo"</tbody>";
				echo"</table>";
				echo"</div>";
			echo"</div>";
			
        //fin de la condicion while

    }
    //fin de la condicion if

    ?>
    <!--fin de php-->

	<div>
	<table>
		<thead>
				<tr>
					<th>Fecha</th>
					<th>Proveedor</th>
					<th>Productos Comprados</th>
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
					<td><?php echo $venta->nombre ?></td>
					<td>
						<table class="table table-bordered sasha">
							<thead>
								<tr>
									<th>Producto</th>
									<th>Precio</th>
									<th>Stock</th>
									<th>C/comprada</th>
									<th>Subtotal</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach(explode("__", $venta->compras) as $productosConcatenados){ 
								$producto = explode("..", $productosConcatenados)
								?>
								<tr>
									<td class="verbo"><?php echo $producto[0] ?></td>
									<td class="verba">$ <?php echo $producto[1] ?></td>
									<td class="verbi"><?php echo $producto[2] ?> kg</td>
									<td class="verbe"><?php echo $producto[3] ?> kg</td>
									<td class="verbu">$ <?php echo $producto[4] ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</td>
					<td>$ <?php echo $venta->total ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		</div>
	</div>
	</main>
<?php include_once "../../template/pie.php" ?>