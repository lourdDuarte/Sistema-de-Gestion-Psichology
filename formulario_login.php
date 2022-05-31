<?php

const USUARIO_GUARDADO = 1;

$mensaje = '';
if (isset($_GET['mensaje'])) {
	$mensaje = $_GET['mensaje'];
} 


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>Iniciar Sesion</title>

  <!-- Favicons -->
  <link href="static/template/img/favicon.png" rel="icon">
  <link href="static/template/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="static/template/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="static/template/ib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="static/template/css/style.css" rel="stylesheet">
  <link href="static/template/css/style-responsive.css" rel="stylesheet">
  
  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

<body>
  <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
<div id="login-page">
  <div class="container">
  <?php if ($mensaje == USUARIO_GUARDADO): ?>
					<h3 align="center"><i class="fa fa-check">Usuario registrado con exito</i></h3>
	<?php endif ?>
      <form class="form-login"  method="POST" action="modulos/usuarios/procesar/login.php">
            <h2 class="form-login-heading">PSYCHOLOGY</h2>
              <div class="login-wrap">
                <input type="text" name ="txtUsuario" class="form-control" placeholder="Usuario" autofocus>
                <br>
                <input type="password" name="txtPassword" class="form-control" placeholder="Contraseña">
                <br>
                <button class="btn btn-theme btn-block" href="index.html" type="submit"><i class="fa fa-lock"></i> INICIAR SESION</button> 
              </div>
              <div class="login-social-link centered">
                <div class="registration">
                  ¿No se encuentra registrado?<br/>
                    <i class="fa fa-lock"><a class="" onclick="location.href='/programacion3/Gestion/modulos/registro/registro.php'">
                    Crear cuenta
                    </a></i>
                </div>
                </div>
        </form> 
  </div>  
</div>
         
  
  
</body>

</html>

