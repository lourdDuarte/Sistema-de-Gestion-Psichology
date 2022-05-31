<?php

require_once "../../class/Especialidad.php";
require_once "../../menu.php";

$id=$_GET['id'];

$especialidad=Especialidad::obtenerPorId($id);


?>

<?php


?>

<!DOCTYPE html>
<html>
<head>
	<title>Nueva Especialidad</title>
	<script type="text/javascript" src="/programacion3/Gestion/static/js/especialidad/validarEspecialidad.js"></script>

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
       			<h4><i class="fa fa-angle-right"></i>Actualizar Especialidad </h4>
       			<div class="form-panel">
       				<div class=" form">
       					<br>
						<form class="cmxform form-horizontal style-form" id="commentForm" name="frmDatos" method="POST" action = "procesar/modificar.php">
							<input type="hidden" name="txtId" value="<?php echo $especialidad->getIdEspecialidad(); ?>">
							<div class="row mt">
	          					<label class="col-lg-2 control-label">Tipo</label>
	          					<div class="col-lg-10">
	          						<input type="text" name="txtTipo" id="txtTipo" class="form-control" value="<?php echo $especialidad->getTipo(); ?>">
								</div>
							</div>
							<div align="left">
                  				<div class="row mt">
                  					<div class="col-lg-offset-2 col-lg-10">
                   						<input type="submit" name="btnGuardar" value="Actualizar" onclick="validarEspecialidad();">
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