<?php
  require_once("User.php");
  abstract class DB
{
  abstract public function registrar($datosuser,$imagenperfil);
  abstract public function subirImgPerfil($imagen,$id);
  abstract public function obtenerUltimoId();
  abstract public function buscarUsuarios();
  abstract public function obtenerId($id);
  abstract public function buscarUsuario($email);
  abstract public function actualizarusuario($imagenperfil,$datosuser,$id);
  abstract public function traerNombreDeUsuarios();
  abstract public function nombreAsocId($nombre);
  // NOTE: métodos class mensaje
  abstract public function crearMensaje($remitente,User $usuario,$fecha,$userchat);
  abstract public function recibirMensaje();
  abstract public function msjAseleccionar();
  abstract public function obtenerTodosLosViajes();
  abstract public function obtenerViajes($id);
}
