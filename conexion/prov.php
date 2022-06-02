<?php

$servidor="localhost";
$usuario="root";
$contraseña="carlosboton6875";
$bd="ventas";

$con = new mysqli($servidor,$usuario,$contraseña,$bd);

if($con->connect_errno){
    die("Error");
}

?>