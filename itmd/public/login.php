<?php
	require_once '../private/config.php';//cargar el codigo config.php
	$titulo_pagina = "Login";//Definir el titulo de la pagina
	include SHARED_PATH. '/head.php';//cargar los codigo de la cabecera
	include SHARED_PATH. '/header.php';

?>

<?php
	if ($_SERVER['REQUEST_METHOD']=="POST") { //Procesar las entradas del formulario
		$datos_login = [];
		$datos_login['usuario'] = $_POST['usuario'] ?? "";
		$datos_login['password'] = $_POST['password'] ?? "";

		if(iniciar_sesion($database_connection,$datos_login)){ //Pasar las entradas a la funcion
			$success_msg = "El usuario se ha conectado con éxito"; //Declarar el mensaje exito
		}else{
			$error_msg = "El usuario y/o la contraseña son incorrectos"; //Declarar el mensaje error
		}
		
	}

?>
	<main>
		<section>
			<div class="container">
				<h1>Login Usuario</h1>
				<div class="user-form-wrapper">
					<p>Aun no tienes cuenta? <a href="<?php echo url_completo('public/registro.php'); ?>">Registrarse</a></p>
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
					<form action="<?php url_completo('public/login.php'); ?>" method="POST">
						<div class="flex align-center justify-between input-group">
							<label for="usuario">Usuario</label>
							<input type="text" name="usuario" id="usuario">
						</div>
						<div class="flex align-center justify-between input-group">
							<label for="password">Password</label>
							<input type="password" name="password" id="password">
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