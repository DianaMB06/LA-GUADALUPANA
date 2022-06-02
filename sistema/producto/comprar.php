<?php include_once "../../template/encabezado.php"?>
<?php
include_once "../../conexion/base_de_datos.php";

$sentenciaSQL=$conexion->prepare("SELECT * FROM proveedores");
$sentenciaSQL->execute();
$vistas=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<br><br>
<div class="tamalotes">
<button class="molaso" onclick="location.href='./listar.php';">regresar</button>					
<table>
<thead>
			<tr>
				<td class="sanchez">proveedor</td>
				<td class="suncho">accion</td>
			</tr>
		</thead>
</table>
</div>

<div class="uaxaqueño">
<table>
		<tbody>
		<?php foreach ($vistas as $vista){ ?>
			<form class="normales" method="POST" action="comprando.php">
			<tr>
				<td class="sanchez">
				<?php echo$vista['nombre']?>
				</td>
				<td class="suncho">
				<button type="submit" class="normales" name="accion">Comprar</button>
				<input type="hidden" name="idProve" id="idProve" value="<?php echo$vista['id']?>">
				</td>
			</tr>
			</form>
			<?php } ?>
		</tbody>
	</table>
</div>
		
	


<?php include_once "../../template/pie.php"?>