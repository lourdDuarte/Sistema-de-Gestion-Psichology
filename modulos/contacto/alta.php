<?php


require_once '../../class/TipoContacto.php';
require_once "../../menu.php";

$idPersona = $_GET['idPersona'];
$idLlamada = $_GET['idLlamada'];
$moduloLlamada = $_GET['modulo'];


$listaTipoContactos = TipoContacto::ObtenerTodos();

?>


<!DOCTYPE html>
<html>
<head>
	<title>Alta de Contacto</title>
	<script type="text/javascript" src="/programacion3/Gestion/static/js/contacto/validarContacto.js" ></script>
	
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
      		 	<h4><i class="fa fa-angle-right"></i> Nueva Contacto</h4>
       			<div class="form-panel">
      				 <div class=" form">
						<form class="cmxform form-horizontal style-form" id="frmDatos" name="frmDatos" method="POST" action = "procesar/guardar.php">

						    <input type="hidden" name="txtIdPersona" value='<?php echo $idPersona ?>'>
						    <input type="hidden" name="txtIdLlamada" value='<?php echo $idLlamada ?>'>
						    <input type="hidden" name="txtModulo" value='<?php echo $moduloLlamada ?>'>

							<div class="row mt">
					        	<label class="col-lg-2 control-label">valor:</label>
					        	<div class="col-lg-10">
									<input type="text" name="txtValor" id="txtValor" class="form-control">
								</div>
							</div>
							<div class="row mt">
					        	<label class="col-lg-2 control-label">Tipo de Contacto:</label>
					        	<div class="col-lg-10">
									<select name="cboTipoContacto" id="cboTipoContacto"> 
										<option value="0">Seleccionar</option>

										<?php foreach($listaTipoContactos as $tipoContacto): ?>

											<option value=<?php echo $tipoContacto->getIdTipoContacto();?> > <?php echo $tipoContacto ?>
												
											</option>

										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div align="left">
				             <div class="row mt">
				             		<div class="col-lg-offset-2 col-lg-10">
						   				<input type="submit" value="Guardar" id="guardar" onclick="validarContacto();"> 
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

  $(function(){
    $('#guardar').on('click', function(e){
      $.ajax({
        type: "POST",
        url:"/programacion3/Gestion/modulos/contacto/procesar/validar.php",
        data:{
          'valor': $('#txtValor').val(),
        },
        success: function(respuesta){
          if (respuesta == 1) {
            alert("Valor ya registrado");
            //return;
          }
        }   
      })
    })
  })
  
</script>
</body>
</html>


