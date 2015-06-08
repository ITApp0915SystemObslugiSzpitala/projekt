<?php
/*
 * Following code will get multiple patient drug treatments
 * A patient is identified by patient id (patientid)
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// check for post data
if (isset($_GET["patientid"])) {
	$patientid = $_GET['patientid'];
	$date = date('Y-m-d');
	if (isset($_GET["history"])) {
		$history = $_GET['history'];
		switch ($history) {
			case '1':
				$date = date("Y-m-d", mktime(0, 0, 0, date("m")-1, date("d"), date("Y")));
				break;
			case '2':
				$date = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"), date("Y")-1));
				break;
			default:
				break;
		}
	}
 
	// get drugs from drugs table
	$query =
		"SELECT pd.*,sd.symptom_id,d.*,pdcmn.comment_text
		FROM PATIENTS p
		INNER JOIN PATIENT_DRUGS pd
		ON p.patient_id = pd.patient_id
		AND DATE(pd.date_to) >= '$date' OR pd.date_to IS NULL
		INNER JOIN COMMENTS pdcmn
		ON pd.comment_id = pdcmn.comment_id
		INNER JOIN SYMPTOM_DRUGS sd
		ON pd.symptom_drug_id = sd.symptom_drug_id
		INNER JOIN DRUGS d
		ON sd.drug_id = d.drug_id
		WHERE p.patient_id = '$patientid'";
 
	$result = mysql_query($query) or die(mysql_error());
 
	// check for empty result
	if (mysql_num_rows($result) > 0) { 
		// looping through all results
		// drugs node
		$response["drugs"] = array();
		
		while ($row = mysql_fetch_assoc($result)) {
			$response["drugs"][] = $row;
		}
		// success
		$response["success"] = 1;

		// echoing JSON response
		echo json_encode($response);
	} else {
		// no drug found
		$response["success"] = 0;
		$response["message"] = "No matching drugs found";

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