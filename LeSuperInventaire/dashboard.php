<?php require_once 'includes/header.php'; ?>

<?php 

$sql = "SELECT * FROM product WHERE status = 1";
$query = $connect->query($sql);
$countProduct = $query->num_rows;

$orderSql = "SELECT * FROM orders WHERE order_status = 1";
$orderQuery = $connect->query($orderSql);
$countOrder = $orderQuery->num_rows;

$totalRevenue = "0";
while ($orderResult = $orderQuery->fetch_assoc()) {
	$totalRevenue += $orderResult['paid'];
}

$lowStockSql = "SELECT * FROM product WHERE quantity <= 3 AND status = 1";
$lowStockQuery = $connect->query($lowStockSql);
$countLowStock = $lowStockQuery->num_rows;

$userwisesql = "SELECT users.username , SUM(orders.grand_total) as totalorder FROM orders INNER JOIN users ON orders.user_id = users.user_id WHERE orders.order_status = 1 GROUP BY orders.user_id";
$userwiseQuery = $connect->query($userwisesql);
$userwieseOrder = $userwiseQuery->num_rows;

$connect->close();

?>


<div class="row">
	<?php  if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>
	<div class="col-md-4">
		<div class="panel panel-success">
			<div class="panel-heading">
				
				<a href="product.php" style="text-decoration:none;color:black;">
					Vos incroyables produits
					<span class="badge pull pull-right"><?php echo $countProduct; ?></span>	
				</a>
				
			</div>
		</div>
	</div>
	
	<div class="col-md-4">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<a href="product.php" style="text-decoration:none;color:black;">
					Produits victime de leurs succès
					<span class="badge pull pull-right"><?php echo $countLowStock; ?></span>	
				</a>
				
			</div>
		</div>
	</div>
	
	
	<?php } ?>  
		<div class="col-md-4">
			<div class="panel panel-info">
			<div class="panel-heading">
				<a href="orders.php?o=manord" style="text-decoration:none;color:black;">
					Les commandes passées
					<span class="badge pull pull-right"><?php echo $countOrder; ?></span>
				</a>
					
			</div> 
		</div> 
		</div> 

	

	<div class="col-md-4">
		<div class="card">
		  <div class="cardHeader">
		    <h1><?php echo date("d.m.Y"); ?></h1>
		  </div>

		  <div class="cardContainer">
		    <p> Date </p>
		  </div>
		</div> 
		<br/>

		<div class="card">
		  <div class="cardHeader" style="background-color:#245580;">
		    <h1><?php if($totalRevenue) {
		    	echo $totalRevenue.'€';
		    	} else {
		    		echo '0€';
		    		} ?></h1>
		  </div>

		  <div class="cardContainer">
		    <p> Revenu Total </p>
		  </div>
		</div> 

	</div>
	
	<?php  if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>
	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading"> <i class="glyphicon glyphicon-calendar"></i> Liste des commandes</div>
			<div class="panel-body">
				<table class="table table-hover table-striped table-bordered" id="productTable">
			  	<thead>
			  		<tr>			  			
			  			<th style="width:40%;">Nom</th>
			  			<th style="width:20%;">Montant des commandes (€)</th>
			  		</tr>
			  	</thead>
			  	<tbody>
					<?php while ($orderResult = $userwiseQuery->fetch_assoc()) { ?>
						<tr>
							<td><?php echo $orderResult['username']?></td>
							<td><?php echo $orderResult['totalorder']?></td>
							
						</tr>
						
					<?php } ?>
				</tbody>
				</table>
				
			</div>	
		</div>
		
	</div> 
	<?php  } ?>
	
</div>


<?php require_once 'includes/footer.php'; ?>