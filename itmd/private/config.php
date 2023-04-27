<?php
	
	define('SHARED_PATH', dirname(__FILE__).'/shared'); // Declara la constante de la ruta al directorio de cabecera y pie
	
	$root_url = substr($_SERVER['SCRIPT_NAME'], 0,strpos($_SERVER['SCRIPT_NAME'], 'itmd')+4); //Declara la raiz de todos los enclaces

	include 'functions.php'; // Carga el código de las funciones
	include 'db_functions.php'; // Carga el código de las funciones de base de datos
	include 'queries.php'; // Carga el código de todas las consultas a la base de datos

	session_start(); // Inicia sesion

	$database_connection = start_database_connection(); // Inicia la conexion a la base de datos
	
?>