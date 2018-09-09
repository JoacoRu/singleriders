<?php

class Register
{
    protected $nombre;
    protected $apellido;
    protected $email;
    protected $pass;
    protected $img;
    protected $id;
    protected $errores = [];

    public function __construct(String $nombre = null, String $apellido = null, $email = null, $pass = null, $img = null, Int $id =null)
    {
        $this->nombre = trim($_POST['nombre']);
        $this->apellido = trim($_POST['apellido']);
        $this->email = trim($_POST['email']);
        $this->pass = trim($_POST['password']);
        $this->id = $this->traerUltimoID();
        $this->img = $img;
    }
    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre= $nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPass()
    {
        return $this->pass;
    }

    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    public function validarLogin()
    {
        GLOBAL $errores;

        if($this->nombre == '')
        {
            $errores['nombre'] = 'Completa el campo "nombre"';

        }
        if($this->apellido == ''){
            $errores['apellido'] = 'Completa el campo "Apellido"';

        }
        if($this->pass == '')
        {
            $errores['pass'] = 'Completa el campo "Contraseña"';
        }

        if($this->email == '')
        {
            $errores['email'] = 'Completa el campo "Email"';

        }
        elseif(!filter_var($this->email, FILTER_VALIDATE_EMAIL))
        {
            $errores['email'] = 'Porfavor ingresa un email con formato valido';

        }elseif($this->existeEmail($this->email))
        {
            $errores['email'] = 'El email ingresado ya existe, Porfavor elije otro!';
        }
    }

    public function traerTodos()
    {
        // Traigo la data de todos los usuarios de 'usuarios.json'
		$todosJson = file_get_contents('usuarios.json');
		// Esto me arma un array con todos los usuarios
		$usuariosArray = explode(PHP_EOL, $todosJson);
		// Saco el último elemento que es una línea vacia
		array_pop($usuariosArray);
		// Creo un array vacio, para guardar los usuarios
		$todosPHP = [];
		// Recorremos el array y generamos por cada usuario un array del usuario
		foreach ($usuariosArray as $usuario) {
			$todosPHP[] = json_decode($usuario, true);
		}
        return $todosPHP;
    }

    public function traerUltimoID(){
        // me traigo todos los usuarios
        $usuarios = $this->traerTodos();
        if (count($usuarios) == 0) {
            return 1;
        }
        // En caso de que haya usuarios agarro el ultimo usuario
        $elUltimo = array_pop($usuarios);
        // Pregunto por le ID de ese ultimo usuario
        $id = $elUltimo['Id'];
        // A ese ID le sumo 1, para asignarle el nuevo ID al usuario que se esta registrando
        return $id + 1;
    }

    public function obtenerUltimoId(){
        $usuarios = file_get_contents('usuarios.json');
        $arrUsuariosJSON = explode(PHP_EOL,$usuarios);
        $arrUsuarioPHP = [];
        array_pop($arrUsuariosJSON);
        foreach ($arrUsuariosJSON as $key => $usuario) {
            $arrUsuarioPHP[] = json_decode($usuario,true);
        }
        $ultimo = array_pop($arrUsuarioPHP);
        $id = $ultimo['Id'];
        return $id;
      }

    public function existeEmail($email){
		// Traigo todos los usuarios
		$todos = $this->traerTodos();
		// Recorro ese array
		foreach ($todos as $unUsuario) {
			// Si el mail del usuario en el array es igual al que me llegó por POST, devuelvo al usuario
			if ($unUsuario['Email'] == $email) {
				return $unUsuario;
			}
		}
		return false;
    }

    public function crearUsuario()
    {
        $arrayPhp =[
            'Nombre' => $this->nombre,
            'Apellido' => $this->apellido,
            'Email' => $this->email,
            'Pass' => password_hash($this->pass, PASSWORD_DEFAULT),
            'Id' => $this->traerUltimoID(),
            'Img' => 'img/' . $this->email. '.' . pathinfo($_FILES['imgperfil']['name'], PATHINFO_EXTENSION),
        ];

        return $arrayPhp;
    }

    public function guardarUsuario()
    {
        $usuario = $this->crearUsuario();
        $usuarioJSON = json_encode($usuario);

        file_put_contents('usuarios.json', $usuarioJSON . PHP_EOL, FILE_APPEND);

        return $usuario;
    }

    public function guardarImagen(){
		$errores = [];
		if ($_FILES['imgperfil']['error'] == UPLOAD_ERR_OK) {
			// Capturo el nombre de la imagen, para obtener la extensión
			$nombreArchivo = $_FILES['imgperfil']['name'];
			// Obtengo la extensión de la imagen
			$ext = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
			// Capturo el archivo temporal
			$archivoFisico = $_FILES['imgperfil']['tmp_name'];
			// Pregunto si la extensión es la deseada
			if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png') {
				// Armo la ruta donde queda gurdada la imagen
				$dondeEstoyParado = dirname(__FILE__);
				$rutaFinalConNombre = $dondeEstoyParado . '/img/' . $_POST['email'] . '.' . $ext;
				// Subo la imagen definitivamente
				move_uploaded_file($archivoFisico, $rutaFinalConNombre);
			} else {
				$errores['imagen'] = 'El formato tiene que ser JPG, JPEG, PNG o GIF';
			}
		} else {
			// Genero error si no se puede subir
			$errores['imagen'] = 'No subiste nada';
		}
		return $errores;
	}

}


?>
