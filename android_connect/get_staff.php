<?php
/*
 * Following code will get single staff details
 * Staff is identified by username (username) and password (password)
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// check for post data
if (isset($_GET["username"]) && isset($_GET["password"])) {
    $username = $_GET['username'];
    $password = $_GET['password'];
 
    // get staff from staff table
    $query =
		"SELECT s.*
		FROM STAFF s
		INNER JOIN USERS u
		ON s.user_id = u.user_id
		WHERE CONCAT(u.forename,u.surname) = '$username'
		AND u.password = '$password'";
 
    $result = mysql_query($query);
 
    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
            $result = mysql_fetch_array($result);

            $staff = array();
			$staff["staff_id"] = $result["staff_id"];
			$staff["user_id"] = $result["user_id"];
			$staff["staff_code"] = $result["staff_code"];
			$staff["job_title"] = $result["job_title"];
			$staff["pin_code"] = $result["pin_code"];
			
            // success
            $response["success"] = 1;
 
            // user node
            $response["staff"] = array();
 
            array_push($response["staff"], $staff);
 
            // echoing JSON response
            echo json_encode($response);
        } else {
            // no staff found
            $response["success"] = 0;
            $response["message"] = "No matching user found";
 
            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no staff found
        $response["success"] = 0;
        $response["message"] = "No user found";
 
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
