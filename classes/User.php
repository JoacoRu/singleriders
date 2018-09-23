<?php
require_once('Model.php');
class User extends Model

{

  private $id;
  private $email;
  private $password;
  public $table = 'usuarios';
  public $columns = ['nombre','apellido','email','password','id','srcImagenperfil'];


}







 ?>
