<?php require_once 'php_action/core.php'; ?>

<!DOCTYPE html>
<html>
<head>

	<title>Le Super Inventaire</title>
	
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap.min.css">
	
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap-theme.min.css">
	
	<link rel="stylesheet" href="assests/font-awesome/css/font-awesome.min.css">
  
  <link rel="stylesheet" href="custom/css/custom.css">
	
  <link rel="stylesheet" href="assests/plugins/datatables/jquery.dataTables.min.css">
  
  <link rel="stylesheet" href="assests/plugins/fileinput/css/fileinput.min.css">
  
	<script src="assests/jquery/jquery.min.js"></script>
    
  <link rel="stylesheet" href="assests/jquery-ui/jquery-ui.min.css">
  <script src="assests/jquery-ui/jquery-ui.min.js"></script>
  
	<script src="assests/bootstrap/js/bootstrap.min.js"></script>

</head>
<body>


	<nav class="navbar navbar-default navbar-static-top">
		<div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Barre de navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
	  <a class="navbar-brand" href="#" style="padding:0px;">
                    <img src="Logo.png" alt="">
                </a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">      

      <ul class="nav navbar-nav navbar-right">        

      	<li id="navDashboard"><a href="index.php"><i class="glyphicon glyphicon-home"></i> Tableau de bord</a></li>        
        <?php if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>
        <li id="navBrand"><a href="brand.php"><i class="glyphicon glyphicon-btc"></i> Marques</a></li>        
		<?php } ?>
		<?php if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>
        <li id="navCategories"><a href="categories.php"> <i class="glyphicon glyphicon-th-list"></i> Catégories</a></li>        
		<?php } ?>
		<?php if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>
        <li id="navProduct"><a href="product.php"> <i class="glyphicon glyphicon-ruble"></i> Produits</a></li> 
		<?php } ?>
		
        <li class="dropdown" id="navOrder">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-usd"></i> Commandes <span class="caret"></span></a>
          <ul class="dropdown-menu">            
            <li id="topNavAddOrder"><a href="orders.php?o=add"> <i class="glyphicon glyphicon-plus"></i> Ajouter une commande</a></li>            
            <li id="topNavManageOrder"><a href="orders.php?o=manord"> <i class="glyphicon glyphicon-edit"></i> Gérer mes commandes</a></li>            
          </ul>
        </li> 
		
		 
    <?php  if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>
		<?php } ?>   
        <li class="dropdown" id="navSetting">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-user"></i> <span class="caret"></span></a>
          <ul class="dropdown-menu">    
			<?php if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>
            <li id="topNavSetting"><a href="setting.php"> <i class="glyphicon glyphicon-wrench"></i> Paramètres</a></li>
            <li id="topNavUser"><a href="user.php"> <i class="glyphicon glyphicon-wrench"></i> Gérer les utilisateurs</a></li>
<?php } ?>              
            <li id="topNavLogout"><a href="logout.php"> <i class="glyphicon glyphicon-log-out"></i> Se déconnecter</a></li>            
          </ul>
        </li>        
           
      </ul>
    </div>
  </div>
	</nav>

	<div class="container">