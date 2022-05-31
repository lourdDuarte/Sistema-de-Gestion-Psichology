
<?php
require_once '../../menu.php';
require_once '../../class/Profesional.php';


$listadoProfesionales=Profesional::obtenerTodos();




?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
 

	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
	<script src="/programacion3/Gestion/static/lib/select/select2.min.js"></script>
	

</head>


<body>
	<section id="main-content">
		<section class="wrapper">
			<br><br>
	 		<a href="informe/informeTurno.php">
				<button type="button" class="btn btn-primary btn-sm">Informe de turnos</button>
	 		</a>
	 		<br><br>
			<form class="cmxform form-horizontal style-form" id="commentForm" name="frmDatos" method="GET" action="turnos.php">
				<div align="center">
					<select class="buscar_profesional" name="idProfesional"  id="idProfesional" >
		  				<option value="0">Profesional</option>
						<?php foreach ($listadoProfesionales as $profesional): ?>

							<option   value="<?php echo $profesional->getIdProfesional(); ?>">
							    <?php echo $profesional; ?>
							</option>
						<?php endforeach ?>
					</select>
		 			<input type="submit" class="btn btn-info" value="Ver Turnos">
					<br><br><br><br>
					<img src="/programacion3/gestion/static/img/calendario2.png">

	 			</div>

			</form>

		</section>
	</section>

	<script>


		


	$(document).ready(function() {
	    $('.buscar_profesional').select2();
	});


	</script>
</body>
</html>

