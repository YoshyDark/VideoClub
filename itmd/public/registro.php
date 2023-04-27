<?php
	require_once '../private/config.php';//cargar el codigo config.php
	$titulo_pagina = "Registro";//Definir el titulo de la pagina
	include SHARED_PATH. '/head.php';//cargar los codigo de la cabecera
	include SHARED_PATH. '/header.php';

?>

<?php
	if ($_SERVER['REQUEST_METHOD']=="POST") {//Procesar las entradas del formulario
		$datos_registro = [];
		$datos_registro['nombre'] = $_POST['nombre'] ?? "";
		$datos_registro['apellido'] = $_POST['apellido'] ?? "";
		$datos_registro['usuario'] = $_POST['usuario'] ?? "";
		$datos_registro['password'] = $_POST['password'] ?? "";
		$datos_registro['rol'] = "user";
		$datos_registro['email'] = $_POST['email'] ?? "";
		$datos_registro['telefono'] = $_POST['telefono'] ?? "";
		$datos_registro['fecha_de_nacimiento'] = $_POST['fecha_de_nacimiento'] ?? "";
		$datos_registro['direccion'] = $_POST['direccion'] ?? "";
		$datos_registro['sexo'] = $_POST['sexo'] ?? "";

		$validar_formulario = validar_formulario($datos_registro);

		if (!verificar_usuario_existe($database_connection,$datos_registro)) {
			if (!is_array($validar_formulario)) {
				if(registrar_usuario($database_connection,$datos_registro)){//Pasar las entradas a la funcion
					$success_msg = "El usuario ha sido creado con exito";//Declarar el mensaje exito
				}else{
					$error_msg = "Error creacion usuario...";//Declarar el mensaje error
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
		<section>
			<div class="container">
				<h1>Registro Usuario</h1>
				<div class="user-form-wrapper">
					<p>Ya tienes una cuenta? <a href="<?php echo url_completo('public/login.php'); ?>">Inicio de Sesion</a></p>
					<?php
						if (isset($error_msg)) {
							//Mostrar el mensaje error y redireccionar a la portada
							echo "<div class=\"error-msg\">".$error_msg."</div>";
						}
						if (isset($success_msg)) {
							//Mostrar el mensaje exito y redireccionar a la portada
							echo "<div class=\"success-msg\">".$success_msg."</div>";
							header("Refresh:1;url=".url_completo('public/login.php'));
						}
					?>
					<form action="<?php url_completo('public/registro.php'); ?>" method="POST">
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
							<input type="password" name="password" id="password" >
						</div>
						<div class="flex align-center justify-between input-group">
							<label for="email">Email</label>
							<input type="text" name="email" id="email" maxlength="100" value="<?php if(isset($_POST['email']) && !isset($validar_formulario['email'])){echo $_POST['email'];} ?>">
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
						<button type="submit">Enviar</button>
					</form>
				</div>
			</div>
		</section>
	</main>
<?php
	include SHARED_PATH. '/footer.php';//Cargar el pie de la pagina
?>