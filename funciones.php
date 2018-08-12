<?php

//validacion de campos para el registro y el alta de usuario
function validar($datosuser, $formulario){
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
  return $errores;
}

//registro de usuario
function registrar($datosuser){
    $datosuser['password']=password_hash($datosuser['password'],PASSWORD_DEFAULT);
    $userjson = json_encode($datosuser);
    file_put_contents('usuarios.json', $userjson . PHP_EOL, FILE_APPEND);
    header('location:login.php');
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






 ?>
