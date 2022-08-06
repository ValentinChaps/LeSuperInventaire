<?php 

require_once 'core.php';

if($_POST) {

	$valid['success'] = array('success' => false, 'messages' => array());

	$currentPassword = md5($_POST['password']);
	$newPassword = md5($_POST['npassword']);
	$conformPassword = md5($_POST['cpassword']);
	$userId = $_POST['user_id'];

	$sql ="SELECT * FROM users WHERE user_id = {$userId}";
	$query = $connect->query($sql);
	$result = $query->fetch_assoc();

	if($currentPassword == $result['password']) {

		if($newPassword == $conformPassword) {

			$updateSql = "UPDATE users SET password = '$newPassword' WHERE user_id = {$userId}";
			if($connect->query($updateSql) === TRUE) {
				$valid['success'] = true;
				$valid['messages'] = "Le mot de passe a été modifié";		
			} else {
				$valid['success'] = false;
				$valid['messages'] = "Il a eu une erreur";	
			}

		} else {
			$valid['success'] = false;
			$valid['messages'] = "Les deux mots de passe ne correspondent pas";
		}

	} else {
		$valid['success'] = false;
		$valid['messages'] = "Le mot de passe actuel est incorrect";
	}

	$connect->close();

	echo json_encode($valid);

}

?>