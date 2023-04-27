<?php
	require_once '../private/config.php';
	unset($_SESSION['idUser']);
	unset($_SESSION['rol']);
	session_destroy();
	close_database_connection($database_connection);
	redirect_to('index.php');
	exit();
?>