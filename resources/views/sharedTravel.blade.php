<head>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
      <link href="https://fonts.googleapis.com/css?family=Abel|Montserrat:400,400i,700,700i|Pacifico" rel="stylesheet">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
      <script type="text/javascript" src="{{asset ('js/jquery-3.3.1.min.js')}}"></script>
			<script type="text/javascript" src="{{('js/jquery.cycle2.min.js')}}"></script>
			<link rel ="stylesheet" href="{{asset ('css/styles.css')}}">
	
</head>

<body>
@include('partials.navbar')
    
  <div class="col-12 pt-4 col-md-4 col-lg-3 ml-lg-2 d-flex flex-column justify-content-flex-start align-items-center">
    <div class="row w-100 pt-2">
      <ul class="d-block list-unstyled w-100 py-4 border rounded shadow-perfil">
			<h3>SingleRiders Unidos a este viaje</h3>
        <li class="text-center"><img style="max-width: 150px;" class="border rounded-circle" src="." alt="" id="trip-followers"></li>
        
      </ul>
    </div>
    <div class="row justify-content-center">
			<h3> Itinerario del viaje</h3>
      <ul class="d-block list-unstyled mt-4 text-center p-3 border navegacion-perfil">
        <!--<li><a href="perfil.php">Ver mi Perfil</a></li>-->
        <li class="d-flex align-items-center mb-2"><span class="fa fa-home"></span> <a class="mt-1" href="home">Fechas</a></li>
        <li class="d-flex align-items-center mb-2"><img class="mr-1" src="./images/iconos/home/crear_viaje.png" alt=""><a href="#">Crear Viaje</a></li>
        <li class="d-flex align-items-center mb-2"><img class="mr-1" src="./images/iconos/home/ver_mis_viajes.png" alt=""><a class="mt-1" href="mis_viajes.php">Ver mis Viajes</a></li>
        <li class="d-flex align-items-center mb-2"><img class="mr-1" src="./images/iconos/home/ver_mis_viajes.png" alt=""><a href="#">Todos los Viajes</a></li>
        <li class="d-flex align-items-center mb-2"><img class="mr-1" style="width:24px;height:24px;" src="./images/iconos/home/sobre.png" alt=""><a href="#">Ver mis Mensajes</a></li>
      </ul>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Follow  </button>
 
</body>

</html>