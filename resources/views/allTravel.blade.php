
<!doctype html>
<html lang="en">
  <head>
    <title>Single Riders</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Abel|Montserrat:400,400i,700,700i|Pacifico" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel ="stylesheet" href="{{asset ('css/styles.css')}}">
    <link rel="stylesheet" href="{{asset ('css/crea.css')}}">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7-_ujclOOF7-Rj28am_xiblQJUNrTd3c"></script>
    <script src="{{ asset('js/turnOff.js') }}"></script>
  </head>
  <body>
  @include('partials.navbar')
    <section class="mt-5">
      <div class="container-fluid pt-5">
        <div class="row p-0 m-0 bg-white rounded home-row-main justify-content-center">
          <div class="col-12 p-0 top-muro-image d-flex align-items-center justify-content-center">
            <h1 class="font-weight-bold text-center">Todos los viajes</h1>
          </div>
          @include('partials.lateral_izquierdo')
          <div class="col-12 p-0 col-md-8">
            <div class="card-columns">
              <?php $contadormodal=0; ?>
              @foreach ($alltravels as $key => $value)
                  <div class="card p-3 mt-3 text-center text-lg-left">
                    <div class="fondo-card"></div>

                      <img class="card-img-top" src="./images/flags/{{$value['country']}}.png" alt="Card image cap">

                    <div class="card-body">
                      <h5 class="card-title text-center">
                          <strong>{{$value['msgInti']}}</strong>
                      </h5>
                        <p class="card-text">
                          <strong>Salida: </strong><span class="ml-1">{{$value['dateIn']}}</span>
                          <br>
                          <strong>Publicado por:</strong>
                          <span class="ml-1">
                                {{$value->user->name}}
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
                            <strong>Nombre del viaje: </strong><span class="ml-1">{{$value['msgInti']}}</span>
                            <br>
                            <strong>País: </strong><span class="ml-1">{{$value['country']}}</span>
                            <br>
                            <strong>Salida: </strong><span class="ml-1">{{$value['dateIn']}}</span>
                            <br>
                            <strong>Regreso: </strong><span class="ml-1">{{$value['dateOut']}}</span>
                            <br>
                            <strong>Presupuesto: </strong><span class="ml-1">{{$value['amount']}}</span>
                            <br>
                            <strong>Moneda: </strong><span class="ml-1">{{$value['coin']}}</span>
                            <br>
                            <strong>Publicado por:</strong>
                            <span class="ml-1">
                            {{$value->user->name}}
                            </span>
                            <br>
                            <strong>Email:</strong>
                            <span class="ml-1">
                            {{$value->user->email}}
                            </span>
                            <br>
                            <form method="post" class="mt-4">
                              @csrf
                              <div class="form-label-group" id="mensajearea">
                                <textarea class="form-control" name="mensaje" placeholder="Escribí tu mensaje..."></textarea>
                              </div>
                              <input type="hidden" name="creador_viaje" value="<?= $value->user->id ?>">
                              <div class="container" id="enviar">

                              <input type="hidden" name="travel_id" value="{{$value['travel_id']}}">
                              <div class="row flex-column flex-md-row justify-content-md-between align-items-md-center">
                                  <button type="submit" class="btn btn-primary iniciar mb-3 mb-md-0">Seguir este Viaje</button>
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
                  <?php $contadormodal+=1; ?>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </section>

     @include('partials.footer')

    </body>
</html>
