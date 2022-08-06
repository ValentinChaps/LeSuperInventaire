<?php 	

require_once 'core.php';

$sql = "SELECT brand_id, brand_name, brand_active, brand_status FROM brands WHERE brand_status = 1";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 
 $activeBrands = ""; 

 while($row = $result->fetch_array()) {
 	$brandId = $row[0];
 	
 	if($row[2] == 1) {
 		
 		$activeBrands = "<label class='label label-success'>Disponible</label>";
 	} else {
 		
 		$activeBrands = "<label class='label label-danger'>Indisponible</label>";
 	}

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editBrandModel" onclick="editBrands('.$brandId.')"> <i class="glyphicon glyphicon-edit"></i> Modifier</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeBrands('.$brandId.')"> <i class="glyphicon glyphicon-trash"></i> Supprimer</a></li>       
	  </ul>
	</div>';

 	$output['data'][] = array( 		
 		$row[1], 		
 		$activeBrands,
 		$button
 		); 	
 }  

}

$connect->close();

echo json_encode($output);