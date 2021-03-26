
<div class="well well-sm text-right">
	<?php
		if ($this->isLoggedIn) {
			echo "<a class='btn btn-primary' href='?c=curso&a=Index'>Listado Cursos</a> ";
			echo "<a class='btn btn-primary' href='?c=alumno&a=Index'>Listado Alumnos</a> ";
			echo "<a class='btn btn-primary' href='?c=anime&a=Index'>Listado Animes</a> ";
			echo "<a class='btn btn-primary' href='?c=usuario&a=Index'>Listado Usuarios</a> ";
			echo "<a class='btn btn-primary' href='?c=main&a=Logout'>Desconectar</a>";
		} else {
			echo "<a class='btn btn-primary' href='?c=main&a=Login'>Login</a> ";
			echo "<a class='btn btn-primary' href='?c=main&a=Register'>Register</a>";
		}
	?>
</div> 
