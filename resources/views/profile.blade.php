
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
  <div class="padre col-12 p-10 pt-4 col-md-8">
    <audio id="audio" src="{{ asset('images/mama.mp3')}}">Play</audio>
    <article class="posteo_crear col-12 p-10 pt-4 col-md-8">
      <div class="publicacion rounded">
        <div class="publicacion_imagen">
            <img style="max-width: 30px;" class="border rounded-circle" src="images/<?=Auth::user()->src?>" alt="" id="foto-perfil">
            <form method="post" class="d-flex flex-column justify-content-center align-items-center pl-2" name="form" >
              @csrf
              @if(count($errors) != 0)
                <textarea name="posteo" id="posteo" rows="10" placeholder="{{ $errors->first()}}" style="resize: none; color: red; border: 1px solid red; "></textarea>
              @else
                <textarea name="posteo" id="posteo" rows="10" placeholder="¿Que estas pensado?" style="resize: none; border: 1px solid lightgrey;">{{old('dateIn')}}</textarea>
              @endif
              <button type="submit" class="mt-3" id="boton_end">Publicar</button>

            </form>
          </div>
        </div>
      <div>
    </article>

    <article id="publicaciones" style="width: 100%;">
      <!-- POSTEO HTML -->
      @foreach($posts as $key)
        <div class="col-12 p-10 pt-4 col-md-8">
            <div class="articulo_post">
              <div class="posteos_card">
                  <div class="datos_post">
                      <img style="max-width: 30px;" class="border rounded-circle" src="images/<?=Auth::user()->src?>" alt="" id="foto-perfil">
                      <p> {{$key['name']}} {{$key['lastname']}}</p>
                  </div>
                  <div class="contenido_post">
                      <p>{{$key['post']}}</p>
                  </div>

                  <div class="post_interaccion">

                      <div class="form_interaccion d-flex flex-row">
                              <label name="cantidad_mg">{{App\Like::bringLike($key['post_id'])}}</label>
                              @if(App\Like::existLike($key['user_id'], $key['post_id']) == 1)
                                <form method="post" action="/profileLike" name="interaccion">
                                  @csrf
                                  <input type="hidden" value="delete" name="accion">
                                  <input type="hidden" value="{{$key['user_id']}}" name="user_id">
                                  <input type="hidden" value="{{$key['post_id']}}" name="post_id">
                                  <label for="no_gusta{{ $key['post_id'] }}" class="no_gusta" onclick="color = black" style="color: red;">No me gusta</label>
                                  <button type="submit" id="no_gusta{{ $key['post_id'] }}"></button>
                                </form>
                              @else
                                <form method="post" action="/profileLike" name="interaccion">
                                  @csrf
                                  <label for="me_gusta{{ $key['post_id'] }}">Me gusta</label>
                                  <input type="hidden" value="insert" name="accion">
                                  <input type="hidden" value="{{$key['user_id']}}" name="user_id">
                                  <input type="hidden" value="{{$key['post_id']}}" name="post_id">
                                  <button type="submit" id="me_gusta{{ $key['post_id'] }}" hidden>
                                </form>
                              @endif
                              
                      </div>
                      <div class="form_interaccion">
                          <label for="comentar">Comentar</label>
                      </div>
                  </div>
              </div>
          </div>
        </div>
        @endforeach
        
    </article>
    <article class="pagination">
        <nav class="links">
          {{ $posts->links() }}
        </nav>
    </article>
          </div>
        </div>
    </div>
  </section>

  @include('partials.footer')

  </body>
</html>
