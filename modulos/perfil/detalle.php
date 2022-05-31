<?php

require_once '../../class/Perfil.php';

require_once '../../class/Modulo.php';

require_once '../../menu.php';

$id = $_GET['id'];

$perfil = Perfil::obtenerPorId($id);

$listadoModulos = Modulo::obtenerModulosPorIdPerfil($id);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Detalle Perfil</title>
</head>
<body>
<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-md-12">
            <div class="content-panel">
              <h4><i class="fa fa-angle-right"></i> <?php echo $perfil;?></h4>
              <hr>
              	<table class="table">
	                <thead>
	                  <tr>
						<th>ID Perfil</th>
						<th>Descripcion</th>
						<th>Modulos</th>
					   </tr>
					</thead>
					<tbody>
						<tr>
							<td><?=$perfil->getIdPerfil();?></td>
							<td><?=$perfil->getDescripcion();?></td>
							<td>
							<?php foreach ($listadoModulos as $modulo): ?>
									<?php 

										$idModulo = $modulo->getIdModulo();

											if ($perfil->tieneModulo($idModulo)) {
												echo "$modulo -";
											} 

									?>
							<?php endforeach ?>
							</td>
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

