<?php
	require_once 'private/config.php'; //cargar el codigo config.php
	$titulo_pagina = "Portada"; //Definir el titulo de la pagina
	include SHARED_PATH. '/head.php'; //cargar los codigo de la cabecera
	include SHARED_PATH. '/header.php';
?>
<main>
	<!--Carga la primera sección de la portada, donde relata un poco acerca de la compañía-->
	<section id="hero">
		<div class="flex align-center justify-center hero-wrapper">
				<h1>PELISFLIX</h1>
				<p>Pelisflix es un servicio de streaming que funciona mediante suscripción y permite a sus usuarios ver series y películas a través de cualquier dispositivo conectado a internet.<br></p>
				<a href="">Saber Mas</a>
			</div>
		<div id="background-overlay"></div>
	</section>
	<!--Carga la segunda sección de la portada acerca de los diferentes planes-->
	<section>
		<div class="flex align-center justify-between section-columns">
			<div class="section-left-column">
				<h2>PLANES DE PELISFLIX</h2>
				<p>Dependiendo de tu plan, también puedes descargar series y películas en cualquier dispositivo iOS, Android o Windows 10 y verlas sin necesidad de conexión a internet.</p>
				<p>Si ya tienes una suscripción y te gustaría obtener más información sobre el uso de Pelisflix, visita Primeros pasos con Pelisflix.</p>
			</div>
			<div class="section-right-column">
				<img src="<?php echo url_completo('assets/img/20210710150159_RTPA981743.jpg'); ?>">
			</div>
		</div>
	</section>
	<!--Carga la tercera sección de la portada, acerca de las tiendas y el compromiso de la empresa-->
	<section>
		<div class="flex align-center justify-between section-columns">
			<div class="section-left-column">
				<img src="<?php echo url_completo('assets/img/_101_b95a978e.jpg'); ?>">
			</div>
			<div class="section-right-column">
				<h2>VISITE NUESTRAS TIENDAS</h2>
				<p>Llevamos más de 17 años a tu lado, construyendo y adaptándonos a lo que necesitas a medida que hemos ido avanzando.</p>
				<p>No obstante, no es tanto todo lo que hemos hecho sino nuestra manera de hacerlo. Por ello, queremos que tengas claro que puedes esperar de nosotros y en qué centramos nuestros esfuerzos día a día. Para que sepas que puedes esperar de Pelisflix si decides formar parte de esta familia.</p>
			</div>
		</div>
	</section>
</main>
<?php
	include SHARED_PATH. '/footer.php';//Cargar el pie de la pagina
?>