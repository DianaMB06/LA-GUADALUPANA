<?php 
session_start();
include_once "../../template/encabezado.php";
if(!isset($_SESSION["carrito"])) $_SESSION["carrito"] = [];
$granTotal = 0;
$resultado = 0;
?>
	<div class="col-xs-12">
		<?php
			if(isset($_GET["status"])){
				if($_GET["status"] === "1"){
					?>
						<div class="alert verde">
							<strong><img src="../../img/comprobado.png" class="eliminado">  Venta realizada correctamente</strong> 
						</div>
					<?php
				}else if($_GET["status"] === "2"){
					?>
					<div class="alert rojo">
							<strong>Venta cancelada</strong>
						</div>
					<?php
				}else if($_GET["status"] === "3"){
					?>
					<div class="alert amarillo">
							<strong><img src="../../img/eliminado.png" class="eliminado">Producto eliminado</strong> 
						</div>
					<?php
				}else if($_GET["status"] === "4"){
					?>
					<div class="alert azul">
							<strong class="dentro">Producto no existente</strong> 
						</div>
					<?php
				}else if($_GET["status"] === "5"){
					?>
					<div class="alert morado">
							<strong class="dentro"><img src="../../img/agotado.png" class="agotado">Producto agotado</strong>
						</div>
					<?php
				}else{
					?>
					<div class="alert alert-danger">
							<strong>Error:</strong> Algo salió mal mientras se realizaba la venta
						</div>
					<?php
				}
			}
		?>

<?php

$idNuevo=(isset($_POST['idPro']))?$_POST['idPro']:"";
$codigo=(isset($_POST['codigo']))?$_POST['codigo']:"";
$precioVenta=(isset($_POST['precioVenta']))?$_POST['precioVenta']:"";
$existencia=(isset($_POST['existencia']))?$_POST['existencia']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

$tiene=(isset($_POST['tiene']))?$_POST['tiene']:"";
$total=(isset($_POST['total']))?$_POST['total']:"";
$resultado=(float)$tiene-(float)$total;

include_once "../../conexion/base_de_datos.php";

