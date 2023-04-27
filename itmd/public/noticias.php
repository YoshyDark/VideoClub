<?php
	require_once '../private/config.php';//cargar el codigo config.php
	$titulo_pagina = "Noticias";//Definir el titulo de la pagina
	include SHARED_PATH. '/head.php';//cargar los codigo de la cabecera
	include SHARED_PATH. '/header.php';

?>
	<main>
		<section>
			<div class="container">
				<h2>Noticias</h2>
				<div class="flex justify-start align-stretch noticias">
					<?php
						$noticias = seleccionar_noticias($database_connection); //Cargar los datos de todas las noticias
						while ($noticia = $noticias->fetch_assoc()) {//Mostrar cada noticia
							$datos_user = datos_usuario($database_connection,$noticia['idUser']);
					?>
					<div class="noticia">
						<p><b><?php echo $noticia['titulo']; ?></b></p>
						<img src="<?php echo url_completo('public/administrador/imagenes/'.$noticia['imagen']); ?>">
						<p><?php echo $noticia['texto']; ?></p>
						<p><?php echo $noticia['fecha']; ?></p>
						<p>Noticia creada por: <?php echo $datos_user['usuario']; ?></p>
					</div>
					<?php
						}
					?>
				</div>
			</div>
		</section>
	</main>


<?php
	include SHARED_PATH.'/footer.php';//Cargar el pie de la pagina
?>