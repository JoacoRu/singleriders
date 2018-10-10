<?php
require_once("User.php");
require_once("Validator.php");
class TravelValidator extends Validator{

    public function validar($datosuser, $formulario, $imagenperfil = false, User $usuario, $mailModificacion = ''){
      //var_dump($datosuser);
      //exit;
    $textmensaje = trim($datosuser['textmensaje']);
    $datein = trim($datosuser['datein']);
    $dateout = trim($datosuser['dateout']);
    $pais= trim($datosuser['pais']);
    //$ciudad=  trim($data['ciudad']);
    $importe= trim($datosuser['importe']);
    $moneda= trim($datosuser['moneda']);
    $errores = [];
    if ($textmensaje == '') {
            $errores['textmensaje']  = 'Por favor compelta el nombre de tu viaje';
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
    /*if ($ciudad == '') {
              $errores['ciudad']  = 'Por favor indica la ciudad a visitar';
       }*/
    if ($importe == '') {
              $errores['importe']  = 'Por favor indica tu presupuesto';
      }
    if ($moneda == '') {
              $errores['moneda']  = 'Por favor indica que moneda presupuestas';
      }
    return $errores;
}

}
 ?>
