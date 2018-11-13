
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
      <link href="https://fonts.googleapis.com/css?family=Abel|Montserrat:400,400i,700,700i|Pacifico" rel="stylesheet">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

      <script type="text/javascript" src="{{asset ('js/jquery-3.3.1.min.js')}}"></script>
      <script type="text/javascript" src="{{('js/jquery.cycle2.min.j')}}"></script>
      <script src="js/crea.js"></script>
      <link rel="stylesheet" href="css/owl.carousel.css">
      <link rel="stylesheet" href="css/owl.theme.default.css">
      
      <link rel ="stylesheet" href="{{asset ('css/styles.css')}}">
      <link rel="stylesheet" href="{{asset ('css/crea.css')}}">


    <title></title>
  </head>
  <body>
  @include('partials.navbar')
    <section class="container-fluid">
    <div class="titulos">
      <div class="row">
        <div class= "col-12">
          <h1>CREA EL VIAJE DE TUS SUEÑOS</h1>
          <h3>Compartilo en linea con todos los viajeros</h3>
        </div>
        </div>
    </div>
    <div class="wrap">
      <div class="row">
        <div class= "col-12">
          <ul class="tabs">
            <li><a href="#tab1"><span class="fa fa-info"></span><span class="tab-text">Info General</span></a></li>
            <li><a href="#tab2"><span class="fa fa-map-marked-alt"></span><span class="tab-text">Destinos</span></a></li>
            <li><a href="#tab3"><span class="fa fa-dollar-sign"></span><span class="tab-text">Presupuesto</span></a></li>
            <li><a href="#tab4"><span class="fa fa-edit"></span><span class="tab-text">Itinerario de tu viaje </span></a></li>
          </ul>
            <div class="secciones">
            <article id="tab1">
              <form method="post" enctype="multipart/form-data">

               <input type="text" id="msgInti" onkeyup="$('#mensaje').text($('#msgInti').val());" class="form-control" name="msgInti" value="{{old('msgInti')}}" placeholder="Ponele un Titulo a tu viaje..."></textarea>
               

              <div class="d-flex flex-column flex-md-row align-items-md-center mt-2">
                Partida: <input class="ml-2 mr-4" type="date" name="dateIn" value="{{old('dateIn')}}"> 
                Regreso: <input class="ml-2 mr-4" type="date" name="dateOut" value="{{old('dateOut')}}"><br></br>
               
              </div>
              <label for="flexibility" > ¿Tus Fechas son flexibles?</label><br></br>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="flexibility" value="{{old('flexibility')}}" id="infoGeneral" value="option1">
                <label class="form-check-label" for="inlineRadio1">Si, seguro!</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="flexibility" value="{{old('flexibility')}}" id="infoGeneral" value="option2">
                <label class="form-check-label" for="inlineRadio2">Lo podemos Charlar!</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="flexibility"value="{{old('flexibility')}}"  id="infoGeneral" value="option3">
                <label class="form-check-label" for="inlineRadio3">No puedo mover las fechas</label>
              </div>
            </article>
              <article id="tab2">
                <label for="country">¿Adonde queres ir?</label>
                <select class="form-control" name="country" value="{{old('country')}}">
                
                  <option value="">Selecciona el país a visitar</option>
                 
                </select>


                <!--<select class="form-control" name="ciudad">
                  <option value="">Selecciona la ciudad a visitar</option>
                 
                </select>-->
                <label for="activities">¿Que tipo de viaje queres hacer?</label>
                <select class="custom-select" size="3">
                  <option value="1">Aventura</option>
                  <option value="2">Impacto Social</option>
                  <option value="3">Relax y playa</option>
                  <option value="2">Proyectos Ecológcos</option>
                  <option value="3">Relax y playa</option>
                </select>
              </article>
              <article id="tab3">
                <div class="card-body">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Importe</span>
                      
                      </div>
                      <input type="text" class="form-control" name="amount" value="{{old('amount')}}" aria-label="Amount (to the nearest dollar)">
                      <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                      </div>
                    </div>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text">Moneda</span>
                       
                        </div>
                        <input type="text" class="form-control" name="coin"  value="{{old('coin')}}" aria-label="Amount (to the nearest dollar)">
                      </div>
                    </div>
              </article>
              <article id="tab4">
                <div class="card-body">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="inputGroupSelect01">Dia 1</label>
                    </div>
                    <select class="custom-select" name="city" value="{{old('city')}}">
                    </select>
                  </div>
                  <div class="descripcion">
                    <textarea id="descripcion" class="form-control" name="mensajeiti" placeholder="Que vas a hacer en esta ciudad?..."></textarea>
                  </div>
                  <input type="submit" class="btn btn-primary" value="Guarda Tu Viaje">
                </div>
              </article>
              <article id"tab3">

              </article>

            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="card-deck">
<div class="card">
  <img class="card-img-top" src="images/crea/america.jpeg" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">America Del Sur</h5>
    <p class="card-text">Desde los picos nevados de los Andes a los extensos ríos de la región del Amazonas, el sur de América tiene una larga lista de maravillas naturales para todos los gustos</p>
  </div>
  <div class="card-footer">
    <small class="text-muted">Conoce los mejores destinos</small>
  </div>
</div>
<div class="card">
  <img class="card-img-top" src="images/crea/beach.jpg" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">Caribe</h5>
    <p class="card-text">El Caribe es definitivamente  un lugar que es sinónimo de hermosas imágenes de arenas blancas, aguas turquesa, cocteles, sol brillante y mucho relax. Aunque estas son las palabras que lo describen en su mayoría, las islas caribeñas ofrecen mucho más de lo que puedas imaginar.</p>
  </div>
  <div class="card-footer">
    <small class="text-muted">Conoce los mejores destinos</small>
  </div>
</div>
<div class="card">
  <img class="card-img-top" src="images/crea/eeuu.jpeg" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">America del Norte</h5>
    <p class="card-text">Sus ciudades desvelan arquitecturas de una modernidad sin igual que se encuentran a tan solo unas horas de los paisajes más salvajes, en los que puedes vivir aventuras en tu tienda de campaña o con la mochila a la espalda rodeado de una naturaleza muy bien conservada.</p>
  </div>
  <div class="card-footer">
    <small class="text-muted">Conoce los mejores destinos</small>
  </div>
</div>
<div class="card">
  <img class="card-img-top" src="images/crea/europa.jpeg" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">Europa</h5>
    <p class="card-text">A algunos les atrae su historia, la multiplicidad de culturas en un mismo espacio, las bellezas naturales, la facilidad para el transporte, la amplia y variada oferta de alojamiento, la arquitectura, las playas, las compras.</p>
  </div>
  <div class="card-footer">
    <small class="text-muted">Conoce los mejores destinos</small>
  </div>
</div>
<div class="card">
  <img class="card-img-top" src="images/crea/resto.png" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">Resto</h5>
    <p class="card-text">Viajar a un destino exótico es conocer un nuevo país, una nueva cultura, nuevas costumbres y tradiciones, ajenas a lo ya explorado. Elegir un viaje no es una decisión fácil, pero es preferible distanciarnos de lo cotidiano, abrir nuestras mentes y disfrutar de las riquezas de una novedosa excursión..</p>
  </div>
  <div class="card-footer">
    <small class="text-muted">Conoce los mejores destinos</small>
  </div>
</div>
</div>

    </section>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    </script>
  </body>
  </html>
