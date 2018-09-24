<?php

    require_once("DB.php");


    class DbMySQL extends DB
    {

        protected $conexion;

        public function __construct()
        //Nuestro constructor es basicamente PDO
        {
            $dsn = 'mysql:host=localhost;dbname=singleriders;
            charset=utf8mb4;port=3306';
            $username ="root";
            $password = "";

            try {
                $this->conexion = new PDO($dsn, $username, $password);
                //A nuestro atributo $conexion le asignamos el new PDO, y de aca en mas solamente tenemos que escribir "conexion" y con "->" accedamos a los metodos que necesitemos y sean propios de PDO.
            }

            catch(Exception $e)
            {
                echo "La conexion a la base de datos falló: " . $e->getMessage();
            }

        }
        //Este metodo solamente va a tener la responsabilidad de guardar un nuevo usuario en nuestra base de datos.
        function guardarUsuario(Usuario $usuario)
        //Mi metodo va a recibir como parametro un $usuario que si o si tiene que ser del tipo Usuario. Re-ver clase 1 de OOP-PHP (Type Hinting) si no se entiende por que.
        {
            $query = $this->conexion->prepare("INSERT INTO users VALUES(default, :email, :password)");
            //nuestra query a MySQL como vimos en PDO, pasando el primer parametro como default ya que cuando creamos la base, el ID es AUTOINCREMENTAL si hay que insertar uno nuevo.
            $query->bindValue(":email", $usuario->getEmail());
            $query->bindValue(":password", $usuario->getPassword());
            //bindeo de valores. En clase lo corregimos a bindParam. Con bindValue podemos pasar tanto valores como variables. Con bindParam solamente podemos pasar variables, y si bien estamos pasando eso con getEmail() y getPassword(), lo cambio aca para que se entienda la diferencia entre ambos y se vea como en este caso particular, hubiera funcionado igual.
            $query->execute();
            //Ejecuto la query

            $id = $this->conexion->lastInsertId();
            //Genero el Id, con "->" le mando un "mensaje" a "conexion", que de nuevo, es lo que se genera en el constructor cuando en el TRY le digo "$this->conexion = new PDO($dsn, $username, $password);". El mensaje que mando en forma de funcion es "DAME EL ID QUE ACABAS DE SETEAR POR DEFAULT"
            $usuario->setId($id);
            //..... y como nuestra nueva instancia de usuario no sabia todavia su ID (porque recuerden, lo genera la base de datos automaticamente), setId($id)!

            return $usuario;
        }

        function buscamePorEmail($email)
        {
            $query = $this->conexion->prepare("Select * from usuarios where email = :email");
            $query->bindValue(":email", $email);
            $query->execute();

            $usuarioFormatoArray = $query->fetch(PDO::FETCH_ASSOC);

            if ($usuarioFormatoArray) {
            //SI hay $usuarioFormatoArray en linea 60
                $usuario = new Usuario($usuarioFormatoArray["email"], $usuarioFormatoArray["password"], $usuarioFormatoArray["id"]);
                //devolveme el OBJETO del tipo Usuario que busque en MySQL. Aca puede confundir "new", pero a MySQL no le importa que vos manejes objetos, solamente guarda datos en campos preestablecidos. Esta nueva instancia de Usuario es un usuario que ya tenemos registrado, pero para usarlo necesitamos manipular los datos de MySQL y transformarlos en un objeto.
                return $usuario;
            } else {
                //y si no hay $usuarioFormatoArray, devolveme null.
                return null;
            }
	    }

        function traeTodaLaBase()
        {
            $query = $this->conexion->prepare("SELECT * FROM usuarios");
            $query->execute();

            $usuariosFormatoArray = $query->fetchAll(PDO::FETCH_ASSOC);
            //Esta variable va a traer todos los usuarios en formato array, pero queremos objetos...
            $usuariosFormatoClase = [];
            //asi que armamos nuestro array de usuarios EN FORMATO DE CLASE y lo "foreacheamos" (?)
            foreach ($usuariosFormatoArray as $usuario):
                //array DE OBJETOS del tipo Usuario, nada mas y nada menos. Como se procesan despues, es responsabilidad de otra clase.
                $usuariosFormatoClase[] = new Usuario($usuario["email"], $usuario["password"], $usuario["id"]);
            endforeach;

            return $usuariosFormatoClase;
            //Aclaro de nuevo, el array que devuelve este metodo es un ARRAY DE OBJETOS.

        }


        function traePaises()
        {
          $query = $this->conexion->prepare("SELECT * FROM countries");
          $query->execute();

          $arrayPaises = $query->fetchAll(PDO::FETCH_ASSOC);
          return $arrayPaises;
        }

        function traeCiudades()
        {
          $query = $this->conexion->prepare("SELECT * FROM cities limit 50");
          $query->execute();

          $arrayCiudades = $query->fetchAll(PDO::FETCH_ASSOC);
          return $arrayCiudades;
        }


// NOTE:  metodos singleriders mysql


        //registro de usuario
        public function registrar($datosuser,$imagenperfil){
            $datosuser['password'] = password_hash($datosuser['password'],PASSWORD_DEFAULT);
            $this->id = $this->obtenerUltimoId();
            $this->id ? $this->id = $this->id + 1 : $this->id = 1;
            $datosuser['id'] = $this->id;
            $ext = strtolower(pathinfo($imagenperfil['imgperfil']['name'], PATHINFO_EXTENSION));
            $hasta = '/images/profileImg/'.'perf'.$this->id.'.'.$ext;
            $datosuser['srcImagenperfil'] = $hasta;

            try {
              $query = $this->conexion->prepare("INSERT INTO users (nombre,apellido,email,password,id,srcImagenperfil) VALUES(:nombre,:apellido,:email,:password,:id,:srcImagenperfil)");
              $query->bindValue(":nombre", $datosuser['nombre']);
              $query->bindValue(":apellido", $datosuser['apellido']);
              $query->bindValue(":email", $datosuser['email']);
              $query->bindValue(":password", $datosuser['password']);
              $query->bindValue(":id", $datosuser['id']);
              $query->bindValue(":srcImagenperfil", $datosuser['srcImagenperfil']);
              $query->execute();
            }

            catch(Exception $e)
            {
                echo "Error: " . $e->getMessage();
            }




            $this->subirImgPerfil($imagenperfil,$this->id);

            $_SESSION['id'] = $this->id;

            header('location:home.php');
        }

        //subir imagen

        public function subirImgPerfil($imagen,$id){
          if ($imagen['imgperfil']['error'] === UPLOAD_ERR_OK) {
              $ext = strtolower(pathinfo($imagen['imgperfil']['name'], PATHINFO_EXTENSION));
              if ($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg') {
                  $hasta = dirname(dirname(__FILE__)) .'/images/profileImg/'.'perf'.$id.'.'.$ext ;
                  $desde = $imagen['imgperfil']['tmp_name'];
                  //$end = end(explode('/', $hasta));
                  if (file_exists($hasta)) {
                    //echo "<br>";
                    //echo "<p>El archivo ya existe, no será subido</p>";
                    move_uploaded_file($desde, $hasta);
                  }else {
                    move_uploaded_file($desde, $hasta);
                  }

              }else {
                  //var_dump('extension invalida!');
              }
          }else {
              //var_dump('error al subir');
          }
        }

        //obtener id del ultimo usuario
        public function obtenerUltimoId(){
          $query = $this->conexion->prepare("SELECT max(id) as id from users");
          $query->execute();
          $id = $query->fetch(PDO::FETCH_ASSOC);
          return $id['id'];
        }

        //obtener usuarios (para registrar si no existe el mail o para loguear si son correctas las credenciales y el email)
        public function buscarUsuarios(){
          $query = $this->conexion->prepare("SELECT * from users");
          $query->execute();
          $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);
          return $usuarios;
        }



        //obtener id de usuario
        public function obtenerId($id){
          $usuarios = $this->buscarUsuarios();
          $usuario = [];
          if (!empty($usuarios)) {
            foreach ($usuarios as $usuario) {
              //var_dump($usuario['id']);
              if ($id == $usuario['id']) {
                return $usuario;
              }
            }
          }
          return false;
        }


        //obtener un usuario
        public function buscarUsuario($email){
          $usuarios = $this->buscarUsuarios();
          $usuario = [];
          if (!empty($usuarios)) {
            foreach ($usuarios as $usuario) {
              if (strtolower($email) == strtolower($usuario['email'])) {
                return $usuario;
              }
            }
          }
          return false;
        }

        //actualizar perfil de usuario
        public function actualizarusuario($imagenperfil,$datosuser,$id){
          // NOTE: obtener los usuarios en usuarios.json, transformandolos en un array
          $usuarios = $this->buscarUsuarios();
          // NOTE: recorrer array de todos los usuarios y sobreescribir el registro que corresponda al usuario a editar
          if (!empty($usuarios)) {
              foreach ($usuarios as $usuario) {
                // NOTE: si encuentro al usuario guardo las modificaciones
                if (strtolower($id) == strtolower($usuario['id'])) {
                  $usuario['nombre'] = $datosuser['nombre'];
                  $usuario['apellido'] = $datosuser['apellido'];
                  $usuario['email'] = $datosuser['email'];
                  if ($usuario['password'] != $datosuser['password']) {
                    $usuario['password'] = password_hash($datosuser['password'],PASSWORD_DEFAULT);
                  }
                  if ($imagenperfil['imgperfil']['error'] === UPLOAD_ERR_OK) {
                    $ext = strtolower(pathinfo($imagenperfil['imgperfil']['name'], PATHINFO_EXTENSION));
                    $hasta = '/images/profileImg/'.'perf'.$id.'.'.$ext;
                    $usuario['srcImagenperfil'] = $hasta;
                }
                try {
                  $query = $this->conexion->prepare("UPDATE users set nombre  = :nombre,apellido = :apellido,email = :email,password = :clave,srcImagenperfil = :srcImagenperfil where id = :id");

                  $query->bindValue(":nombre", $usuario['nombre']);
                  $query->bindValue(":apellido", $usuario['apellido']);
                  $query->bindValue(":email", $usuario['email']);
                  $query->bindValue(":clave", $usuario['password']);
                  $query->bindValue(":id", intval($usuario['id']));
                  $query->bindValue(":srcImagenperfil", $usuario['srcImagenperfil']);
                  $query->execute();
                  $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);

                }

                catch(Exception $e)
                {
                    echo "Error: " . $e->getMessage();

                }
                $this->subirImgPerfil($imagenperfil,$id);
              }
            }
          }


        }

        //Todos los nombres en un array
        public function traerNombreDeUsuarios(){
          $todosLosUsuarios = $this->buscarUsuarios();
          $ultimoId = $this->obtenerUltimoId();
          $nombres = [];
          $nombres['usuarios'] = array_map(function($item){
            return $item['nombre'];
            }, $todosLosUsuarios);
            //unset($nombres['usuarios'][0]);
            return $nombres;
          }

          // asociar el nombre a una id
          public function nombreAsocId($nombre){
            $todosLosUsuarios = $this->buscarUsuarios();
            $datosDeUsuario = [];
            $idDelUsuario='';
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

          // NOTE: métodos mensajes
          // crea el mensaje
          public function crearMensaje($remitente='anónimo',User $usuario,$fecha,$userchat=''){
            $convertidor = $usuario->nombreAsocId(intval($_POST['to_id']));
            $mensaje = [
              'from_id' => $_SESSION['id'],
              'to_id'  => intval($_POST['to_id']),
              'nombreRemitente' => $remitente,
              'idDestinatario' => intval($_POST['to_id']),
              'msj'  => $_POST['mensaje'],
              'fecha' => $fecha,
            ];
            try {
              $query = $this->conexion->prepare("INSERT INTO messages (from_id,to_id,nombreRemitente,idDestinatario,msj,fecha) VALUES(:from_id,:to_id,:nombreRemitente,:idDestinatario,:msj,:fecha)");
              $query->bindValue(":from_id", intval($mensaje['from_id']));
              $query->bindValue(":to_id", intval($mensaje['to_id']));
              $query->bindValue(":nombreRemitente", $mensaje['nombreRemitente']);
              $query->bindValue(":idDestinatario", intval($mensaje['idDestinatario']));
              $query->bindValue(":msj", $mensaje['msj']);
              $query->bindValue(":fecha", $mensaje['fecha']);
              $query->execute();

            }

            catch(Exception $e)
            {
                echo "Error: " . $e->getMessage();
            }
            header('location:mensajes.php?userchat='.$userchat);
          }
          //decodea el msj
          public function recibirMensaje(){
            $query = $this->conexion->prepare("SELECT * from messages");
            $query->execute();
            $mensajes = $query->fetchAll(PDO::FETCH_ASSOC);
            return $mensajes;
          }

          //selecciona el msj

          public function msjAseleccionar(){
            $recibe = $this->recibirMensaje();
            $idEnSesion = $_SESSION['id'];
            $datosDelMensaje = [];
            foreach ($recibe as $dato) {
              if($dato['idDestinatario'] == $idEnSesion || $dato['from_id'] == $idEnSesion){
                $datosDelMensaje[] = $dato;
              }
            }
            return $datosDelMensaje;
          }

          // NOTE: viajes.php
          function obtenerTodosLosViajes() {
            $query = $this->conexion->prepare("SELECT * from travels");
            $query->execute();
            $viajes = $query->fetchAll(PDO::FETCH_ASSOC);
            $counter = 0;
            $usuarioviaje['counter'] = $counter+1;
            $usuarioviaje['viajes'] = $viajes;
            return $usuarioviaje;
          }
          function obtenerViajes($id) {
            $query = $this->conexion->prepare("SELECT * from travels where creadorDeViaje = :id");
            $query->bindValue(":id", $id);
            $query->execute();
            $viajes = $query->fetchAll(PDO::FETCH_ASSOC);
            $arrUsuarioViajes = [];
            $arrUsuarioViajestmp = [];
            $arrUsuarioViaje = [];
            $counter = 0;
            foreach ($viajes as $key => $usuario) {
                if ($key['creadorDeViaje'] == $id) {
                  $counter++;
                }
            }
            $usuarioviaje['counter'] = $counter+1;
            $usuarioviaje['viajes'] = $viajes;
            return $usuarioviaje;
          }

    }
