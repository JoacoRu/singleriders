<?php
  require_once('funciones.php');
  require_once('loader.php');

  $nombres = $usuario->traerNombreDeUsuarios();
  //msjAseleccionar();

  $usuariologin = $autenticador->loginControl($usuario);

  if($_POST){
    $guardarMsj = $mensaje->crearMensaje($usuariologin['nombre'],$usuario,$_POST['to']);
  }


  $userViajes = $usuario->obtenerTodosLosViajes();

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
    <link rel="stylesheet" href="./css/muro2.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7-_ujclOOF7-Rj28am_xiblQJUNrTd3c"></script>
  </head>
  <body>
    <?php require_once('header.php'); ?>
    <section class="mt-5">
      <div class="container-fluid pt-5">
        <div class="row p-0 m-0 bg-white rounded home-row-main justify-content-center">
          <div class="col-12 p-0 top-muro-image d-flex align-items-center justify-content-center">
            <h1 class="font-weight-bold text-center">Todos los viajes</h1>
          </div>
          <?php require_once('lateral_izquierdo.php'); ?>
          <div class="col-12 p-0 col-md-8">
            <!--<div class="w-100 d-flex mt-4 pl-3 pr-3">
              <div class="d-flex justify-content-center align-items-center border rounded-circle stepper-muro">
                1
              </div>
              <div class="d-flex linea-steps" style="width:auto;height:1px;background:#cccccc">
              </div>
              <div class="d-flex justify-content-center align-items-center border rounded-circle stepper-muro">
                2
              </div>
              <div class="d-flex linea-steps" style="width:auto;height:1px;background:#cccccc">
              </div>
              <div class="d-flex justify-content-center align-items-center border rounded-circle stepper-muro">
                3
              </div>
            </div>-->
            <div class="card-columns">
              <?php $contadormodal=0; ?>
              <?php foreach ($userViajes['viajes'] as $key => $value) : ?>
                  <?php
                  $contadormodal++;
                  $publisher = $usuario->obtenerId($value['creadorDeViaje']);
                  ?>
                  <div class="card p-3 mt-3 text-center text-lg-left">
                    <div class="fondo-card"></div>
                    <?php if ($value['pais'] == 'india') :?>
                      <img class="card-img-top" src="./images/flags/<?= $value['pais'] ?>.png" alt="Card image cap">

                    <?php elseif ($value['pais'] == 'egipto') :?>
                      <img class="card-img-top" src="./images/flags/<?= $value['pais'] ?>.png" alt="Card image cap">

                    <?php elseif ($value['pais'] == 'nueva guinea') :?>
                      <img class="card-img-top" src="./images/flags/nuevaguinea.png" alt="Card image cap">

                    <?php else :?>
                      <img class="card-img-top" src="./images/flags/india.png" alt="Card image cap">
                    <?php endif; ?>

                    <div class="card-body">
                      <h5 class="card-title text-center">
                          <strong><?= $value['textmensaje'] ?></strong>
                      </h5>
                        <p class="card-text">
                          <strong>Salida: </strong><span class="ml-1"><?= $value['datein'] ?></span>
                          <br>
                          <strong>Publicado por:</strong>
                          <span class="ml-1">
                            <?= $publisher['nombre'] ?>
                          </span>
                        </p>
                        <!-- Button trigger modal -->
                        <div class="text-center mt-3">
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal<?= $contadormodal ?>">
                            Ver detalle
                          </button>
                        </div>
                    </div>
                  </div>
                  <!-- Modal -->
                  <div class="modal fade" id="Modal<?= $contadormodal  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Detalle del viaje</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p class="card-text">
                            <strong>Nombre del viaje: </strong><span class="ml-1"><?= $value['textmensaje'] ?></span>
                            <br>
                            <strong>País: </strong><span class="ml-1"><?= $value['pais'] ?></span>
                            <br>
                            <strong>Salida: </strong><span class="ml-1"><?= $value['datein'] ?></span>
                            <br>
                            <strong>Regreso: </strong><span class="ml-1"><?= $value['dateout'] ?></span>
                            <br>
                            <strong>Presupuesto: </strong><span class="ml-1"><?= $value['importe'] ?></span>
                            <br>
                            <strong>Moneda: </strong><span class="ml-1"><?= $value['moneda'] ?></span>
                            <br>
                            <strong>Publicado por:</strong>
                            <span class="ml-1">
                              <?= $publisher['nombre'] ?>
                            </span>
                            <br>
                            <strong>Email:</strong>
                            <span class="ml-1">
                              <?= $publisher['email'] ?>
                            </span>
                            <br>
                            <form method="post" class="mt-4">
                              <div class="form-label-group" id="mensajearea">
                                <textarea class="form-control" name="mensaje" placeholder="Escribí tu mensaje..."></textarea>
                              </div>
                              <input type="hidden" name="to" value=<?= intval($value['creadorDeViaje']) ?>>
                              <div class="container" id="enviar">
                                <div class="row flex-column flex-md-row justify-content-md-between align-items-md-center">
                                  <button type="submit" class="btn btn-primary iniciar mb-3 mb-md-0">Enviar mensaje</button>
                                </div>
                                <div class="row mt-3">
                                </div>
                              </div>
                            </form>

                          </p>
                        </div>
                        <div class="modal-footer mt-3">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                      </div>
                    </div>
                  </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </section>

    <?php require_once('footer.php'); ?>

    </body>
</html>
