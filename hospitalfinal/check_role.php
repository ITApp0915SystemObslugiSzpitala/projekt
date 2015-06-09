


	<?php
	session_start();




ini_set('display_errors',1);
error_reporting(E_ALL);
$db =new mysqli('localhost', 'HOSPITAL', 'password', 'HOSPITAL_DEV')or die('Błąd !: ' . mysql_error());

            
		

if ($_POST["button"]=="Wstaw"){
 $db->query("INSERT INTO user_roles (user_roles.user_id, user_roles.role_id, user_roles.created_by_user_id,  user_roles.created_on_date) values ('".$_POST['user_id']."', '".$_POST['role_id']."', '".$_SESSION['id']."', '".date('Y-m-d H:m:s')."' );");

 $db->query("INSERT INTO  staff ( staff.staff_code, staff.user_id) values ('00001', '".$_POST['user_id']."' );");

$_SESSION['message'] = '<div class="alert alert-success" role="alert">Rola zostala dodana/zmieniona</div>';
}

 

$db->close();
if ($_POST["button"]=="Wstaw"){
header ('Location: mainpage.php');}

?>
    
            
           



