@extends('layouts.profile')

<html lang="en">

<head>
  <title>Single Riders</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @section('archivos')
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
            <img style="max-width: 30px;" class="border rounded-circle" src="#" alt="" id="foto-perfil">
            <form method="get" class="d-flex flex-column justify-content-center align-items-center pl-2">
              <textarea name="posteo" rows="10" placeholder="¿Que estas pensado?" style="resize: none;border: 1px solid lightgrey;"></textarea>
              <button type="submit" class="mt-3" id="boton_end">Publicar</button>
            </div>
        </form>
      </div>
    </article>

    <!-- POSTEO HTML -->
          

                  <div class="col-12 p-10 pt-4 col-md-8">
                    <article class="articulo_post">
                      <div class="posteos_card">
                        <div class="datos_post">
                          <img style="max-width: 30px;" class="border rounded-circle" src="imagen" alt="" id="foto-perfil">
                          <p>Nombre Usuario</p>
                        </div>
                        <div class="contenido_post">
                          <p>Contenido post</p>
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
          </div>
        </div>
    </div>
  </section>
    
    @include('partials.footer')

  </body>
</html>