<?php
	require_once '../../private/config.php';		//carga el código config.php
	$titulo_pagina = "Crear Usuario";				//Define el título de la pagina
	include SHARED_PATH. '/head.php';				//carga los código de la cabecera
	include SHARED_PATH. '/header.php';				//Carga el header

	/*Si la sesión no esta iniciada por un usuario de tipo admin, redirecciona a la página login*/
	if (!isset($_SESSION['rol']) || $_SESSION['rol']!=="admin" || !isset($_SESSION['idUser'])) {
		redirect_to('public/login.php');
	}

?>
<?php
	if ($_SERVER['REQUEST_METHOD']=="POST") {
		$datos_registro = [];
		$datos_registro['nombre'] = $_POST['nombre'] ?? "";
		$datos_registro['apellido'] = $_POST['apellido'] ?? "";
		$datos_registro['usuario'] = $_POST['usuario'] ?? "";
		$datos_registro['password'] = $_POST['password'] ?? "";
		$datos_registro['rol'] = $_POST['rol'] ?? "";
		$datos_registro['email'] = $_POST['email'] ?? "";
		$datos_registro['telefono'] = $_POST['telefono'] ?? "";
		$datos_registro['fecha_de_nacimiento'] = $_POST['fecha_de_nacimiento'] ?? "";
		$datos_registro['direccion'] = $_POST['direccion'] ?? "";
		$datos_registro['sexo'] = $_POST['sexo'] ?? "";

		/**Validamos el formulario */
		$validar_formulario = validar_formulario($datos_registro);

		/** Verificamos si el usuario existe*/
		if (!verificar_usuario_existe($database_connection,$datos_registro)) {
			if (!is_array($validar_formulario)) {
				if (registrar_usuario($database_connection,$datos_registro)) {
					$success_msg = "El usuario se ha registrado con exito";
				}else{
					$error_msg = "Error al registrar el nuevo usuario";
				}
			}else{
				$error_msg = implode("<br>", array_values($validar_formulario) );
			}
		}else{
			$error_msg = "Este usuario ya existe";
		}
		
	}
?>
	<main>
		<!--Sección desde el que se creará el usuario-->
		<section>
			<div class="container">
				<h1>Crear Usuario</h1>
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
					<!--Formulario a rellenar con el nombre, apellidos, usuario, etc.-->
					<form action="<?php url_completo('public/administrador/crear-usuario.php'); ?>" method="POST">
						<div class="flex align-center justify-between input-group">
							<label for="nombre">Nombre</label>
							<input type="text" name="nombre" id="nombre" maxlength="100" value="<?php if(isset($_POST['nombre']) && !isset($validar_formulario['nombre'])){echo $_POST['nombre'];} ?>">
						</div>
						<div class="flex align-center justify-between input-group">
							<label for="apellido">Apellido</label>
							<input type="text" name="apellido" id="apellido" maxlength="100" value="<?php if(isset($_POST['apellido']) && !isset($validar_formulario['apellido'])){echo $_POST['apellido'];} ?>">
						</div>
						<div class="flex align-center justify-between input-group">
							<label for="usuario">Usuario</label>
							<input type="text" name="usuario" id="usuario" value="<?php if(isset($_POST['usuario']) && !isset($validar_formulario['usuario'])){echo $_POST['usuario'];} ?>">
						</div>
						<div class="flex align-center justify-between input-group">
							<label for="password">Password</label>
							<input type="password" name="password" id="password">
						</div>
						<div class="flex align-center justify-between input-group">
							<label for="email">Email</label>
							<input type="email" name="email" id="email" maxlength="100" value="<?php if(isset($_POST['email']) && !isset($validar_formulario['email'])){echo $_POST['email'];} ?>">
						</div>
						<div class="flex align-center justify-between input-group">
							<label for="telefono">Telefono</label>
							<input type="text" name="telefono" id="telefono" maxlength="9" value="<?php if(isset($_POST['telefono']) && !isset($validar_formulario['telefono'])){echo $_POST['telefono'];} ?>">
						</div>
						<div class="flex align-center justify-between input-group">
							<label for="fecha_de_nacimiento">Fecha de Nacimiento</label>
							<input type="date" name="fecha_de_nacimiento" id="fecha_de_nacimiento" value="<?php if(isset($_POST['fecha_de_nacimiento']) && !isset($validar_formulario['fecha_de_nacimiento'])){echo $_POST['fecha_de_nacimiento'];} ?>">
						</div>
						<div class="flex align-center justify-between input-group">
							<label for="direccion">Direccion</label>
							<input type="text" name="direccion" id="direccion" value="<?php if(isset($_POST['direccion']) && !isset($validar_formulario['direccion'])){echo $_POST['direccion'];} ?>">
						</div>
						<div class="flex align-center justify-between input-group">
							<label for="sexo">Sexo</label>
							<input type="text" name="sexo" id="sexo" value="<?php if(isset($_POST['sexo']) && !isset($validar_formulario['sexo'])){echo $_POST['sexo'];} ?>">
						</div>
						<div class="flex align-center justify-between input-group">
							<label for="rol">Rol</label>
							<select name="rol" id="rol" >
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
	include SHARED_PATH. '/footer.php';				//carga el footer
?>