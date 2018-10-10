<?php

  require_once('funciones.php');
  require_once('loader.php');
  $nombres = $usuario->traerNombreDeUsuarios();
  $allUsers = $usuario->buscarUsuarios();
  $msj = $mensaje->msjAseleccionar();


  $usuariologin = $autenticador->loginControl($usuario);

  isset($_GET['userchat']) ? $userchat = intval($_GET['userchat']) : $userchat = '';

  if($_POST){
    $guardarMsj = $mensaje->crearMensaje($usuariologin['nombre'],$usuario,$userchat);
  }



?>
<!doctype html>
<html lang="en">
  <head>
    <title>Single Riders</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Abel|Montserrat:400,400i,700,700i|Pacifico" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/styles.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7-_ujclOOF7-Rj28am_xiblQJUNrTd3c"></script>
  </head>
  <body>
    <?php require_once('header.php'); ?>
    <section class="mt-5">
      <div class="container-fluid pt-5 w-lg-75">
        <div class="row p-0 m-0 bg-white rounded home-row-main">
          <div class="col-12 p-0 top-muro-image d-flex align-items-center justify-content-center">
            <h1 class="font-weight-bold">Mensajes</h1>
          </div>
          <div class="container-fluid">
              <div class="row justify-content-center">
                <?php require_once('lateral_izquierdo.php'); ?>
                <div class="col-12 mt-2 col-md-8">
                  <div class="container-fluid">
                    <div class="row justify-content-center">
                      <div class="col-12 col-lg-8">
                        <h2 class="mt-4 mb-4 text-center">Enviar Mensaje</h2>
                        <div class="w-100 d-flex mt-4 pl-3 pr-3">
                          <div class="d-flex justify-content-center align-items-center border rounded-circle stepper-muro stepunomsj <?= !isset($_GET['userchat']) ? 'btn-primary' : '' ?>">
                            1
                          </div>
                          <div class="d-flex linea-steps" style="width:auto;height:1px;background:#cccccc">
                          </div>
                          <div class="d-flex justify-content-center align-items-center border rounded-circle stepper-muro stepdosmsj <?= isset($_GET['userchat']) ? 'btn-primary' : '' ?>">
                            2
                          </div>
                          <div class="d-flex linea-steps" style="width:auto;height:1px;background:#cccccc">
                          </div>
                          <div class="d-flex justify-content-center align-items-center border rounded-circle stepper-muro steptresmsj">
                            3
                          </div>
                        </div>
                        <div>
                          <form method="post" class="mt-4">
                            <div class="form-label-group" id="touser">
                              <select id="to_id" name="to_id" class="form-control" onchange="$('#mensajearea').show();setactivo($('.stepdosmsj'));window.location.assign(window.location.origin+window.location.pathname+'?userchat='+document.getElementById('to_id').value)">
                                <option value="elige_usuario">Seleccioná un usuario</option>
                                <?php foreach ($allUsers as $nombre) { ?>
                                <option <?= $nombre['id'] == $userchat ? 'selected' : '' ?> value="<?php echo $nombre['id']; ?>"><?php echo $nombre['email']; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                            <div class="form-label-group" id="mensajearea" style="display:<?= isset($_GET['userchat']) ? 'block' : 'none' ?>">
                              <textarea onkeyup="$('#enviar').show();setactivo($('.steptresmsj'));" class="form-control" name="mensaje" placeholder="Escribí tu mensaje..."></textarea>
                            </div>
                            <div class="container" id="enviar">
                              <div class="row flex-column flex-md-row justify-content-md-between align-items-md-center">
                                <button type="submit" class="btn btn-primary iniciar mb-3 mb-md-0">Enviar</button>
                              </div>
                              <div class="row mt-3">
                              </div>
                            </div>

                          </form>
                        </div>
                        <div class="border rounded px-4 mb-3">
                          <h2 class="mt-4 mb-4">Mensajes</h2>

                          <?php foreach ($msj as $key) :?>
                          <?php if (($key['to_id'] == $usuariologin['id'] && $key['from_id'] == $userchat) || ($key['from_id'] == $usuariologin['id'] && $key['to_id'] == $userchat)) :?>
                            <p><strong><span class="<?= ( $key['from_id'] == $usuariologin['id'] ) ? 'userchatlogueado' : 'otrouserchat'  ?>"><?= $key['from_id'] == $usuariologin['id'] ? $usuariologin['nombre'].'</span> (el '.date_format(date_create($key['fecha']),'d-m-Y H:i:s') : $key['nombreRemitente'].'</span> (el '.date_format(date_create($key['fecha']),'d-m-Y H:i:s')  ?>)</strong>: <?= $key['msj'] ?></p>
                          <?php endif; ?>
                          <?php endforeach; ?>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 pt-3 col-md-3 d-flex align-items-center flex-column" style="display:none !important;">
                  <!--<h5 class="mb-3">Top destinos</h5>
                  <ul class="list-unstyled">
                    <li>Europa del este</li>
                    <li>Asia</li>
                    <li>América</li>
                  </ul>-->
                </div>
              </div>
            </div>
          </div>
      </div>
    </section>

    <?php require_once('footer.php'); ?>

    </body>
    <script type="text/javascript">
      //$('#mensajearea').hide();
      $('#enviar').hide();
      function setactivo(valor) {
        $('.stepunomsj').removeClass('btn-primary');
        $('.stepdosmsj').removeClass('btn-primary');
        $('.steptresmsj').removeClass('btn-primary');
        valor.addClass('btn-primary');
      }
    </script>
</html>
