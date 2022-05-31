<?php

require_once '../../class/Especialidad.php';
require_once "../../menu.php";

$listadoEspecialidades = Especialidad::obtenerTodos();

const SIN_ACCION = 0;
const ESPECIALIDAD_GUARDADO = 1;
const ESPECIALIDAD_ACTUALIZADA = 2;

if (isset($_GET['mensaje'])) {
	$mensaje = $_GET['mensaje'];
} else {
	$mensaje = SIN_ACCION;
}



?>

<!DOCTYPE html>
<html>
<head>
	<title>Listado Especialidades</title>

</head>
<body>
<section id="main-content">
	<section class="wrapper">
		<?php if ($mensaje == ESPECIALIDAD_GUARDADO){ ?>
				<h3>Especialidad añadida con exito</h3>
				<br><br>
		<?php }elseif ($mensaje == ESPECIALIDAD_ACTUALIZADA){ ?>
			 	<h3>Especialidad actualizada con exito</h3>
			 	<br><br>
		<?php } ?>
		<h3><i class="fa fa-angle-right"></i> Especialidades</h3>
		<a href="alta.php"><button type="button" class="btn btn-primary btn-sm">
         	Nueva Especialidad</button></a>
		<div class="row mt">
          <div class="col-md-12">
            <div class="content-panel">
              <table class="table table-striped table-advance table-hover">
	              	<hr>
		                <thead>
		                  <tr>
								<th>Nombre</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($listadoEspecialidades as $especialidad): ?>
									<tr>
										<td> <?php echo $especialidad->getTipo(); ?> </td>
										<td>
											<a href="modificar.php?id=<?php echo $especialidad->getIdEspecialidad(); ?>">
												<img src="../../imagenes/iconos/update.png" title="actualizar">
											</a>
											<a href="procesar/eliminar.php?id=<?php echo $especialidad->getIdEspecialidad(); ?>">
												<img src="../../imagenes/iconos/delete.png" title="eliminar">
											</a>
										</td>
									</tr>

							<?php endforeach ?>
						</tbody>
				</table>
			</div>
		</div>
	</div>
</section>
</section>

	
	<br><br>
	<div align="left">
		<a href="alta.php">
		<img src="../../imagenes/iconos/add.png">Agregar Nueva Especialidad</a>

	</div>
</body>
</html>