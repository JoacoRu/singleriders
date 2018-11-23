<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Abel|Montserrat:400,400i,700,700i|Pacifico" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/muro2.css') }}">
    <title>Buscador</title>
</head>
<body>
    @include('partials.navbar')
    <section class="mt-5 section">
        <div class="container-fluid pt-5">
            <div class="row p-0 m-0 bg-white rounded home-row-main justify-content-center">
                <div class="col-12 p-0 top-muro-image d-flex align-items-center justify-content-center">
                    <h1 class="font-weight-bold text-center">Buscador</h1>
                </div>

          @include('partials.lateral_izquierdo')

          <div class="col-12 p-10 pt-4 col-md-8">
              <div class="buscador">
                <form method="get">
                    <input type="search" name="search" >
                    <button type="submit">Enviar</button>
                </form>
              </div>
              <article class="resultadosBusqueda">
                  

                    @foreach($search as $key => $user)
                        <div>$user</div>
                    @endforeach

                  
              </article>
          </div>

            </div>
        </div>
    </section>
</body>
</html>