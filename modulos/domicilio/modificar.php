<?php

require_once '../../class/Domicilio.php';
require_once '../../class/Barrio.php';
 require_once "../../menu.php";

$idDomicilio = $_GET['idDomicilio'];
$idPersona = $_GET['idPersona'];
$idLlamada = $_GET['idLlamada'];
$moduloLlamada = $_GET['modulo'];

$domicilio= Domicilio::obtenerPorIdPersona($idPersona);
$listadoBarrio = Barrio::obtenerTodos();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Alta de Domicilio</title>

</head>
<body>
<section id="main-content">
    <section class="wrapper">
    	<div class="row mt">
      		<div class="col-lg-12">
       			<h4><i class="fa fa-angle-right"></i> Actualizar Domicilio</h4>
       			<div class="form-panel">
       				<div class=" form">
						<form name="frmDatos" method="POST" action="procesar/modificar.php">
							<input type="hidden" name="txtDomicilio" value='<?php echo $idDomicilio; ?>'>
						    <input type="hidden" name="txtIdPersona" value='<?php echo $idPersona; ?>'>
						    <input type="hidden" name="txtIdLlamada" value='<?php echo $idLlamada;?>'>
						    <input type="hidden" name="txtModulo" value='<?php echo $moduloLlamada; ?>'>

						    <div class="row mt">
	        					<label class="col-lg-2 control-label">Calle:</label>
	        					<div class="col-lg-10">
		    						<input type="text" name="txtCalle" class="form-control" value="<?php echo $domicilio->getCalle();?>">
		    					</div>
							</div>
							<div class="row mt">
                          		<label class="col-lg-2 control-label">Barrio: </label>
                          		<div class="col-lg-10">
                            		<select  name= "cboBarrio" id="cboBarrio">
                              			<option value = "0">Seleccionar</option>
                              			<?php
												foreach ($listadoBarrio as $barrio):
													$selected = '';
													if ($domicilio->getIdBarrio() == $barrio->getIdBarrio()) {
														$selected = "SELECTED";
													}
												?>

													<option value="<?php echo $barrio->getIdBarrio(); ?>" <?php echo $selected; ?>>
														<?php echo $barrio; ?>
													</option>

												<?php endforeach ?>
                            		</select>
                            	</div>
                            </div> 

							<div class="row mt">
						    	<label  class="col-lg-2 control-label">Altura:</label>
						    	<div class="col-lg-10">
						    		<input type="number" name="txtAltura" class="form-control" value="<?php echo $domicilio->getAltura();?>">
						    	</div>
							</div>
						   <div class="row mt">
						    	<label class="col-lg-2 control-label">Piso:</label>
						    	<div class="col-lg-10">
						    		<input type="text" name="txtPiso" class="form-control" value="<?php echo $domicilio->getPiso();?>">
								</div>
							</div> 
						   <div class="row mt">
						    	<label class="col-lg-2 control-label">Manzana:</label>
						    	<div class="col-lg-10">
						    		<input type="text" name="txtManzana" class="form-control" value="<?php echo $domicilio->getManzana();?>">
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