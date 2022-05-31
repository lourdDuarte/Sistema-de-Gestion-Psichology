	<?php 
		require_once "../../menu.php";
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
       			<h4><i class="fa fa-angle-right"></i>Agregar Nueva Especialidad </h4>

       			<div class="form-panel">
       				<div class=" form">
       					<br>
						<form class="cmxform form-horizontal style-form" id="frmDatos" name="frmDatos" method="POST" action = "procesar/guardar.php">
							<div class="row mt">
	          					<label class="col-lg-2 control-label">Tipo</label>
	          					<div class="col-lg-10">
	          						<input type="text" name="txtTipo" id="txtTipo" class="form-control">
								</div>
							</div>
							<div align="left">
                  				<div class="row mt">
                  					<div class="col-lg-offset-2 col-lg-10">
                   						<input type="submit" name="btnGuardar" id="guardar" value="Guardar" onclick="validarEspecialidad();">
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
        url:"/programacion3/Gestion/modulos/especialidad/procesar/validar.php",
        data:{
          'tipo': $('#txtTipo').val(),
        },
        success: function(respuesta){
          if (respuesta == 1) {
            alert("Especialidad ya registrada");
            //return;
          }
        }   
      })
    })
  })
  
</script>
</body>	
</html>			