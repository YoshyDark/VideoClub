<?php
	/**Función para verificar los usuarios */
	function verificar_usuario_existe($database_connection,$datos_registro){
		$sql = "SELECT * FROM users_login WHERE usuario='".e_s($datos_registro['usuario'])."';";
		$result = $database_connection->query($sql);
		if ($result->num_rows>0) {
			return true;
		}else{
			return false;
		}
	}
	/**Funcion para registrar los usuarios */
	function registrar_usuario($database_connection,$datos_registro){
		$sql = "INSERT INTO users_data (nombre,apellido,email,telefono,fecha_de_nacimiento,direccion,sexo) VALUES (";
		$sql .= "'".e_s($datos_registro['nombre'])."',";
		$sql .= "'".e_s($datos_registro['apellido'])."',";
		$sql .= "'".e_s($datos_registro['email'])."',";
		$sql .= "'".e_s($datos_registro['telefono'])."',";
		$sql .= "'".e_s($datos_registro['fecha_de_nacimiento'])."',";
		$sql .= "'".e_s($datos_registro['direccion'])."',";
		$sql .= "'".e_s($datos_registro['sexo'])."')";
		$result = $database_connection->query($sql);
		if ($result) {
			$idUser = $database_connection->insert_id;
			$sql = "INSERT INTO users_login (idUser,usuario,password,rol) VALUES (";
			$sql .= "'".e_s($idUser)."',";
			$sql .= "'".e_s($datos_registro['usuario'])."',";
			$sql .= "'".password_hash($datos_registro['password'], PASSWORD_DEFAULT)."',";
			$sql .= "'".e_s($datos_registro['rol'])."')";
			$result = $database_connection->query($sql);
			if ($result) {
				return true;
			}else{
				echo $database_connection->error;
				return false;
			}
		}else{
			echo $database_connection->error;
			return false;
		}
	}

	/**Función para iniciar sesión */
	function iniciar_sesion($database_connection,$datos_login){
		$sql = "SELECT * FROM users_login WHERE usuario='".e_s($datos_login['usuario'])."';";
		$result = $database_connection->query($sql);
		if ($result->num_rows>0) {
			$usuario = $result->fetch_assoc();
			if (password_verify($datos_login['password'], $usuario['password'])) {
				$_SESSION['idUser'] = $usuario['idUser'];
				$_SESSION['rol'] = $usuario['rol'];
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	function datos_usuario($database_connection,$idUser){
		$sql = "SELECT * FROM users_data WHERE idUser='".e_s($idUser)."';";
		$result = $database_connection->query($sql);
		if ($result) {
			$user_data = $result->fetch_assoc();
			$sql = "SELECT * FROM users_login WHERE idUser='".e_s($idUser)."';";
			$result = $database_connection->query($sql);
			if ($result) {
				$user_login = $result->fetch_assoc();
				$user_data['usuario'] = $user_login['usuario'];
				$user_data['password'] = $user_login['password'];
				return $user_data;
			}else{
				echo $database_connection->error;
				return false;
			}
		}else{
			echo $database_connection->error;
			return false;
		}
	}

	/**Función para modificar el perfil de los usuarios */
	function modificar_perfil($database_connection,$idUser,$datos_perfil){
		$sql = "UPDATE users_data SET nombre='".e_s($datos_perfil['nombre'])."',";
		$sql .= "apellido='".e_s($datos_perfil['apellido'])."',";
		$sql .= "email='".e_s($datos_perfil['email'])."',";
		$sql .= "telefono='".e_s($datos_perfil['telefono'])."',";
		$sql .= "fecha_de_nacimiento='".e_s($datos_perfil['fecha_de_nacimiento'])."',";
		$sql .= "direccion='".e_s($datos_perfil['direccion'])."',";
		$sql .= "sexo='".e_s($datos_perfil['sexo'])."' ";
		$sql .= " WHERE idUser='".e_s($idUser)."'";
		$result = $database_connection->query($sql);
		if ($result) {
			$sql = "UPDATE users_login SET password='".password_hash($datos_perfil['password'], PASSWORD_DEFAULT)."' WHERE idUser='".e_s($idUser)."';";
			$result = $database_connection->query($sql);
			if ($result) {
				return true;
			}else{
				echo $database_connection->error;
				return false;
			}
		}else{
			echo $database_connection->error;
			return false;
		}
	}

	/**Función para seleccionar los usuarios */
	function seleccionar_usuarios($database_connection){
		$sql = "SELECT * FROM users_data;";
		$result = $database_connection->query($sql);
		if ($result) {
			return $result;
		}else{
			echo $database_connection->error;
		}
	}
	/**Función para modificar los usuarios */
	function modificar_usuario($database_connection,$idUser,$datos_perfil){
		$sql = "UPDATE users_data SET nombre='".e_s($datos_perfil['nombre'])."',";
		$sql .= "apellido='".e_s($datos_perfil['apellido'])."',";
		$sql .= "email='".e_s($datos_perfil['email'])."',";
		$sql .= "telefono='".e_s($datos_perfil['telefono'])."',";
		$sql .= "fecha_de_nacimiento='".e_s($datos_perfil['fecha_de_nacimiento'])."',";
		$sql .= "direccion='".e_s($datos_perfil['direccion'])."',";
		$sql .= "sexo='".e_s($datos_perfil['sexo'])."' ";
		$sql .= " WHERE idUser='".e_s($idUser)."'";
		$result = $database_connection->query($sql);
		if ($result) {
			$sql = "UPDATE users_login SET usuario='".$datos_perfil['usuario']."', password='".password_hash($datos_perfil['password'], PASSWORD_DEFAULT)."', rol='".$datos_perfil['rol']."' WHERE idUser='".e_s($idUser)."';";
			$result = $database_connection->query($sql);
			if ($result) {
				return true;
			}else{
				echo $database_connection->error;
				return false;
			}
		}else{
			echo $database_connection->error;
			return false;
		}
	}
	/**Función para borrar usuarios */
	function borrar_usuario($database_connection,$idUser){
		$sql = "DELETE FROM users_login WHERE idUser='".e_s($idUser)."';";
		$result = $database_connection->query($sql);
		if ($result) {
			$sql = "DELETE FROM users_data WHERE idUser='".e_s($idUser)."';";
			$result = $database_connection->query($sql);
			if ($result) {
				return true;
			}else{
				echo $database_connection->error;
			}
		}else{
			echo $database_connection->error;
		}
	}

	/**Función para seleccionar citas */
	function seleccionar_citas($database_connection){
		$sql = "SELECT * FROM citas;";
		$result = $database_connection->query($sql);
		if ($result) {
			return $result;
		}else{
			echo $database_connection->error;
		}
	}

	/**Muestra las citas de los usuarios */
	function citas_usuario($database_connection,$idUser){
		$sql = "SELECT * FROM citas WHERE idUser='".e_s($idUser)."';";
		$result = $database_connection->query($sql);
		if ($result) {
			return $result;
		}else{
			echo $database_connection->error;
		}
	}

	/**Muestra los datos de las citas */
	function datos_cita($database_connection,$idUser,$idCita){
		$sql = "SELECT * FROM citas WHERE idUser='".$idUser."' AND idCita='".$idCita."';";
		$result = $database_connection->query($sql);
		if ($result) {
			$datos_cita = $result->fetch_assoc();
			return $datos_cita;
		}else{
			echo $database_connection->error;
		}
	}

	/**Función para crear citas */
	function crear_cita($database_connection,$datos_cita){
		$sql = "INSERT INTO citas (idUser,fecha_cita,motivo_cita) VALUES (";
		$sql .= "'".e_s($datos_cita['idUser'])."',";
		$sql .= "'".e_s($datos_cita['fecha_cita'])."',";
		$sql .= "'".e_s($datos_cita['motivo_cita'])."')";
		$result = $database_connection->query($sql);
		if ($result) {
			return true;
		}else{
			echo $database_connection->error;
			return false;
		}
	}

	/**Función para modificar citas */
	function modificar_cita($database_connection,$idUser,$idCita,$datos_cita){
		$sql = "UPDATE citas SET fecha_cita='".e_s($datos_cita['fecha_cita'])."',";
		$sql .= "motivo_cita='".e_s($datos_cita['motivo_cita'])."'";
		$sql .= " WHERE idUser='".e_s($idUser)."' AND idCita='".e_s($idCita)."';";
		$result = $database_connection->query($sql);
		if ($result) {
			return true;
		}else{
			echo $database_connection->error;
			return false;
		}
	}

	/**Función para borrar citas */
	function borrar_cita($database_connection,$idCita){
		$sql = "DELETE FROM citas WHERE idCita='".e_s($idCita)."';";
		$result = $database_connection->query($sql);
		if ($result) {
			return true;
		}else{
			echo $database_connection->error;
			return false;
		}
	}

	/**Función para crear noticias */
	function crear_noticia($database_connection,$datos_noticia){
		$sql = "INSERT INTO noticias (idUser,titulo,imagen,texto,fecha) VALUES (";
		$sql .= "'".e_s($datos_noticia['idUser'])."',";
		$sql .= "'".e_s($datos_noticia['titulo'])."',";
		$sql .= "'".e_s($datos_noticia['imagen'])."',";
		$sql .= "'".e_s($datos_noticia['texto'])."',";
		$sql .= "'".e_s($datos_noticia['fecha'])."')";
		$result = $database_connection->query($sql);
		if ($result) {
			return true;
		}else{
			echo $database_connection->error;
		}
	}

	/**Selecciona la noticia pertinente */
	function seleccionar_noticias($database_connection){
		$sql = "SELECT * FROM noticias;";
		$result = $database_connection->query($sql);
		if ($result) {
			return $result;
		}else{
			echo $database_connection->error;
		}
	}
	/**Muestra los datos de la noticia seleccionada */
	function datos_noticia($database_connection,$idNoticia){
		$sql = "SELECT * FROM noticias WHERE idNoticia='".e_s($idNoticia)."';";
		$result = $database_connection->query($sql);
		if ($result) {
			$noticia = $result->fetch_assoc();
			return $noticia;
		}else{
			echo $database_connection->error;
		}
	}

	/**Función para modificar los datos de la noticia seleccionada */
	function modificar_noticia($database_connection,$idNoticia,$datos_noticia){
		$sql = "UPDATE noticias SET titulo='".e_s($datos_noticia['titulo'])."',";
		$sql .= "texto='".e_s($datos_noticia['texto'])."',";
		$sql .= "fecha='".e_s($datos_noticia['fecha'])."',";
		$sql .= "imagen='".e_s($datos_noticia['imagen'])."'";
		$sql .= " WHERE idNoticia='".e_s($idNoticia)."';";
		$result = $database_connection->query($sql);
		if ($result) {
			return true;
		}else{
			echo $database_connection->error;
			return false;
		}
	}
	
	/**Función para borrar la noticia */
	function borrar_noticia($database_connection,$idNoticia){
		$sql = "DELETE FROM noticias WHERE idNoticia='".e_s($idNoticia)."';";
		$result = $database_connection->query($sql);
		if ($result) {

			return true;
		}else{
			echo $database_connection->error;
		}
	}
?>