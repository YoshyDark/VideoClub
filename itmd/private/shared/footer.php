	<!--Este es el footer con la dirección, derechos, y redes sociales de mi página-->
	<footer>
		<div class="footer-wrapper">
			<p class="text-center">Paseo de la Castellana 89, 28046 Madrid (España)</p>
			<p class="text-center">--------------------------------------------------------------------------------</p>
			<p class="text-center">© 2023 Pelisflix Todos los derechos reservados. Todas las marcas registradas pertenecen a sus respectivos dueños en EE. UU. y otros países. Todos los precios incluyen IVA </p>
			<p class="text-center">--------------------------------------------------------------------------------</p>
			<ul class="flex justify-center align-center social-icons">
				<li class="social-icon"><a href="https://es-es.facebook.com"><img src="<?php echo url_completo('assets/img/facebook.png'); ?>"></a></li>
				<li class="social-icon"><a href="https://www.instagram.com/"><img src="<?php echo url_completo('assets/img/instagram.png'); ?>"></a></li>
				<li class="social-icon"><a href="https://twitter.com/?lang=es"><img src="<?php echo url_completo('assets/img/twitter.png'); ?>"></a></li>
				<li class="social-icon"><a href="https://www.linkedin.com/"><img src="<?php echo url_completo('assets/img/linkedin.png'); ?>"></a></li>
				<li class="social-icon"><a href="https://www.youtube.com/"><img src="<?php echo url_completo('assets/img/youtube.png'); ?>"></a></li>
			</ul>
		</div>
		
	</footer>
</body>
<script type="text/javascript"></script>
</html>
<?php
	close_database_connection($database_connection);//Cierra la conexion a la base de datos
?>