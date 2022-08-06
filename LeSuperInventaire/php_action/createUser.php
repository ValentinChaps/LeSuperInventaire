<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$userName 		= $_POST['userName'];
  $upassword 			= md5($_POST['upassword']);
  $uemail 			= $_POST['uemail'];

	
				$sql = "INSERT INTO users (username, password,email) 
				VALUES ('$userName', '$upassword' , '$uemail')";
				if($connect->query($sql) === TRUE) {
					$valid['success'] = true;
					$valid['messages'] = "L'utilisateur a bien été créé";	
				} else {
					$valid['success'] = false;
					$valid['messages'] = "Il y a eu une erreur";
				}

					
		
	} 		

	$connect->close();

	echo json_encode($valid);
 
