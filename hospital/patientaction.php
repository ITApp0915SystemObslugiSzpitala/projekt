


	<?php
	session_start();




ini_set('display_errors',1);
error_reporting(E_ALL);
$db =new mysqli('localhost:3306', 'root', 'haslo123', 'hospital_dev')or die('Błąd !: ' . mysql_error());

            
		



if ($_POST["button"]=="Wstaw"){
 $db->query("INSERT INTO patients (forename, surname,  gender, birth_place, birth_date, modified_by_user_id, created_by_user_id, created_on_date ) values ('".$_POST['forename']."', '".$_POST['surname']."', '".$_POST['gender']."', '".$_POST['birth_place']."', '".$_POST['birth_date']."', '".$_SESSION['id']."', '".$_SESSION['id']."', '".date('Y-m-d H:m:s')."');");
$_SESSION['message'] = '<div class="alert alert-success" role="alert">Pacjent dodany do bazy . </div>';
 }
 elseif ($_POST["button"]=="Przyjmij"){
 $db->query("INSERT INTO patient_stays (patient_id, date_from,  created_by_user_id, created_on_date, stay_code ) values ('".$_POST['patient_id']."', '".$_POST['date_from']."', '".$_SESSION['id']."', '".date('Y-m-d H:m:s')."','".$_POST['stay_code']."');");
$stay = $db->insert_id;
$db->query("INSERT INTO patient_records (patient_id, created_by_user_id, created_on_date, ward_id, record_code ) values ('".$_POST['patient_id']."', '".$_SESSION['id']."', '".date('Y-m-d H:m:s')."','".$_POST['ward_id']."','".$_POST['record_code']."');");
$rec = $db->insert_id;
$db->query("INSERT INTO record_items (patient_stay_id, date_from, patient_record_id ) values ('".$stay."', '".$_POST['date_from']."','".$rec."');");
$_SESSION['message'] = '<div class="alert alert-success" role="alert">Pacjent o id: '.$_POST['patient_id'].' został przyjęty na oddział '.$_POST['ward_id'].' . </div>';
}

 

$db->close();
if ($_POST["button"]=="Przyjmij"){
header ('Location: searchwynik.php');}
if ($_POST["button"]=="Wstaw"){
header ('Location: patientprofile.php');}

?>
    
            
           



