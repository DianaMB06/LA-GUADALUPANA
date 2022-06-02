
<?php

$menudo = $_POST["numeroUno"];
$max = $_POST["numeroDos"];
$constante = (float)$menudo / (float)$max;

	header("Location: ./formulario.php");


?>