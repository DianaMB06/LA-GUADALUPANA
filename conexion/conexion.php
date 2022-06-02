<?php

$servidor="bduqeoys4q5dzfxhriuz-mysql.services.clever-cloud.com";
$usuario="uhj2iahcjnhkzxt0";
$contraseña="GSGaOWLHndXdtDF1M9Gc";
$bd="bduqeoys4q5dzfxhriuz";

try {

    $conexion=new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$contraseña);
    
} catch (Exception $e) {

    echo $e->getMessage();
}

?>