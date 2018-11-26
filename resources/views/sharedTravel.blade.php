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
  </head>
  <body>
  @include('partials.navbar')
    <section class="mt-5">
      <div class="container-fluid pt-5">
        <div class="row p-0 m-0 bg-white rounded home-row-main justify-content-center">
          <div class="col-12 p-0 top-muro-image d-flex align-items-center justify-content-center">
          @foreach($sharedTravel as $key =>$value)
             @if(Auth::id()==$value->follower_user_id && $travel_id == $value->travel_id)
            <h1 id="sharedTitle" class="font-weight-bold text-center" >{{$value->msgInti}}</h1>
          </div>
           <!-- Button trigger modal -->
          <div class= "botones-modal">
          
          <button type="button"  class="btn btn-primary" data-toggle="modal" data-target="#modalfechas">
          Fechas del viaje
          </button>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#flexibilidad">
          Flexibilidad de fechas
          </button>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pais">
          País al que viajamos
          </button>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tipodeviaje">
          Tipo de Viaje
          </button>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#presupuesto">
          Presupuesto
          </button>
        
          </div>
          <!-- Modal -->

          <div class="modal fade" id="modalfechas" tabindex="-1" role="dialog" aria-labelledby="modalfechas" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Fechas del Viaje</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                        </button>
          </div>
            <div class="modal-body">
               Inicio del Viaje: {{$value->dateIn}}
               Fin del Viaje: {{$value->dateOut}}
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
            </div>
            </div>
            </div>
            <div class="modal fade" id="flexibilidad" tabindex="-1" role="dialog" aria-labelledby="flexibilidad" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Flexibilidad de fechas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                        </button>
          </div>
            <div class="modal-body">
             {{$value->flexibility}}
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
            </div>
            </div>
            </div>
            <div class="modal fade" id="pais" tabindex="-1" role="dialog" aria-labelledby="pais" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">País al que viajamos</h5> 
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                        </button>
          </div>
            <div class="modal-body">
             {{$value->country}}
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
            </div>
            </div>
            </div>
            <div class="modal fade" id="presupuesto" tabindex="-1" role="dialog" aria-labelledby="presupuesto" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Presupuesto</h5> 
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                        </button>
          </div>
            <div class="modal-body">
             Importe:{{$value->amount}}
             Moneda:{{$value->coin}}
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
            </div>
            </div>
            </div>
            <div class="modal fade" id="tipodeviaje" tabindex="-1" role="dialog" aria-labelledby="tipodeviaje" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Tipo de Viaje</h5> 
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                        </button>
          </div>
            <div class="modal-body">
             {{$value->activities}}
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
            </div>
            </div>
            </div>
            @endif
            @endforeach
          <div class="col-12 p-0 col-md-8">
           <h2 class=itiTitle>Itinerario del Viaje</h2>
          @for($i=1;$i<$diff;$i++)
          <p>Día {{$i}} <p>
          <p><div class="input-group">
          <span class="input-group-addon"></span>
          <input type="text" class="form-control" placeholder="Itinerario">
          </div></p>
          @endfor
         
          
      </div>
    </section>

     @include('partials.footer')
    </body>
</html>