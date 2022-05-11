<?php include_once "../../template/encabezado.php" ?>
<?php
include_once "../../conexion/base_de_datos.php";
$sentencia = $conexion->query("SELECT proveedores.nombre, GROUP_CONCAT(productos.codigo, '..', productos.deuda SEPARATOR '__') AS productos FROM proveedores INNER JOIN productos ON proveedores.id=productos.id_proveedor GROUP BY proveedores.nombre ORDER BY proveedores.nombre;");
$ventas = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

	<div class="col-xs-12">
		<h1>producto-proveedor</h1>
		<br>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Proveedor</th>
					<th>Productos</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($ventas as $venta){ ?>
				<tr>
					<td><?php echo $venta->nombre ?></td>
					<td>
						<table class="table table-bordered">
                        <thead>
								<tr>
									<th>Producto</th>
									<th>Deuda</th>
                                    <th>pagar</th>
								</tr>
						</thead>
							<tbody>
								<?php foreach(explode("__", $venta->productos) as $productosConcatenados){ 
								$producto = explode("..", $productosConcatenados)
								?>
								<tr>
									<td><?php echo $producto[0] ?></td>
                                    <td><?php echo $producto[1] ?></td>
                                    <td><button>like</button></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</td>
					<td><a class="btn btn-danger" href="<?php echo "eliminarVenta.php?id=" . $venta->id?>"><i class="fa fa-trash"></i></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
<?php include_once "../../template/pie.php" ?>