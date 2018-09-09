<?php
include_once('register.php');
$errores = [];

if($_POST)
{

    $usuario = new Register();
    $usuario->validarLogin();
    if(empty($errores))
    {
        $usuario->guardarUsuario();
    }

}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <form method="post">
        <input type="text" name="nombre" placeholder="Ingrese su nombre">
        <br>
        <p> <?php if (isset($errores['nombre'])): ?>
            <?= $errores['nombre'] ?>
            <?php endif; ?></p>
        <input type="text" name="apellido" placeholder="Ingrese su apellido">
        <br>
        <p> <?php if (isset($errores['apellido'])): ?>
            <?= $errores['apellido'] ?>
            <?php endif; ?></p>
        <input type="password" name="password" placeholder="****">
        <br>
        <p> <?php if (isset($errores['pass'])): ?>
            <?= $errores['pass'] ?>
            <?php endif; ?></p>
        <input type="text" name="email" placeholder="Ingrese su email">
        <br>
        <p> <?php if (isset($errores['email'])): ?>
            <?= $errores['email'] ?>
            <?php endif; ?></p>
        <input type="file" name="imgperfil" id="imgperfil">
        <br>
        <p> <?php if (isset($errores['img'])): ?>
            <?= $errores['img'] ?>
            <?php endif; ?></p>
        <button type="submit">Registrarse!</button>
    </form>
</body>
</html>
