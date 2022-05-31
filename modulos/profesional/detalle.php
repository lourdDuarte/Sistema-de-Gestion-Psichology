<?php
require_once '../../class/Profesional.php';

require_once '../../class/Especialidad.php';

require_once '../../class/ObraSocial.php';
require_once "../../menu.php";


$id = $_GET['id'];

$profesional= Profesional::obtenerPorId($id);

$listadoEspecialidad=Especialidad::obtenerEspecialidadPorIdProfesional($id);

$listaObraSocial=ObraSocial::obtenerOsPorIdProfesional($id);


?>

<!DOCTYPE html>
<html>
<head>
	<title>Detalle Profesional</title>

</head>
<body>

    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-md-12">
            <div class="content-panel">
              <h4><i class="fa fa-angle-right"></i> <?php echo $profesional;?></h4>
              <hr>
              <table class="table">
	                <thead>
	                  <tr>
							<th>ID Profesional</th>
							<th>ID Persona</th>
							<th>Nombre</th>
							<th>Apellido</th>
							<th>Matricula</th>
							<th>Numero Documento</th>
							<th>Fecha Nacimiento</th>
							<th>Estado</th>
							<th>Domicilio</th>
							<th>Contacto</th>
	                  	</tr>
	                </thead>
	                <tbody>
	                  	<tr>
							<td> <?php echo $profesional->getIdProfesional(); ?> </td>
							<td> <?php echo $profesional->getIdPersona(); ?> </td>
							<td> <?php echo $profesional->getNombre(); ?></td>
							<td> <?php echo $profesional->getApellido(); ?></td>
							<td> <?php echo $profesional->getMatricula(); ?></td>
							<td> <?php echo $profesional->getNumeroDocumento(); ?></td>
							<td> <?php echo $profesional->getFechaNacimiento(); ?></td>
							<td> ACTIVO </td>
							<?php if (is_null($profesional->domicilio)){?>
					
								<td>	
									<a href="/programacion3/Gestion/modulos/domicilio/alta.php?idPersona=<?php echo $profesional->getIdPersona();?>;?>&idLlamada=<?php echo $profesional->getIdProfesional(); ?>&modulo=profesional">Agregar domicilio</a>
									
								</td>	
							<?php }else{ ?>
								<td>

									<a  href="/programacion3/Gestion/modulos/domicilio/modificar.php?idPersona=<?php echo $profesional->getIdPersona(); ?>&idLlamada=<?php echo $profesional->getIdProfesional(); ?>&idDomicilio=<?php echo $profesional->domicilio->getIdDomicilio();?>&modulo=profesional" title="modificar"><?php echo $profesional->domicilio; ?> </a>	

								</td>
							<?php } ?>
								<td>
									<?php foreach ($profesional->arrContactos as $contacto) : ?>
										<a href="/programacion3/Gestion/modulos/contacto/procesar/eliminar.php?idPersonaContacto=<?php echo $contacto->getIdPersonaContacto(); ?>&idLlamada=<?php echo $profesional->getIdProfesional(); ?>&modulo=profesional" title="eliminar"><?php echo $contacto; ?></a>
							

							
						    	</td>	
	    							<?php endforeach ?>
	                  	</tr>
	                </tbody>
              </table >
              <br>
			 <h4><i class="fa fa-angle-right"></i> Especializacion:</h4>
              <table class = "table">
              	
	              	<tr>
	              
						<th> 
							<?php foreach ($listadoEspecialidad as $especialidad): ?>

								<?php

								$idEspecialidad= $especialidad->getIdEspecialidad();

								?>

									<?php if($profesional->tieneEspecialidad($idEspecialidad)): ?>

										<?php echo  "$especialidad -";?>
									
									<?php endif ?>
								
							<?php endforeach ?>
					 	</th>
					</tr>
				</table>
				<br>		
				<h4><i class="fa fa-angle-right"></i> Obra Social Admitida:</h4>    
              	<table class = "table"> 	
              		<tr>
              
						<th> 
							<?php foreach ($listaObraSocial as $obraSocial): ?>

								<?php

								$idObraSocial= $obraSocial->getIdObraSocial();

								?>

									<?php if($profesional->tieneObraSocial($idObraSocial)): ?>

										<?php echo  "$obraSocial -";?>
									
									<?php endif ?>
								
							<?php endforeach ?>
				 		</th>
					</tr>
				</table>
            </div>
          </div>
        </div>
        <br><br>
        <div align="left">
			<a href="/programacion3/Gestion/modulos/contacto/alta.php?idPersona=<?php echo $profesional->getIdPersona(); ?>&idLlamada=<?php echo $profesional->getIdProfesional(); ?>&modulo=profesional"><h4><i class="fa fa-angle-right"></i>Agregar Contacto</h4></a>
		</div>
    </section>
</section>

</body>
</html>
