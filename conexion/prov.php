<?php

$servidor="bhcn51os3deykotocpwf-mysql.services.clever-cloud.com";
$usuario="bhcn51os3deykotocpwf";
$contraseña="djk7ethFnloSxf1pph0K";
$bd="b6uouuky18ayzflhdp9y";

$con = new mysqli($servidor,$usuario,$contraseña,$bd);

if($con->connect_errno){
    die("Error");
}

?>