<?php

$servidor="localhost";
$usuario="root";
$contraseña="carlosboton6875";
$bd="ventas";

try {

    $conexion=new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$contraseña);
    
} catch (Exception $e) {

    echo $e->getMessage();
}

?>