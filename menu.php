<?php

require_once "class/Usuario.php";


session_start();

if (!isset($_SESSION['usuario'])) {
	header('location: /programacion3/Gestion/formulario_login.php');
}

$usuario = $_SESSION['usuario'];

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>


<?php require_once 'layouts/head.php';?>


</head>


<header>
  
<?php require_once 'layouts/header.php'; ?>

</header>
<body>
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered">
            <a href="profile.html"><img src="" class="img-circle" width="80"></a>
          </p>
          <h5 class="centered"><?php echo $usuario;?></h5>
          <li class="mt">
		<?php foreach ($usuario->perfil->getModulos() as $modulo): ?>
            <a href="/programacion3/gestion/modulos/<?php echo $modulo->getDirectorio()?>/listado.php">
              <i class="fa fa-dashboard"></i>
              <span><?php echo $modulo;?></span>
              </a>
        <?php endforeach; ?>
          
        </ul>
      </div>
    </aside>
</body>








