<?php

    require_once("Model.php");
    require_once("User.php");

    class Auth
    {

        public function __construct()
        {
            session_start();
            if (!isset($_SESSION["id"]) && isset($_COOKIE["id"])) {

                $_SESSION["id"] = $_COOKIE["id"];

            }
        }

        public function login($email,User $usuario)

        {
          $usuariologin = $usuario->buscarUsuario($email);
          $_SESSION['id'] = $usuariologin['id'];
          if(!isset($_COOKIE['id']) && $_POST['recordarme']) {
            setcookie('id', $usuariologin['id'], time() + 3600);
          }
          header('location:home.php');
        }

        public function loginControl(User $usuario)
        {

          if (!isset($_SESSION['id']) && !isset($_COOKIE['id'])) {
            header('location:login.php');
          }else if (isset($_SESSION['id'])) {
            return $usuariologin = $usuario->obtenerId($_SESSION['id']);
          }else if (isset($_COOKIE['id'])) {
            return $usuariologin = $usuario->obtenerId($_COOKIE['id']);
          }else {
            header('location:login.php');
          }

        }

        public function usuarioLoginHeader(User $usuario){
          if (isset($_SESSION['id'])) {
            return $usuariologin = $usuario->obtenerId($_SESSION['id']);
          }else if (isset($_COOKIE['id'])) {
            return $usuariologin = $usuario->obtenerId($_COOKIE['id']);
          }
        }

        public function loggedBackToHome() {
          if (isset($_SESSION['id']) || isset($_COOKIE['id'])) {
            header('location:home.php');
          }
        }


        public function logout()
        {
            session_destroy();
            setcookie('id', '', time() - 3600);
            header('location:login.php');
        }
    }
