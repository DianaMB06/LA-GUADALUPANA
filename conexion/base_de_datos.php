<?php

$servidor="bhcn51os3deykotocpwf-mysql.services.clever-cloud.com";
$usuario="bhcn51os3deykotocpwf";
$contraseña="djk7ethFnloSxf1pph0K";
$base_de_datos="b6uouuky18ayzflhdp9y";

try {

    $conexion=new PDO("mysql:host=$servidor;dbname=$base_de_datos",$usuario,$contraseña);
    
} catch (Exception $e) {

    echo $e->getMessage();
}

//$servidor="bhcn51os3deykotocpwf-mysql.services.clever-cloud.com;
//$usuario="bhcn51os3deykotocpwf";
//$contraseña="djk7ethFnloSxf1pph0K";
//$base_de_datos="b6uouuky18ayzflhdp9y";

//$servidor="localhost";
//$usuario="root";
//$contraseña="carlosboton6875";
//$base_de_datos="ventas";

?>