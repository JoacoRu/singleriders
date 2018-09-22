<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php
require_once('classes/Creaviaje.php');
require_once('funciones.php');
require_once('loader.php');
if (!isset($_SESSION['id']) && !isset($_COOKIE['id'])) {
  header('location:login.php');
}else if (isset($_SESSION['id'])) {
  $usuariologin = $usuario->obtenerId($_SESSION['id']);
}else if (isset($_COOKIE['id'])) {
  $usuariologin = $usuario->obtenerId($_COOKIE['id']);
}else {
  header('location:login.php');
}
$textmensaje = '';
$datein = '';
$dateout = '';
$pais='';
$ciudad='';
$importe='';
$moneda='';
$errores = [];
$paises = traerPaises();
//$ciudades = traerCiudades();
if ($_POST) {
  //echo '<pre>';
  //echo var_dump($_POST);
  $textmensaje = trim($_POST['mensaje']);
  $datein = trim($_POST['datein']);
  $dateout = trim($_POST['dateout']);
  $pais = trim($_POST['pais']);
  //$ciudad = trim($_POST['ciudad']);
  $importe = trim($_POST['importe']);
  $moneda = trim($_POST['moneda']);
  $creadorDeViaje = $_SESSION['id'];
  $errores = $viaje->validarviaje($_POST);
  if (empty($errores)) {
      //var_dump($errores);
      $viaje->guardarViaje($_POST,$creadorDeViaje);
  }else {
    //var_dump($errores);
    //exit;
  }
}

?>
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
      <link href="https://fonts.googleapis.com/css?family=Abel|Montserrat:400,400i,700,700i|Pacifico" rel="stylesheet">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

      <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
      <script src="crea.js"></script>
      <link rel="stylesheet" href="css/styles.css">
      <link rel="stylesheet" href="css/crea.css">


    <title></title>
  </head>
  <body>
    <?php require_once('header.php'); ?>
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

                <input type="text" id="textmensaje" onkeyup="$('#mensaje').text($('#textmensaje').val());" class="form-control" name="mensaje" value="<?=$textmensaje?>" placeholder="Ponele un Titulo a tu viaje..."></textarea>
                <?php if (isset($errores['mensaje'])):?>
                  <p><?= $errores['mensaje'] ?></p>
                <?php endif; ?>

              <div class="d-flex flex-column flex-md-row align-items-md-center mt-2">
                Partida: <input class="ml-2 mr-4" type="date" name="datein" value="<?=$datein?>">
                Regreso: <input class="ml-2 mr-4" type="date" name="dateout" value="<?=$dateout?>"><br></br>
                <?php if (isset($errores['datein'])):?>
                    <p><?= $errores['datein']?></p>
                  <?php endif;?>
                  <?php if (isset($errores['dateout'])):?>
                      <p><?= $errores['dateout']?></p>
                    <?php endif;?>
              </div>
              <label for="inlineRadioOptions"> ¿Tus Fechas son flexibles?</label><br></br>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="infoGeneral" value="option1">
                <label class="form-check-label" for="inlineRadio1">Si, seguro!</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="infoGeneral" value="option2">
                <label class="form-check-label" for="inlineRadio2">Lo podemos Charlar!</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="infoGeneral" value="option3">
                <label class="form-check-label" for="inlineRadio3">No puedo mover las fechas</label>
              </div>
            </article>
              <article id="tab2">
                <label for="pais">¿Adonde queres ir?</label>
                <select class="form-control" name="pais"<?=$pais?>>
                  <?php if (isset($errores['pais'])):?>
                      <p><?= $errores['pais']?></p>
                    <?php endif;?>
                  <option value="">Selecciona el país a visitar</option>
                  <?php foreach ($paises as $key => $value) :?>
                      <option value="<?= $value['CODIGO'] ?>"><?= $value['NOMBRE'] ?></option>
                  <?php endforeach ?>
                </select>


                <!--<select class="form-control" name="ciudad">
                  <option value="">Selecciona la ciudad a visitar</option>
                  <?php foreach ($ciudades as $key => $value) :?>
                      <option value="<?= $value['ciudad'] ?>"><?= $value['ciudad'] ?></option>
                  <?php endforeach ?>
                </select>-->
                <label for="actividades">¿Que tipo de viaje queres hacer?</label>
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
                      <?php if (isset($errores['importe'])):?>
                          <p><?= $errores['importe']?></p>
                        <?php endif;?>
                      </div>
                      <input type="text" class="form-control" name="importe" aria-label="Amount (to the nearest dollar)">
                      <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                      </div>
                    </div>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text">Moneda</span>
                        <?php if (isset($errores['moneda'])):?>
                            <p><?= $errores['moneda']?></p>
                          <?php endif;?>
                        </div>
                        <input type="text" class="form-control" name="moneda" aria-label="Amount (to the nearest dollar)">
                      </div>
                    </div>
              </article>
              <article id="tab4">
                <div class="card-body">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="inputGroupSelect01">Dia 1</label>
                    </div>
                    <select class="custom-select" name="ciudad" <?=$ciudad?>>
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
    <div class="destinos-container-fluid">
    <div class="destinos-top">
      <h2> Los Mejores Destinos</h2>
      <ul>
        <li>
          <a href="https://www.tripadvisor.es/TravelersChoice-Destinations-cTop-g13" class="category-name" target="_blank">
            <img src="images/crea/ico-caribe.png" alt="Top 25 America del Sur">
          </a>
        </li>
        <li>
          <a href="https://www.tripadvisor.es/TravelersChoice-Destinations-cTop-g4" class="category-name" target="_blank">
            <img src="images/crea/ico-europa.png" alt="Top 25 Europa">
          </a>
        </li>
        <li>
          <a href="https://www.tripadvisor.com.ar/TravelersChoice-Destinations-cTop-g191" class="category-name" target="_blank">
            <img src="images/crea/ico-norteamerica.png" alt="Top 25 Estados Unidos">
          </a>
        </li>
        <li>
          <a href="https://www.tripadvisor.es/TravelersChoice-Destinations-cTop-g13" class="category-name" target="_blank">
            <img src="images/crea/ico-sudamerica2.png" alt="Top 25 America del Sur">
          </a>
        </li>
        <li>
          <a href="https://www.tripadvisor.com.ar/TravelersChoice-Destinations-cTop-g2" class="category-name" target="_blank">
            <img src="images/crea/ico-restomundo.png" alt="Top 25 Sudeste Asíatico">
          </a>
        </li>
        </ul>
      </div>
    </div>
    </section>

  </body>
  </html>
