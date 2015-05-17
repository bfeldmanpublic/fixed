<?php session_start();
	
	$GLOBALS['NOW'] = date("Y-m-d H:i:s");

	try {
	    
	    $GLOBALS['db'] = new PDO('mysql:host=localhost;dbname=FixedLP;charset=utf8', 'root', '12ontheDot!');
	    // $GLOBALS['db'] = new PDO('mysql:host=localhost;dbname=FixedLP;charset=utf8', 'root', 'root');
	    $GLOBALS['db']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $GLOBALS['db']->exec('USE FixedLP;');
	} catch (PDOException $error) {
	   
	    $error = $error->getMessage();
	    // echo json_encode(array('error' => true,
					//         'msg' => "MySQL Connection Failed: ".$error), header("HTTP/1.0 400 Not Found"));
		echo json_encode(array('error' => true,
					        'msg' => "Hmm, something went wrong. Please try again."), header("HTTP/1.0 400 Not Found"));
	    die();
	}

?>