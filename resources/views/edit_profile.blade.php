<!DOCTYPE html>
<html lang="es">
<head>
    <title>Perfil</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Abel|Montserrat:400,400i,700,700i|Pacifico" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body class="home">
  @include('partials.navbar')
  <!-- OPCIONES DEL USUARIO-->
  <section class="home-container container-fluid mt-5">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-8 bg-white rounded text-center">
        <article class="perfil">
          <div class="imagen_perfil pt-5 mb-2">
            @if(Auth::user()->src)
              <img class="rounded-circle" src="images/<?=Auth::user()->src?>" alt="" width="100px">
            @else
              <img class="rounded-circle" src="images/perfil.jpg" alt="" width="100px">
            @endif
          </div>
          <div class="nombre_usuario mb-2">
            <h3><?= Auth::user()->name ?></h3>
          </div>
          <div class="container mt-1">
            <div class="row justify-content-center">
              <div class="col-12 col-lg-2">
                <div>
                  <strong>100</strong>
                </div>
                <div>Seguidores</div>
              </div>
              <div class="col-12 col-lg-2">
                <div>
                  <strong>100</strong>
                </div>
                <div>Seguidos</div>
              </div>
              <div class="col-12 col-lg-2">
                <div>
                  <strong>100</strong>
                </div>
                <div>Publicaciones</div>
              </div>
              <div class="col-12 col-lg-2">
                <div>
                  <strong>100</strong>
                </div>
                <div class="text-center">Viajes realizados</div>
              </div>
            </div>
          </div>
        </article>
        <div class="row justify-content-center bg-white mt-5 text-left">
          <div class="col-11 col-md-10">
            <form method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-label-group">
                <input type="text" name="nombre" id="nombre" aria-describedby="nombreHelp" placeholder="Nombre" value="<?=old('nombre') ? old('nombre') : Auth::user()->name?>" class="form-control <?= $errors->has('nombre') ? strlen($errors->has('nombre')) > 0 ? 'errores-form-sr':'' : '' ?>">
                <label for="nombre">Nombre</label>
                @if ($errors->has('nombre'))
                  <small id="nombreHelp" class="form-text text-danger">{{ $errors->first('nombre') }}</small>
                @endif
              </div>
              <div class="form-label-group">
                <input type="text" name="apellido" id="apellido" aria-describedby="apellidoHelp" placeholder="Apellido" value="<?=old('apellido') ? old('apellido') : Auth::user()->lastname?>" class="form-control <?= $errors->has('apellido') ? strlen($errors->has('apellido')) > 0 ? 'errores-form-sr':'' : '' ?>">
                <label for="apellido">Apellido</label>
                @if ($errors->has('apellido'))
                  <small id="apellidoHelp" class="form-text text-danger">{{ $errors->first('apellido') }}</small>
                @endif
              </div>
              <div class="form-label-group">
                <input name="email" id="email" type="text" aria-describedby="emailHelp" placeholder="Correo electrónico" value="<?=old('email') ? old('email') :Auth::user()->email?>" class="form-control <?= $errors->has('email') ? strlen($errors->has('email')) > 0 ? 'errores-form-sr':'' : '' ?>">
                <label for="email">Correo electrónico</label>
                @if ($errors->has('email'))
                  <small id="emailHelp" class="form-text text-danger">{{ $errors->first('email')}}</small>
                @endif
              </div>
              <div class="form-label-group">
                <input name="password" id="password" type="password" aria-describedby="passwordHelp" placeholder="Contraseña" value="" class="form-control <?= $errors->has('password') ? strlen($errors->has('password')) > 0 ? 'errores-form-sr':'' : '' ?>">
                <label for="password">Contraseña</label>
                @if ($errors->has('password'))
                  <small id="passwordHelp" class="form-text text-danger">{{ $errors->first('password') }}</small>
                @endif
              </div>
              <div class="form-label-group">
                <input name="imgperfil" id="imgperfil" type="file" aria-describedby="imgperfilHelp" placeholder="Imagen de perfil" class="form-control <?= $errors->has('imgperfil') ? strlen($errors->has('imgperfil')) > 0 ? 'errores-form-sr':'' : '' ?>">
                <label for="password">Imagen de perfil</label>
                @if ($errors->has('imgperfil'))
                  <small id="imgperfilHelp" class="form-text text-danger">{{ $errors->first('imgperfil') }}</small>
                @endif
              </div>
              <div class="container">
                <div class="row flex-column flex-md-row justify-content-md-between align-items-md-center">
                  <button type="submit" class="btn btn-primary iniciar mb-3 mb-md-0">Modificar</button>
                </div>
                <div class="row mt-3">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Modal -->
  <div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Datos actualizados</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

        </div>
        <div class="modal-footer mt-3">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
    @include('partials.footer')
  </body>
</html>
