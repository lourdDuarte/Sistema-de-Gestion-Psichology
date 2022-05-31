<?php
require_once '../../class/Usuario.php';

$id = $_GET['id'];

$usuarioDetalle= Usuario::obtenerPorId($id);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Datos Usuario</title>
</head>
<body>
	<?php
		require_once "../../menu.php";
	?>
 <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-md-12">
            <div class="content-panel">
              <h4><i class="fa fa-angle-right"></i> <?php echo $usuarioDetalle;?></h4>
              <hr>
              <table class="table">
                <thead>
                  <tr>

					<th>ID Usuario</th>
					<th>ID Persona</th>
					<th>Nombre</th>
					<th>Apellido</th>
					<th>Username</th>
					<th>Numero Documento</th>
					<th>Fecha Nacimiento</th>
				 	<th>Estado</th>
				 </tr>
                </thead>
                <tbody>
                  <tr>
                  	<td> <?php echo $usuarioDetalle->getIdUsuario();?></td>
					<td> <?php echo $usuarioDetalle->getIdPersona(); ?> </td>
					<td> <?php echo $usuarioDetalle->getNombre(); ?></td>
					<td> <?php echo $usuarioDetalle->getApellido(); ?></td>
					<td> <?php echo $usuarioDetalle->getUsername(); ?></td>
					<td> <?php echo $usuarioDetalle->getNumeroDocumento(); ?></td>
					<td> <?php echo $usuarioDetalle->getFechaNacimiento(); ?></td>
					<td> ACTIVO </td>
					</tr>

                </tbody>
              </table>

            </div>
          </div>
        </div>
      </section>
 
	</section> 



</body>

</html>