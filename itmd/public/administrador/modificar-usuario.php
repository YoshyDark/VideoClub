<?php
	require_once '../../private/config.php';		//carga el código config.php
	$titulo_pagina = "Modificar Usuario";			//Define el título de la pagina
	include SHARED_PATH. '/head.php';				//carga los código de la cabecera
	include SHARED_PATH. '/header.php';				//Carga el header

	/*Si la sesión no esta iniciada por un usuario de tipo admin, redirecciona a la página login*/
	if (!isset($_SESSION['rol']) || $_SESSION['rol']!=="admin" || !isset($_SESSION['idUser'])) {
		redirect_to('public/login.php');
	}

?>
<?php
	if (isset($_GET['idUser'])) {
		$idUser = $_GET['idUser'];
		$usuario = datos_usuario($database_connection,$idUser);
	}else{
		redirect_to('index.php');
	}
?>
<?php
	if ($_SERVER['REQUEST_METHOD']=="POST") {
		$datos_perfil = [];
		$datos_perfil['nombre'] = $_POST['nombre'] ?? "";
		$datos_perfil['apellido'] = $_POST['apellido'] ?? "";
		$datos_perfil['usuario'] = $_POST['usuario'] ?? "";
		$datos_perfil['password'] = $_POST['password'] ?? "";
		$datos_perfil['rol'] = $_POST['rol'] ?? "";
		$datos_perfil['email'] = $_POST['email'] ?? "";
		$datos_perfil['telefono'] = $_POST['telefono'] ?? "";
		$datos_perfil['fecha_de_nacimiento'] = $_POST['fecha_de_nacimiento'] ?? "";
		$datos_perfil['direccion'] = $_POST['direccion'] ?? "";
		$datos_perfil['sexo'] = $_POST['sexo'] ?? "";

		if (modificar_usuario($database_connection,$idUser,$datos_perfil)) {
			$success_msg =  "El usuario se ha actualizado con exito";
		}else{
			$error_msg = "Error al modificar el usuario";
		}
	}
?>
	<main>
		<!--En esta sección modificaremos el usuario-->
		<section>
			<div class="container">
				<h1>Mdificar Usuario</h1>
				<div class="user-form-wrapper">
					<?php
						if (isset($error_msg)) {
							echo "<div class=\"error-msg\">".$error_msg."</div>";
							header("Refresh:1;usuarios-administracion.php");
						}
						if (isset($success_msg)) {
							echo "<div class=\"success-msg\">".$success_msg."</div>";
							header("Refresh:1;usuarios-administracion.php");
						}
					?>
					<!--Formulario con todos los datos del usuario-->
					<form action="<?php url_completo('public/administrador/modificar-usuario.php?idUser='.$idUser); ?>" method="POST">
						<div class="flex align-center justify-between input-group">
							<label for="nombre">Nombre</label>
							<input type="text" name="nombre" id="nombre" value="<?php echo $usuario['nombre']; ?>">
						</div>
						<div class="flex align-center justify-between input-group">
							<label for="apellido">Apellido</label>
							<input type="text" name="apellido" id="apellido" value="<?php echo $usuario['apellido']; ?>">
						</div>
						<div class="flex align-center justify-between input-group">
							<label for="usuario">Usuario</label>
							<input type="text" name="usuario" id="usuario" value="<?php echo $usuario['usuario']; ?>">
						</div>
						<div class="flex align-center justify-between input-group">
							<label for="password">Password</label>
							<input type="password" name="password" id="password">
						</div>
						<div class="flex align-center justify-between input-group">
							<label for="email">Email</label>
							<input type="email" name="email" id="email" value="<?php echo $usuario['email']; ?>">
						</div>
						<div class="flex align-center justify-between input-group">
							<label for="telefono">Telefono</label>
							<input type="text" name="telefono" id="telefono" value="<?php echo $usuario['telefono']; ?>">
						</div>
						<div class="flex align-center justify-between input-group">
							<label for="fecha_de_nacimiento">Fecha de Nacimiento</label>
							<input type="date" name="fecha_de_nacimiento" id="fecha_de_nacimiento" value="<?php echo $usuario['fecha_de_nacimiento']; ?>">
						</div>
						<div class="flex align-center justify-between input-group">
							<label for="direccion">Direccion</label>
							<input type="text" name="direccion" id="direccion" value="<?php echo $usuario['direccion']; ?>">
						</div>
						<div class="flex align-center justify-between input-group">
							<label for="sexo">Sexo</label>
							<input type="text" name="sexo" id="sexo" value="<?php echo $usuario['sexo']; ?>">
						</div>
						<div class="flex align-center justify-between input-group">
							<label for="rol">Rol</label>
							<select name="rol" id="rol">
								<option value="admin">Administrador</option>
								<option value="user">Usuario</option>
							</select>
						</div>
						<button type="submit">Enviar</button>
						<a class="manage-btn delete-btn" href="<?php echo url_completo('public/administrador/usuarios-administracion.php'); ?>">Cancelar</a>
					</form>
				</div>
			</div>
		</section>
	</main>
<?php
	include SHARED_PATH. '/footer.php';			//carga el footer
?>