
<html lang="en">

<head>
  <title>Single Riders</title>
  <meta charset="utf-8">
  <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Abel|Montserrat:400,400i,700,700i|Pacifico" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  <link rel="stylesheet" href="{{ asset('css/muro2.css') }}">
  <link rel="stylesheet" href="{{ asset('css/posteo.css') }}">
  <!-- <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script> -->
  <script src="{{ asset('js/profile.js') }}"></script>
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
            <img style="max-width: 30px;" class="border rounded-circle" src="#" alt="" id="foto-perfil">

            <form method="post" class="d-flex flex-column justify-content-center align-items-center pl-2" name="form">
              <input type='hidden' value='{{ csrf_token() }}' name='_token'>
              <textarea name="posteo" id="posteo" rows="10" placeholder="¿Que estas pensado?" style="resize: none;border: 1px solid lightgrey;"></textarea>
              <button type="submit" class="mt-3" id="boton_end">Publicar</button>

            </div>
        </form>
      </div>
      @if ($errors->has('email'))
          <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('post') }}</strong>
          </span>
      @endif
    </article>
    <section style="display: hidden;" id="publicaciones">
      <!-- POSTEO HTML -->
      @foreach($posts as $key)
        <div class="col-12 p-10 pt-4 col-md-8">
            <div class="articulo_post">
              <div class="posteos_card">
                  <div class="datos_post">
                      <img style="max-width: 30px;" class="border rounded-circle" src="imagen" alt="" id="foto-perfil">
                      <p> {{$key['name']}} {{$key['lastname']}}</p>
                  </div>
                  <div class="contenido_post">
                      <p>{{$key['post']}}</p>
                  </div>

                  <div class="post_interaccion">
              
                      <div class="form_interaccion">
                          <form method="post" action="/profileLike" name="interaccion">
                                @csrf
                              <label for="me_gusta">Me gusta</label>
                              <input type="hidden" value="{{$key['user_id']}}" name="user_id"> 
                              <input type="hidden" value="{{$key['post_id']}}" name="post_id">
                              <button type="submit" id="me_gusta" hidden> 
                          </form>
                      </div>
                      <div class="form_interaccion"> 
                          <label for="comentar">Comentar</label>
                      </div>
                  </div>
              </div>
          </div>
        </div>
        @endforeach
    </section>          
          </div>
        </div>
    </div>
  </section>
    

  </body>
</html>