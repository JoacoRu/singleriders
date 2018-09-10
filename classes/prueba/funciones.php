<?php

session_start();

// NOTE: prueba

//validacion de campos para el registro y el alta de usuario
function validar($datosuser, $formulario, $imagenperfil = false, $mailModificacion = ''){
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
        elseif ($formulario == 'login') {
            if (!$usuariologin) {
              if (!isset($errores[$clave])) {
                $errores[$clave] = 'Usuario incorrecto';
              }
            }
        }
        else if ($formulario == 'modificacion' && $mailModificacion != '') {
          if (buscarUsuario(trim($dato))) {
            if (!isset($errores[$clave])) {
              $errores[$clave] = 'El email ya fue registrado';
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
  if ($formulario == 'modificacion' && $imagenperfil) {
    if ($imagenperfil['imgperfil']['error'] === UPLOAD_ERR_OK) {
        $ext = strtolower(pathinfo($imagenperfil['imgperfil']['name'], PATHINFO_EXTENSION));
        if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg') {
          $errores['imgperfil'] = 'Extension no válida (debe ser jpg, jpeg o png)';
        }
    }elseif ($imagenperfil['imgperfil']['error'] === 4) {
        //var_dump($imagenperfil);
        //exit;
        //$errores['imgperfil'] = 'Seleccioná una imagen chango';
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

    header('location:muro.php');
}

//subir imagen

function subirImgPerfil($imagen,$id){
  if ($imagen['imgperfil']['error'] === UPLOAD_ERR_OK) {
      $ext = strtolower(pathinfo($imagen['imgperfil']['name'], PATHINFO_EXTENSION));
      if ($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg') {
          $hasta = dirname(__FILE__) .'/images/profileImg/'.'perf'.$id.'.'.$ext ;
          $desde = $imagen['imgperfil']['tmp_name'];
          //$end = end(explode('/', $hasta));
          if (file_exists($hasta)) {
            //echo "<br>";
            //echo "<p>El archivo ya existe, no será subido</p>";
            move_uploaded_file($desde, $hasta);
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
  header('location:muro.php');
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

//actualizar perfil de usuario
function actualizarusuario($imagenperfil,$datosuser,$id){
  // NOTE: obtener los usuarios en usuarios.json, transformandolos en un array
  $usuarios = buscarUsuarios();
  // NOTE: recorrer array de todos los usuarios y sobreescribir el registro que corresponda al usuario a editar
  if (!empty($usuarios)) {
    // NOTE: vacio el archivo usuarios.json para poder insertar las modificaciones sin duplicar al usuario
      file_put_contents('usuarios.json', '');
      foreach ($usuarios as $usuario) {
        // NOTE: si encuentro al usuario guardo las modificaciones
        if (strtolower($id) == strtolower($usuario['id'])) {
          $usuario['nombre'] = $datosuser['nombre'];
          $usuario['apellido'] = $datosuser['apellido'];
          $usuario['email'] = $datosuser['email'];
          if ($usuario['password'] != $datosuser['password']) {
            $usuario['password'] = password_hash($datosuser['password'],PASSWORD_DEFAULT);
          }
          if ($imagenperfil['imgperfil']['error'] === UPLOAD_ERR_OK) {
            $ext = strtolower(pathinfo($imagenperfil['imgperfil']['name'], PATHINFO_EXTENSION));
            $hasta = '/images/profileImg/'.'perf'.$id.'.'.$ext;
            $usuario['srcImagenperfil'] = $hasta;
        }
        $userjson = json_encode($usuario);
        file_put_contents('usuarios.json', $userjson . PHP_EOL, FILE_APPEND);
        subirImgPerfil($imagenperfil,$id);
      }else {
        // NOTE: si no encuentro al usuario guardo a los demas sin cambios
        $userjson = json_encode($usuario);
        file_put_contents('usuarios.json', $userjson . PHP_EOL, FILE_APPEND);
      }
    }
  }
  // NOTE: volver a convertir a json y guardar archivo usuarios.json
  //$userjson = json_encode($usuarios);
  //file_put_contents('usuarios2.json', $userjson . PHP_EOL, FILE_APPEND);
  //subirImgPerfil($imagenperfil,$id);


}

//Todos los nombres en un array
function traerNombreDeUsuarios(){
  $todosLosUsuarios = buscarUsuarios();
  $ultimoId = obtenerUltimoId();
  $nombres = [];
  $nombres['usuarios'] = array_map(function($item){
    return $item['nombre'];
    }, $todosLosUsuarios);
    //unset($nombres['usuarios'][0]);
    return $nombres;
  }

  // asociar el nombre a una id
  function nombreAsocId($nombre){
    $todosLosUsuarios = buscarUsuarios();
    $datosDeUsuario = [];
    $idDelUsuario;
    foreach ($todosLosUsuarios as $usuario) {
      if($usuario['nombre'] == $nombre){
        $datosDeUsuario[] = $usuario;
      }
    }
    foreach ($datosDeUsuario as $dato) {
      $idDelUsuario = $dato['id'];
    }

    return $idDelUsuario;
  }

 // crea el mensaje
  function crearMensaje($remitente='anónimo'){
    $convertidor = nombreAsocId($_POST['to']);
    $mensaje = [
      'from' => $_SESSION['id'],
      'to'  => $_POST['to'],
      'nombreRemitente' => $remitente,
      'idDestinatario' => $convertidor,
      'msj'  => $_POST['mensaje'],
    ];
    $msjJson = json_encode($mensaje, true);
    file_put_contents('mensajes.json', $msjJson . PHP_EOL, FILE_APPEND);
    header('location:mensajes.php');
  }
  //decodea el msj
  function recibirMensaje(){
    $msjJson= file_get_contents('mensajes.json');
    $msjArray = explode(PHP_EOL, $msjJson);
    array_pop($msjArray);
    $arrayPhp = [];
    foreach ($msjArray as $contenido) {
      $arrayPhp[] = json_decode($contenido, true);
    }
    return $arrayPhp;
  }

  //selecciona el msj

  function msjAseleccionar(){
    $recibe = recibirMensaje();
    $idEnSesion = $_SESSION['id'];
    $datosDelMensaje = [];
    foreach ($recibe as $dato) {
      if($dato['idDestinatario'] == $idEnSesion){
        $datosDelMensaje[] = $dato;
      }
    }
    return $datosDelMensaje;
  }





 ?>
