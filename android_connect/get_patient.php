<?php
 
/*
 * Following code will get single product details
 * A product is identified by product id (pid)
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// check for post data
if (isset($_GET["pid"])) {
    $pid = $_GET['pid'];
 
    // get a product from products table
    $query =
		"SELECT p.*,id.*,ti.*
		FROM PATIENTS p
		INNER JOIN PATIENT_IDENTITY_DOCS pid
		ON p.patient_id = pid.patient_id
		AND pid.default_flg = 1
		INNER JOIN IDENTITY_DOCUMENTS id
		ON id.identity_document_id = pid.identity_document_id
		INNER JOIN TYPE_ITEMS ti
		ON ti.type_item_id = id.document_type_id
		WHERE id.document_number = '$pid'";
 
    $result = mysql_query($query);
 
    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
 
            $result = mysql_fetch_array($result);

            	$patient = array();
		$patient["patient_id"] = $result["patient_id"];
		$patient["forename"] = $result["forename"];
		$patient["surname"] = $result["surname"];
		$patient["created_by_user_id"] = $result["created_by_user_id"];
		$patient["created_on_date"] = $result["created_on_date"];
		$patient["modified_by_user_id"] = $result["modified_by_user_id"];
		$patient["modified_on_date"] = $result["modified_on_date"];
		$patient["gender"] = $result["gender"];
		$patient["birth_date"] = $result["birth_date"];
		$patient["birth_place"] = $result["birth_place"];

		$identity_document = array();
		$identity_document["document_number"] = $result["document_number"];
		$identity_document["document_type"] = $result["value"]; 
            // success
            $response["success"] = 1;
 
            // user node
            $response["patient"] = array();
            $response["identity_document"] = array();
 
            array_push($response["patient"], $patient);
            array_push($response["identity_document"], $identity_document);
 
            // echoing JSON response
            echo json_encode($response);
        } else {
            // no patient found
            $response["success"] = 0;
            $response["message"] = "No matching patient found";
 
            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no patient found
        $response["success"] = 0;
        $response["message"] = "No patient found";
 
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
