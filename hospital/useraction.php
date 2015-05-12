


	<?php
	session_start();




ini_set('display_errors',1);
error_reporting(E_ALL);
$db =new mysqli('localhost:3306', 'root', 'haslo123', 'hospital_dev')or die('Błąd !: ' . mysql_error());

            
		

if ($_POST["button"]=="Wstaw"){
 $db->query("INSERT INTO users (forename, surname, password,  gender, birth_place, birth_date, modified_by_user_id, created_by_user_id, created_on_date ) values ('".$_POST['forename']."', '".$_POST['surname']."', '".$_POST['password']."', '".$_POST['gender']."', '".$_POST['birth_place']."', '".$_POST['birth_date']."', '".$_SESSION['id']."', '".$_SESSION['id']."', '".date('Y-m-d H:m:s')."');");
$_SESSION['message'] = '<div class="alert alert-success" role="alert">Użytkownik został dodany do bazy</div>';
}

 

$db->close();
if ($_POST["button"]=="Wstaw"){
header ('Location: mainpage.php');}

?>
    
            
           



