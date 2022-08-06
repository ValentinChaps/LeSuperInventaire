<?php 	



require_once 'core.php';

$sql = "SELECT * FROM users";

$result = $connect->query($sql);

$output = array('data' => array());
if($result->num_rows > 0) { 

 
 $active = ""; 

 while($row = $result->fetch_array()) {
 	$userid = $row[0];
 	
 	$username = $row[1];

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" id="editUserModalBtn" data-target="#editUserModal" onclick="editUser('.$userid.')"> <i class="glyphicon glyphicon-edit"></i> Modifier</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeUserModal" id="removeUserModalBtn" onclick="removeUser('.$userid.')"> <i class="glyphicon glyphicon-trash"></i> Supprimer</a></li>       
	  </ul>
	</div>';

	

 	$output['data'][] = array( 		
 		
 		$username,
 		
 		$button 		
 		); 	
 }  

}

$connect->close();

echo json_encode($output);