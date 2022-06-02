
<?php

//$mysqli = new MySQLi("b6uouuky18ayzflhdp9y-mysql.services.clever-cloud.com", "urqz8qagcmfacnnt","DbfpbsTBqXoaOKacOMBI", "b6uouuky18ayzflhdp9y");

		$mysqli = new MySQLi("localhost", "root","carlosboton6875", "ventas");
		if ($mysqli -> connect_errno) {
			die( "Fallo la conexión a MySQL: (" . $mysqli -> mysqli_connect_errno() 
				. ") " . $mysqli -> mysqli_connect_error());
		}
		else

?>