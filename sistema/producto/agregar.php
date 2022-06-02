<?php
if (!isset($_POST["codigo"])) {
    return;
}

if (!isset($_POST["peso"])) {
    return;
}

if (!isset($_POST["Prove"])) {
    return;
}

$codigo = $_POST["codigo"];

$can = $_POST["peso"];

$provedor = $_POST["Prove"];

include_once "../../conexion/base_de_datos.php";

$sentencia = $conexion->prepare("SELECT * FROM productos WHERE id_proveedor = ? AND codigo = ? LIMIT 1;");
$sentencia->execute([$provedor, $codigo]);
$producto = $sentencia->fetch(PDO::FETCH_OBJ);
# Si no existe, salimos y lo indicamos
if (!$producto) {
    header("Location: ./comprando.php?status=4");
    exit;
}

session_start();
# Buscar producto dentro del cartito
$indice = false;
for ($i = 0; $i < count($_SESSION["compra"]); $i++) {
    if ($_SESSION["compra"][$i]->codigo === $codigo) {
        $indice = $i;
        break;
    }
}
# Si no existe, lo agregamos como nuevo
if ($indice === false) {
    $producto->cantidad = $can;
    $producto->total = $producto->precioCompra * $can;
    array_push($_SESSION["compra"], $producto);
} else {
    # Si ya existe, se agrega la cantidad
    # Pero espera, tal vez ya no haya
    $cantidadExistente = $_SESSION["compra"][$indice]->cantidad;
    # si al sumarle uno supera lo que existe, no se agrega
    if ($cantidadExistente + $can > $producto->existencia) {
        header("Location: ./comprando.php?status=5");
        exit;
    }
    $_SESSION["compra"][$indice]->cantidad = $_SESSION["compra"][$indice]->cantidad + $can;
    $_SESSION["compra"][$indice]->total = $_SESSION["compra"][$indice]->cantidad * $_SESSION["compra"][$indice]->precioCompra;
}

echo"<form action='comprando.php' method='POST' name='formulario'>";
echo"<input type='text' name='idProve' value=".$provedor.">";
echo"</form>";

?>

<script>
    window.addEventListener("load",function(){
		formulario = document.formulario;
		idProve = document.formulario.idProve;
		campoError = document.getElementById("error");
		
		idProve.addEventListener("input",function(){
			campoError.innerHTML= "";
		});
		idProve.addEventListener("change",envioAutomatico);
	});

	function enviarFormulario(e){
		e = e || window.event;	//compatibilidad explorer
		if(idProve.value==""){ 
			e.preventDefault(); // parar la ejecución por defecto del evento.
			campoError.innerHTML ="rellene este campo";
		}else{
			console.log("se ha procedio al envío del formulario");
		};
	};

    function envioAutomatico(){
		formulario.addEventListener("submit",enviarFormulario);
		formulario.submit();
	}

    window.onload = function envioAutomatico(){
		formulario.addEventListener("submit",enviarFormulario);
		formulario.submit();
	}
</script>