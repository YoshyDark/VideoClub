<?php
	require_once '../../private/config.php';		//carga el código config.php
	$titulo_pagina = "Usuarios Administracion";		//Define el título de la pagina
	include SHARED_PATH. '/head.php';				//carga los código de la cabecera
	include SHARED_PATH. '/header.php';				//Carga el header

	/*Si la sesión no esta iniciada por un usuario de tipo admin, redirecciona a la página login*/
	if (!isset($_SESSION['rol']) || $_SESSION['rol']!=="admin" || !isset($_SESSION['idUser'])) {
		redirect_to('public/login.php');
	}

?>
<?php 
	if (isset($_GET['accion']) && $_GET['accion']=="borrar") {
		if (isset($_GET['idUser'])) {
			if (borrar_usuario($database_connection,$_GET['idUser'])) {
				redirect_to('public/administrador/usuarios-administracion.php');
			}
		}else{
			rredirect_to('public/administrador/usuarios-administracion.php');
		}
	}
?>
<main>	<!--En esta sección se muestran todos los usuarios creados, y que podremos modificar-->
		<section>
			<div class="container">
				<h2>Usuarios</h2>
				<a class="manage-btn add-btn" href="<?php echo url_completo('public/administrador/crear-usuario.php') ?>">Crear Usuario</a>
				<div class="flex align-center justify-start usuarios">
					<?php
						$usuarios = seleccionar_usuarios($database_connection);
						while ($usuario = $usuarios->fetch_assoc()) {
					?>
					<div class="usuario">
						<p><b><?php echo $usuario['nombre'] . " " . $usuario['apellido']; ?></b></p>
						<p>Email: <?php echo $usuario['email']; ?></p>
						<p>Telefono: <?php echo $usuario['telefono']; ?></p>
						<p>Fecha de Nacimiento: <?php echo $usuario['fecha_de_nacimiento']; ?></p>
						<p>Direccion: <?php echo $usuario['direccion']; ?></p>
						<p>Sexo: <?php echo $usuario['sexo']; ?></p>
						<a class="manage-btn edit-btn" href="<?php echo url_completo('public/administrador/modificar-usuario.php?idUser='.$usuario['idUser']); ?>">Modificar Usuario</a>
						<a class="manage-btn delete-btn" href="<?php echo url_completo('public/administrador/usuarios-administracion.php?idUser='.$usuario['idUser'].'&accion=borrar'); ?>">Borrar Usuario</a>
					</div>
					<?php
						}
					?>
				</div>
			</div>
		</section>
	</main>
<?php
	include SHARED_PATH.'/footer.php';				//carga el footer
?>