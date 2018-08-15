<?php

session_start();
unset($_COOKIE['id']);
setcookie('id', '', time() - 3600, '/'); //send browser command remove sid from cookie
session_destroy(); //remove sid-login from server storage
session_write_close();
var_dump($_COOKIE);
echo '<br>';
header('location:login.php');

?>
