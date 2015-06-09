


	<?php
	session_start();




ini_set('display_errors',1);
error_reporting(E_ALL);
$db =new mysqli('localhost', 'HOSPITAL', 'password', 'HOSPITAL_DEV')or die('Błąd !: ' . mysql_error());

            if ($_POST["button"]=="Dokumenty"){
			$idp=$_POST['patient_id'];
			
		//header ('Location: patientdocs.php?id='.$_POST['patient_id'].'');
		
		}
		
		
if ($_POST["button"]=="Aktualizuj"){

 
  $db->query("UPDATE patients  SET forename = '".$_POST['ud_forename']."', surname = '".$_POST['ud_surname']."', gender = '".$_POST['ud_gender']."',  birth_place = '".$_POST['ud_birth_place']."', modified_by_user_id = '".$_SESSION['id']."'  where patient_id = '".$_POST['ud_patient_id']."';");

$_SESSION['message'] = '<div class="alert alert-success" role="alert">Zaktualizowano
</div>';
}


if ($_POST["button"]=="Dodaj dokument"){
 

$db->query("INSERT INTO identity_documents (document_type_id, document_number) values ('".$_POST['doctype']."', '".$_POST['doc_nr']."');");
$iddokumentu = $db->insert_id;
$db->query("INSERT INTO patient_identity_docs (patient_id, identity_document_id, default_flg) values ('".$_GET['id']."', '".$iddokumentu."', '0' );");
 $_SESSION['message'] = '<div class="alert alert-success" role="alert">Dokument dodany do bazy . </div>';
 header ('Location: patientdocs.php?id='.$_GET['id'].'');}
 if ($_POST["button"]=="Dodaj adres"){
 
$db->query("INSERT INTO addresses (street_name, street_number, city,  postal_code, country, modified_by_user_id, created_by_user_id, created_on_date, address_type_id) values ('".$_POST['street_name']."', '".$_POST['street_number']."', '".$_POST['city']."', '".$_POST['postal_code']."', '".$_POST['country']."',  '".$_SESSION['id']."', '".$_SESSION['id']."', '".date('Y-m-d H:m:s')."', '2') ;");
$idadresu = $db->insert_id;
$db->query("INSERT INTO patient_addresses (address_id, patient_id) values ('".$idadresu."', '".$_GET['id']."' );");
 $_SESSION['message'] = '<div class="alert alert-success" role="alert">Adres dodany do bazy . </div>';
 header ('Location: patientaddresses.php?id='.$_GET['id'].'');
 }
