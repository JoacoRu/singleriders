<?php
  require_once('funciones.php');
  require_once('loader.php');

  $nombres = $usuario->traerNombreDeUsuarios();
  $mensaje = new Message();
  //msjAseleccionar();
  $usuariologin = $autenticador->loginControl($usuario); 
  $errores = [];
  $posteos = $post->recuperarPostDeUsuario();


  if($_POST){
    $guardarMsj = $mensaje->crearMensaje($usuariologin['nombre'],$usuario,$usuariologin['id']);
  }
  
  if($_GET)
  {
    $errores = $postValidator->validar();
    if(empty($errores))
    {
      $post->crearPost();
    }
  }
  $postRealizados = $post->recuperarPostDeUsuario();

  
  $userViajes = $usuario->obtenerViajes($usuariologin['id']);

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
    <link rel="stylesheet" href="./css/posteo.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7-_ujclOOF7-Rj28am_xiblQJUNrTd3c"></script>
  </head>

  <body>
    <?php require_once('header.php'); ?>
    <section class="mt-5 section">
      <div class="container-fluid pt-5">
        <div class="row p-0 m-0 bg-white rounded home-row-main justify-content-center">
          <div class="col-12 p-0 top-muro-image d-flex align-items-center justify-content-center">
            <h1 class="font-weight-bold text-center">Muro</h1>
          </div>

            <?php require_once('lateral_izquierdo.php'); ?>

      <!-- CREAR UN POST HTML -->
    <div class="col-12 p-10 pt-4 col-md-8">
      <article class="posteo_crear col-12 p-10 pt-4 col-md-8">
        <div class="publicacion">
            <div class="publicacion_imagen">
              <img style="max-width: 30px;" class="border rounded-circle" src=".<?=$usuariologin['srcImagenperfil']?>" alt="" id="foto-perfil">
              <form method="get">
                <textarea name="posteo" cols="30" rows="10" placeholder="¿Que estas pensado?" style="resize: none;"></textarea>
                <button type="submit" class="" id="boton_end">Publicar</button>
              </div>
          </form>
        </div>
      </article>

      <!-- POSTEO HTML -->
            <?php foreach ($postRealizados as $key => $value) : ?>
                  <?php if($value['user_id'] == $_SESSION['id']) : ?>
                  
                    <div class="col-12 p-10 pt-4 col-md-8">
                      <article class="articulo_post">
                        <div class="posteos_card">
                          <div class="datos_post">
                            <img style="max-width: 30px;" class="border rounded-circle" src=".<?=$usuariologin['srcImagenperfil']?>" alt="" id="foto-perfil">
                            <p><?= $usuariologin['nombre'] ?></p>
                          </div>
                          <div class="contenido_post">
                            <p><?php echo $value['post'] ?></p>
                          </div>
                          <div class="post_interaccion">
                            <label for="me_gusta">Me gusta</label>
                            <img src="images/iconos/interaccion_posteo/me-gusta_no_seleccionado.png" alt="" name="me_gusta">
                            <label for="comentar">Comentar</label>
                            <img src="images/iconos/interaccion_posteo/comentario.png" alt="" name="comentar">
                          </div>
                        </div>
                      </article>
                    </div>
                  <?php endif;?>
              <?php endforeach;?>
            </div>
          </div>
      </div>
    </section>

    <?php require_once('footer.php'); ?>

    </body>
</html>
