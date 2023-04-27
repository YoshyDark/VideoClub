<?php
	require_once '../../private/config.php';			//carga el código config.php
	$titulo_pagina = "Citas";							//Define el título de la página
	include SHARED_PATH. '/head.php';					//carga los código de la cabecera
	include SHARED_PATH. '/header.php';					//Carga el header

	/*Si la sesión no esta iniciada por un usuario de tipo user, redirecciona a la página login*/
	if (!isset($_SESSION['rol']) || $_SESSION['rol']!=="user" || !isset($_SESSION['idUser'])) {
		redirect_to('public/login.php');
	}

?>
<?php
	if (isset($_GET['idUser'])) {
		$idUser = $_GET['idUser'];
		$citas_usuario = citas_usuario($database_connection,$idUser);		//Recuperar los datos de citas del usuario pasando su idUser a la consulta
	}else{
		redirect_to('index.php');
	}
?>

<?php 
	if (isset($_GET['accion']) && $_GET['accion']=="borrar") {				//Borrar la cita recuperando el idCita y la accion=borrar desde el enlace
		if (isset($_GET['idCita'])) {
			if (borrar_cita($database_connection,$_GET['idCita'])) {
				$success_msg = "La cita ha sido borrada con exito";
			}else{
				$error_msg = "Error borrar cita...";
			}
		}else{
			redirect_to('public/usuario/citas.php?idUser='.$idUser);
		}
	}
?>
	<main>
		<!--Muestra las citas de cada usuario con rol "user"-->
		<section>
			<div class="container">
				<h2>Mis Citas</h2>
				<a class="manage-btn add-btn" href="<?php echo url_completo('public/usuario/solicitar_cita.php?idUser='.$idUser) ?>">Solicitar Cita</a>
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
				<div class="flex align-stretch jutify-start citas">
					<?php
						while ($cita_usuario = $citas_usuario->fetch_assoc()) {
							$idCita = $cita_usuario['idCita'];
					?>
					<div class="cita">
						<p><b><?php echo $cita_usuario['fecha_cita']; ?></b></p>
						<p><?php echo $cita_usuario['motivo_cita']; ?></p>
						<?php
							$fecha_hoy = date("Y-m-d");
							$fecha_cita = $cita_usuario['fecha_cita'];

							if ($fecha_cita >= $fecha_hoy) {		//Si la cita no es en el dia anterior de hoy
						?>
							<!-- pasa el idUser y idCita para modificar la cita -->
							<a class="manage-btn edit-btn" href="<?php echo url_completo('public/usuario/modificar_cita.php?idUser='.$idUser.'&idCita='.$idCita) ?>">Modificar Cita</a>
						<?php
							}else{
								echo "<p class=\"error-msg\">La cita ya ha pasado</p>";
							}
						?>
						<!-- pasa el idUser y idCita y accion=borrar para borrar la cita -->
						<a class="manage-btn delete-btn" href="<?php echo url_completo('public/usuario/citas.php?idUser='.$idUser.'&idCita='.$idCita.'&accion=borrar'); ?>">Borrar Cita</a>
					</div>
					<?php
						}
					?>
				</div>
			</div>
		</section>
	</main>
<?php
	include SHARED_PATH.'/footer.php';		//Cargar el pie de la pagina
?>