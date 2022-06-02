<?php
if(!isset($_GET["indice"])) return;
$indice = $_GET["indice"];

if (!isset($_GET["proveedor"])) {
    return;
}

$provedor = $_GET["proveedor"];

session_start();
array_splice($_SESSION["compra"], $indice, 1);
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

