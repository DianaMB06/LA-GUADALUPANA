
<?php

//$mysqli = new MySQLi("b6uouuky18ayzflhdp9y-mysql.services.clever-cloud.com", "urqz8qagcmfacnnt","DbfpbsTBqXoaOKacOMBI", "b6uouuky18ayzflhdp9y");

		$mysqli = new MySQLi("bhcn51os3deykotocpwf-mysql.services.clever-cloud.com", "ulabaaufc7krjlsg","djk7ethFnloSxf1pph0K", "bhcn51os3deykotocpwf");
		if ($mysqli -> connect_errno) {
			die( "Fallo la conexión a MySQL: (" . $mysqli -> mysqli_connect_errno() 
				. ") " . $mysqli -> mysqli_connect_error());
		}
		else

?>