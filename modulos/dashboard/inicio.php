<?php
require_once "../../class/Usuario.php";
require_once "../../menu.php"; 


session_start();

if (!isset($_SESSION['usuario'])) {
	header('location: formulario_login.php');
}

$usuario = $_SESSION['usuario'];


?>

<!DOCTYPE html>
<html>
<head>
  <title></title>

</head>


<body>
	
	<section id= "main-content">
		<section class="wrapper">
        <div class="row">
          <div class="col-lg-9 main-chart">
            <!--CUSTOM CHART START -->
            <div class="border-head">
              <h3>Bienvenido</h3>
             
            </div>


	</section>


</body>

</html>