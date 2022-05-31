<?php

require_once '../../class/ObraSocial.php';
require_once "../../menu.php";

CONST SIN_ACCION = 0;
CONST OBRA_SOCIAL_GUARDADA = 1;
CONST OBRA_SOCIAL_ACTUALIZADA = 2;
CONST OBRA_SOCIAL_ELIMNADA = 3;

if (isset($_GET['mensaje'])){
	$mensaje=$_GET['mensaje'];
}else {
	$mensaje = SIN_ACCION;
} 


$listadoObraSocial = ObraSocial::obtenerTodos();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Obra Social</title>

</head>
<body>
<section id="main-content">
	<section class="wrapper">
		<?php if ($mensaje == OBRA_SOCIAL_GUARDADA){ ?>
		  <h3 align="center"><i class="fa fa-check">Obra Social Guardada con Exito</i></h3>
		<?php }elseif ($mensaje == OBRA_SOCIAL_ACTUALIZADA){ ?>
			  <h3 align="center"><i class="fa fa-check">Obra Social Actualizada con Exito</i></h3>
		<?php }elseif ($mensaje == OBRA_SOCIAL_ELIMNADA){ ?>
			  <h3 align="center"><i class="fa fa-check">Obra Social eliminada</i></h3>
			  <br><br>
		<?php } ?>
 		<h3><i class="fa fa-angle-right"></i> Listado Obra Sociales</h3>
 		<a href="alta.php"><button type="button" class="btn btn-primary btn-sm">
         Nueva Obra Social</button></a>
        <div class="row mt">
          <div class="col-md-12">
            <div class="content-panel">
              <table class="table table-striped table-advance table-hover">
	                <hr>
	                <thead>
	                  <tr>
							<th><i class="fa fa-bullhorn"></i>Nombre</th>
							<th><i class="fa fa-bullhorn"></i>Acciones</th>
						</tr>
	                </thead>
	                <tbody>
					<?php foreach ($listadoObraSocial as $obraSocial): ?>
					<tr>
						<td> <?php echo $obraSocial->getNombre(); ?> </td>
						<td>
							<a href="detalle.php?id=<?php echo $obraSocial->getIdObraSocial(); ?>" title="ver detalle">
	                      <button class="btn btn-success btn-xs"><i class="fa fa-eye"></i></button>
							</a>
							<a href="modificar.php?id=<?php echo $obraSocial->getIdObraSocial(); ?>"title= "actualizar">
	                      <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
							</a>
							<a href="procesar/eliminar.php?id=<?php echo $obraSocial->getIdObraSocial(); ?>" title= "eliminar">
	                      <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
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