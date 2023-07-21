<aside class="main-sidebar">
	<section class="sidebar">
		<ul class="sidebar-menu">
			<?php

			if ($_SESSION["role"] == "Usuario") {
				echo '
				<li class="active">
						<a href="inicio">
							<i class="fa fa-home"></i>
							<span>Inicio</span>
						</a>
				</li>
				
				<li>
					<a href="categorias">
					<i class="fa fa-th"></i>
						<span>Categorias</span>
					</a>
				</li>

				<li>
					<a href="productos">
						<i class="fa fa-product-hunt"></i>
						<span>Productos</span>
					</a>
				</li>

				<li>
					<a href="inventario">
						<i class="fa fa-product-hunt"></i>
						<span>Inventario</span>
					</a>
				</li>

				<li>
					<a href="gestorprograma">
					<i class="fa fa-cubes" aria-hidden="true"></i>
						<span>Gestionar Programas</span>
					</a>
				</li>				
				
				';
			}

			if ($_SESSION["role"] == "Administrador") {
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
						<i class="fa fa-address-card" aria-hidden="true"></i>
							<span>Roles</span>
						</a>
					</li>

					<li>
						<a href="categorias">
						<i class="fa fa-th"></i>
							<span>Categorias</span>
						</a>
					</li>
										
					<li>
						<a href="productos">
							<i class="fa fa-product-hunt"></i>
							<span>Productos</span>
						</a>
					</li>
					
					<li>
						<a href="inventario">
						<i class="fa fa-list-alt" aria-hidden="true"></i>
							<span>Inventario</span>
						</a>
					</li>					

					<li>
						<a href="programas">
						<i class="fa fa-archive" aria-hidden="true"></i>
							<span>Programas</span>
						</a>
					</li>
					
					<li>
						<a href="gestorprograma">
						<i class="fa fa-cubes" aria-hidden="true"></i>
							<span>Gestionar Programas</span>
						</a>
					</li>				
				

					
			';
			}

			?>
		</ul>

	</section>

</aside>