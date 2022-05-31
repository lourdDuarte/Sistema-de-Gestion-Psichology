<?php

require_once '../../class/Profesional.php';
require_once '../../class/TipoDocumento.php';
require_once '../../class/Especialidad.php';
require_once '../../class/ObraSocial.php';
require_once "../../menu.php";

$id= $_GET['id'];

$profesional= Profesional::ObtenerPorId($id);
$listadoDocumento=TipoDocumento::obtenerTodos();

$listadoEspecialidad= Especialidad::obtenerTodos();

$listaObraSocial=ObraSocial::obtenerTodos();

?>


<!DOCTYPE html>
<html>
<head>
	<title>Actualizar Profesional</title>

</head>
<body>
<section id="main-content">
    <section class="wrapper">
    	<div class="row mt">
      		<div class="col-lg-12">
       			<h4><i class="fa fa-angle-right"></i> Actualizar Profesional</h4>
       			<div class="form-panel">
       				<div class=" form">
						<form class="cmxform form-horizontal style-form" id="commentForm" name="frmDatos" method="POST" action = "procesar/modificar.php">

							<input type="hidden" name="txtId" value="<?php echo $profesional->getIdProfesional(); ?>">
							<div class="row mt">
                  				<label class="col-lg-2 control-label">Nombre</label>
                  				<div class="col-lg-10">
									<input type="text" name="txtNombre" value="<?php echo $profesional->getNombre();?>"class="form-control">
								</div>
							</div>
							<div class="row mt">
                 	 			<label class="col-lg-2 control-label">Apellido</label>
                 				<div class="col-lg-10">
									<input type="text" name="txtApellido" value="<?php echo $profesional->getApellido();?>"class="form-control">
								</div>
							</div>

							<div class="row mt">
             	 				<label class="col-lg-2 control-label">Fecha Nacimiento</label>
              					<div class="col-lg-10">
									<input type="date" name="txtFechaNacimiento" value="<?php echo $profesional->getFechaNacimiento();?>">
								</div>
							</div> 

							<div class="row mt">
          						<label class="col-lg-2 control-label">Tipo Documento: </label>
          						<div class="col-lg-10">
									<select name="cboTipoDocumento" id="cboTipoDocumento">
										<option value="0">Seleccionar</option>
										<?php foreach ($listadoDocumento as $tipoDocumento): ?>
											<option value=<?php echo $tipoDocumento->getIdTipoDocumento();?>><?php echo $tipoDocumento; ?> 
											</option>
									
										<?php endforeach ?>
									</select>
								</div>
							</div>

							<div class="row mt">
                  				<label class="col-lg-2 control-label">Numero Documento</label>
                  				<div class="col-lg-10">
									<input type="text" name="txtNumeroDocumento" value="<?php echo $profesional->getNumeroDocumento();?>" class="form-control">
								</div>
							</div>

							<div class="row mt">
                  				<label class="col-lg-2 control-label">Matricula</label>
                  				<div class="col-lg-10">
									<input type="text" name="txtMatricula" value="<?php echo $profesional->getMatricula();?>" class="form-control">
								</div>
							</div>
		 					<div class="row mt">
                  				<label class="col-lg-2 control-label">Especialidades: </label>
                  				<select name="cboEspecialidad[]" multiple style="width: 150px; height: 150px;">

						         <?php foreach ($listadoEspecialidad as $especialidad) :?>

						         	<?php

						         	$selected = '';
						         	$idEspecialidad = $especialidad->getIdEspecialidad();

						         	if ($profesional->tieneEspecialidad($idEspecialidad)) {
						         		$selected = "SELECTED";
						         	}

						         	?>

						         	<option value="<?php echo $especialidad->getIdEspecialidad(); ?>" <?php echo $selected ?> >
						         		<?php echo $especialidad ?>
						         	</option>

						         <?php endforeach ?>

		    					</select>
							</div>
		    				<br><br>
		    				<div class="row mt">
                  				<label class="col-lg-2 control-label">Obra Social Admitidas: </label>      
                  				<select name="cboObraSocial[]" multiple style="width: 150px; height: 150px;">

						         <?php foreach ($listaObraSocial as $obraSocial) :?>

						         	<?php

						         	$selected = '';
						         	$idObraSocial = $obraSocial->getIdObraSocial();

						         	if ($profesional->tieneObraSocial($idObraSocial)) {
						         		$selected = "SELECTED";
						         	}

						         	?>

						         	<option value="<?php echo $obraSocial->getIdObraSocial(); ?>" <?php echo $selected ?> >
						         		<?php echo $obraSocial ?>
						         	</option>

						         <?php endforeach ?>

		    					</select>
							</div>
		

                 			<div align="left">
                 
                  				<div class="row mt">
                  					<div class="col-lg-offset-2 col-lg-10">
                   						<input type="submit" name="btnGuardar" value="Actualizar">
                   					</div>
                   				</div>
              				</div>
                  
						</form>

					</div>
				</div>
			</div>
		</div>
	</section>
</section>




</body>
</html>