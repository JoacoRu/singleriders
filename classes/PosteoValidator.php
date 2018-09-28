<?php 
class PostValidator extends Validator
{
    public function validar($datosuser = null, $formulario = null, $imagenperfil = null, User $usuario = null, $mailModificacion = null)
    {
        $errores = [];
        $post = trim($_GET['posteo']);
        if(strlen($post) == 0 )
        {
            $errores['post'] = 'Porfavor la publicacion debe tener contenido';
        }
        return $errores;
    }
}

?>