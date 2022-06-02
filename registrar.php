<?php

	$mail=$_POST['nick'];
	$pass= $_POST['pass'];

	require("conexion/cone.php");
	$checkemail=mysqli_query($mysqli,"SELECT * FROM usuario WHERE Correo_Electronico='$mail'");
	$check_mail=mysqli_num_rows($checkemail);
		if($pass){
			if($check_mail>0){
				echo ' <script language="javascript">alert("Atencion, ya existe el email designado para un usuario, verifique sus datos");</script> ';
			}else{
				
				mysqli_query($mysqli,"INSERT INTO usuario (Correo_Electronico,password) VALUES ('$mail','$pass');");

				echo ' <script language="javascript">alert("Usuario registrado con éxito");</script> ';
				
				
			}
			
		}else{
			echo 'Las contraseñas son incorrectas';
		}

	
?>



<META HTTP-EQUIV="REFRESH" CONTENT="1;URL=index.php"> 