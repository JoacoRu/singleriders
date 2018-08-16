<?php

session_start();

// NOTE: prueba

//validacion de campos para el registro y el alta de usuario
function validar($datosuser, $formulario, $imagenperfil = false){
  $usuariologin = buscarUsuario(trim($datosuser['email']));
  $errores = [];
  foreach ($datosuser as $clave => $dato) {
    if (isset($datosuser[$clave])){
      if (trim($dato) == '') {
        if ($clave == 'password') {
          //agrego esto para que en el texto de la validacion coincida con el placeholder y diga contraseña en vez de password que es el name del input
          $errores[$clave] = 'Completá la contraseña';
        }else $errores[$clave] = 'Completá el '.$clave;
      }
      if ($clave == 'email') {
        if (!filter_var($dato,FILTER_VALIDATE_EMAIL)) {
          //pregunto si no tiene un valor previo para no sobreescribirlo
          if (!isset($errores[$clave])) {
            $errores[$clave] = 'Email inválido';
          }
        }
        if ($formulario == 'registro') {
          if (buscarUsuario(trim($dato))) {
            if (!isset($errores[$clave])) {
              $errores[$clave] = 'El email ya fue registrado';
            }
          }
        }
        if ($formulario == 'login') {
            if (!$usuariologin) {
              if (!isset($errores[$clave])) {
                $errores[$clave] = 'Usuario incorrecto';
              }
            }
        }
      }
      if ($clave == 'password') {
        if (strlen($dato) < 6) {
          if (!isset($errores[$clave])) {
            $errores[$clave] = 'Ingresá al menos 6 caracteres';
          }
        }
        if ($formulario == 'login') {
          if ($usuariologin) {
            if (!password_verify($dato,$usuariologin['password'])) {
              if (!isset($errores['password'])) {
                $errores['password'] = 'Contraseña incorrecta';
              }
            }
          }else {
              if ($errores['email'] == 'Usuario incorrecto') {
                $errores['password'] = 'Verificá el usuario';
              }else if (!isset($errores['password'])) {
                $errores['password'] = 'Contraseña incorrecta';
              }
          }
        }
      }
    }
  }
  if ($formulario == 'registro') {

    if ($imagenperfil['imgperfil']['error'] === UPLOAD_ERR_OK) {
        $ext = strtolower(pathinfo($imagenperfil['imgperfil']['name'], PATHINFO_EXTENSION));
        if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg') {
          $errores['imgperfil'] = 'Extension no válida (debe ser jpg, jpeg o png)';
        }
    }else {
        $errores['imgperfil'] = 'Seleccioná una imagen de perfil';
    }
  }
  return $errores;
}

//registro de usuario
function registrar($datosuser,$imagenperfil=false){
    $datosuser['password'] = password_hash($datosuser['password'],PASSWORD_DEFAULT);
    $id = obtenerUltimoId();
    $id ? $id = $id + 1 : $id = 1;
    $datosuser['id'] = $id;
    $ext = strtolower(pathinfo($imagenperfil['imgperfil']['name'], PATHINFO_EXTENSION));
    $hasta = '/images/profileImg/'.'perf'.$id.'.'.$ext;
    $datosuser['srcImagenperfil'] = $hasta;
    $userjson = json_encode($datosuser);
    file_put_contents('usuarios.json', $userjson . PHP_EOL, FILE_APPEND);
    subirImgPerfil($imagenperfil,$id);

    $_SESSION['id'] = $id;

    header('location:home.php');
}

//subir imagen

function subirImgPerfil($imagen,$id){
  if ($imagen['imgperfil']['error'] === UPLOAD_ERR_OK) {
      $ext = strtolower(pathinfo($imagen['imgperfil']['name'], PATHINFO_EXTENSION));
      if ($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg') {
          $hasta = dirname(__FILE__) .'/images/profileImg/'.'perf'.$id.'.'.$ext ;
          $desde = $imagen['imgperfil']['tmp_name'];
          $end = end(explode('/', $hasta));
          if (file_exists($hasta)) {
            echo "<br>";
            echo "<p>El archivo ya existe, no será subido</p>";
          }else {
            move_uploaded_file($desde, $hasta);
          }

      }else {
          var_dump('extension invalida!');
      }
  }else {
      var_dump('error al subir');
  }
}


//login de usuario
function login(){
  header('location:home.php');
}

//obtener usuarios (para registrar si no existe el mail o para loguear si son correctas las credenciales y el email)
function buscarUsuarios(){
  $usuarios = file_get_contents('usuarios.json');
  $arrUsuariosJSON = explode(PHP_EOL,$usuarios);
  $arrUsuarioPHP = [];
  array_pop($arrUsuariosJSON);
  foreach ($arrUsuariosJSON as $key => $usuario) {
      $arrUsuarioPHP[] = json_decode($usuario,true);
  }
  return $arrUsuarioPHP;
}

//obtener id del ultimo usuario
function obtenerUltimoId(){
  $usuarios = file_get_contents('usuarios.json');
  $arrUsuariosJSON = explode(PHP_EOL,$usuarios);
  $arrUsuarioPHP = [];
  array_pop($arrUsuariosJSON);
  foreach ($arrUsuariosJSON as $key => $usuario) {
      $arrUsuarioPHP[] = json_decode($usuario,true);
  }
  $ultimo = array_pop($arrUsuarioPHP);
  $id = $ultimo['id'];
  return $id;
}

//obtener id de usuario
function obtenerId($id){
  $usuarios = buscarUsuarios();
  $usuario = [];
  if (!empty($usuarios)) {
    foreach ($usuarios as $usuario) {
      //var_dump($usuario['id']);
      if ($id == $usuario['id']) {
        return $usuario;
      }
    }
  }
  return false;
}


//obtener un usuario
function buscarUsuario($email){
  $usuarios = buscarUsuarios();
  $usuario = [];
  if (!empty($usuarios)) {
    foreach ($usuarios as $usuario) {
      if (strtolower($email) == strtolower($usuario['email'])) {
        return $usuario;
      }
    }
  }
  return false;
}

//agregar file upload para el perfil de usuario






 ?>
