

<?php


require_once '../../class/Modulo.php';
require_once '../../menu.php';

$listadoModulos=Modulo::obtenerTodos();


?>

<!DOCTYPE html>
<html>
<head>
  <title>Nuevo Perfil</title>
  <script type="text/javascript" src="/programacion3/Gestion/static/js/perfil/validacionPerfil.js" ></script>
</head>
<body>

  <section id="main-content">
    <section class="wrapper">
       <?php if (isset($_SESSION['mensaje_error'])) : ?>

                <font color="red" align="center">
                    <h3><?php echo $_SESSION['mensaje_error'] ?></h3>
                </font>
            <?php
                    unset($_SESSION['mensaje_error']);
                endif;
            ?>

         <div id="mensajeError"></div>
          <div class="row mt">

            <div class="col-lg-12">
              <h4><i class="fa fa-angle-right"></i> Nuevo Pefil</h4>
              <div class="form-panel">
                <div class=" form">
                  <br>
                  <form class="cmxform form-horizontal style-form" id="commentForm" name="frmDatos" method="POST" action = "procesar/guardar.php">
                  <div class="row mt">
                    <label class="col-lg-2 control-label">Descripcion:</label>
                    <div class="col-lg-10">
                      <input type="text" name="txtDescripcion" id= "txtDescripcion" class="form-control">
                    </div>
                  </div>
                  <div class="row mt">
                    <label class="col-lg-2 control-label">Acceso a modulos: </label>
                    <div class="col-lg-10">
                      <select id="cboModulos" name= "cboModulos[]" multiple style="width: 150px; height: 150px;">
                        <?php foreach($listadoModulos as $modulo): ?>
                          <option value="<?php echo $modulo->getIdModulo();?>"><?php echo $modulo?></option>
                        <?php endforeach?>
                      </select>
                    </div>
                  </div>
                  <div align="left">
                    <div class="row mt">
                      <div class="col-lg-offset-2 col-lg-10">
                        <input type="submit" name="btnGuardar" id="guardar" value="Guardar" onclick="validarPerfil();">
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

<script>

  $(function(){
    $('#guardar').on('click', function(e){
      $.ajax({
        type: "POST",
        url:"/programacion3/Gestion/modulos/perfil/procesar/validar.php",
        data:{
          'descripcion': $('#txtDescripcion').val(),
        },
        success: function(respuesta){
          if (respuesta == 1) {
            alert("Descripcion ya existente");
            //return;
          }
        }   
      })
    })
  })
  
</script>


</html>