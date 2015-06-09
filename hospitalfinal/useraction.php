


	<?php
	session_start();




ini_set('display_errors',1);
error_reporting(E_ALL);
$db =new mysqli('localhost', 'HOSPITAL', 'password', 'HOSPITAL_DEV')or die('Błąd !: ' . mysql_error());

            
		

if ($_POST["button"]=="Wstaw"){
 $db->query("INSERT INTO users (forename, surname, password,  gender, birth_place, birth_date, modified_by_user_id, created_by_user_id, created_on_date ) values ('".$_POST['forename']."', '".$_POST['surname']."', '".$_POST['password']."', '".$_POST['gender']."', '".$_POST['birth_place']."', '".$_POST['birth_date']."', '".$_SESSION['id']."', '".$_SESSION['id']."', '".date('Y-m-d H:m:s')."');");
 $idusera = $db->insert_id;
 $db->query("INSERT INTO addresses (street_name, street_number, city,  postal_code, country, modified_by_user_id, created_by_user_id, created_on_date, address_type_id) values ('".$_POST['street_name']."', '".$_POST['street_number']."', '".$_POST['city']."', '".$_POST['postal_code']."', '".$_POST['country']."',  '".$_SESSION['id']."', '".$_SESSION['id']."', '".date('Y-m-d H:m:s')."', '3') ;");
$idadresu = $db->insert_id;
$db->query("INSERT INTO user_addresses (address_id, user_id) values ('".$idadresu."', '".$idusera."' );");
$db->query("INSERT INTO staff_codes (staff_code, description ) values ('".$idusera."', 'aaa' );");
$_SESSION['message'] = '<div class="alert alert-success" role="alert">Użytkownik został dodany do bazy,  <a href= "przypiszrole.php">przejdź do przypisania roli</a></div>';
}

if ($_POST["button"]=="Aktualizuj"){

  $db->query("UPDATE users SET forename = '".$_POST['ud_forename']."', surname = '".$_POST['ud_surname']."', password = '".$_POST['ud_password']."', gender = '".$_POST['ud_gender']."',  birth_place = '".$_POST['ud_birth_place']."', modified_by_user_id = '".$_SESSION['id']."' where user_id = '".$_POST['ud_user_id']."';");
 /*$db->query("UPDATE users, addresses  SET forename = '".$_POST['ud_forename']."', surname = '".$_POST['ud_surname']."', password = '".$_POST['ud_password']."', gender = '".$_POST['ud_gender']."',  birth_place = '".$_POST['ud_birth_place']."', modified_by_user_id = '".$_SESSION['id']."', street_number = '".$_POST['ud_street_number']."', street_name = '".$_POST['ud_street_name']."', city = '".$_POST['ud_city']."', postal_code = '".$_POST['ud_postal_code']."',  country = '".$_POST['ud_country']."' where user_id = '".$_POST['ud_user_id']."';");

*/

$_SESSION['message'] = '<div class="alert alert-success" role="alert">Zaktualizowano
</div>';
}
 

$db->close();
if ($_POST["button"]=="Wstaw"){
header ('Location: mainpage.php');}

?>
    
            
           



