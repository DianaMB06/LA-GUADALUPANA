
<?php

session_start();
	require("conexion/cone.php");

	$username=$_POST['mail'];
	$pass=$_POST['pass'];


	$sql2=mysqli_query($mysqli,"SELECT * FROM usuario WHERE Correo_Electronico='$username'");
	if($f2=mysqli_fetch_assoc($sql2)){
		if($pass==$f2['Correo_Electronico']){
			$_SESSION['id']=$f2['id'];
			$_SESSION['user']=$f2['user'];
			$_SESSION['rol']=$f2['rol'];

			echo '<script>alert("ADMINISTRADOR")</script> ';
			echo "<script>location.href='sistema/productos.php'</script>";
		
		}
	}


	$sql=mysqli_query($mysqli,"SELECT * FROM usuario WHERE password='$pass'");
	if($f=mysqli_fetch_assoc($sql)){
		if($pass==$f['password']){
			$_SESSION['id']=$f['id'];
			$_SESSION['user']=$f['user'];
			$_SESSION['rol']=$f['rol'];

			header("Location: sistema/venta/vender.php");
		}else{
			echo '<script>alert("CONTRASEÑA INCORRECTA")</script> ';
		
			echo "<script>location.href='index.php'</script>";
		}
	}else{
		
		echo '<script>alert("CUENTA NO EXISTENTE/REGISTRATE")</script> ';
		
		echo "<script>location.href='registro.php'</script>";	

	}

?>