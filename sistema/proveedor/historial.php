<?php include_once "../../template/encabezado.php" ?>
<?php
include_once "../../conexion/base_de_datos.php";
$sentencia = $conexion->query("SELECT otras.id, otras.fecha, proveedores.nombre, otras.total, otras.otras, GROUP_CONCAT(sabes.producto, '..', sabes.cantidad, '..', sabes.subtotal SEPARATOR '__' ) AS vato FROM otras INNER JOIN sabes ON sabes.id_otras = otras.id INNER JOIN proveedores ON proveedores.id = sabes.id_proveedor GROUP BY otras.id ORDER BY otras.id;");
$ventas = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

<?php
include_once "../../conexion/base_de_datos.php";

$sentenciaSQL=$conexion->prepare("SELECT * FROM proveedores");
$sentenciaSQL->execute();
$valores=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

	<main class="todo">
	<div>
		<br>
		<br>
		<!--<form class="acomodalo" action="" method="GET">
		<select required name="proveedor" id="proveedor">
			<option value="">Proveedor</option>
			<?php foreach ($valores as $valor) { ?>
			<option value="<?php echo $valor['id'];?>"><?php echo $valor['nombre'];?></option>
			<?php } ?>
		</select>
			<input type="submit" name="enviar" value="buscar">
	</form>-->
	<button class="regre" onclick="location.href='./productoProveedor.php';">Regresar</button>
	<button class="actu" onclick="location.href='./productoProveedor.php';">Actualizar</button>

	<?php
    //llamando a la conexion para el envio de datos
    include "../../conexion/prov.php";
    
    //uso de la condicion if, preduntando con ISSET si el envio de datos $_GET tiene un valor, y si tiene un valor entra en la condicion
    if(isset($_GET['enviar'])){
        //el valor $_GET se guarda en la variable $BUSQUEDA
        $proveedor = $_GET['proveedor'];
        
        //llamando a el comando SELECT para imprimir la busqueda que se guardo en $BUSQUEDA
        $consulta = $con->query("SELECT proveedores.nombre, GROUP_CONCAT(productos.codigo, '..', productos.deuda SEPARATOR '__') AS productos FROM proveedores INNER JOIN productos ON proveedores.id=productos.id_proveedor WHERE productos.deuda > 0 AND proveedores.id LIKE '%$proveedor%' GROUP BY proveedores.nombre ORDER BY proveedores.nombre");

        //uso de la condicion while, guardando nuestra consulta en $row para su impresion de los datos, imprimiendolos con fetch_array() para imprimirlos ordenada
			
			echo "<div class='tabla'>";
			echo"<table>";
			echo"<thead>";
					echo"<tr>";
						echo"<th>Proveedor</th>";
						echo"<th>Productos</th>";
					echo"</tr>";
				echo"</thead>";
			echo"</table>";
			echo"<div class='scroll'>";
			echo"<table class='table table-bordered'>";
				echo"<tbody>";
				while ($row = $consulta->fetch_array()){
					echo"<tr>";
						echo"<td>".$row['nombre']."</td>";
						echo"<td>";
							echo"<table class='table table-bordered'>";
							echo"<thead>";
									echo"<tr>";
										echo"<th>Producto</th>";
										echo"<th>Deuda</th>";
										echo"<th>pagar</th>";
									echo"</tr>";
							echo"</thead>";
								echo"<tbody>";
									foreach(explode("__", $row['productos']) as $productosConcatenados){ $producto = explode("..", $productosConcatenados);
									echo"<tr>";
										echo"<td>".$producto[0]."</td>";
										echo"<td>".$producto[1]."</td>";
										echo"<td><button>like</button></td>";
									echo"</tr>";
									}
								echo"</tbody>";
							echo"</table>";
						echo"</td>";
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
		<table>
		<thead>
				<tr>
					<th>Fecha</th>
					<th>Proveedor</th>
					<th>Productos</th>
					<th>Total</th>
					<th>Pagado</th>
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
									<th>P/kilo</th>
                                    <th>Subtotal</th>
								</tr>
						</thead>
							<tbody>
								<?php foreach(explode("__", $venta->vato) as $productosConcatenados){ 
								$producto = explode("..", $productosConcatenados)
								?>
								<tr>
									<td><?php echo $producto[0] ?></td>
                                    <td><?php echo $producto[1] ?> kg</td>
									<td>$ <?php echo $producto[2] ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</td>
					<td>$ <?php echo $venta->total ?></td>
					<td>$ <?php echo -$venta->otras ?></td>
					<td>
						<button class="tabla-boton" style="background-color:green">
                            PAGADO
                        </button>
					</td>
				</tr>
					<?php } ?>
			</tbody>
		</table>
		</div>
	</div>
	</main>
<?php include_once "../../template/pie.php" ?>