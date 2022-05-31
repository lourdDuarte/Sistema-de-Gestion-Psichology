<?php

require_once '../../class/ObraSocial.php';
require_once "../../menu.php";

$id= $_GET['id'];

$obraSocial= ObraSocial::ObtenerPorId($id);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Actualizar Obra Social</title>

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
       				<h4><i class="fa fa-angle-right"></i> Actualizar Obra Social</h4>
       				<div class="form-panel">
       					<div class=" form">
       						<br>
							<form class="cmxform form-horizontal style-form" id="commentForm" name="frmDatos" method="POST" action = "procesar/modificar.php">
								<input type="hidden" name="txtId" value="<?php echo $obraSocial->getIdObraSocial(); ?>">
								<div class="row mt">
	         					 	<label class="col-lg-2 control-label">Nombre</label>
               						<div class="col-lg-10">
										<input type="text" name="txtNombre" id="txtNombre" value="<?php echo $obraSocial->getNombre();?>"class="form-control">
									</div>
								</div>
								<div class="row mt">
									<label class="col-lg-2 control-label">Co Seguro:</label>
									<div class="col-lg-10">
										<input type="text" name="txtCoSeguro" value="<?php echo $obraSocial->getCoSeguro();?>"class="form-control">
									</div>
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