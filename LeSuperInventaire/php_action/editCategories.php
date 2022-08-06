<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$brandName = $_POST['editCategoriesName'];
  $brandStatus = $_POST['editCategoriesStatus']; 
  $categoriesId = $_POST['editCategoriesId'];

	$sql = "UPDATE categories SET categories_name = '$brandName', categories_active = '$brandStatus' WHERE categories_id = '$categoriesId'";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "La catégorie a été mise à jour";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Il y a eu une erreur";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} 