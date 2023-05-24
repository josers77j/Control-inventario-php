<aside class="main-sidebar">
	 <section class="sidebar">
		<ul class="sidebar-menu">
		<?php

		if($_SESSION["role"] == "Administrador"){
			echo '<li class="active">
				<a href="inicio">
					<i class="fa fa-home"></i>
					<span>Inicio</span>
				</a>
			</li>
			';

		}

		?>
		</ul>

	 </section>

</aside>