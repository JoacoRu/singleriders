<?php
include_once('classes/Grupos.php');
include_once('loader.php');
include_once('funciones.php');

if (!isset($_SESSION['id']) && !isset($_COOKIE['id'])) {
    header('location:login.php');
  }else if (isset($_SESSION['id'])) {
    $usuariologin = $usuario->obtenerId($_SESSION['id']);
  }else if (isset($_COOKIE['id'])) {
    $usuariologin =$usuario->obtenerId($_COOKIE['id']);
  }else {
    header('location:login.php');
  }

$errores = [];

if($_POST)
{
 $grupo = new Grupo();
  $grupo->validarGrupo();
 if(empty($errores))
 {
     $grupo->crearGrupo();
 } 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crea tu grupo</title>
</head>
<body>
    <form method="post">
        <input type="text" placeholder="Nombre del grupo" name="titulo">
        <textarea name="descripcion" cols="30" rows="10" placeholder="describe la funcion del grupo"></textarea>
        <input type="text" name="integrantes" placeholder="ingresa los integrantes del grupo separados por una coma">
        <button type="submit">Enviar</button>
    </form>    
</body>
</html>