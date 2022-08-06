<?php 
require_once 'php_action/db_connect.php';

session_start();

if(isset($_SESSION['userId'])) {
	header('location:'.$store_url.'dashboard.php');		
}

$errors = array();

if($_POST) {		

	$username = $_POST['username'];
	$password = $_POST['password'];

	if(empty($username) || empty($password)) {
		if($username == "") {
			$errors[] = "Veuillez entrer un nom d'utilisateur";
		} 

		if($password == "") {
			$errors[] = "Veuillez entrer un mot de passe";
		}
	} else {
		$sql = "SELECT * FROM users WHERE username = '$username'";
		$result = $connect->query($sql);

		if($result->num_rows == 1) {
			$password = md5($password);
			
			$mainSql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
			$mainResult = $connect->query($mainSql);

			if($mainResult->num_rows == 1) {
				$value = $mainResult->fetch_assoc();
				$user_id = $value['user_id'];

				
				$_SESSION['userId'] = $user_id;

				header('location:'.$store_url.'dashboard.php');	
			} else{
				
				$errors[] = "Le nom d'utilisateur ou le mot de passe ne sont pas correct";
			} 
		} else {		
			$errors[] = "Le nom d'utilisateur n'est pas correct";		
		} 
	} 
	
} 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Le Super Inventaire</title>
	
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap.min.css">
	
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap-theme.min.css">
	
	<link rel="stylesheet" href="assests/font-awesome/css/font-awesome.min.css">
  
  <link rel="stylesheet" href="custom/css/custom.css">	
  
	<script src="assests/jquery/jquery.min.js"></script>
    
  <link rel="stylesheet" href="assests/jquery-ui/jquery-ui.min.css">
  <script src="assests/jquery-ui/jquery-ui.min.js"></script>
  
	<script src="assests/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="row vertical">
			<div class="col-md-5 col-md-offset-4">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title text-center">Le Super Inventaire</h3>
					</div>
					<div class="panel-body">

						<div class="messages">
							<?php if($errors) {
								foreach ($errors as $key => $value) {
									echo '<div class="alert alert-warning" role="alert">
									<i class="glyphicon glyphicon-exclamation-sign"></i>
									'.$value.'</div>';										
									}
								} ?>
						</div>

						<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" id="loginForm">
							<fieldset>
							  <div class="form-group">
									<label for="username" class="col-sm-2 control-label">Utilisateur</label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" id="username" name="username" placeholder="Nom d'utilisateur" autocomplete="off" />
									</div>
								</div>
								<div class="form-group">
									<label for="password" class="col-sm-2 control-label">Mot de passe</label>
									<div class="col-sm-10">
									  <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" autocomplete="off" />
									</div>
								</div>								
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
									  <button type="submit" class="btn btn-success"> <i class="glyphicon glyphicon-log-in"></i> Se connecter</button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
					
				</div>
				
			</div>
			
		</div>
		
	</div>
		
</body>
</html>







	