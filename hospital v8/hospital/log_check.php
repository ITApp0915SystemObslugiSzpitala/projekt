<?php

error_reporting(E_ALL);
$db =new mysqli('localhost', 'root', 'haslo123', 'hospital_dev')or die('Błąd !: ' . mysql_error());
$result = $db->query("SELECT users.* FROM users where forename='".$_SESSION['login']."' AND surname='".$_SESSION['surname']."' AND password='".$_SESSION['password']."'") or die('Błąd !: ' . mysql_error());


if ($result->num_rows!=1 || !$result) 
header ('Location: login.php');
while($row = $result->fetch_assoc()){
   
   $_SESSION['id'] = $row{'user_id'};   
  
}



?>