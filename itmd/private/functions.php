<?php
	/* función para generar el enlace completo*/
	function url_completo($url){
		global $root_url;
		return $root_url.'/'.$url;
	}
	/* función para redireccionar a un enlace indicado*/
	function redirect_to($url){
		header("Location: ".url_completo($url));
	}
	/* función para evitar inyeccion a la base de datos */ 
	function e_s($string){
		global $database_connection ;
		return $database_connection->escape_string($string);
	}

	/**Aqui validamos el formulario */
	function validar_formulario($formulario){

		$errors = [];
		
		if (isset($formulario['nombre']) && ($formulario['nombre']=="" || !preg_match("/^[a-zA-Z]+$/", $formulario['nombre']))) {
			$errors['nombre'] = "El campo nombre no pueder ser vacío y solo debe contener letras";
		}

		if (isset($formulario['apellido']) && ($formulario['apellido']=="" || !preg_match("/^[a-zA-Z]+$/", $formulario['apellido']))) {
			$errors['apellido'] = "El campo apellido no pueder ser vacío y solo debe contener letras";
		}

		if (isset($formulario['usuario']) && $formulario['usuario']=="") {
			$errors['usuario'] = "El campo usuario no pueder ser vacío";
		}

		if (isset($formulario['password']) && $formulario['password']=="") {
			$errors['password'] = "El campo password no pueder ser vacío";
		}

		if (isset($formulario['email']) && $formulario['email']=="") {
			$errors['email'] = "El campo email no pueder ser vacío";
		}

		if (isset($formulario['email']) && !preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $formulario['email'])) {
			$errors['email'] = "El campo email tiene un formato incorrecto";
		}

		if (isset($formulario['telefono']) && $formulario['telefono']=="") {
			$errors['telefono'] = "El campo telefono no pueder ser vacío";
		}

		if (isset($formulario['telefono']) && !preg_match("/^[0-9]+$/", $formulario['telefono'])) {
			$errors['telefono'] = "El campo telefono tiene un formato incorrecto";
		}

		if (isset($formulario['fecha_de_nacimiento']) && $formulario['fecha_de_nacimiento']=="") {
			$errors['fecha_de_nacimiento'] = "El campo fecha de nacimiento no pueder ser vacío";
		}

		if (isset($formulario['direccion']) && $formulario['direccion']=="") {
			$errors['direccion'] = "El campo direccion no pueder ser vacío";
		}

		if (isset($formulario['sexo']) && $formulario['sexo']=="") {
			$errors['sexo'] = "El campo sexo no pueder ser vacío";
		}

		if (!empty($errors)) {
			return $errors;
		}else{
			return true;
		}
	}
?>