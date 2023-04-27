<?php
	require_once '../../private/config.php';	//carga el código config.php
	$titulo_pagina = "Citas Administracion";	//Define el título de la página
	include SHARED_PATH. '/head.php';			//carga los código de la cabecera
	include SHARED_PATH. '/header.php';			//Carga el header

	/*Si la sesión no esta iniciada por un usuario de tipo admin, redirecciona a la página login*/
	if (!isset($_SESSION['rol']) || $_SESSION['rol']!=="admin" || !isset($_SESSION['idUser'])) {
		redirect_to('public/login.php');
	}

?>

<main>	
		<!--Muestra la página "Citas Administración"-->
		<section>
			<div class="container">
				<h2>Citas Administración</h2>
				
				<div class="flex align-center justify-start usuarios">
					<?php
						$usuarios = seleccionar_usuarios($database_connection);
						while ($usuario = $usuarios->fetch_assoc()) {
							$datos_usuario = datos_usuario($database_connection,$usuario['idUser']);
					?>
					<div class="usuario">
						<p><b><?php echo $usuario['nombre'] . " " . $usuario['apellido']; ?></b></p>
						<p><?php echo $datos_usuario['usuario']; ?></p>
						<a class="manage-btn edit-btn" href="<?php echo url_completo('public/administrador/citas-usuario.php?idUser='.$usuario['idUser']); ?>">Ver Citas Usuario</a>
					</div>
					<?php
						}
					?>
				</div>
			</div>
		</section>
	</main>
<?php
	include SHARED_PATH.'/footer.php';		//Carga el pie de la página
?>