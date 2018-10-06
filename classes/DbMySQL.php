<?php

    require_once("DB.php");


    class DbMySQL extends DB
    {

        protected $conexion;

        public function __construct()
        //Nuestro constructor es basicamente PDO
        {

            // NOTE: db local:
            $dsn = 'mysql:host=localhost;dbname=singleriders;
            charset=utf8mb4;port=3306';
            $username ="root";
            $password = "";
            // NOTE: db hosting
            /*$dsn = 'mysql:host=localhost;dbname=id6873172_singleriders;
            charset=utf8mb4;port=3306';
            $username ="id6873172_root";
            $password = "agostoeighteen";*/

            try {
                $this->conexion = new PDO($dsn, $username, $password);
                //A nuestro atributo $conexion le asignamos el new PDO, y de aca en mas solamente tenemos que escribir "conexion" y con "->" accedamos a los metodos que necesitemos y sean propios de PDO.
            }

            catch(Exception $e)
            {
                echo "La conexion a la base de datos falló: " . $e->getMessage();
            }

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

        //Guardar Viaje//

        public function guardarViaje($data, $id){

          $textmensaje=$data['textmensaje'];
          $datein=$data['datein'];
          $dateout=$data['dateout'];
          $pais=$data['pais'];
          $mensajeiti=$data['mensajeiti'];
          $importe=$data['importe'];
          $moneda=$data['moneda'];
          $creadorDeViaje=$id;

          try {
            $query = $this->conexion->prepare("INSERT INTO travels (textmensaje,datein,dateout,pais,mensajeiti,importe,moneda,creadorDeViaje) VALUES(:textmensaje,:datein,:dateout,:pais,:mensajeiti,:importe,:moneda)");
            $query->bindValue(":textmensaje", $textmensaje);
            $query->bindValue(":datein", $datein);
            $query->bindValue(":dateout", $dateout);
            $query->bindValue(":pais", $pais);
            $query->bindValue(":mensajeiti", $mensajeiti);
            $query->bindValue(":importe", $importe);
            $query->bindValue(":moneda", $moneda);
            $query->execute();
          }

          catch(Exception $e)
          {
              echo "Error: " . $e->getMessage();
          }

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

          public function crearPost()
          {
            $post = $_GET['posteo'];

            $arrayPost = [
              'post' => $_GET['posteo'],
              'user_id' => $_SESSION['id'],
            ];
            try
            {
              $query = $this->conexion->prepare("INSERT INTO posts(post, user_id) VALUES (:post, :user_id)");

              $query->bindValue(":post", trim($arrayPost['post']));
              $query->bindValue(":user_id", $arrayPost['user_id']);
              $query->execute();
            }
            catch(Exception $e)
            {
              echo " Error: ". $e->getMessage();
            }

            header('location:home.php');
          }

          public function recuperarPostDeUsuario()
          {
            try{
              $query = $this->conexion->prepare("SELECT * from posts");
              $query->execute();
              $posts = $query->fetchAll(PDO::FETCH_ASSOC);
              return $posts;
            }
            catch(Exception $e)
            {
              echo "Error: ". $e->getMessage();
            }
          }

          public function asociarIdANombre($id)
          {
            $todos = $this->buscarUsuarios();
            $arrayUsuario = [];

            foreach ($todos as $key => $value) {
              if($value['id'] == $id)
              {
                 $arrayUsuario[] = $value['nombre'];

              }
            }
            return $arrayUsuario;
          }

    }
