<?php

require_once '../../menu.php';
require_once '../../class/Paciente.php';
require_once '../../class/ObraSocial.php';
require_once '../../class/EstadoPago.php';


$listaPacientes = Paciente::obtenerTodos();
$listaObraSocial = ObraSocial::obtenerTodos();
$listaEstados = EstadoPago::obtenerTodos();

?>
s
<html>
<head>
	<title></title>
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
        endif;?>
           <div id="mensajeError"></div>
      </div>        
    	<div class="row mt">
      		<div class="col-lg-12">
       			<h4><i class="fa fa-angle-right"></i> Nuevo Registro de Pago</h4>
       			<br>
       			<div class="form-panel">
       				<div class=" form">
       					<br>
						<form class="cmxform form-horizontal style-form" id="commentForm" name="frmDatos" method="POST" action = "procesar/guardar.php">

						<div class="row mt">
							<label class="col-lg-2 control-label">Paciente: </label>
							<div class="col-lg-10">
								<select class="buscar_paciente" name="cboPaciente" >
			    					<option value="0">Seleccionar</option>

									<?php foreach ($listaPacientes as $paciente): ?>

										<option value="<?php echo $paciente->getIdPaciente(); ?>">
										    <?php echo $paciente; ?>
										</option>

									<?php endforeach ?>

								</select>
							</div>
						</div>
						<div class="row mt">
							<label class="col-lg-2 control-label">Obra Social: </label>
							<div class="col-lg-10">
								<select class="buscar_obra_social" name="cboObraSocial" >
			    					<option value="0">Seleccionar</option>

									<?php foreach ($listaObraSocial as $obraSocial): ?>

										<option value="<?php echo $obraSocial->getIdObraSocial(); ?>">
										    <?php echo $obraSocial." "."-"." "."$". $obraSocial->getCoSeguro(); ?>
										</option>

									<?php endforeach ?>
								</select>
							</div>
						</div>  
						<div class="row mt">
            				<label class="col-lg-2 control-label">Cantidad de Sesiones Autorizadas:</label>
            				<div class="col-lg-10">
								<input type="text" name="txtSesionesAutorizadas" class="form-control" >
							</div>
						</div>
						<div class="row mt">
            				<label class="col-lg-2 control-label">Fecha:</label>
            				<div class="col-lg-10">
								<input type="date" name="txtFecha" class="form-control"  >
							</div>
						</div>
			
						<div class="row mt">
            				<label class="col-lg-2 control-label">Sesion Abonada:</label>
            				<div class="col-lg-10">
								<input type="text" name="txtSesionesAbonadas" class="form-control" >
							</div>
						</div>
          
			 			<div align="left">    
             				<div class="row mt">
                  				<div class="col-lg-offset-2 col-lg-10">
                   					<input type="submit" name="btnGuardar"value="Guardar">
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
    $('.buscar_paciente').select2();
});


</script>
 <script>


	


$(document).ready(function() {
    $('.buscar_obra_social').select2();
});


</script>

</body>
</html>