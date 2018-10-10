<?php 
    class Grupo
    {
        protected $nombreGrupo;
        protected $descripcion;
        protected $integrantes;
        protected $errores = [];


        /* VALIDA LOS CAMPOS DEL FORMULARIO*/
        public function validarGrupo()
        {
            GLOBAL $errores;
            $titulo = trim($_POST['titulo']);
            $descripcion = trim($_POST['descripcion']);
            $integrantes = trim($_POST['integrantes']);

            if($titulo == " ")
            {
                $errores['titulo'] = 'El grupo debe tener un titulo';
            }elseif($titulo > 3)
            {
                $errores['titulo'] = 'El titulo del grupo debe poseer mas de 3 caracteres';
            }
            if($descripcion == " ")
            {
                $errores['descripcion'] = 'El grupo debe poseer una descripcion';
            }elseif($descripcion > 10)
            {
                $errores['descripcion'] = 'La descripcion del grupo debe ser mayor a 10 caracteres';
            }
            if($this->buscador($integrantes, ",") == false)
            {
                $errores['integrantes'] = 'El grupo debe poseer por lo menos dos integrantes, recuerda que debes separar cada nombre por una ","';
            }
            return $errores;
        }

/* CREA EL ARRAY DEL GRUPO*/
        public function crearGrupo()
        {
            $titulo = trim($_POST['titulo']);
            $descripcion = trim($_POST['descripcion']);
            $integrantes = $this->integrantesAunArray();

            $grupo = array(
                'titulo' => $titulo,
                'descripcion' => $descripcion,
                'integrantes' => $integrantes,
                'adminGrupo' => $_SESSION['id'],
                'id' => $this->sumadorId(),
            );

            $grupoJson = json_encode($grupo, true);
            file_put_contents('grupos.json', $grupoJson . PHP_EOL, FILE_APPEND);
        }


        /* BUSCA TODOS LOS NOMBRES*/
        public function recibirNombres()
            {
                $usuariosJson= file_get_contents('usuarios.json');
                $usuariosArray = explode(PHP_EOL, $msjJson);
                array_pop($usuariosArray);
                $arrayPhp = [];
                foreach ($usuariosArray as $usuario) {
                  $arrayPhp[] = json_decode($usuario, true);
                }
                return $arrayPhp;
            }
              
        public function buscador($string, $stringBuscado)
        {
            $buscador = strpos($string, $stringBuscado);
            if($buscador == true){
                return true;
            }else
            {
                return false;
            }
        }

        public function obtenerUltimoId(){
            $grupos = file_get_contents('grupos.json');
            $arrGruposJSON = explode(PHP_EOL,$grupos);
            $arrGruposPHP = [];
            array_pop($arrGruposJSON);
            foreach ($arrGruposJSON as $key => $grupos) {
                $arrGruposPHP[] = json_decode($grupos,true);
            }
            $ultimo = array_pop($arrGruposPHP);
            $id = $ultimo['id'];
            return $id;
          }

        public function sumadorId()
        {
            $ids= $this->obtenerUltimoId();
            
        }

        public function integrantesAunArray()
        {
          $integrantes = trim($_POST['integrantes']);
          $convertidor = explode("," , $integrantes);
          return $convertidor;
        }
            
    }
?>