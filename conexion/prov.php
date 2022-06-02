<?php

$servidor="b6uouuky18ayzflhdp9y-mysql.services.clever-cloud.com";
$usuario="urqz8qagcmfacnnt";
$contraseña="DbfpbsTBqXoaOKacOMBI";
$bd="b6uouuky18ayzflhdp9y";

$con = new mysqli($servidor,$usuario,$contraseña,$bd);

if($con->connect_errno){
    die("Error");
}

?>