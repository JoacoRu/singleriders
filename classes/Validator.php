<?php
require_once("User.php");
abstract class Validator
{

  //validacion de campos para el registro y el alta de usuario
  abstract public function validar($datosuser, $formulario, $imagenperfil, User $usuario, $mailModificacion);

}




 ?>
