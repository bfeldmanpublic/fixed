<?php include_once("connect.php");

session_start();



function getLeadByEmail($email){
	$getLead = $GLOBALS['db']->prepare('SELECT * FROM leads WHERE email = ?');
	$getLead -> execute(array($email));

	if($results = $getLead -> fetchAll(PDO::FETCH_ASSOC)){

		http_response_code(200);
		return array("error"		=> false, 
						"msg"		=> "success",
						"lead"		=> $results);

	}else{

		http_response_code(404);
		return array( "error"		=> true, 
						"msg"		=> "Lead not found.",
						"lead"		=> null);
	}

}

function insertLead($email){

	$insertLead = $GLOBALS['db'] -> prepare('INSERT INTO leads (email, created_at)
									VALUES (?, ?)');
	$insertLead -> execute(array($email, $GLOBALS['NOW']));

	if($id = $GLOBALS['db']->lastInsertId()){ // Lead created successfully. Returning the new lead id.

		http_response_code(200);
		return array( "error"		=> false,
						"msg"		=> "success",
				    	"userID"	=> $id);

	}else{

		http_response_code(500);
		return array( "error"		=> true,
						"msg"		=> "No email submitted.",
						"userID"	=> null);
	}

}

function resubmitLead($email){

	$insertLead = $GLOBALS['db'] -> prepare('UPDATE leads SET resubmitted_at = ? WHERE email = ?');
	$insertLead -> execute(array($GLOBALS['NOW'], $email));

	// if($id = $GLOBALS['db']->lastInsertId()){ // Lead created successfully. Returning the new lead id.

	// 	http_response_code(200);
	// 	return array( "error"		=> false,
	// 					"msg"		=> "success",
	// 			    	"userID"	=> $id);

	// }else{

	// 	http_response_code(500);
	// 	return array( "error"		=> true,
	// 					"msg"		=> "No email submitted.",
	// 					"userID"	=> null);
	// }

	return array( "error"		=> false,
				"msg"		=> $email." resubmitted at ".$GLOBALS['NOW'],
				"userID"	=> null);

}
		


 ?>