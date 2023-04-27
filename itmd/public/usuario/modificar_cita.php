<?php
	require_once '../../private/config.php';			//carga el código config.php
	$titulo_pagina = "Modificar Citas";					//Define el título de la página
	include SHARED_PATH. '/head.php';					//carga los código de la cabecera
	include SHARED_PATH. '/header.php';					//Carga el header

	/*Si la sesión no esta iniciada por un usuario de tipo user, redirecciona a la página login*/
	if (!isset($_SESSION['rol']) || $_SESSION['rol']!=="user" || !isset($_SESSION['idUser'])) {
		redirect_to('public/login.php');
	}
?>
<?php
	if (isset($_GET['idUser']) && isset($_GET['idCita'])) {
		$idUser = $_GET['idUser'];
		$idCita = $_GET['idCita'];
		$cita = datos_cita($database_connection,$idUser,$idCita);			//Recuperar los datos de de la cita del usuario pasando su idUser y idCita a la consulta
	}else{
		redirect_to('index.php');
	}
?>
<?php
	if ($_SERVER['REQUEST_METHOD']=="POST") {						//Procesar las entradas del formulario
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
<main>	<!--En esta sección podremos modificar la cita-->
		<section>
			<div class="container">
				<h2>Modificar Cita</h2>
				<div class="user-form-wrapper">
					<form action="<?php url_completo('public/usuario/modificar_cita.php?idUser='.$idUser.'&idCita='.$idCita); ?>" method="POST">
					<?php
						if (isset($error_msg)) {
							echo "<div class=\"error-msg\">".$error_msg."</div>";
							header("Refresh:1;citas.php?idUser=".$idUser);
						}
						if (isset($success_msg)) {
							echo "<div class=\"success-msg\">".$success_msg."</div>";
							header("Refresh:1;citas.php?idUser=".$idUser);
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
						<a class="manage-btn delete-btn" href="<?php echo url_completo('public/usuario/citas.php?idUser='.$idUser); ?>">Cancelar</a>
					</form>
				</div>
			</div>
		</section>
	</main>

<?php
	include SHARED_PATH.'/footer.php';			//Cargar el pie de la pagina
?>