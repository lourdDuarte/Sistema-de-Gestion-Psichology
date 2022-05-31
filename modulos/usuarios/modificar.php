<?php

require_once '../../class/Usuario.php';
require_once '../../class/TipoDocumento.php';
require_once '../../menu.php';

$id= $_GET['id'];

$usuario= Usuario::ObtenerPorId($id);
$listadoDocumento = TipoDocumento::obtenerTodos();

?>


<!DOCTYPE html>
<html>
<head>
	<title>Actualizar Usuario</title>
</head>
<body>
<section id="main-content">
    <section class="wrapper">

		<div class="row mt">
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

      			<div class="col-lg-12">
       				<h4><i class="fa fa-angle-right"></i> Actualizar Usuario</h4>
       				<div class="form-panel">
       					<div class=" form">
       	
							<form class="cmxform form-horizontal style-form" id="commentForm" name="frmDatos" method="POST" action = "procesar/modificar.php">

								<input type="hidden" name="txtId" value="<?php echo $usuario->getIdUsuario(); ?>">

								<div class="row mt">
					            	<label class="col-lg-2 control-label">Nombre</label>
					            	<div class="col-lg-10">
										<input type="text" name="txtNombre" class="form-control" value="<?php echo $usuario->getNombre();?>">
							    	</div>
								</div>

								<div class="row mt">
									<label class="col-lg-2 control-label">Apellido:</label>
									<div class="col-lg-10">
										<input type="text" name="txtApellido" class="form-control" value="<?php echo  $usuario->getApellido();?>">
									</div>
								</div>

								<div class="row mt">
									<label class="col-lg-2 control-label">Username</label>
									<div class="col-lg-10">
										<input type="text" name="txtUsername" class="form-control" value="<?php echo $usuario->getUsername();?>">
									</div>
								</div>

								<div class="row mt">
									<label class="col-lg-2 control-label">Password</label>
									<div class="col-lg-10">
										<input type="text" name="txtPassword" class="form-control" value="<?php echo $usuario->getPassword();?>">
									</div>
								</div>

								<div class="row mt">
									<label class="col-lg-2 control-label">Fecha Nacimiento:</label>
									<div class="col-lg-10">
										<input type="date" name="txtFechaNacimiento" class="form-control" value="<?php echo $usuario->getFechaNacimiento();?>">
							 		</div>
								</div>

								 <div class="row mt">
					          		<label class="col-lg-2 control-label">Tipo Documento: </label>
					          		<div class="col-lg-10">
					        			<select name="cboTipoDocumento" id="cboTipoDocumento">
					              
					        				<option value="0">Seleccionar</option>
					        		  		<?php
					                			foreach ($listadoDocumento as $tipoDocumento):
					                     			$selected = '';
							                      if ($usuario->getIdTipoDocumento() == $tipoDocumento->getIdTipoDocumento()){
							                        $selected = "SELECTED";
							                      }
					                    
					              			?>

								              <option value="<?php echo $tipoDocumento->getIdTipoDocumento(); ?>" <?php echo $selected; ?>>
								              <?php echo $tipoDocumento; ?>
								              </option>
								              <?php endforeach ?>
					        			
					        			</select>
					        		</div>
					        	</div>

								<div class="row mt">
									<label class="col-lg-2 control-label">Numero Documento:</label>
									<div class="col-lg-10">
										<input type="text" name="txtNumeroDocumento" value="<?php echo  $usuario->getNumeroDocumento();?>">
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