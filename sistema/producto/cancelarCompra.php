<?php

session_start();

unset($_SESSION["compra"]);
$_SESSION["compra"] = [];

header("Location: ./comprar.php");
?>