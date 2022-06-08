<?php
include_once "../../template/encabezado.php";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

switch ($accion) {
    case 'Confirmar':
        include_once "../../conexion/base_de_datos.php";

        $ahora=date("Y-m-d");

        $sentencia = $conexion->prepare("INSERT INTO dia(fecha) VALUES (?);");
        $sentencia->execute([$ahora]);

        $sentencia = $conexion->prepare("SELECT id FROM dia ORDER BY id DESC LIMIT 1;");
        $sentencia->execute();
        $resultado = $sentencia->fetch(PDO::FETCH_OBJ);

        $iddia = $resultado === false ? 1 : $resultado->id;

        $sentencia = $conexion->query("SELECT ganancia.id, ganancia.producto, ganancia.cantidad, ganancia.total, productos.precioCompra, productos.precioVenta FROM productos INNER JOIN ganancia ON ganancia.id_producto = productos.id GROUP BY ganancia.id ORDER BY ganancia.id;");
        $valores = $sentencia->fetchAll(PDO::FETCH_OBJ);

        $conexion->beginTransaction();
            $sentencia = $conexion->prepare("INSERT INTO histoG(producto, cantidad, ganancia, total, recuperacion, id_dia) VALUES (?, ?, ?, ?, ?, ?);");
            foreach ($valores as $valor) {
                $valor->mega = $valor->precioVenta - $valor->precioCompra;
                $valor->yamp = $valor->cantidad * $valor->mega;
                $valor->subtotal = $valor->cantidad * $valor->precioVenta;
                $valor->ganancia = $valor->subtotal - $valor->total;

                $sentencia->execute([$valor->producto, $valor->cantidad, $valor->yamp, $valor->total, $valor->ganancia , $iddia]);
            }
        $conexion->commit();

        ///--------------------------------------------------------------------///

        $sentencia = $conexion->prepare("INSERT INTO noche(fecha) VALUES (?);");
        $sentencia->execute([$ahora]);

        $sentencia = $conexion->prepare("SELECT id FROM noche ORDER BY id DESC LIMIT 1;");
        $sentencia->execute();
        $valia = $sentencia->fetch(PDO::FETCH_OBJ);

        $idnoche = $valia === false ? 1 : $valia->id;

        $sentencia = $conexion->query("SELECT * FROM ventas");
        $quejas = $sentencia->fetchAll(PDO::FETCH_OBJ);

        $conexion->beginTransaction();
            $sentencia = $conexion->prepare("INSERT INTO medianoche(fecha, total, id_noche) VALUES (?, ?, ?);");
            foreach ($quejas as $queja) {

                $sentencia->execute([$queja->fecha, $queja->total, $idnoche]);
            }
        $conexion->commit();

        $sentencia = $conexion->query("SELECT * FROM productos_vendidos");
        $baras = $sentencia->fetchAll(PDO::FETCH_OBJ);

        $conexion->beginTransaction();
            $sentencia = $conexion->prepare("INSERT INTO malas(id_producto, cantidad, subtotal, id_medianoche) VALUES (?, ?, ?, ?);");
            foreach ($baras as $bara) {

                $sentencia->execute([$bara->id_producto, $bara->cantidad, $bara->subtotal, $bara->id_venta]);
            }
        $conexion->commit();

        $sentencia = $conexion->prepare("DELETE FROM ventas;");
        $sentencia->execute();

        header("Location: ../venta/vender.php");
        break;
    
    default:
        # code...
        break;
}

?>


<div class="ventana-proveedor" id="ventana-proveedor">
            <h3 class="termino">TERMINAR VENTA DEL DIA</h3>
            <div class="ventana-proveedor__decorativa">
                <br>
                <br>
                <form action="" method="POST">
                    <input class="duracion" type="submit" name="accion" value="Confirmar">
                </form>
                <form action="../venta/vender.php" method="POST">
                    <input class="duraciones" type="submit" value="Cancelar">
				</form>
            </div>
        </div>

        <div class="caja-vista">
			<div class="caja-vista__compras">
                <h4 class="caja-vista__compras-modulo">TERMINAR VENTA DEL DIA HARA QUE SE GUARDEN LOS DATOS DEL HISTORIAL Y LAS GANANCIAS EN EL MOMENTO QUE CONFIRME</h4>
			</div>
		</div>


<?php include_once "../../template/pie.php";?>