<?php

$servidor="bhcn51os3deykotocpwf-mysql.services.clever-cloud.com";
$usuario="bhcn51os3deykotocpwf";
$contraseña="djk7ethFnloSxf1pph0K";
$bd="b6uouuky18ayzflhdp9y";

try {

    $conexion=new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$contraseña);
    
} catch (Exception $e) {

    echo $e->getMessage();
}

?>