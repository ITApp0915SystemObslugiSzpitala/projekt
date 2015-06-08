


	<?php
	session_start();




ini_set('display_errors',1);
error_reporting(E_ALL);
$db =new mysqli('localhost', 'root', '', 'hospital_dev')or die('Błąd !: ' . mysql_error());

            
		

if ($_POST["button"]=="Wstaw"){
 $db->query("INSERT INTO user_roles (user_id, role_id, created_by_user_id,  created_on_date) values ('".$_POST['user_id']."', '".$_POST['role_id']."', '".$_SESSION['id']."', '".date('Y-m-d H:m:s')."');");

$_SESSION['message'] = '<div class="alert alert-success" role="alert">Rola zostala dodana/zmieniona</div>';
}

 

$db->close();
if ($_POST["button"]=="Wstaw"){
header ('Location: mainpage.php');}

?>
    
            
           



