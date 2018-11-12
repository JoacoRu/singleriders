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
    @include('partials.navbar')
    <section class="mt-5 section">
      <div class="container-fluid pt-5">
        <div class="row p-0 m-0 bg-white rounded home-row-main justify-content-center">
          <div class="col-12 p-0 top-muro-image d-flex align-items-center justify-content-center">
            <h1 class="font-weight-bold text-center">Muro</h1>
          </div>

            @include('partials.lateral_izquierdo')

      <!-- CREAR UN POST HTML -->
    <div class="col-12 p-10 pt-4 col-md-8">
      <article class="posteo_crear col-12 p-10 pt-4 col-md-8">
        <div class="publicacion rounded">
            <div class="publicacion_imagen">
              <img style="max-width: 30px;" class="border rounded-circle" src="." alt="" id="foto-perfil">
              <form method="get" class="d-flex flex-column justify-content-center align-items-center pl-2">
                <textarea name="posteo" rows="10" placeholder="¿Que estas pensado?" style="resize: none;border: 1px solid lightgrey;"></textarea>
                <button type="submit" class="mt-3" id="boton_end">Publicar</button>
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

    @include('partials.footer')

    </body>
</html>
