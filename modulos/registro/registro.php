
<?php 

require_once '../../class/TipoDocumento.php';
require_once '../../class/Perfil.php';
require_once '../../class/Usuario.php';



$tipoDocumento = TipoDocumento::obtenerTodos();
$tipoPerfil= Perfil::obtenerTodos();



?>

<!DOCTYPE html>
<html>
<head>
	<title>Nuevo Usuario</title>

	<link href="/programacion3/Gestion/static/template/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="/programacion3/Gestion/static/template/lib/font-awesome/css/font-awesome.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="/programacion3/Gestion/static/template/css/style.css" rel="stylesheet">
  <link href="/programacion3/Gestion/static/template/css/style-responsive.css" rel="stylesheet">
  


</head>
<body>
<section id="main-content">
    <section class="wrapper">
	<button type="button" onclick="location.href='/programacion3/Gestion/formulario_login.php'" class="btn btn-info">VOLVER</button>
	<?php if (isset($_GET['mensaje'])):
	?>
		<h3 align="center"><i><?php echo $_GET['mensaje'];?></i></h3>			
	<?php endif ?>
    <div class="row mt">
	
      <div class="col-lg-12">
		
		<br>
       <h4><i class="fa fa-lock"></i> Nuevo Usuario</h4>
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

</body>
</html>