switch ($accion) {
	case "btnProducto":
		$sentenciaSQL=$conexion->prepare("SELECT * FROM productos WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$idNuevo);
        $sentenciaSQL->execute();
        $vista=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $codigo=$vista['codigo'];
        $precioVenta=$vista['precioVenta'];
		$existencia=$vista['existencia'];
		break;
	
	default:
		# code...
		break;
}

$sentenciaSQL=$conexion->prepare("SELECT * FROM productos");
$sentenciaSQL->execute();
$vistas=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<!--buscador de los productos con un metodo get-->
	<form class="buscar" action=""  method="GET">
		<input class="cajas" type="submit" name="enviar" value="Buscar">
        <input class="busca" type="text" name="buscador"  id="buscador">
    </form>
    <!--fin de buscador-->

    <!--inicio de php-->
    <?php
    //llamando a la conexion para el envio de datos
    include "../../conexion/prov.php";
    
    //uso de la condicion if, preduntando con ISSET si el envio de datos $_GET tiene un valor, y si tiene un valor entra en la condicion
    if(isset($_GET['enviar'])){
        //el valor $_GET se guarda en la variable $BUSQUEDA
        $busqueda = $_GET['buscador'];
        
        //llamando a el comando SELECT para imprimir la busqueda que se guardo en $BUSQUEDA
        $consulta = $con->query("SELECT * FROM productos WHERE codigo LIKE '%$busqueda%'");

        //uso de la condicion while, guardando nuestra consulta en $row para su impresion de los datos, imprimiendolos con fetch_array() para imprimirlos ordenada
		echo "<div class='caja-panales'>";
        while ($row = $consulta->fetch_array()){
			
			echo "<form class='panales' method='POST'>";
				echo "<button type='submit' class='normales' name='accion' value='btnProducto'>" .$row['codigo']. "</button>";
				echo "<input type='hidden' name='idPro' id='idPro' value=".$row['id'].">";
				echo "<input type='hidden'  value=".$row['precioVenta'].">";
				echo "<input type='hidden'  value=".$row['existencia'].">";
			echo "</form>";
			
        }
		echo "</div>";
        //fin de la condicion while

    }
    //fin de la condicion if

    ?>
    <!--fin de php-->
		<br>
		<br>

	<div class="tamañitos">
	<?php foreach ($vistas as $vista){ ?>
		<form class="normales" method="POST">
				<button type="submit" class="normales" name="accion" value="btnProducto"><?php echo$vista['codigo']?></button>
				<input type="hidden" name="idPro" id="idPro" value="<?php echo$vista['id']?>">
				<input type="hidden" value="<?php echo$vista['existencia']?>">
				<input type="hidden" value="<?php echo$vista['precioVenta']?>">
    	</form>
	<?php } ?>
	</div>

	<div class="agregamos">
		<form method="post" action="agregarAlCarrito.php">
			<h3 class="compras"><?php echo $codigo?></h3><br>
			<h3 class="compras"><?php echo "$".$precioVenta." precio/kg"?></h3><br>
			<h3 class="compras"><?php echo "existencia ".$existencia." kg"?></h3><br>
			<input autofocus class="form-control" name="codigo" type="hidden" id="codigo" value="<?php echo
			$codigo?>" placeholder="Escribe el producto">
			<input required type="number" step="any" name="peso" id="peso">
		</form>
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
					<th>Eliminar</th>
				</tr>
			</thead>
			</table>
		<div class="scroller">
		<table class="table table-bordered">
			<tbody>
				<?php foreach($_SESSION["carrito"] as $indice => $producto){
						$subtotal = $producto->total;
						$granTotal += $producto->total;
					?>
				<tr>
					<td class="id"><?php echo $producto->id ?></td>
					<td class="producto"><?php echo $producto->codigo ?></td>
					<td class="precioVenta">$ <?php echo $producto->precioVenta ?></td>
					<td class="cantidad"><?php echo $producto->cantidad ?> kg</td>
					<td class="total">$ <?php echo $producto->total ?></td>
					<td class="quitar">
						<a class="estatico" href="<?php echo "quitarDelCarrito.php?indice=" . $indice?>">
							<img class="imajinece" src="../../img/eliminar.png" alt="">
						</a>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		</div>

		<form action="./terminarVenta.php" method="POST">
		<input name="total" type="hidden" value="<?php echo $granTotal;?>">
			<div class="ventana" id="ventana">
				<h3 class="termino">Terminar venta</h3>
				<div class="ventana-decorativa">
					<br>
					<p class="padezitos">Total = $<?php echo $granTotal;?></p>
					<p class="padezitos">Cambio = $<?php echo $resultado?></p>
					<br>
					<br>
					<br>

					<input type="image" class="termino-imagen" src="../../img/si.png" alt="">

					<a href="javascript:cerrar()">
						<img class="termino-imagen" src="../../img/no.png" alt="">
					</a>
				</div>
			</div>

		</form>
		<form class="acomodalo" action="./terminarVenta.php" method="POST">
				<h3>Total: $<?php echo $granTotal; ?></h3>
				<input name="total" id="total" type="hidden" oninput="calcular()" value="<?php echo $granTotal;?>">
				<label for="">Recibo $</label>
				<input type="number" required oninput="calcular()" name="tiene" id="tiene"><br>
				<label for="">Cambio $</label>
				<input type="number" name="precioCompra" required disabled id="precioCompra">
				<br>
				<input type="submit" value="Terminar venta">
			</form>
		<a href="./cancelarVenta.php" class="btn btn-danger">Cancelar venta</a>
		
		<script type="text/javascript">

			function calcular(){
				try {
					var a = parseFloat(document.getElementById('total').value) || 0,
						b = parseFloat(document.getElementById('tiene').value) || 0;
						
				document.getElementById('precioCompra').value = b - a;
					
				} catch (e) {
					
				}
			}
		</script>

	</div>
		</main>
<?php include_once "../../template/pie.php" ?>