<?php
require_once("User.php");
require_once("Validator.php");
class ProfileValidator extends Validator
{

  //validacion de campos para el registro y el alta de usuario
  public function validar($datosuser, $formulario, $imagenperfil = false, User $usuario, $mailModificacion = ''){
    $usuariologin = $usuario->buscarUsuario(trim($datosuser['email']));
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
          if ($formulario == 'modificacion' && $mailModificacion != '') {
            if ($usuario->buscarUsuario(trim($dato))) {
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
        }
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

}




 ?>
