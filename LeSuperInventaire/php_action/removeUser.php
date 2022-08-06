<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$userid = $_POST['userid'];

if($userid) { 

 $sql = "DELETE FROM users  WHERE user_id = {$userid}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "L'utilisateur a été supprimé";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Il y a eu une erreur";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} 