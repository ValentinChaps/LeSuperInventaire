<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$edituserName = $_POST['edituserName'];
	$editPassword 		= md5($_POST['editPassword']);
	$userid 		= $_POST['userid'];

				
	$sql = "UPDATE users SET username = '$edituserName', password = '$editPassword' WHERE user_id = $userid ";

	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "L'utilisateur a été mise à jour";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Il y a eu une erreur";
	}

} 
	 
$connect->close();

echo json_encode($valid);
 
