<?php

$servidor="bduqeoys4q5dzfxhriuz-mysql.services.clever-cloud.com";
$usuario="uhj2iahcjnhkzxt0";
$contraseña="GSGaOWLHndXdtDF1M9Gc";
$base_de_datos="bduqeoys4q5dzfxhriuz";

try {

    $conexion=new PDO("mysql:host=$servidor;dbname=$base_de_datos",$usuario,$contraseña);
    
} catch (Exception $e) {

    echo $e->getMessage();
}

//$servidor="bduqeoys4q5dzfxhriuz-mysql.services.clever-cloud.com;
//$usuario="uhj2iahcjnhkzxt0";
//$contraseña="GSGaOWLHndXdtDF1M9Gc";
//$base_de_datos="bduqeoys4q5dzfxhriuz";

//$servidor="localhost";
//$usuario="root";
//$contraseña="carlosboton6875";
//$base_de_datos="ventas";

?>