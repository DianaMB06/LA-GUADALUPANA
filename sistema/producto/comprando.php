<?php
session_start();
include_once "../../template/encabezado.php";
if(!isset($_SESSION["compra"])) $_SESSION["compra"] = [];
$granTotal = 0;

if(!isset($_POST["idProve"])) exit();

$numero = $_POST["idProve"];

include_once "../../conexion/base_de_datos.php";


$sentenciaSQL=$conexion->prepare("SELECT productos.id,productos.codigo,productos.precioCompra,productos.existencia,productos.id_proveedor FROM proveedores INNER JOIN productos ON productos.id_proveedor = proveedores.id WHERE proveedores.id = ?;");
$sentenciaSQL->execute([$numero]);
$vistas=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSQL=$conexion->prepare("SELECT * FROM proveedores WHERE id = ?;");
$sentenciaSQL->execute([$numero]);
$proveedor=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
$idnuevonombre=$proveedor['id'];
$nombreNuevo=$proveedor['nombre'];

?>
<h2 class="capitulazo">Comprando con <?php echo$nombreNuevo?></h2>
<div class="col-xs-12">

		<br>

		<div class="tamales">
		<button class="molaso" onclick="location.href='./comprar.php';">regresar</button>
			<table>
				<thead>
					<tr>
						<td class="chave">id</td>
						<td class="cheve">Producto</td>
						<td class="chava">Precio de compra</td>
						<td class="chive">Existencia</td>
						<td class="chove">comprar</td>
						<td class="chavo">agregar</td>
					</tr>
				</thead>
			</table>
		</div>

		<div class="tamalitos">
			<table>
				<tbody>
				<?php foreach ($vistas as $vista){ ?>
					<form class="normales" action="agregar.php" method="POST">
					<tr>
						<td class="chave">
							<?php echo$vista['id']?>
						</td>
						<td class="cheve">
							<?php echo$vista['codigo']?>
						</td>
						<td class="cheva">
							$ <?php echo $vista['precioCompra']?>
						</td>
						<td class="chive">
							<?php echo$vista['existencia']?> kg
						</td>
						<td class="chove">
							<input type="number" required name="peso" id="peso">
						</td>
						<td class="chavo">
								<input type="submit" value="Agregar">
								<input type="hidden" name="codigo" value="<?php echo$vista['codigo']?>">
								<input type="hidden" name="Prove" value="<?php echo$vista['id_proveedor']?>">
							
						</td>
					</tr>
					</form>
					<?php } ?>
				</tbody>
			</table>
	</div>

		<br><br>
		<main class="manias">
			<table>
			<thead>
				<tr>
					<th>ID</th>
					<th>Producto</th>
					<th>Precio de venta</th>
					<th>Cantidad</th>
					<th>Total</th>
					<th>Quitar</th>
				</tr>
			</thead>
			</table>
		<div class="scroller">
		<table class="table table-bordered">
			<tbody>
				<?php foreach($_SESSION["compra"] as $indice => $producto){
						$subtotal = $producto->total;
						$granTotal += $producto->total;
					?>
				<tr>
					<td class="id"><?php echo $producto->id ?></td>
					<td class="producto"><?php echo $producto->codigo ?></td>
					<td class="precioVenta">$ <?php echo $producto->precioCompra ?></td>
					<td class="cantidad"><?php echo $producto->cantidad?> kg</td>
					<td class="total">$ <?php echo $producto->total ?></td>
					<td class="quitar">
						<form action="quitarCompra.php" method="GET">
						<input name="proveedor" type="hidden" id="proveedor" value="<?php echo $idnuevonombre;?>">
						<input type="hidden" name="indice" value="<?php echo $indice ?>">
						<input type="image" src="../../img/quitar.png" alt="">
						</form>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		</div>
		<form class="acomodalo" action="terminar.php" method="POST">
				<input name="proveedor" type="hidden" id="proveedor" value="<?php echo $idnuevonombre;?>">
				<input name="total" type="hidden" id="total" oninput="calcular()" value="<?php echo $granTotal;?>">
				<h3>Total: $<?php echo $granTotal; ?></h3>
				<label for="">Recibo: $</label>
				<input type="text" name="tiene" required oninput="calcular()" id="tiene"><br>
				<label for="">Cambio: $</label>
				<input type="number" name="mermelada" disabled id="mermelada"><br>
				<input type="submit" value="Realizar compra">
			</form>
		<a href="./cancelarCompra.php" class="btn btn-danger">Cancelar Compra</a>

		<script type="text/javascript">

			function calcular(){
				try {
					var a = parseFloat(document.getElementById('total').value) || 0,
						b = parseFloat(document.getElementById('tiene').value) || 0;
						
				document.getElementById('mermelada').value = b - a;
					
				} catch (e) {
					
				}
			}
		</script>
	</div>

	<!--
		oninput="calcular()
	-->
		</main>

<?php include_once "../../template/pie.php"?>