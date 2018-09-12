<?php
//establezco la horaria de Bs As para que devuelva la hora local
date_default_timezone_set('America/Argentina/Buenos_Aires');
class Mensaje
{
   protected $fecha;
   public function __construct(){
     $this->fecha = date('d-m-Y H:i:s');
   }
   // crea el mensaje
   public function crearMensaje($remitente='anónimo',Usuario $usuario,$userchat=''){
     $convertidor = $usuario->nombreAsocId(intval($_POST['to']));
     $mensaje = [
       'from' => $_SESSION['id'],
       'to'  => intval($_POST['to']),
       'nombreRemitente' => $remitente,
       'idDestinatario' => intval($_POST['to']),
       'msj'  => $_POST['mensaje'],
       'fecha' => $this->fecha,
     ];
     $msjJson = json_encode($mensaje, true);
     file_put_contents('mensajes.json', $msjJson . PHP_EOL, FILE_APPEND);
     header('location:mensajes.php?userchat='.$userchat);
   }
   //decodea el msj
   public function recibirMensaje(){
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

   public function msjAseleccionar(){
     $recibe = $this->recibirMensaje();
     $idEnSesion = $_SESSION['id'];
     $datosDelMensaje = [];
     foreach ($recibe as $dato) {
       if($dato['idDestinatario'] == $idEnSesion || $dato['from'] == $idEnSesion){
         $datosDelMensaje[] = $dato;
       }
     }
     return $datosDelMensaje;
   }
}




 ?>
