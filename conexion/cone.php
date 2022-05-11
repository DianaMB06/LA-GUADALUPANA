
<?php


		$mysqli = new MySQLi("b6uouuky18ayzflhdp9y-mysql.services.clever-cloud.com", "urqz8qagcmfacnnt","DbfpbsTBqXoaOKacOMBI", "b6uouuky18ayzflhdp9y");
		if ($mysqli -> connect_errno) {
			die( "Fallo la conexión a MySQL: (" . $mysqli -> mysqli_connect_errno() 
				. ") " . $mysqli -> mysqli_connect_error());
		}
		else

?>