<body>
	<!--Este es el header de todas las páginas-->
	<header>
		<div class="container">
			<div class="flex align-center justify-between header-wrapper">
				<div class="header-logo"></div>
				<nav>
					<ul class="flex align-center justify-between nav-links">
						<li class="nav-link"><a class="<?php if($titulo_pagina=="Portada"){echo "active-link";} ?>" href="<?php echo url_completo('index.php'); ?>">Portada</a></li>
						<li class="nav-link"><a class="<?php if($titulo_pagina=="Noticias"){echo "active-link";} ?>" href="<?php echo url_completo('public/noticias.php'); ?>">Noticias</a></li>
						<?php
							if (isset($_SESSION['rol']) && $_SESSION['rol']=="user") { //Carga los enlaces apropiados (Citaciones y Perfil) si la sesión es iniciada por un usuario de tipo "user"
						?>
						<li class="nav-link"><a class="<?php if($titulo_pagina=="Citas"){echo "active-link";} ?>" href="<?php echo url_completo('public/usuario/citas.php?idUser='.$_SESSION['idUser']); ?>">Citaciones</a></li>
						<li class="nav-link"><a class="<?php if($titulo_pagina=="Perfil"){echo "active-link";} ?>" href="<?php echo url_completo('public/perfil.php?idUser='.$_SESSION['idUser']); ?>">Perfil</a></li>
						<li class="nav-link"><a  href="<?php echo url_completo('public/logout.php'); ?>">Cerrar Sesion</a></li>
						<?php
							}elseif(isset($_SESSION['rol']) && $_SESSION['rol']=="admin"){ //Carga los enlaces apropiados(Usuarios, Citaciones y Noticias Administración, y Perfil) si la sesión es iniciada por un usuario de tipo "admin"
						?>
						<li class="nav-link"><a class="<?php if($titulo_pagina=="Usuarios Administracion"){echo "active-link";} ?>" href="<?php echo url_completo('public/administrador/usuarios-administracion.php'); ?>">Usuarios Administración</a></li>
						<li class="nav-link"><a class="<?php if($titulo_pagina=="Citas Administracion"){echo "active-link";} ?>" href="<?php echo url_completo('public/administrador/citas-administracion.php'); ?>">Citaciones Administración</a></li>
						<li class="nav-link"><a class="<?php if($titulo_pagina=="Noticias Administracion"){echo "active-link";} ?>" href="<?php echo url_completo('public/administrador/noticias-administracion.php?idUser='.$_SESSION['idUser']); ?>">Noticias Administración</a></li>
						<li class="nav-link"><a class="<?php if($titulo_pagina=="Perfil"){echo "active-link";} ?>" href="<?php echo url_completo('public/perfil.php?idUser='.$_SESSION['idUser']); ?>">Perfil</a></li>
						<li class="nav-link"><a href="<?php echo url_completo('public/logout.php'); ?>">Cerrar Sesion</a></li>
						<?php
							}else{ //Carga los enlaces para "registro" y "Inicio de Sesión" si no hay una sesion iniciada
						?>
						<li class="nav-link"><a class="<?php if($titulo_pagina=="Registro"){echo "active-link";} ?>" href="<?php echo url_completo('public/registro.php'); ?>">Registro</a></li>
						<li class="nav-link"><a class="<?php if($titulo_pagina=="Login"){echo "active-link";} ?>" href="<?php echo url_completo('public/login.php'); ?>">Inicio de Sesión</a></li>
						<?php
							}
						?>
					</ul>
				</nav>
			</div>
		</div>
	</header>