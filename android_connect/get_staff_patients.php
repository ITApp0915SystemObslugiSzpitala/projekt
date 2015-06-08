<?php
/*
 * Following code will get multiple patients assigned to the doctor
 * A doctor is identified by staff id (staffid)
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// check for post data
if (isset($_GET["staffid"])) {
	$staffid = $_GET['staffid'];
	$date = date('Y-m-d');
 
	// get patients from patients table
	$query =
		"SELECT dp.date_from,dp.date_to,p.*
		FROM DOCTOR_PATIENTS dp		
		INNER JOIN PATIENTS p
		ON p.patient_id = dp.patient_id
		WHERE dp.doctor_id = '$staffid'
		AND DATE(dp.date_from) <= '$date'
		AND (DATE(dp.date_to) >= '$date' OR dp.date_to IS NULL)";
 
	$result = mysql_query($query) or die(mysql_error());
 
	// check for empty result
	if (mysql_num_rows($result) > 0) { 
		// looping through all results
		// patients node
		$response["patients"] = array();
		
		while ($row = mysql_fetch_assoc($result)) {
			$response["patients"][] = $row;
		}
		// success
		$response["success"] = 1;

		// echoing JSON response
		echo json_encode($response);
	} else {
		// no patients found
		$response["success"] = 0;
		$response["message"] = "No matching patients found";

		// echo no users JSON
		echo json_encode($response);
	}
} else {
	// required field is missing
	$response["success"] = 0;
	$response["message"] = "Required field(s) is missing";
 
	// echoing JSON response
	echo json_encode($response);
}
?>