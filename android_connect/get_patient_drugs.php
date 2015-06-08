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
		$res_arr_values = array();
		$i= 0;
		
		while ($row = mysql_fetch_assoc($result)) {
			/*// temp user arrays
			$single_drug = array();
			
			$drug = array();
			$drug["drug_id"] = $row["drug_id"];
			$drug["drug_name"] = $row["drug_name"];
			$drug["drug_description"] = $row["drug_description"];
			$drug["drug_code"] = $row["drug_code"];
			
			$patient_drug = array();
			$patient_drug["patient_drug_id"] = $row["patient_drug_id"];
			$patient_drug["date_from"] = $row["date_from"];
			$patient_drug["date_to"] = $row["date_to"];
			$patient_drug["created_by_user_id"] = $row["created_by_user_id"];
			$patient_drug["created_on_date"] = $row["created_on_date"];
			$patient_drug["modified_by_user_id"] = $row["modified_by_user_id"];
			$patient_drug["modified_on_date"] = $row["modified_on_date"];
			
			$patient_drug_comment = array();
			$patient_drug_comment["comment_text"] = $row["comment_text"];
			
			$patient_drug_symptom = array();
			$patient_drug_symptom["symptom_id"] = $row["symptom_id"];
			
			array_push($single_drug["drug"], $drug);
			array_push($single_drug["patient_drug"], $patient_drug);
			array_push($single_drug["patient_drug_comment"], $patient_drug_comment);
			array_push($single_drug["patient_drug_symptom"], $patient_drug_symptom);
			
			// push single drug into final response array
			$response["drugs"][] = $single_drug;*/
			$response["drugs"][] = $row;
			$i++;
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