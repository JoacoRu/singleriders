<?php

session_start();

// NOTE: prueba

require_once("classes/Usuario.php");

//login de usuario
function login(){
  header('location:home.php');
}


  //Funcion guardar viaje del formulario crea tu viaje//
//cuando vincule funciones a crea2.php , complete el formulario y puse enviar, me dio error de validacion //
/*function validarviaje($data){
    $mensaje = trim($data['mensaje']);
    $datein = trim($data['datein']);
    $dateout = trim($data['dateout']);
    $pais= trim($data['pais']);
    //$ciudad=  trim($data['ciudad']);
    $importe= trim($data['importe']);
    $moneda= trim($data['moneda']);
    $errores = [];
    if ($mensaje == '') {
            $errores['mensaje']  = 'Por favor compelta el nombre de tu viaje';
        }
    if ($datein == '') {
            $errores['datein']  = 'Por favor compelta la fecha salida';
        }
    if ($dateout == '') {
              $errores['dateout']  = 'Por favor compelta la fecha de regreso';
        }
    if ($pais == '') {
              $errores['pais']  = 'Por favor indica el País al que viajas';
       }
    //if ($ciudad == '') {
              //$errores['ciudad']  = 'Por favor indica la ciudad a visitar';
       //}
    if ($importe == '') {
              $errores['importe']  = 'Por favor indica tu presupuesto';
      }
    if ($moneda == '') {
              $errores['moneda']  = 'Por favor indica que moneda presupuestas';
      }
    return $errores;
}
   function guardarViaje($data,$id){
      $viaje=[
        "textmensaje" => $data['mensaje'],
        "datein" =>$data['datein'],
        "dateout" =>$data['dateout'],
        "pais" =>$data['pais'],
        //"actividades" ->$data['actividades'],
        //"ciudad" ->$data['ciudad'],
        "mensajeiti" =>$data['mensajeiti'],
        "importe" =>$data['importe'],
        "moneda" =>$data['moneda'],
        "creadorDeViaje" => $id
      ];
    $viajeJSON= json_encode($viaje);
    file_put_contents('viajes.json', $viajeJSON . PHP_EOL, FILE_APPEND);
  }*/
  function traerViajes(){
      $allViajes = file_get_contents('viajes.json');
      $arrayDeViajes = explode(PHP_EOL, $allViajes);
      array_pop($arrayDeViajes);
      $arrayDeViajesPHP = [];
      foreach ($arrayDeViajes as $key => $value) {
          $arrayPHP[] = json_decode($ViajeJSON, true);
      }
      return $arrayPHP;
  }
//nose como hacer para recorrer el ARRAY de arriba y que lo devuelva en el select //
  function traerPaises(){
    $allPaises= file_get_contents('paises.json');
    $arrayPaises= explode(';',$allPaises);
    array_pop($arrayPaises);
    array_shift($arrayPaises);
    $arrayPaisesPhp = [];
    foreach ($arrayPaises as $value) {
      $arrayPaisesPhp[] = json_decode($value, true);
    }
    return $arrayPaisesPhp;
  }
  function traerCiudades(){
    $allCiudades= file_get_contents('ciudades.json');
    $arrayCiudades = explode(PHP_EOL,$allCiudades);
    array_pop($arrayCiudades);
    $arrayCiudadesPhp = [];
    foreach ($arrayCiudades as $value) {
      $arrayCiudadesPhp[] = json_decode($value, true);
    }
    return $arrayCiudadesPhp;
  }
  // NOTE: viajes.php
  function obtenerTodosLosViajes() {
    $viajes = file_get_contents('viajes.json');
    $arrViajesJSON = explode(PHP_EOL,$viajes);
    $arrUsuarioViajes = [];
    $arrUsuarioViajestmp = [];
    array_pop($arrViajesJSON);
    $counter = 0;
    foreach ($arrViajesJSON as $key => $usuario) {
          $arrUsuarioViaje[] = json_decode($usuario,true);
    }
    $usuarioviaje['counter'] = $counter+1;
    $usuarioviaje['viajes'] = $arrUsuarioViaje;
    return $usuarioviaje;
  }
  function obtenerViajes($id) {
    $viajes = file_get_contents('viajes.json');
    $arrViajesJSON = explode(PHP_EOL,$viajes);
    $arrUsuarioViajes = [];
    $arrUsuarioViajestmp = [];
    $arrUsuarioViaje = [];
    array_pop($arrViajesJSON);
    $counter = 0;
    foreach ($arrViajesJSON as $key => $usuario) {
        $arrUsuarioViajetmp[] = json_decode($usuario,true);
        if ($arrUsuarioViajetmp[0]['creadorDeViaje'] == $id) {
          $counter++;
          $arrUsuarioViaje[] = json_decode($usuario,true);
        }
        $arrUsuarioViajetmp = [];
    }
    $usuarioviaje['counter'] = $counter+1;
    $usuarioviaje['viajes'] = $arrUsuarioViaje;
    return $usuarioviaje;
  }

   function nombreAsocId($nombre){
    $todosLosUsuarios = $this->buscarUsuarios();
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


 ?>
