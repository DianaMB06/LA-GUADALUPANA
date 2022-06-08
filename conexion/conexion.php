<?php

$servidor="bhcn51os3deykotocpwf-mysql.services.clever-cloud.com";
$usuario="ulabaaufc7krjlsg";
$contraseña="djk7ethFnloSxf1pph0K";
$bd="bhcn51os3deykotocpwf";

try {

    $conexion=new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$contraseña);
    
} catch (Exception $e) {

    echo $e->getMessage();
}

?>