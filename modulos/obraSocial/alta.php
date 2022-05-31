<!DOCTYPE html>
<html>
<head>
	<title>Nueva Obra Social</title>
	<script type="text/javascript" src="/programacion3/Gestion/static/js/obrasocial/validacionObraSocial.js" ></script>

</head>
<body>
	<?php require_once "../../menu.php" ?>

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
       			<h4><i class="fa fa-angle-right"></i> Nueva Obra Social</h4>
       			<div class="form-panel">
       				<div class=" form">
       					<br>
						<form class="cmxform form-horizontal style-form" id="commentForm" name="frmDatos" method="POST" action = "procesar/guardar.php">
							<div class="row mt">
	          					<label class="col-lg-2 control-label">Nombre</label>
               					<div class="col-lg-10">
									<input type="text" name="txtNombre" id="txtNombre" class="form-control">
								</div>
							</div>
							<div class="row mt">
								<label class="col-lg-2 control-label">Co Seguro:</label>
								<div class="col-lg-10">
									<input type="text" name="txtCoSeguro" id="txtCoSeguro" class="form-control">
								</div>
							</div>

		 					<div align="left">
                  				<div class="row mt">
                  					<div class="col-lg-offset-2 col-lg-10">
                   						<input type="submit" id="guardar" name="btnGuardar" value="Guardar" onclick="validarObraSocial();">
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
        url:"/programacion3/Gestion/modulos/obraSocial/procesar/validar.php",
        data:{
          'obrasocial': $('#txtNombre').val(),
        },
        success: function(respuesta){
          if (respuesta == 1) {
            alert("Obra social ya registrada");
            //return;
          }
        }   
      })
    })
  })
  
</script>

</body>
</html>
