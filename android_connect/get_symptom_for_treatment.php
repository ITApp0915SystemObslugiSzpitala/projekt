<?php
/*
 * Following code will get single symptom details
 * A symptom is identified by symptom id (symptomid)
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// check for post data
if (isset($_GET["symptomid"])) {
    $symptomid = $_GET['symptomid'];
 
    // get a symptom from symptoms table
    $query =
		"SELECT s.symptom_id,s.created_by_user_id AS symptom_created_by,s.created_on_date AS symptom_created_on,
				d.diagnose_id,d.created_by_user_id AS diagnose_created_by,d.created_on_date AS diagnose_created_on,
				dcode.diagnose_code,dcode.name,dcode.short_description,
				sc.comment_text AS symptom_comment,
				dc.comment_text AS diagnose_comment
		FROM SYMPTOMS s
		INNER JOIN DIAGNOSES d
		ON s.diagnose_id = d.diagnose_id
		INNER JOIN DIAGNOSE_CODES dcode
		ON d.diagnose_code = dcode.diagnose_code
		INNER JOIN COMMENTS sc
		ON s.comment_id = sc.comment_id
		INNER JOIN COMMENTS dc
		ON d.comment_id = dc.comment_id
		WHERE s.symptom_id = '$symptomid'";
 
    $result = mysql_query($query);
 
    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) { 
			$result = mysql_fetch_array($result);
			
			$symptom = array();
			$symptom["symptom_id"] = $result["symptom_id"];
			$symptom["symptom_created_by"] = $result["symptom_created_by"];
			$symptom["symptom_created_on"] = $result["symptom_created_on"];
			
			$diagnose = array();
			$diagnose["diagnose_id"] = $result["diagnose_id"];
			$diagnose["diagnose_created_by"] = $result["diagnose_created_by"];
			$diagnose["diagnose_created_on"] = $result["diagnose_created_on"];
			
			$symptom_comment = array();
			$symptom_comment["symptom_comment"] = $result["symptom_comment"];
			
			$diagnose_comment = array();
			$diagnose_comment["diagnose_comment"] = $result["diagnose_comment"];
			
			$diagnose_code = array();
			$diagnose_code["diagnose_code"] = $result["diagnose_code"];
			$diagnose_code["name"] = $result["name"];
			$diagnose_code["short_description"] = $result["short_description"];
			
            // success
            $response["success"] = 1;
 
            // user node
            $response["symptom"] = array();
            $response["diagnose"] = array();
			$response["symptom_comment"] = array();
            $response["diagnose_comment"] = array();
			$response["diagnose_code"] = array();
 
            array_push($response["symptom"], $symptom);
            array_push($response["diagnose"], $diagnose);
			array_push($response["symptom_comment"], $symptom_comment);
            array_push($response["diagnose_comment"], $diagnose_comment);
			array_push($response["diagnose_code"], $diagnose_code);
 
            // echoing JSON response
            echo json_encode($response);
        } else {
            // no symptom found
            $response["success"] = 0;
            $response["message"] = "No matching symptom found";
 
            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no symptom found
        $response["success"] = 0;
        $response["message"] = "No symptom found";
 
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