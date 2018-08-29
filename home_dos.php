<?php

require_once('funciones.php');
$nombres = traerNombreDeUsuarios();
msjAseleccionar();
if($_POST){
  $guardarMsj = crearMensaje();
}
if (!isset($_SESSION['id']) && !isset($_COOKIE['id'])) {
  header('location:login.php');
}else if (isset($_SESSION['id'])) {
  $usuariologin = obtenerId($_SESSION['id']);
}else if (isset($_COOKIE['id'])) {
  $usuariologin = obtenerId($_COOKIE['id']);
}else {
  header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- FUENTES -->
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Abel|Montserrat:400,400i,700,700i|Pacifico" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/home.css">
    <title>Document</title>
</head>
<body>
    <header>
        <?php
        include_once "header.php";
        ?>
    </header>
    <section class="super-container">
        <!-- CAJA RELLENO -->
        <div class="relleno"></div>
        <!-- CAJA IZQUIERDA -->
        <article class="izquierda">
            <div class="datos_perfil_container">
                <div class="perfil  container">
                    <img src="images/perfil.jpg" alt="una imagen de perfil" width="25px" height="25px">
                    <h4><?= $usuariologin['nombre'];?></h4>
                </div>
                &nbsp
                &nbsp
                <div class="funciones container">
                    <button class="crear_viaje"><img src="images/iconos/home/funciones_crear-viaje.png" alt="" width="15px" heigth="15px"><p>Crear Viaje</p></button>
                    
                    <button class="crear_viaje"><img src="images/iconos/home/funciones_grupo.png" alt="" width="15px" heigth="15px" id="grupo"><p>Crear Grupo</p></button>
                    
                   
                    <button class="crear_viaje"><img src="images/iconos/home/funciones-usuario.png" alt="" width="15px" heigth="15px" id="grupo"><p> Usuarios</p></button>

                     <button class="crear_viaje"><img src="images/iconos/home/funciones_unete.png" alt="" width="15px" heigth="15px" id="grupo"><p> Unirte a un Viaje</p></button>

                     <button class="crear_viaje"><img src="images/iconos/home/funciones_mis_viajes.png" alt="" width="15px" heigth="15px" id="grupo"><p> Ver mis Viajes</p></button>

                     <p id="acceso">Accesos Directos</p>


                </div>
            </div>
        </article>
        <!-- CAJA CENTRO -->
        <article class="centro"></article>
        <!-- CAJA DERECHA -->
        <article class="derecha"></article>
    </section>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>