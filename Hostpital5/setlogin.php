<?php
session_start();
 $_SESSION['login'] = $_POST['login'];
 $_SESSION['surname'] = $_POST['surname'];
 $_SESSION['password'] = $_POST['password']  ;
 header ('Location: mainpage.php')
?>