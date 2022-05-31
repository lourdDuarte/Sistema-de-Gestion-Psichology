<?php

require_once '../../menu.php';
require_once '../../class/Barrio.php';

$id = $_GET['id'];

$barrio = Barrio::obtenerPorId($id)

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<section id="main-content">
    <section class="wrapper">
    	<?php if (isset($_SESSION['mensaje_error'])): ?>

			<font color="red">
		<?php echo $_SESSION['mensaje_error']?>

			</font>

     	<?php unset($_SESSION['mensaje_error']);?>
            
		<?php endif ?>
    	<div class="row mt">

      		<div class="col-lg-12">
       			<h4><i class="fa fa-angle-right"></i> Actualizar Barrio</h4>
       			<div class="form-panel">
       				<div class=" form">
       					<br>
						<form class="cmxform form-horizontal style-form" id="commentForm" name="frmDatos" method="POST" action = "procesar/modificar.php">
							<input type="hidden" name="txtId" value="<?php echo $barrio->getIdBarrio(); ?>">

							<div class="row mt">
	          					<label class="col-lg-2 control-label">Nombre</label>
               					<div class="col-lg-10">
									<input type="text" name="txtDescripcion" id="txtDescripcion" class="form-control" value="<?echo $barrio->getDescripcion();?>">
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