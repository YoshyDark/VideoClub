<?php
	require_once '../private/config.php';//cargar el codigo config.php
	$titulo_pagina = "Perfil";//Definir el titulo de la pagina
	include SHARED_PATH. '/head.php';//cargar los codigo de la cabecera
	include SHARED_PATH. '/header.php';

	if (!isset($_SESSION['rol']) || !isset($_SESSION['idUser'])) {//Redireccionar la pagina login si el usuario no ha iniciado sesion
		redirect_to('public/login.php');
	}
?>

<?php
	if (isset($_GET['idUser'])) {
		$idUser = $_GET['idUser'];
		$usuario = datos_usuario($database_connection,$idUser);//Recuperar los datos del usuario pasando su idUser a la consulta
	}else{
		//Redireccionar a la portada si el idUser no esta definido
		redirect_to('index.php');
	}
?>

<?php
	if ($_SERVER['REQUEST_METHOD']=="POST") {//Procesar las entradas del formulario
		$datos_perfil = [];
		$datos_perfil['nombre'] = $_POST['nombre'] ?? "";
		$datos_perfil['apellido'] = $_POST['apellido'] ?? "";
		$datos_perfil['password_actual'] = $_POST['password_actual'] ?? "";
		$datos_perfil['password'] = $_POST['password'] ?? "";
		$datos_perfil['email'] = $_POST['email'] ?? "";
		$datos_perfil['telefono'] = $_POST['telefono'] ?? "";
		$datos_perfil['fecha_de_nacimiento'] = $_POST['fecha_de_nacimiento'] ?? "";
		$datos_perfil['direccion'] = $_POST['direccion'] ?? "";
		$datos_perfil['sexo'] = $_POST['sexo'] ?? "";

		$validar_formulario = validar_formulario($datos_perfil);

		if (password_verify($datos_perfil['password_actual'], $usuario['password'])) {
			if (!is_array($validar_formulario)) {
				if (modificar_perfil($database_connection,$idUser,$datos_perfil)) {//Pasar las entradas a la funcion
					$success_msg =  "Tu perfil se ha actualizado con exito";
				}else{
					$error_msg = "Error modificacion del perfil";
				}
			}else{
				$error_msg = implode("<br>", array_values($validar_formulario) );
			}
		}else{
			$error_msg = "El password actual introducido es incorrecto";
		}
		
		
	}

?>
	<main>
		<section>
			<div class="container">
				<h1>Perfil</h1>
				<div class="user-form-wrapper">
					<?php
						if (isset($error_msg)) {
							//Mostrar el mensaje error y redireccionar a la portada
							echo "<div class=\"error-msg\">".$error_msg."</div>";
						}
						if (isset($success_msg)) {
							//Mostrar el mensaje exito y redireccionar a la portada
							echo "<div class=\"success-msg\">".$success_msg."</div>";
							header("Refresh:1;url=".url_completo('index.php'));
						}
					?>
					<form action="<?php url_completo('public/perfil.php?idUser='.$idUser); ?>" method="POST">
						<div class="flex align-center justify-between input-group">
							<label for="nombre">Nombre</label>
							<input type="text" name="nombre" id="nombre" maxlength="100" value="<?php echo $usuario['nombre']; ?>">
						</div>
						<div class="flex align-center justify-between input-group">
							<label for="apellido">Apellido</label>
							<input type="text" name="apellido" id="apellido" maxlength="100" value="<?php echo $usuario['apellido']; ?>">
						</div>
						<div class="flex align-center justify-between input-group">
							<label for="usuario">Usuario</label>
							<input type="text" name="usuario" id="usuario" disabled value="<?php echo $usuario['usuario']; ?>">
						</div>
						<div class="flex align-center justify-between input-group">
							<label for="password">Password Actual</label>
							<input type="password" name="password_actual" id="password_actual">
						</div>
						<div class="flex align-center justify-between input-group">
							<label for="password">Password Nuevo</label>
							<input type="password" name="password" id="password">
						</div>
						<div class="flex align-center justify-between input-group">
							<label for="email">Email</label>
							<input type="email" name="email" id="email" maxlength="100" value="<?php echo $usuario['email']; ?>">
						</div>
						<div class="flex align-center justify-between input-group">
							<label for="telefono">Telefono</label>
							<input type="text" name="telefono" id="telefono" maxlength="9" value="<?php echo $usuario['telefono']; ?>">
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
						<button type="submit">Enviar</button>
					</form>
				</div>
			</div>
		</section>
	</main>
<?php
	include SHARED_PATH.'/footer.php';//Cargar el pie de la pagina
?>