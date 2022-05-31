
<?php
require_once '../../class/Paciente.php';
require_once '../../class/Profesional.php';
require_once '../../class/Ficha.php';
require_once "../../menu.php";

const SIN_ACCION = 0;
const PACIENTE_GUARDADO = 1;
const PACIENTE_MODIFICADO = 2;
const PACIENTE_ELIMINADO = 3;

if (isset($_GET['mensaje'])) {
	$mensaje = $_GET['mensaje'];
} else {
	$mensaje = SIN_ACCION;
}


$listaPacientes = Paciente::obtenerTodos();

$listadoProfesional = Profesional::obtenerTodos();
$fichas = Ficha::obtenerTodos();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Listado Pacientes</title>
</head>
<body>
	<section id="main-content">
      	<section class="wrapper">

			<?php if ($mensaje == PACIENTE_GUARDADO){ ?>
					<h3 align="center"><i class="fa fa-check">Paciente guardado con exito</i></h3>
			<?php }elseif ($mensaje == PACIENTE_MODIFICADO){ ?>
					<h3 align="center"><i class="fa fa-check">Paciente actualizado con exito</i></h3>
			<?php }elseif ($mensaje == PACIENTE_ELIMINADO){ ?>
					<h3 align="center"><i class="fa fa-check">Paciente eliminado con exito</i></h3> 
			<?php } ?>
        	<h3><i class="fa fa-angle-right"></i> Listado Pacientes</h3>
    	 	<a href="alta.php"><button type="button" class="btn btn-primary btn-sm">
         		Nuevo Paciente</button></a>
				 <br><br><br>
				 <form class="form-inline my-2 my-lg-0" id="frmDatos" name="frmDatos" method="GET" action = "PacienteSearch.php">
					<input class="form-control mr-sm-2" type="search" aria-label="Search" id="txtBuscar" name="txtBuscar">
				<input class="btn btn-outline-success my-2 my-sm-0" type="submit" value="Buscar">
				</form>
        	<div class="row mt">
          		<div class="col-md-12">
            		<div class="content-panel">
              			<table class="table table-striped table-advance table-hover">
                			<hr>
                			<thead>
                				<tr>
									<th><i class="fa fa-bullhorn"></i>Nombre</th>
									<th><i class="fa fa-bullhorn"></i>Apellido</th>
									<th><i class="fa fa-bullhorn"></i>Acciones</th>
								</tr>
							</thead>
                			<tbody>

								<?php foreach ($listaPacientes as $paciente): ?>
								<tr>
									<td> <?php echo $paciente->getNombre(); ?> </td>
									<td> <?php echo $paciente->getApellido(); ?> </td>
									<td>
										<a href="detalle.php?id=<?php echo $paciente->getIdPaciente();?>" title="ver detalle">
											<button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
										</a>
										<?php foreach ($fichas as $ficha):?>
											<?php if ($ficha->getIdPaciente() == $paciente->getIdPaciente()):?>
										<a href="modificar.php?id=<?php echo $paciente->getIdPaciente(); ?>&idFicha=<?php echo $ficha->getIdFicha();?>" title= "actualizar">
											<button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
										</a>
										<?php endif?>
										<?php endforeach?>
										<a href="procesar/eliminar.php?id=<?php echo $paciente->getIdPaciente(); ?>" title="eliminar">
											<button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
										</a>
										<?php if ($usuario->perfil->getIdPerfil() == 1):?>
											<a href="informe/informePaciente.php?id=<?php echo $paciente->getIdPaciente(); ?>" title="hacer informe">
												<button class="btn btn-primary btn-xs"><i class="fa fa-clone "></i></button>
											</a>
										<?php endif?>
										
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
</body>
</html>