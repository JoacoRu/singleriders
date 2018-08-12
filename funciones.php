<?php

function registrar($datosUser){


    //echo "<pre>";
    //var_dump($nombre);
    //var_dump($apellido);
    //var_dump($email);
    //var_dump($password);
}

function validar($datosuser){
  $errores = [];
  foreach ($datosuser as $clave => $dato) {
    if (isset($datosuser[$clave])){
      if ($dato == '') {
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
      }
      if ($clave == 'password') {
        if (strlen($dato) < 6) {
          if (!isset($errores[$clave])) {
            $errores[$clave] = 'Ingresá al menos 6 caracteres';
          }

        }
      }
    }
  }
  return $errores;
}







 ?>
