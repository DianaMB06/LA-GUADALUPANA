<?php

$servidor="b6uouuky18ayzflhdp9y-mysql.services.clever-cloud.com";
$usuario="urqz8qagcmfacnnt";
$contraseña="DbfpbsTBqXoaOKacOMBI";
$bd="b6uouuky18ayzflhdp9y";

try {

    $conexion=new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$contraseña);
    
} catch (Exception $e) {

    echo $e->getMessage();
}

?>