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
            $query = $this->conexion->prepare("INSERT INTO usuarios VALUES(default, :email, :password)");
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
          $query = $this->conexion->prepare("SELECT * FROM paises");
          $query->execute();

          $arrayPaises = $query->fetchAll(PDO::FETCH_ASSOC);
          return $arrayPaises;
        }

        function traeCiudades()
        {
          $query = $this->conexion->prepare("SELECT * FROM ciudades limit 50");
          $query->execute();

          $arrayCiudades = $query->fetchAll(PDO::FETCH_ASSOC);
          return $arrayCiudades;
        }
    }
