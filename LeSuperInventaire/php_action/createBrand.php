<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$brandName = $_POST['brandName'];
  $brandStatus = $_POST['brandStatus']; 

	$sql = "INSERT INTO brands (brand_name, brand_active, brand_status) VALUES ('$brandName', '$brandStatus', 1)";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "La marque a été ajoutée";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Il y a eu une erreur";
	}
	 

	$connect->close();

	echo json_encode($valid);
 
} 