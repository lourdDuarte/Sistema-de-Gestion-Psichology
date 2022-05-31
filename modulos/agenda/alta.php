<?php

require_once '../../class/Profesional.php';
require_once '../../menu.php';
require_once '../../class/AgendaDia.php';


$listaProfesional= Profesional::obtenerTodos();

$diaSemana = AgendaDia::obtenerTodos()

?>
<!DOCTYPE html>
<html>
<head>
	<title>Nueva Agenda</title>

	<script type="text/javascript" src="/programacion3/Gestion/static/js/agenda/validacionAgenda.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
	<script src="/programacion3/Gestion/static/lib/select/select2.min.js"></script>

</head>
<body>

<section id="main-content">
    <section class="wrapper">
    	<div align="center">

            <?php if (isset($_SESSION['mensaje_error'])) : ?>

                <font color="red">
                    <h3><?php echo $_SESSION['mensaje_error'] ?></h3>
                </font>

            <?php
                    unset($_SESSION['mensaje_error']);
                endif;
            ?>

         	<div id="mensajeError"></div>
        </div>
    		<div class="row mt">
      			<div class="col-lg-12">
       				<h4><i class="fa fa-angle-right"></i> Nueva Agenda</h4>
       				<br>
       				<div class="form-panel">
       					<div class="form">
							<form class="cmxform form-horizontal style-form" id="frmDatos" name="frmDatos" method="POST" action = "procesar/guardar.php">

								<div class="row mt">
									<label class="col-lg-2 control-label">Profesional </label>
									<div class="col-lg-10">
										<select name="cboProfesional" id="cboProfesional" class="buscar_profesional">
										    <option value="0">Seleccionar</option>

											<?php foreach ($listaProfesional as $profesional): ?>

												<option value="<?php echo $profesional->getIdProfesional(); ?>">
												    <?php echo $profesional; ?>
												</option>

											<?php endforeach ?>

										</select>
									</div>
							    </div> 
			

							  <div class="row mt">
	            					<label class="col-lg-2 control-label">Fecha inicio de atencion</label>
	             					<div class="col-lg-10">
										<input type="date" name="txtFechaInicio" class="form-control" id="fechaInicio">
									</div>
								</div> 
								<div class="row mt">
					            <label class="col-lg-2 control-label">Fecha final de atencion</label>
	             					<div class="col-lg-10">
										<input type="date" name="txtFechaFinal" class="form-control" id="fechaFinal">
									</div>
								</div> 

								<div class="row mt">
						            <label class="col-lg-2 control-label">Duracion por turno</label>
							       <div class="col-lg-10">
										<input type="text" name="txtDuracion" class="form-control" id="txtDuracion">
									</div>
								</div>

								<div class="row mt">
									<label class="col-lg-12 control-label">Hora Inicio de Atencion</label>
									<div class="col-lg-10">
										<input type="time" name="txtHoraInicio" class="form-control" id="horaInicio">
									</div>
								</div>

								<div class="row mt">
									<label class="col-lg-12 control-label">Hora Final de Atencion</label>
									<div class="col-lg-10">
										<input type="time" name="txtHoraFinal" class="form-control" id="horaFinal">
									</div>
								</div>
								<div class="row mt">
					             	<label class="col-lg-12 control-label">Dias Disponibles</label>
					             	<div class="col-lg-10">
	             						<br>
						                <input type="checkbox" name="txtLunes" >Lunes
						             	<input type="checkbox" name="txtMartes" >Martes
						             	<input type="checkbox" name="txtMiercoles" >Miercoles
						             	<input type="checkbox" name="txtJueves" >Jueves
						             	<input type="checkbox" name="txtViernes" >Viernes
					             </div>
					         </div>


								 <div align="left"> 
						            <div class="row mt" align="left">
	                  					<div class="col-lg-offset-2 col-lg-10">
	                   						<input type="submit" name="btnGuardar" value="Guardar" onclick="validarAgenda();" >
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
   

	<script>


		$(document).ready(function() {
		    $('.buscar_profesional').select2();
		});


	</script>

</body>
</html>

