<?php
	require_once '../../private/config.php';		//carga el código config.php
	$titulo_pagina = "Noticias Administracion";		//Define el título de la pagina
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
	if (isset($_GET['accion']) && $_GET['accion']=="borrar") {
		if (isset($_GET['idNoticia'])) {
			$datos_noticia = datos_noticia($database_connection,$_GET['idNoticia']);
			if (borrar_noticia($database_connection,$_GET['idNoticia'])) {
				/********Borrar la imagen de la noticia del directorio**********/
				if (file_exists('imagenes/'.$datos_noticia['imagen'])) {
					unlink('imagenes/'.$datos_noticia['imagen']);
				}
				redirect_to('public/administrador/noticias-administracion.php?idUser='.$idUser);
			}
		}else{
			redirect_to('public/administrador/noticias-administracion.php?idUser='.$idUser);
		}
	}
?>
<main>	<!--En esta sección aparecen las noticias a administrar-->
		<section>
			<div class="container">
				<h2>Mis Noticias</h2>
				<a class="manage-btn add-btn" href="<?php echo url_completo('public/administrador/crear-noticia.php?idUser='.$idUser); ?>">Crear Noticia</a>
				<div class="flex align-stretch justify-between noticias">
					<?php
						$noticias = seleccionar_noticias($database_connection);
						while ($noticia = $noticias->fetch_assoc()) {
							$idNoticia = $noticia['idNoticia'];
					?>
					<div class="noticia">
						<p class="text-center"><b><?php echo $noticia['titulo']; ?></b></p>
						<img src="<?php echo url_completo('public/administrador/imagenes/'.$noticia['imagen']); ?>">
						<p><?php echo $noticia['texto']; ?></p>
						<p><?php echo $noticia['fecha']; ?></p>
						<a class="manage-btn edit-btn" href="<?php echo url_completo('public/administrador/modificar-noticia.php?idUser='.$idUser."&idNoticia=".$idNoticia); ?>">Modificar Noticia</a>
						<a class="manage-btn delete-btn" href="<?php echo url_completo('public/administrador/noticias-administracion.php?idUser='.$idUser.'&idNoticia='.$idNoticia.'&accion=borrar'); ?>">Borrar Noticia</a>
					</div>
					<?php
						}
					?>
				</div>
			</div>
		</section>
	</main>
<?php
	include SHARED_PATH.'/footer.php';		//carga el footer
?>