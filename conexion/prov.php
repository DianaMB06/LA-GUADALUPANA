<?php

$servidor="bduqeoys4q5dzfxhriuz-mysql.services.clever-cloud.com";
$usuario="uhj2iahcjnhkzxt0";
$contraseña="GSGaOWLHndXdtDF1M9Gc";
$bd="bduqeoys4q5dzfxhriuz";

$con = new mysqli($servidor,$usuario,$contraseña,$bd);

if($con->connect_errno){
    die("Error");
}

?>