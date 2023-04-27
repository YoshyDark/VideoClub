<?php
	require_once '../../private/config.php';		//carga el código config.php
	$titulo_pagina = "Crear Noticia";				//Define el título de la pagina
	include SHARED_PATH. '/head.php';				//carga los código de la cabecera
	include SHARED_PATH. '/header.php';				//Carga el header

	/*Si la sesión no esta iniciada por un usuario de tipo admin, redirecciona a la página login*/
	if (!isset($_SESSION['rol']) || $_SESSION['rol']!=="admin" || !isset($_SESSION['idUser'])) {
		redirect_to('public/login.php');
	}

?>
<?php
	if (isset($_GET['idUser'])) {
		$idUser = $_GET['idUser'];
	}else{
		redirect_to('index.php');
	}
?>
<?php
	if ($_SERVER['REQUEST_METHOD']=="POST") {
		$datos_noticia = [];
		$datos_noticia['idUser'] = $idUser;
		$datos_noticia['titulo'] = $_POST['titulo'] ?? "";
		$datos_noticia['texto'] = $_POST['texto'] ?? "";
		$datos_noticia['fecha'] = $_POST['fecha'] ?? "";

		if (isset($_FILES['imagen']) && $_FILES['imagen']['name']!=="") {
			$directorio_imagenes = 'imagenes/';
			$nombre = $_FILES['imagen']['tmp_name'];
			$destinacion = $directorio_imagenes . basename($_FILES['imagen']['name']);
			if(!move_uploaded_file($nombre, $destinacion)){
				$error_msg = "Error subir fichero imagen";
				$datos_noticia['imagen'] = "";
			}else{
				$datos_noticia['imagen'] = $_FILES['imagen']['name'];
			}
		}else{
			$datos_noticia['imagen'] = "";
		}
		
		if (crear_noticia($database_connection,$datos_noticia)) {
			$success_msg = "La noticia ha sido registrada con exito";
		}else{
			$error_msg = "Error creacion noticia";
		}
	}
?>
	<main>
		<!--En esta sección se creará la noticia -->
		<section>
			<div class="container">
				<h2>Crear Noticia</h2>
				<div class="user-form-wrapper">
					<form action="<?php url_completo('public/administrador/crear-noticia.php?idUser='.$idUser); ?>" method="POST" enctype="multipart/form-data">
					<?php
						if (isset($error_msg)) {
							echo "<div class=\"error-msg\">".$error_msg."</div>";
							header("Refresh:1;noticias-administracion.php?idUser=".$idUser);
						}
						if (isset($success_msg)) {
							echo "<div class=\"success-msg\">".$success_msg."</div>";
							header("Refresh:1;noticias-administracion.php?idUser=".$idUser);
						}
					?>	
						<div class="flex align-center justify-between input-group">
							<label for="titulo">Titulo</label>
							<input type="text" name="titulo" id="titulo">
						</div>
						<div class="flex align-center justify-between input-group">
							<label for="texto">Texto</label>
							<textarea id="texto" name="texto"></textarea>
						</div>
						<div class="flex align-center justify-between input-group">
							<label for="texto">Imagen</label>
							<input type="file" name="imagen" id="imagen">
						</div>
						<div class="flex align-center justify-between input-group">
							<label for="fecha">Fecha</label>
							<input type="date" name="fecha" id="fecha">
						</div>
						<button type="submit">Enviar</button>
						<a class="manage-btn delete-btn" href="<?php echo url_completo('public/administrador/noticias-administracion.php?idUser='.$idUser); ?>">Cancelar</a>
					</form>
				</div>
			</div>
		</section>
	</main>

<?php
	include SHARED_PATH.'/footer.php';  		//carga el footer
?>