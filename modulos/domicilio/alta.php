<?php

require_once '../../class/Barrio.php';

$idPersona = $_GET['idPersona'];
$idLlamada = $_GET['idLlamada'];
$moduloLlamada = $_GET['modulo'];

$listaBarrios = Barrio::obtenerTodos();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Alta de Domicilio</title>


</head>
<body>

	<?php require_once "../../menu.php"; ?>
	<br>
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
       			<h4><i class="fa fa-angle-right"></i> Domicilio</h4>
       			<div class="form-panel">
       				<div class=" form">
						<form name="frmDatos" method="POST" action="procesar/guardar.php">

						    <input type="hidden" name="txtIdPersona" value='<?php echo $idPersona ?>'>
						    <input type="hidden" name="txtIdLlamada" value='<?php echo $idLlamada ?>'>
						    <input type="hidden" name="txtModulo" value='<?php echo $moduloLlamada ?>'>

		    				<div class="row mt">
	        					<label class="col-lg-2 control-label">Calle:</label>
	        					<div class="col-lg-10">
		    						<input type="text" name="txtCalle" class="form-control">
		    					</div>
							</div>
							<div class="row mt">
                          		<label class="col-lg-2 control-label">Barrio: </label>
                          		<div class="col-lg-10">
                            		<select  name= "cboBarrio" id="cboBarrio">
                              			<option value = "0">Seleccionar</option>
                              			<?php foreach($listaBarrios as $barrio): ?>
                                			<option value="<?php echo $barrio->getIdBarrio();?>"><?php echo $barrio?></option>
                              			<?php endforeach?>
                            		</select>
                            	</div>
                            </div>
							<div class="row mt">
						    	<label  class="col-lg-2 control-label">Altura:</label>
						    	<div class="col-lg-10">
						    		<input type="number" name="txtAltura" class="form-control">
						    	</div>
							</div>

							<div class="row mt">
						    	<label class="col-lg-2 control-label">Piso:</label>
						    	<div class="col-lg-10">
						    		<input type="text" name="txtPiso" class="form-control">
								</div>
							</div> 
							<div class="row mt">
						    	<label class="col-lg-2 control-label">Manzana:</label>
						    	<div class="col-lg-10">
						    		<input type="text" name="txtManzana" class="form-control">
								</div>
							</div>
		
			        		<div align="left">
                  				<div class="row mt">
                  					<div class="col-lg-offset-2 col-lg-10">
                   						<input type="submit" name="btnGuardar" value="Guardar">
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