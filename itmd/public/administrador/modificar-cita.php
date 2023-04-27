<?php
	require_once '../../private/config.php';		//carga el código config.php
	$titulo_pagina = "Modificar Cita";				//Define el título de la pagina
	include SHARED_PATH. '/head.php';				//carga los código de la cabecera
	include SHARED_PATH. '/header.php';				//Carga el header

	/*Si la sesión no esta iniciada por un usuario de tipo admin, redirecciona a la página login*/
	if (!isset($_SESSION['rol']) || $_SESSION['rol']!=="admin" || !isset($_SESSION['idUser'])) {
		redirect_to('public/login.php');
	}
?>
<?php
	if (isset($_GET['idUser']) && isset($_GET['idCita'])) {
		$idUser = $_GET['idUser'];
		$idCita = $_GET['idCita'];
		$cita = datos_cita($database_connection,$idUser,$idCita);

		$fecha_hoy = date("Y-m-d");
		$fecha_cita = $cita['fecha_cita'];

		if ($fecha_cita < $fecha_hoy) {				//Si la cita es del dia anterior
			redirect_to('public/administrador/citas-administracion.php');
		}
	}else{
		redirect_to('index.php');
	}
?>
<?php
	if ($_SERVER['REQUEST_METHOD']=="POST") {
		$datos_cita = [];
		$datos_cita['fecha_cita'] = $_POST['fecha_cita'] ?? "";
		$datos_cita['motivo_cita'] = $_POST['motivo_cita'] ?? "";

		if(modificar_cita($database_connection,$idUser,$idCita,$datos_cita)){
			$success_msg = "La cita ha sido modificada con exito";
		}else{
			$error_msg = "Error modificacion cita...";
		}
	}
?>
<main>	<!--Sección donde modificaremos la cita (su fecha y motivo)-->
		<section>
			<div class="container">
				<h2>Modificar Cita</h2>
				<div class="user-form-wrapper">
					<form action="<?php url_completo('public/administrador/modificar-cita.php?idUser='.$idUser.'&idCita='.$idCita); ?>" method="POST">
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
							<label for="fecha_cita">Fecha Cita</label>
							<input type="date" name="fecha_cita" id="fecha_cita" value="<?php echo $cita['fecha_cita'] ?>" min="<?php echo date("Y-m-d"); ?>">
						</div>
						<div class="flex align-center justify-between input-group">
							<label for="motivo_cita">Motivo Cita</label>
							<input type="text" name="motivo_cita" id="motivo_cita"  value="<?php echo $cita['motivo_cita'] ?>">
						</div>
						<button type="submit">Enviar</button>
						<a class="manage-btn delete-btn" href="<?php echo url_completo('public/administrador/citas-usuario.php?idUser='.$idUser); ?>">Cancelar</a>
					</form>
				</div>
			</div>
		</section>
	</main>

<?php
	include SHARED_PATH.'/footer.php';			//carga el footer
?>