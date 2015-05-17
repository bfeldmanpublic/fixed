<?php include_once("LEAD.php");

$email = $_POST['email'];

$lead = getLeadByEmail($email);
if($lead['lead']){

	http_response_code(403);
	echo json_encode(array("error"	=> true,
							"msg"	=> "Looks like you've already signed up for Fixed alerts. ".$email." is already on our list."));
	return;
}

$output = insertLead($email);
echo json_encode($output);


?>