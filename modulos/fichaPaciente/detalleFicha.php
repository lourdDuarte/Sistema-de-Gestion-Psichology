<?php
require_once '../../class/Ficha.php';
require_once '../../class/Paciente.php';
require_once '../../class/ObraSocial.php';
require_once '../../class/Profesional.php';
require_once '../../class/TipoAtencion.php';
require_once '../../class/Tratamiento.php';
require_once '../../class/Turno.php';
require_once '../../class/EstadoTurno.php';
require_once '../../class/ObraSocialPaciente.php';
require_once '../../class/PacienteObservacion.php';
require_once '../../menu.php';

error_reporting(0);

if (isset($_GET['id'])){
	$id = $_GET['id'];
	$ficha = Ficha::obtenerPorId($id);
}
if (isset($_GET['idPaciente'])){
	$idPaciente = $_GET['idPaciente'];
	$paciente = Paciente::obtenerPorId($idPaciente);
	$turnos = Turno::obtenerPorIdPaciente($idPaciente);
	$numeroAsociado = ObraSocialPaciente::obtenerPorIdPaciente($idPaciente);
	$pacienteObservacion = PacienteObservacion::obtenerPorIdPaciente($idPaciente);

}



$listaObraSocial = ObraSocial::obtenerTodos();
$profesionales = Profesional::obtenerTodos();
$tipoAtencion = TipoAtencion::obtenerTodos();
$tratamientos = Tratamiento::obtenerTodos();
$estadoTurnos = EstadoTurno::obtenerTodos();



?>


<!DOCTYPE html>
<html>
<head>
	<title>Historia Clinica</title>
</head>
<body>
<section id="main-content">
	<section class="wrapper site-min-with">

                <u><h3><b>Paciente:</b></u> <?php echo $paciente?></h3>

                <b>Fecha Admision:</b> <?php echo $ficha->getFechaAlta();?>

                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                <b>Profesional Asignado:</b>
				<?php foreach($profesionales as $profesional):?>
					<?php if($profesional->getIdProfesional() == $ficha->getIdProfesional()):?>
						<?php echo $profesional;?>
					<?php endif?>
				<?php endforeach?>

				 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

				<b>Tipo Atencion:</b>
				<?php foreach($tipoAtencion as $atencion):?>
					<?php if($atencion->getIdTipoAtencion() == $ficha->getIdTipoAtencion()):?>
						<?php echo $atencion;?>
					<?php endif?>
				<?php endforeach?>

				<br><br>

                <b>Fecha Nacimiento:</b> <?php echo $paciente->getFechaNacimiento();?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                <b>Numero Documento:</b> <?php echo $paciente->getNumeroDocumento();?>

                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                <b>Obra Social:</b>
                <?php foreach ($listaObraSocial as $obraSocial): ?>

					<?php

					$idObraSocial= $obraSocial->getIdObraSocial();

					?>

						<?php if($paciente->tieneObraSocial($idObraSocial)): ?>

							<?php echo  "$obraSocial ". "";?>
						
						<?php endif ?>
					
				<?php endforeach ?>

				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

				<b>Numero Asociado:</b>
				<?php foreach ($numeroAsociado as $numero):?>
					<?php echo $numero->getNumeroAsociado();?>
				<?php endforeach?>

				<br><br>

				<?php if(is_null($ficha->getIdTratamiento())):?>
					<b>Diagnostico:</b> <a href="../tratamiento/alta.php?id=<?php echo $ficha->getIdFicha();?>&idLlamada=<?php echo $paciente->getIdPaciente(); ?>&modulo=fichaPaciente">
					<button type="button" class="btn btn-primary btn-sm">Agregar</button>
					 </a>
				<?php endif?>

				<?php if (!is_null($ficha->getIdTratamiento())):?>
					<?php foreach ($tratamientos as $tratamiento):?>
						<?php if($tratamiento->getIdTratamiento() == $ficha->getIdTratamiento()):?>
							<b>Diagnostico:</b> <?php echo $tratamiento; ?>
							<a href="../tratamiento/modificar.php?id=<?php echo $tratamiento->getIdTratamiento();?>&paciente=<?php echo $paciente->getIdPaciente()?>&ficha=<?php echo $ficha->getIdFicha();?>&modulo=fichaPaciente">
							<button type="button" class="btn btn-primary btn-sm">Modificar</button></a>
						<?php endif ?>
					<?php endforeach?>
				<?php endif?>
					
		
                </p>
                <div class="col-xs-6">
		            <div class="table-responsive">
		        		<table class="table">
		          			<thead>
		           		 		<tr>
				              		<th scope="col">Fecha de Sesion</th>
				   
				              		<th scope="col">Estado</th>
		            			</tr>
		          			</thead>
		         		 	<tbody>
		        			 <?php foreach($turnos as $turno):?>
		            		<tr>
		              		 	<td><?php echo $turno->getFecha();?></td>
				              
				              	<?php foreach ($estadoTurnos as $estado):?>
				              		<?php if($turno->getIdEstado() == $estado->getIdEstado()):?>
				              			<td><?php echo $estado;?></td>
		   							<?php endif?>
		   						<?php endforeach?>
		            		</tr>
		    				<?php endforeach ?>
		          			</tbody>
		        		</table>
		        	</div>
          		</div>
          		 <div class="col-xs-6">
		            <div class="table-responsive">
		        		<table class="table">
		          			<thead>
		           		 		<tr>
					            	<th scope="col"> <a  href="../ObservacionesPaciente/alta.php?id=<?php echo $paciente->getIdPaciente();?>&idFicha=<?php echo $ficha->getIdFicha();?>&modulo=fichaPaciente">
										<button type="button" class="btn btn-primary btn-sm">Nueva Observacion</button></a>
									</th>
		            			</tr>
		          			</thead>
		        		</table>	
		            	<?php foreach($pacienteObservacion as $observacion):?>
					 		<?php if($observacion->getIdPaciente() == $ficha->getIdPaciente()):?>
		              			<?php echo $observacion; ?><br>

		              		<?php endif?>
		             	<?php endforeach?>	
		        	</div>
          		</div>	
		</section>
	</section>
</body>
</html>