<?php
	require_once '../../private/config.php';			//carga el código config.php
	$titulo_pagina = "Solicitar Cita";					//Define el título de la página
	include SHARED_PATH. '/head.php';					//carga los código de la cabecera
	include SHARED_PATH. '/header.php';					//Carga el header

	/*Si la sesión no esta iniciada por un usuario de tipo user, redirecciona a la página login*/
	if (!isset($_SESSION['rol']) || $_SESSION['rol']!=="user" || !isset($_SESSION['idUser'])) {
		redirect_to('public/login.php');
	}
?>
<?php
	//Recuperar el idUser desde el enlace
	if (isset($_GET['idUser'])) {
		$idUser = $_GET['idUser'];
	}else{
		redirect_to('index.php');
	}
?>
<?php
	if ($_SERVER['REQUEST_METHOD']=="POST") {				//Procesar las entradas del formulario
		$datos_cita = [];
		$datos_cita['idUser'] = $idUser;
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
		<!--Sección donde podremos solicitar citas-->
		<section>
			<div class="container">
				<h2>Solicitar Cita</h2>
				<div class="user-form-wrapper">
					<form action="<?php url_completo('public/usuario/solicitar_cita.php?idUser='.$idUser); ?>" method="POST">
					<?php
						if (isset($error_msg)) {
							//Mostrar el mensaje error y redireccionar a las citas
							echo "<div class=\"error-msg\">".$error_msg."</div>";
							header("Refresh:1;citas.php?idUser=".$idUser);
						}
						if (isset($success_msg)) {
							//Mostrar el mensaje exito y redireccionar a las citas
							echo "<div class=\"success-msg\">".$success_msg."</div>";
							header("Refresh:1;citas.php?idUser=".$idUser);
						}
					?>	
						<div class="flex align-center justify-between input-group">
							<label for="fecha_cita">Fecha Cita</label>
							<input type="date" name="fecha_cita" id="fecha_cita" min="<?php echo date("Y-m-d"); ?>">
						</div>
						<div class="flex align-center justify-between input-group">
							<label for="motivo_cita">Motivo Cita</label>
							<input type="text" name="motivo_cita" id="motivo_cita" >
						</div>
						<button type="submit">Enviar</button>
						<a class="manage-btn delete-btn" href="<?php echo url_completo('public/usuario/citas.php?idUser='.$idUser); ?>">Cancelar</a>
					</form>
				</div>
			</div>
		</section>
	</main>

<?php
	include SHARED_PATH.'/footer.php';			//Cargar el pie de la pagina
?>