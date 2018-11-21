<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('enlaces')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Abel|Montserrat:400,400i,700,700i|Pacifico" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    @endyield
    <title>Login</title>
</head>
<body>

 @yield('login')
 <section class="ingresar mt-5">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-10 col-lg-5 bg-white p-4 mt-5 rounded shadow">
            <h1 class="titulo-sr-home text-center mb-4"><span class="single-f mr-2">Single</span><span class="single-f">Riders</span></h1>
            <!--<div class="dropdown-divider mb-4 mt-4 ml-3 mr-3"></div>-->
            <!-- NOTE: tabs -->
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="login-tab" data-toggle="tab" role="tab" aria-controls="login" aria-selected="true">Ingresá</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="registro-tab" href="register" aria-selected="false">Registrate</a>
              </li>
            </ul>
            <div class="card border-top-0 rounded-0 bottom-radius">
              <div class="car-body">
                <div class="container mt-3">
                  <div class="row">
                    <div class="col-12">
                      <div class="tab-content">
                        <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                          <form method="post" action="{{ route('login') }}">
                            <div class="form-label-group">
                                @csrf
                              <input name="email" id="useremail" aria-describedby="useremailHelp" type="text" placeholder="Correo electrónico" value="{{ old('email') }}" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}">
                              <label for="useremail">Email</label>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-label-group">
                              <input name="password" id="userpassword" aria-describedby="userpasswordHelp" type="password" placeholder="Contraseña" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}">

                              <label for="userpassword">Contraseña</label>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                            </div>
                            <div class="container">
                              <div class="row flex-column flex-md-row justify-content-md-between align-items-md-center">
                                <button type="submit" class="btn btn-primary iniciar mb-3 mb-md-0">Iniciar sesión</button>
                                <a class="text-center text-md-left" href="#">¿Olvidaste tu contraseña?</a>
                              </div>
                              <div class="row mt-3">
                                <label>
                                  <input type="checkbox" value="1" name="recordarme" {{ old('recordarme') ? 'checked' : '' }}>
                                    Recordarme
                                </label>
                              </div>
                            </div>
                          </form>
                        </div>
                        <div class="tab-pane fade" id="registro" role="tabpanel" aria-labelledby="profile-tab">
                          <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                              <input type="text" name="nombre" class="form-control" aria-describedby="nombreHelp" placeholder="Nombre">
                            </div>
                            <div class="form-group">
                              <input type="text" name="apellido" class="form-control" aria-describedby="apellidoHelp" placeholder="Apellido">
                            </div>
                            <div class="form-group">
                              <input name="email" type="email" class="form-control" aria-describedby="emailHelp" placeholder="Correo electrónico">
                            </div>
                            <div class="form-group">
                              <input name="password" type="password" class="form-control" placeholder="Contraseña">
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
    @yield('busca')
    <article class="mt-4 objetive">
              <div class="card">
                <div class="card-body">
                  <div class="container">
                    <div class="row">
                      <!--<div class="features-sr">
                       <h5 class="mb-3"><span class="sr-textdecoration">Single Riders</span> te facilita</h5>
                       <ul class="mb-0 pl-2">
                         <li><i class="fa fa-search"></i> Buscar y contactar a otros viajeros:
                            <ul>
                              <li>Para unirte a un viaje</li>
                              <li>Durante un viaje</li>
                            </ul>

                         </li>
                         <li><i class="fa fa-map-marker-alt"></i>Explorar viajes de otras personas para ver consejos y opiniones</li>
                         <li><i class="fa fa-share-alt"></i> Compartir tus experiencias para ayudar a otros viajeros</li>
                       </ul>
                     </div>-->
                      <div class="col-12 col-sm-6 text-center features-sr overbuttons" onclick="$('.card-viajes').collapse('hide');$('#collapsebuscar').collapse('toggle')">
                        <div>
                          Buscá
                          <i class="fa fa-search"></i>
                        </div>
                        <i class="fa fa-angle-down"></i>
                      </div>
                      <div class="col-12 col-sm-6 text-center features-sr overbuttons" onclick="$('.card-viajes').collapse('hide');$('#collapsecrear').collapse('toggle')">
                        <div>
                          Creá
                          <i class="fa fa-plus"></i>
                        </div>
                        <i class="fa fa-angle-down"></i>
                      </div>
                    </div>
                  </div>
                  <div class="container">
                    <div class="row">
                      <div class="col-12 obj-viajes text-uppercase text-center p-1 font-weight-bold">
                        viajes
                        <i class="fa fa-suitcase"></i>
                        <div class="collapse card-viajes" id="collapsebuscar">
                          <div class="card card-body border-0">
                            Buscá: Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                          </div>
                        </div>
                        <div class="collapse card-viajes" id="collapsecrear">
                          <div class="card card-body border-0">
                            Creá: Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                          </div>
                        </div>
                        <div class="collapse card-viajes" id="collapseunirse">
                          <div class="card card-body border-0">
                            Unite: Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                          </div>
                        </div>
                        <div class="collapse card-viajes" id="collapsecompartir">
                          <div class="card card-body border-0">
                            Compartí: Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="container">
                    <div class="row">
                      <div class="col-12 col-sm-6 text-center features-sr overbuttons" onclick="$('.card-viajes').collapse('hide');$('#collapseunirse').collapse('toggle')">
                        <i class="fa fa-angle-up"></i>
                        <div>
                          Unite
                          <i class="far fa-hand-pointer"></i>
                        </div>
                      </div>
                      <div class="col-12 col-sm-6 text-center features-sr overbuttons" onclick="$('.card-viajes').collapse('hide');$('#collapsecompartir').collapse('toggle')">
                        <i class="fa fa-angle-up"></i>
                        <div>
                          Compartí
                          <i class="fa fa-share-alt"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </article>
          </div>
        </div>
      </div>
   </section>
</body>
</html>