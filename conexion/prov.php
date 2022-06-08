<?php

$servidor="bhcn51os3deykotocpwf-mysql.services.clever-cloud.com";
$usuario="ulabaaufc7krjlsg";
$contraseña="djk7ethFnloSxf1pph0K";
$bd="bhcn51os3deykotocpwf";

$con = new mysqli($servidor,$usuario,$contraseña,$bd);

if($con->connect_errno){
    die("Error");
}

?>