<?php

class Mensajes
{
    protected $from;
    protected $to;
    protected $remitente;
    protected $idDestinatario;
    protected $mensajes;

    public function __construct(Int $from = null, String $to = null, String $remitente = null, Int $idDestinatario = null, $mensajes = null)
    {
        $this->from = $_SESSION['id'];
        $this->to = $_POST['to'];
        $this->remitente = $_POST['nombreRemitente'];
        $this->idDestinatario = $this->nombreAsocId($this->to);
        $this->mensajes = $_POST['msj'];
    }


    public function nombreAsocId($nombre){
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

   public function crearMensaje($remitente='anónimo',Usuario $usuario){
        $mensaje = [
          'from' => $this->from,
          'to'  => $this->to,
          'nombreRemitente' => $remitente,
          'idDestinatario' => $this->idDestinatario,
          'msj'  => $this->mensajes,
        ];
        $msjJson = json_encode($mensaje, true);
        file_put_contents('mensajes.json', $msjJson . PHP_EOL, FILE_APPEND);
        header('location:mensajes.php');
      }

      public function buscarUsuarios(){
        $usuarios = file_get_contents('usuarios.json');
        $arrUsuariosJSON = explode(PHP_EOL,$usuarios);
        $arrUsuarioPHP = [];
        array_pop($arrUsuariosJSON);
        foreach ($arrUsuariosJSON as $key => $usuario) {
            $arrUsuarioPHP[] = json_decode($usuario,true);
        }
        return $arrUsuarioPHP;
      }

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

      public function msjAseleccionar(){
        $recibe = $this->recibirMensaje();
        $idEnSesion = $this->from;
        $datosDelMensaje = [];
        foreach ($recibe as $dato) {
          if($dato['idDestinatario'] == $idEnSesion){
            $datosDelMensaje[] = $dato;
          }
        }
        return $datosDelMensaje;
      }

}

?>
