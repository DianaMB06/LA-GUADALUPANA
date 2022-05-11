<?php include_once "../../template/encabezado.php" ?>
<?php
include_once "../../conexion/base_de_datos.php";
$sentencia = $conexion->query("SELECT * FROM proveedores");
$proveedores = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

	<div class="col-xs-12">
		<h1>Proveedores</h1>
		<div>
			<a class="btn btn-success" href="./formularioProveedores.php">Nuevo <i class="fa fa-plus"></i></a>
			<a class="btn btn-success" href="./productoProveedor.php">producto-proveedor <i class="fa"></i></a>
		</div>
		
		<br>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Proveedor</th>
					<th>Telefono</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($proveedores as $proveedor){ ?>
				<tr>
					<td><?php echo $proveedor->nombre ?></td>
					<td><?php echo $proveedor->telefono ?></td>
                    <td><a class="btn btn-warning" href="<?php echo "editarProveedor.php?id=" . $proveedor->id?>"><i class="fa fa-edit"></i></a></td>
					<td><a class="btn btn-danger" href="<?php echo "eliminarProveedor.php?id=" . $proveedor->id?>"><i class="fa fa-trash"></i></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
<?php include_once "../../template/pie.php" ?>