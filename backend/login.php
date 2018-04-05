<?php include_once("LEAD.php");

$email = $_POST['email'];

$lead = getLeadByEmail($email);
if($lead['lead']){

	resubmitLead($email);
	http_response_code(200);
	echo json_encode(array("error"	=> true,
							"msg"	=> "Sweet, ".$email." is in!"));
	return;
}else{
	http_response_code(403);
	echo json_encode(array("error"	=> true,
							"msg"	=> "".$email." can't be found in our records."));

	return;
}

?>