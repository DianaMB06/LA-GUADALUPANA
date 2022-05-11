<?php include_once "../../template/encabezado.php" ?>
<?php
include_once "base_de_datos.php";
$sentencia = $conexion->query("SELECT * FROM ventas");
$ventas = $sentencia->fetchAll(PDO::FETCH_OBJ);
    
    $busqueda ="";
    $fecha_de ="";
    $fecha_a ="";

    if(!empty($_REQUEST['busqueda'])){
        if(!ia_numeric($_REQUEST['busqueda'])){
            header("location: ventas.php");
        }
        $busqueda = strtolower($_REQUEST['busqueda']);
        $where = "Numero = $busqueda";
        $buscar = "busqueda = $busqueda";
    }

    if(!empty($_REQUEST['fecha_de']) && !empty($_REQUEST['fecha_a'])){
        $fecha_de = $_REQUEST['fecha_de'];
        $fecha_a = $_REQUEST['fecha_a'];

        $buscar = "";

        if($fecha_de > $fecha_a){
            header("location: ventas.php");
        }else if($fecha_de == $fecha_a){
            $where = "fecha LINE '$fecha_deN'";
            $buscar = "fecha_de"
        }
    }
?>

	<div class="col-xs-12">
		<h1>Ventas</h1>
		<div>
			<a class="btn btn-success" href="./vender.php">Nueva <i class="fa fa-plus"></i></a>
		</div>
		<br>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Número</th>
					<th>Fecha</th>
					<th>Productos vendidos</th>
					<th>Total</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($ventas as $venta){ ?>
				<tr>
					<td><?php echo $venta->id ?></td>
					<td><?php echo $venta->fecha ?></td>
					<td>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Código</th>
									<th>Descripción</th>
									<th>Cantidad</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach(explode("__", $venta->productos) as $productosConcatenados){ 
								$producto = explode("..", $productosConcatenados)
								?>
								<tr>
									<td><?php echo $producto[0] ?></td>
									<td><?php echo $producto[1] ?></td>
									<td><?php echo $producto[2] ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</td>
					<td><?php echo $venta->total ?></td>
					<td><a class="btn btn-danger" href="<?php echo "eliminarVenta.php?id=" . $venta->id?>"><i class="fa fa-trash"></i></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
<?php include_once "../../template/pie.php" ?>