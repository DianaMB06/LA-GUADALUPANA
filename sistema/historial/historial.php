<?php include_once "../../template/encabezado.php" ?>
<?php
include_once "../../conexion/base_de_datos.php";
$sentencia = $conexion->query("SELECT * FROM noche");
$ventas = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

	<main class="todo">
	<div class="tamalotes">
        <button class="molaso" onclick="location.href='./ventas.php';">Regresar</button>					
        <table>
        <thead>
                    <tr>
                        <td class="">ID</td>
                        <td class="">FECHA</td>
                        <td>VER</td>
                    </tr>
                </thead>
        </table>
        </div>

        <div class="uaxaqueño">
        <table>
                <tbody>
                <?php foreach ($ventas as $vista){ ?>
                    
                    <tr>
                        <td class="">
                        <?php echo $vista->id?>
                        </td>
                        <td>
                        <?php echo $vista->fecha?>
                        </td>
                        <td class="">
                        <form class="normales" method="POST" action="reservado.php">
                        <input type="submit" value="VER">
                        <input type="hidden" name="id" id="id" value="<?php echo $vista->id?>">
                        </form>
                        </td>
                    </tr>
                    
                    <?php } ?>
                </tbody>
            </table>
        </div>
	</main>
<?php include_once "../../template/pie.php" ?>