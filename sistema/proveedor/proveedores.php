<?php include_once "../../template/encabezado.php" ?>
<?php
include_once "../../conexion/base_de_datos.php";
$sentencia = $conexion->query("SELECT * FROM proveedores");
$proveedores = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

	<main class="todo">
	<div class="col-xs-12">
		<div class="menudes">
		<button class="nuevo botones" onclick="location.href='./formularioProveedores.php';">
				Nuevo
			</button>
			<button class="historial botones" onclick="location.href='./productoProveedor.php';">
				Saldo a pagar
			</button>
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
					<td class="proveedor"><?php echo $proveedor->nombre ?></td>
					<td class="telefono"><?php echo $proveedor->telefono ?></td>
                    <td class="editar"><a class="btn btn-warning" href="<?php echo "editarProveedor.php?id=" . $proveedor->id?>"><img class="imajinece" src="../../img/editar.png" alt=""></a></td>
					<td class="eliminar">
						<form action="delete.php" method="POST">
							<input type="hidden" name="id" value="<?php echo $proveedor->id?>">
							<input type="image" src="../../img/quitar.png" alt="">
						</form>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>

	</main>
<?php include_once "../../template/pie.php" ?>