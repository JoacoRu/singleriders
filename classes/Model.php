<?php
require_once('DbJSON.php');
require_once('DbMySQL.php');
class Model
{
  public $table;
  public $columns;
  public $datos;
  protected $db;
  protected $fecha;

  public function __construct()
  {
    //$this->datos = $datos;
    //$this->db = new DbJSON();
    $this->db = new DbMySQL();
    $this->fecha = date('Y-m-d H:i:s');

  }

// NOTE: registro singleriders
public function registrar($datosuser,$imagenperfil){
  $this->db->registrar($datosuser,$imagenperfil);
}
public function subirImgPerfil($imagen,$id){
  $this->db->subirImgPerfil($imagen,$id);
}
public function obtenerUltimoId(){
  return $this->db->obtenerUltimoId();
}
public function buscarUsuarios(){
  return $this->db->buscarUsuarios();
}
public function obtenerId($id){
  return $this->db->obtenerId($id);
}
public function buscarUsuario($email){
  return $this->db->buscarUsuario($email);
}
public function actualizarusuario($imagenperfil,$datosuser,$id){
  $this->db->actualizarusuario($imagenperfil,$datosuser,$id);
}
public function traerNombreDeUsuarios(){
  return $this->db->traerNombreDeUsuarios();
}
public function nombreAsocId($nombre){
  $this->db->nombreAsocId($nombre);
}

// NOTE: inicio métodos de la clase message
public function crearMensaje($remitente='anónimo',User $usuario,$userchat=''){
  $this->db->crearMensaje($remitente,$usuario,$this->fecha,$userchat);
}
public function recibirMensaje(){
  return $this->db->recibirMensaje();
}
public function msjAseleccionar(){
  return $this->db->msjAseleccionar();
}

// NOTE: inicio métodos para obtener Viajes
public function obtenerTodosLosViajes() {
  return $this->db->obtenerTodosLosViajes();
}
public function obtenerViajes($id){
  return $this->db->obtenerViajes($id);
}


}
