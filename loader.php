<?php

    //Loader simple que hace el require de las clases necesarias para que nuestra App trabaje
    //require_once("classes/DbMySQL.php");
    //require_once('classes/DbJSON.php');
    require_once("classes/Auth.php");
    require_once("classes/Validator.php");
    require_once("classes/LoginValidator.php");
    require_once("classes/RegisterValidator.php");
    require_once("classes/ProfileValidator.php");
    require_once("classes/User.php");
    require_once("classes/Message.php");
    require_once("classes/Travel.php");
    require_once('classes/TravelValidator.php');
    require_once("classes/PosteoValidator.php");
    require_once("classes/Posteo.php");

    //instancias de objetos que necesitamos para la logica de login , registro y crear viajes
    //$db = new DbMySQL();
    $usuario = new User();
    $loginvalidator = new LoginValidator();
    $registervalidator = new RegisterValidator();
    $profilevalidator = new ProfileValidator();
    $viaje = new Travel();
    $travelValidator= new TravelValidator();
    $mensaje = new Message();
    $autenticador = new Auth();
    $postValidator = new PostValidator();
    $post = new Posteo();
