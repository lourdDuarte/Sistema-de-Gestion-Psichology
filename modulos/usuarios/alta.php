
<?php 

require_once '../../class/TipoDocumento.php';
require_once '../../class/Perfil.php';
require_once '../../menu.php';

$tipoDocumento = TipoDocumento::obtenerTodos();
$tipoPerfil= Perfil::obtenerTodos();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Nuevo Usuario</title>

	<script type="text/javascript" src="/programacion3/Gestion/static/js/usuario/validacionUsuario.js"></script>


</head>
<body>

<section id="main-content">

<section class="wrapper">

    <section class="wrapper">
>>>>>>> 21d8557726e78d895681add51afdbcfd09c980be
=======
    <section class="wrapper">
>>>>>>> 21d8557726e78d895681add51afdbcfd09c980be
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
       <h4><i class="fa fa-angle-right"></i> Nuevo Usuario</h4>
       <div class="form-panel">
       <div class=" form">
       	<br>
		<form class="cmxform form-horizontal style-form" id="frmDatos" name="frmDatos" method="POST" action = "procesar/guardar.php">

		<div class="row mt">
            <label class="col-lg-2 control-label">Nombre</label>
            <div class="col-lg-10">
				<input type="text" name="txtNombre" class="form-control" id="txtNombre">
			</div>
		</div>
		<div class="row mt">
            <label class="col-lg-2 control-label">Apellido</label>
            <div class="col-lg-10">
				<input type="text" name="txtApellido" class="form-control" id="txtApellido">
			</div>
		</div>
		<div class="row mt">
          <label class="col-lg-2 control-label">Perfil: </label>
          <div class="col-lg-10">
			<select name="cboTipoPerfil" id="cboTipoPerfil">
				<option value="0">Seleccionar</option>
		<?php foreach ($tipoPerfil as $perfil): ?>
					<option value=<?php echo $perfil->getIdPerfil();?>><?php echo $perfil; ?> 
				</option>
				
				<?php endforeach ?>
			</select>
		</div>
		</div>
		<div class="row mt">
            <label class="col-lg-2 control-label">Username</label>
            <div class="col-lg-10">
				<input type="text" name="txtUsername" class="form-control" id="txtUsername">
			</div>
		</div>
		<div class="row mt">
            <label class="col-lg-2 control-label">Password</label>
            <div class="col-lg-10">
				<input type="text" name="txtPassword" class="form-control" id="txtPassword">
			</div>
		</div>
		<div class="row mt">
          <label class="col-lg-2 control-label">Tipo Documento: </label>
          <div class="col-lg-10">
			<select name="cboTipoDocumento" id="cboTipoDocumento">
				<option value="0">Seleccionar</option>
		<?php foreach ($tipoDocumento as $tipo): ?>
					<option value=<?php echo $tipo->getIdTipoDocumento();?>><?php echo $tipo; ?> 
				</option>
				
				<?php endforeach ?>
			</select>
		</div>
		</div>
		<div class="row mt">
            <label class="col-lg-2 control-label">Numero Documento</label>
            <div class="col-lg-10">
				<input type="text" name="txtNumeroDocumento" class="form-control" id="txtNumeroDocumento">
			</div>
		</div>
		<div class="row mt">
            <label class="col-lg-2 control-label">Fecha Nacimiento</label>
             <div class="col-lg-10">
				<input type="date" name="txtFechaNacimiento" id="txtFechaNacimiento" class="form-control">
			</div>
		</div> 

		
		  <div align="left">
                 
             <div class="row mt">
                  <div class="col-lg-offset-2 col-lg-10">
                   <input type="submit" id="guardar" name="btnGuardar" value="Guardar" onclick="validarUsuario();">
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
				url:"/programacion3/Gestion/modulos/usuarios/procesar/validar.php",
				data:{
					'username': $('#txtUsername').val(),
					'numeroDocumento':$('#txtNumeroDocumento').val()
				},
				success: function(respuesta){
					if (respuesta == 1) {
						alert("Ingreso un usuario ya existente");
						//return;
					}else if (respuesta == 2) {
						alert("Ingreso un numero de documento ya existente");
					}
				}		
			})
		})
	})
	
</script>



</body>
</html>
