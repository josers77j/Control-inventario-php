<aside class="main-sidebar">
	 <section class="sidebar">
		<ul class="sidebar-menu">
		<?php

		if($_SESSION["role"] == "Administrador"){
			echo '
			<li class="active">
				<a href="inicio">
					<i class="fa fa-home"></i>
					<span>Inicio</span>
				</a>
			</li>

			<li>
				<a href="usuarios">
					<i class="fa fa-user"></i>
					<span>Usuarios</span>
				</a>
			</li>

			<li>
				<a href="role">
					<i class="fa fa-key"></i>
					<span>Roles</span>
				</a>
			</li>

			<li>
				<a href="productos">
					<i class="fa fa-product-hunt"></i>
					<span>Productos</span>
				</a>
			</li>

			';

		}

		?>
		</ul>

	 </section>

</aside>