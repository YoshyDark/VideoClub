<?php
	require_once '../../private/config.php';		//carga el código config.php
	$titulo_pagina = "Crear Cita";					//Define el título de la pagina
	include SHARED_PATH. '/head.php';				//carga los código de la cabecera
	include SHARED_PATH. '/header.php';				//Carga el header

	/*Si la sesion no está iniciada por un usuario de tipo admin, redirecciona a la página login*/
	if (!isset($_SESSION['rol']) || $_SESSION['rol']!=="admin" || !isset($_SESSION['idUser'])) {
		redirect_to('public/login.php');
	}
?>
<?php
	if ($_SERVER['REQUEST_METHOD']=="POST") {			//Procesa las entradas del formulario
		$datos_cita = [];
		$datos_cita['idUser'] = $_POST['idUser'] ?? "";
		$datos_cita['fecha_cita'] = $_POST['fecha_cita'] ?? "";
		$datos_cita['motivo_cita'] = $_POST['motivo_cita'] ?? "";

		if(crear_cita($database_connection,$datos_cita)){
			$success_msg = "La cita ha sido registrada con exito";
		}else{
			$error_msg = "Error creacion cita...";
		}
	}
?>
	<main>
		<!--Página para crear citas para un usuario (que podrá ser elegido entre los que estén creados)-->
		<section>
			<div class="container">
				<h2>Crear Cita</h2>
				<a class="error-msg" href="<?php echo url_completo('public/administrador/citas-administracion.php') ?>">Volver Atras</a>
				<div class="user-form-wrapper">
					<form action="<?php url_completo('public/administrador/crear-cita.php'); ?>" method="POST">
					<?php
						if (isset($error_msg)) {
							echo "<div class=\"error-msg\">".$error_msg."</div>";
							header("Refresh:1;citas-administracion.php");
						}
						if (isset($success_msg)) {
							echo "<div class=\"success-msg\">".$success_msg."</div>";
							header("Refresh:1;citas-administracion.php");
						}
					?>	
						<div class="flex align-center justify-between input-group">
							<label for="idUser">Usuario</label>
							<select name="idUser" id="idUser">
							<?php
								$usuarios = seleccionar_usuarios($database_connection);
								while ($usuario = $usuarios->fetch_assoc()) {
									$datos_usuario = datos_usuario($database_connection,$usuario['idUser']);
							?>
								<option value="<?php echo $usuario['idUser']; ?>"><?php echo $datos_usuario['usuario']; ?></option>
							<?php
								}
							?>
							</select>
						</div>
						
						<div class="flex align-center justify-between input-group">
							<label for="fecha_cita">Fecha Cita</label>
							<input type="date" name="fecha_cita" id="fecha_cita" min="<?php echo date("Y-m-d"); ?>">
						</div>
						<div class="flex align-center justify-between input-group">
							<label for="motivo_cita">Motivo Cita</label>
							<input type="text" name="motivo_cita" id="motivo_cita" >
						</div>
						<button type="submit">Enviar</button>
					</form>
				</div>
			</div>
		</section>
	</main>

<?php
	include SHARED_PATH.'/footer.php';			//Carga el pie de la pagina
?>