if ($_POST["button"]=="Wstaw"){
 $db->query("INSERT INTO patients (forename, surname,  gender, birth_place, birth_date, modified_by_user_id, created_by_user_id, created_on_date ) values ('".$_POST['forename']."', '".$_POST['surname']."', '".$_POST['gender']."', '".$_POST['birth_place']."', '".$_POST['birth_date']."', '".$_SESSION['id']."', '".$_SESSION['id']."', '".date('Y-m-d H:m:s')."');");

$idpacjenta = $db->insert_id;
$db->query("INSERT INTO addresses (street_name, street_number, city,  postal_code, country, modified_by_user_id, created_by_user_id, created_on_date, address_type_id) values ('".$_POST['street_name']."', '".$_POST['street_number']."', '".$_POST['city']."', '".$_POST['postal_code']."', '".$_POST['country']."',  '".$_SESSION['id']."', '".$_SESSION['id']."', '".date('Y-m-d H:m:s')."', '2') ;");
$idadresu = $db->insert_id;
$db->query("INSERT INTO patient_addresses (address_id, patient_id) values ('".$idadresu."', '".$idpacjenta."' );");
//echo "INSERT INTO identity_documents (document_type_id, document_number) values ('".$_POST['doctype']."', '".$_POST['doc_nr']."');";
$db->query("INSERT INTO identity_documents (document_type_id, document_number) values ('".$_POST['doctype']."', '".$_POST['doc_nr']."');");
$iddokumentu = $db->insert_id;
$db->query("INSERT INTO patient_identity_docs (patient_id, identity_document_id, default_flg) values ('".$idpacjenta."', '".$iddokumentu."', '1' );");
//echo "INSERT INTO patient_identity_docs (patient_id, identity_document_id, default_flg) values ('".$idpacjenta."', '".$iddokumentu."', '1' );";
 $_SESSION['message'] = '<div class="alert alert-success" role="alert">Pacjent dodany do bazy . </div>';
header ('Location: mainpage.php');
 }
 elseif ($_POST["button"]=="Przyjmij"){
 $result = $db->query("SELECT patient_stays.* FROM patient_stays where patient_id=".$_POST['patient_id']." AND date_to IS NULL");
echo $result->num_rows;
if ($result->num_rows!=0){
{ $_SESSION['message'] = '<div class="alert alert-danger" role="alert">Ten pacjent znajduje się obecnie w szpitalu</div>'; }
header ('Location: mainpage.php');}

else {
 $db->query("INSERT INTO patient_stays (patient_id, date_from,  created_by_user_id, created_on_date, stay_code ) values ('".$_POST['patient_id']."', '".$_POST['date_from']."', '".$_SESSION['id']."', '".date('Y-m-d H:m:s')."','".$_POST['stay_code']."');");
$stay = $db->insert_id;
$db->query("INSERT INTO patient_records (patient_id, created_by_user_id, created_on_date, ward_id, record_code ) values ('".$_POST['patient_id']."', '".$_SESSION['id']."', '".date('Y-m-d H:m:s')."','".$_POST['ward_id']."','".$_POST['record_code']."');");
$rec = $db->insert_id;
$db->query("INSERT INTO record_items (patient_stay_id, date_from, patient_record_id ) values ('".$stay."', '".$_POST['date_from']."','".$rec."');");
$db->query("INSERT INTO doctor_patients (patient_id,  doctor_id ) values ('".$_POST['patient_id']."', '".$_POST['user_id']."' );");
echo "INSERT INTO doctor_patients (patient_id,  doctor_id ) values ('".$_POST['patient_id']."', '".$_POST['user_id']."' );";
$_SESSION['message'] = '<div class="alert alert-success" role="alert">Pacjent o id: '.$_POST['patient_id'].' został przyjęty na oddział '.$_POST['ward_id'].' . </div>';
header ('Location: mainpage.php');}
}
if ($_POST["button"]=="Wypisz"){
 $db->query("UPDATE patient_stays SET date_to='".date('Y-m-d H:m:s')."'  where patient_stay_id= '".$_POST['patient_stay_id']."' AND date_to IS NULL");
$_SESSION['message'] = '<div class="alert alert-success" role="alert">Pacjent wypisany. </div>';
header ('Location: mainpage.php');
 }
 if ($_POST["button"]=="Dodaj karte"){
 $db->query("INSERT INTO patient_records (patient_id, created_by_user_id, created_on_date, ward_id, record_code ) values ('".$_GET['patient']."', '".$_SESSION['id']."', '".date('Y-m-d H:m:s')."','".$_POST['ward_id']."','".$_POST['record_code']."');");
$rec = $db->insert_id;
$db->query("INSERT INTO record_items (patient_stay_id, date_from, patient_record_id ) values ('".$_GET['stayid']."', '".$_POST['date_from']."','".$rec."');");
$_SESSION['message'] = '<div class="alert alert-success" role="alert">Pacjent o id: '.$_GET['patient'].' został przyjęty na oddział '.$_POST['ward_id'].' . </div>';
header ('Location: patientstays.php?patient='.$_GET['patient'].'&id='.$_GET['stayid'].'');
 }
 if ($_POST["button"]=="Dodaj operacje"){
 
$db->query("INSERT INTO patient_operations (operation_code, patient_id, record_item_id, room_id, date_from, created_by_user_id ) values ('".$_POST['operation_code']."', '".$_GET['patient']."','".$_GET['recordid']."','".$_POST['room_id']."','".$_POST['date_from']."', '".$_SESSION['id']."');");
//echo "INSERT INTO patient_operations (operation_code, patient_id, record_item_id, room_id, date_from, created_by_user_id ) values ('".$_POST['operation_code']."', '".$_GET['patient']."','".$_GET['recordid']."','".$_POST['room_id']."','".$_POST['date_from']."', '".$_SESSION['id']."');";
$_SESSION['message'] = '<div class="alert alert-success" role="alert">Pacjent o id: '.$_GET['patient'].' ma dodaną operację. </div>';
header ('Location: patientstays2.php?patient='.$_GET['patient'].'&id='.$_GET['stayid'].'&recordid='.$_GET['recordid'].'');
 }
 if ($_POST["button"]=="Dodaj lek"){
 
$db->query("INSERT INTO comments (comment_text, created_by_user_id, created_on_date ) values ('".$_POST['comment']."', '".$_SESSION['id']."','".date('Y-m-d H:m:s')."');");
$kom = $db->insert_id;
$db->query("INSERT INTO symptoms (diagnose_id, comment_id, created_by_user_id, created_on_date ) values ('".$_GET['diagnoseid']."', '".$kom."', '".$_SESSION['id']."','".date('Y-m-d H:m:s')."');");
$sym = $db->insert_id;
$db->query("INSERT INTO symptom_drugs ( drug_id, symptom_id, created_by_user_id, created_on_date ) values ('".$_POST['drug_code']."', '".$sym."', '".$_SESSION['id']."','".date('Y-m-d H:m:s')."');");
//echo "INSERT INTO symptom_drugs ( drug_id, symptom_id, created_by_user_id, created_on_date ) values ('".$_POST['drug_code']."', '".$sym."', '".$_SESSION['id']."','".date('Y-m-d H:m:s')."');";
$sdid = $db->insert_id;
$db->query("INSERT INTO patient_drugs ( symptom_drug_id, patient_id, comment_id, created_by_user_id, created_on_date ) values ('".$sdid."', '".$_GET['patient']."', '".$kom."', '".$_SESSION['id']."','".date('Y-m-d H:m:s')."');");
//echo "INSERT INTO patient_drugs ( symptom_drug_id, patient_id, comment_id, created_by_user_id, created_on_date ) values ('".$sdid."', '".$_GET['patient']."', '".$kom."', '".$_SESSION['id']."','".date('Y-m-d H:m:s')."');";
$_SESSION['message'] = '<div class="alert alert-success" role="alert">Pacjent o id: '.$_GET['patient'].' ma dodany lek. </div>';

header ('Location: patientsymptoms.php?patient='.$_GET['patient'].'&id='.$_GET['stayid'].'&diagnoseid='.$_GET['diagnoseid'].'&recordid='.$_GET['recordid'].'');
 }
  if ($_POST["button"]=="Dodaj diagnoze"){
 
$db->query("INSERT INTO comments (comment_text, created_by_user_id, created_on_date ) values ('".$_POST['comment']."', '".$_SESSION['id']."','".date('Y-m-d H:m:s')."');");
$kom = $db->insert_id;
$db->query("INSERT INTO diagnoses (record_item_id, diagnose_code, comment_id, created_by_user_id, created_on_date ) values ('".$_GET['recordid']."', '".$_POST['diagnose_code']."', '".$kom."', '".$_SESSION['id']."','".date('Y-m-d H:m:s')."');");
$_SESSION['message'] = '<div class="alert alert-success" role="alert">Pacjent o id: '.$_GET['patient'].' ma dodaną diagnozę. </div>';

header ('Location: patientstays2.php?patient='.$_GET['patient'].'&id='.$_GET['stayid'].'&recordid='.$_GET['recordid'].'');
 }
$db->close();


?>
    
            
           



