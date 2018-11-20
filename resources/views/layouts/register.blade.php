<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('enlaces')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css?family=Abel|Montserrat:400,400i,700,700i|Pacifico" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

    <link rel="stylesheet" href="{{asset('css/styles.css')}}">

    <title>Registro</title>
</head>
<body>
    @yield('section')
    <section class="ingresar mt-5">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-10 col-lg-5 bg-white p-4 mt-5 rounded shadow">
            <h1 class="titulo-sr-home text-center mb-4"><span class="single-f mr-2">Single</span><span class="single-f">Riders</span></h1>
            <!--<div class="dropdown-divider mb-4 mt-4 ml-3 mr-3"></div>-->
            <!-- NOTE: tabs -->
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item">
                <a class="nav-link" id="login-tab" href="login">Ingresá</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" id="registro-tab" data-toggle="tab" role="tab" aria-controls="registro" aria-selected="false">Registrate</a>
              </li>
            </ul>
            <div class="card border-top-0 rounded-0 bottom-radius">
              <div class="car-body">
                <div class="container mt-3">
                  <div class="row">
                    <div class="col-12">
                      <div class="tab-content">
                        <div class="tab-pane" id="login" role="tabpanel" aria-labelledby="login-tab">
                          <form method="post" enctype="multipart/form-data">
                        
                            <div class="form-group">
                              <input name="useremail" type="email" class="form-control" aria-describedby="emailHelp" placeholder="Correo electrónico">
                            </div>
                            <div class="form-group">
                              <input name="userpassword" type="password" class="form-control" placeholder="Contraseña">
                            </div>
                            <div class="container">
                              <div class="row flex-column flex-md-row justify-content-md-between align-items-md-center">
                                <button type="submit" class="btn btn-primary iniciar mb-3 mb-md-0">Iniciar sesión</button>
                                <a class="text-center text-md-left" href="#">¿Olvidaste tu contraseña?</a>
                              </div>
                              <div class="row mt-3">
                                <label>
                                  <input type="checkbox" value="1" name="recordarme" checked="checked">
                                    Recordarme
                                </label>
                              </div>
                            </div>
                          </form>
                        </div>
                        <div class="tab-pane fade show active" id="registro" role="tabpanel" aria-labelledby="profile-tab">
                          <form method="post" enctype="multipart/form-data" action="{{ route('register') }}">
                            @csrf
                            <div class="form-label-group">
                              <input type="text" name="nombre" id="nombre" aria-describedby="nombreHelp" placeholder="Nombre" value="{{ old('nombre') }}" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}">
                              <label for="nombre">Nombre</label>
                              
                              @if ($errors->has('nombre'))
                                <small id="nombreHelp" class="form-text text-danger">{{ $errors->first('name') }}</small>
                              @endif
                            </div>
                            <div class="form-label-group">
                              <input type="text" name="apellido" id="apellido" aria-describedby="apellidoHelp" placeholder="Apellido" value="{{ old('apellido') }}" class="form-control{{ $errors->has('apellido') ? ' is-invalid' : '' }}">
                              <label for="apellido">Apellido</label>
                              
                              @if ($errors->has('apellido'))
                                <small id="apellidoHelp" class="form-text text-danger">{{ $errors->first('lastname') }}</small>
                              @endif

                            </div>
                            <div class="form-label-group">
                              <input name="email" id="email" type="text" aria-describedby="emailHelp" placeholder="Correo electrónico" value="{{ old('email') }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}">
                              <label for="email">Correo electrónico</label>
                              @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <small id="emailHelp" class="form-text text-danger">{{ $errors->first('email') }}</small>
s
                                    </span>
                                @endif
                            </div>
                            <div class="form-label-group">
                              <input name="password" id="password" type="password" aria-describedby="passwordHelp" placeholder="Contraseña" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}">
                              <label for="password">Contraseña</label>
                              @if($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <small id="passwordHelp" class="form-text text-danger">{{ $errors->first('password') }}</small>
                                </span>
                              @endif
                            </div>

                            <div class="form-label-group">
                              <input name="imgperfil" id="imgperfil" type="file" aria-describedby="imgperfilHelp" placeholder="Imagen de perfil" class="form-control{{ $errors->has('imgperfil') ? ' is-invalid' : '' }}">
                              <label for="password">Imagen de perfil</label>
                              @if($errors->has('imgperfil'))
                                <span class="invalid-feedback" role="alert">
                                    <small id="imgperfilHelp" class="form-text text-danger">{{ $errors->first('imgperfil') }}</small>
                                </span>
                              @endif
                            </div>
                            <div class="container">
                              <div class="row flex-column flex-md-row justify-content-md-between align-items-md-center">
                                <button type="submit" class="btn btn-primary iniciar mb-3 mb-md-0">Registrate</button>
                              </div>
                              <div class="row mt-3">
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</body>
</html>