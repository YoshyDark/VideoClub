<?php

	/*Definimos el servidor, el usuario, la contraseña, y la base de datos */
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', '76654592');
	define('DB_NAME', 'itmd');
	
	
	/* Función para iniciar la conección a la base de datos */
	function start_database_connection(){

		$database_connection = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		if ($database_connection->connect_error) {
			echo "Error database connection: ".$database_connection->error." Error No. ".$database_connection->errno;
			die();
		}else{
			return $database_connection;
		}
	}

	/* Función para cerrar la conección a la base de datos */
	function close_database_connection($database_connection){
		$database_connection->close();
	}
?>