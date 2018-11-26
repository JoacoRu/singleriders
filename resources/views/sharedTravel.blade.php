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
  @include('partials.navbar')
    <section class="mt-5">
      <div class="container-fluid pt-5">
        <div class="row p-0 m-0 bg-white rounded home-row-main justify-content-center">
          <div class="col-12 p-0 top-muro-image d-flex align-items-center justify-content-center">
            <h1 class="font-weight-bold text-center" ></h1>
          </div>
           <!-- Button trigger modal -->
          <button type="button"  class="btn btn-primary" data-toggle="modal" data-target="#modalfechas">
          Fechas del viaje
          </button>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
          Flexibilidad de fechas
          </button>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
          País al que viajamos
          </button>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
          Tipo de Viaje
          </button>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
          Presupuesto
          </button>
          
          <!-- Modal -->
          
          <div class="modal fade" id="modalfechas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                        </button>
          </div>
            <div class="modal-body">
            @foreach($sharedTravel as $key =>$value)
             @if(Auth::id()==$value->follower_user_id)
               {{$value->dateIn}}
             @endif
            
                        
            @endforeach
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
            </div>
            </div>
            </div>
          <div class="col-12 p-0 col-md-8">
           <h2 class=itiTitle>Itinerario del Viaje</h2> 
      </div>
    </section>

     @include('partials.footer')
    </body>
</html>
