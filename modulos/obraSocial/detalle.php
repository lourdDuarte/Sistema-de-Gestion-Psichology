<?php
require_once '../../class/ObraSocial.php';

$id = $_GET['id'];

$obraSocial= ObraSocial::obtenerPorId($id);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Detalle Obra Social</title>

</head>
<body>
	<?php
		require_once "../../menu.php";
	?>
	<br><br>

<section id="main-content">
		<section class="wrapper">
 			<h3><i class="fa fa-angle-right"></i> <?php echo $obraSocial;?></h3>
        	<div class="row mt">
          		<div class="col-md-12">
            		<div class="content-panel">
              			<table class="table table-striped table-advance table-hover">
                			<hr>
							<thead>
								<tr>
									<th>ID Obra Social</th>
									<th>Nombre</th>
									<th>CO Seguro</th>

			    				</tr>
                			</thead>
                			<tbody>

								<tr>
									<td> <?php echo $obraSocial->getIdObraSocial(); ?> </td>
									<td> <?php echo $obraSocial->getNombre(); ?></td>
									<td> <?php echo $obraSocial->getCoSeguro(); ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</section>
	</section>
</body>