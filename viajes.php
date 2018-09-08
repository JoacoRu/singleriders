<?php

require_once('funciones.php');
$nombres = traerNombreDeUsuarios();
msjAseleccionar();

if (!isset($_SESSION['id']) && !isset($_COOKIE['id'])) {
  header('location:login.php');
}else if (isset($_SESSION['id'])) {
  $usuariologin = obtenerId($_SESSION['id']);
}else if (isset($_COOKIE['id'])) {
  $usuariologin = obtenerId($_COOKIE['id']);
}else {
  header('location:login.php');
}
if($_POST){
  $guardarMsj = crearMensaje($usuariologin['nombre']);
}


$userViajes = obtenerTodosLosViajes();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- FUENTES -->
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Abel|Montserrat:400,400i,700,700i|Pacifico" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <!-- FUENTE MENU DE NAVEGACION IZQUIERDO-->
    <link href="https://fonts.googleapis.com/css?family=Acme" rel="stylesheet">
    <!-- CSS-->
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/styles.css">
    <title>Document</title>
</head>
<body>
    <?php require_once('header.php'); ?>
    <section class="super-container container">
        <!-- CAJA RELLENO -->
        <div class="relleno"></div>
        <!-- CAJA IZQUIERDA -->
        <article class="izquierda">
            <div class="datos-perfil">
                <img src=".<?=$usuariologin['srcImagenperfil']?>" alt="" id="foto-perfil">
                <button id="editar-foto"><a href="editar_perfil.php"><img src="images/iconos/home/editar.png" alt=""> <p>Editar perfil</p></button></a>
            </div>
            <div class="caja-navegacion-perfil">
                <ul class="navegacion-perfil">
                    <li style="display:none;">
                        <img src="images/iconos/home/perfil_chico.png" alt="" width="20px">
                        <a href="perfil.php">Ver mi Perfil</a>
                    </li>
                    <li>
                        <img src="images/iconos/home/crear_viaje.png" alt="">
                        <a href="crea2.php">Crear Viaje</a>
                    </li>
                    <li>
                        <img src="images/iconos/home/ver_mis_viajes.png" alt="">
                        <a href="home.php">Ver mis Viajes</a>
                    </li>
                    <li>
                        <img src="images/iconos/home/ver_mis_viajes.png" alt="">
                        <a href="viajes.php">Todos los Viajes</a>
                    </li>
                    <li style="display:none;">
                        <img src="images/iconos/home/crear_grupo.png" alt="">
                        <a href="#">Crear Grupo</a>
                    </li>
                    <li style="display:none;">
                        <img src="images/iconos/home/unirte_a_viaje.png" alt="">
                        <a href="#">Unirte a Grupo</a>
                    </li>
                    <li>
                        <img src="images/iconos/home/sobre.png" alt="">
                        <a href="mensajes.php">Ver mis Mensajes</a>
                    </li>
                </ul>
            </div>
            <div class="redes" style="display:none">
                <div class="redes-titulo">
                    <h5>
                        Social
                    </h5>
                </div>
                <div class="menu-social">
                    <ul>
                        <li>
                            <a href="#"><img src="images/iconos/home/redes/facebook.png" alt=""></a>
                        </li>
                        <li>
                            <a href="#"><img src="images/iconos/home/redes/instagram.png" alt=""></a>
                        </li>
                        <li>
                            <a href="#"><img src="images/iconos/home/redes/twitter.png" alt="" style="border-radius: 5px;"></a>
                        </li>
                        <li>
                            <a href="#"><img src="images/iconos/home/redes/google-plus.png" alt="" style="border-radius: 5px;"></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="redes" style="display:none;">
                <div class="redes-titulo">
                    <h5>
                        Viajes Aleatorios
                    </h5>
                </div>
                <div class="viajes_aleatorios">
                    <p>Proximamente</p>
                </div>
            </div>
        </article>
        <!-- CAJA CENTRO -->
        <article class="centro">
            <div class="muro">
                <div class="header_muro">
                     <p>Muro</p>
                </div>
                <div class="contenido_muro">
                    <!-- <div class="centro-muro container">
                        <div class="foto-publicar">
                            <div class="imagen_foto">
                                <img src="images/perfil.jpg" alt="" width="50px">
                                <p><?= $usuariologin['nombre']; ?></p>
                            </div>
                            <div class="caja_texto container">
                                <form action="get">
                                    <textarea name="publicacion" id="" cols="15" rows="3" placeholder="¿Que estas pensando?"></textarea>
                                    <br>
                                    <input type="submit" value="Publicar">
                                </form>
                            </div>
                        </div> -->
                        <?php $contadormodal=0; ?>
                        <?php foreach ($userViajes['viajes'] as $key => $value) : ?>
                            <?php
                            $contadormodal++;
                            $publisher = obtenerId($value['creadorDeViaje']);
                            ?>
                            <div class="card p-3 m-3">
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
        </article>
    </section>
    <?php require_once('footer.php'); ?>

</body>
</html>
