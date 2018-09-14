<?php
include_once('Seguidores.php');


if($_POST)   
{
    print_r($_POST['seguir']);
   

}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>

    <form method="post">
        <label for="seguir">
            <input type="radio" name="seguir" id="hola"  onClick="document.getElementById('boton').click();">
            <button type="submit" id="boton" style="visibility: hidden">
        </label>
    </form>
    
</body>
</html>
