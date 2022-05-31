<?php
require_once '../../class/Perfil.php';

require_once '../../menu.php';

const SIN_ACCION = 0;
const PERFIL_GUARDADO = 1;
const PERFIL_MODIFICADO = 2;
if (isset($_GET['mensaje'])) {
	$mensaje = $_GET['mensaje'];
} else {
	$mensaje = SIN_ACCION;
}


$listadoPerfiles=Perfil::obtenerTodos();


?>

<!DOCTYPE html>
<html>
<head>
	<title>Listado Modulos</title>
</head>
<body>
	<section id="main-content">
      <section class="wrapper">
      			<?php if ($mensaje == PERFIL_GUARDADO){ ?>
				<h3 align="center"><i class="fa fa-check">Perfil guardado con exito</i></h3>
				<?php }elseif ($mensaje == PERFIL_MODIFICADO){ ?>
				<h3 align="center"><i class="fa fa-check">Perfil actualizado con exito</i></h3>
				<?php } ?>

      			<h3><i class="fa fa-angle-right"></i>Listado Perfiles</h3>
      			<a href="alta.php"><button type="button" class="btn btn-primary btn-sm">
         		Nuevo Perfil</button></a>
        		<div class="row mt">
          			<div class="col-md-12">
            			<div class="content-panel">
              				<table class="table table-striped table-advance table-hover">
                				<hr>
                				<thead>
                					<tr>
					                	<th><i class="fa fa-bullhorn"></i>ID Perfil</th>
										<th><i class="fa fa-bullhorn"></i>Descripcion</th>
										<th><i class="fa fa-bullhorn"></i>Accion</th>
									</tr>
								</thead>
                				<tbody>
                					<?php foreach($listadoPerfiles as $perfil): ?>
					                	<td> <?php echo $perfil->getIdPerfil(); ?> </td>
										<td> <?php echo $perfil->getDescripcion(); ?> </td>
										<td>
										<a href="detalle.php?id=<?php echo $perfil->getIdPerfil(); ?>" title="ver detalle">
				                      	<button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
				                    	</a>
										<a href="modificar.php?id=<?php echo $perfil->getIdperfil(); ?>" title= "actualizar">
											<button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
										</a>
						
										</td>
										</tr>	
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
		</section>
	</section>
</body>
</html>