<?php 
require_once 'php_action/db_connect.php'; 
require_once 'includes/header.php'; 

if($_GET['o'] == 'add') { 

	echo "<div class='div-request div-hide'>add</div>";
} else if($_GET['o'] == 'manord') { 
	echo "<div class='div-request div-hide'>manord</div>";
} else if($_GET['o'] == 'editOrd') { 
	echo "<div class='div-request div-hide'>editOrd</div>";
} 


?>

<ol class="breadcrumb">
  <li><a href="dashboard.php">Tableau de bord</a></li>
  <li>Commande</li>
  <li class="active">
  	<?php if($_GET['o'] == 'add') { ?>
  		Ajouter une commande
		<?php } else if($_GET['o'] == 'manord') { ?>
			Gérer mes commandes
		<?php }   ?>
  </li>
</ol>


<h4>
	<i class='glyphicon glyphicon-circle-arrow-right'></i>
	<?php if($_GET['o'] == 'add') {
		echo "Ajouter une commmande";
	} else if($_GET['o'] == 'manord') { 
		echo "Gérer une commande";
	} else if($_GET['o'] == 'editOrd') { 
		echo "Modifier une commande";
	}
	?>	
</h4>



<div class="panel panel-default">
	<div class="panel-heading">

		<?php if($_GET['o'] == 'add') { ?>
  		<i class="glyphicon glyphicon-plus-sign"></i>	Information sur la commande
		<?php } else if($_GET['o'] == 'manord') { ?>
			<i class="glyphicon glyphicon-edit"></i> Gestionnaire des commandes
		<?php } else if($_GET['o'] == 'editOrd') { ?>
			<i class="glyphicon glyphicon-edit"></i> Modifier une commande
		<?php } ?>

	</div> 	
	<div class="panel-body">
			
		<?php if($_GET['o'] == 'add') { 
			
			?>			

			<div class="success-messages"></div> 

  		<form class="form-horizontal" method="POST" action="php_action/createOrder.php" id="createOrderForm">

			  <div class="form-group">
			    <label for="orderDate" class="col-sm-2 control-label">Date de la commande</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="orderDate" name="orderDate" autocomplete="off" />
			    </div>
			  </div> 
			  <div class="form-group">
			    <label for="clientName" class="col-sm-2 control-label">Nom du client</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="clientName" name="clientName" placeholder="Nom du client" autocomplete="off" />
			    </div>
			  </div> 
			  <div class="form-group">
			    <label for="clientContact" class="col-sm-2 control-label">Téléphone du client</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="clientContact" name="clientContact" placeholder="Numéro de téléphone" autocomplete="off" />
			    </div>
			  </div> 			  

			  <table class="table" id="productTable">
			  	<thead>
			  		<tr>			  			
			  			<th style="width:40%;">Produit</th>
			  			<th style="width:20%;">Prix</th>
			  			<th style="width:10%;">Quantité disponible</th>
			  			<th style="width:16%;">Quantité<br><small>("Entrée" pour actualiser)</small></th>			  			
			  			<th style="width:25%;">Total</th>			  			
			  			<th style="width:10%;"></th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php
			  		$arrayNumber = 0;
			  		for($x = 1; $x < 2; $x++) { ?>
			  			<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">			  				
			  				<td style="margin-left:20px;">
			  					<div class="form-group">

			  					<select class="form-control" name="productName[]" id="productName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)" >
			  						<option value="">~~Selectionner~~</option>
			  						<?php
			  							$productSql = "SELECT * FROM product WHERE active = 1 AND status = 1 AND quantity != 0";
			  							$productData = $connect->query($productSql);

			  							while($row = $productData->fetch_array()) {									 		
			  								echo "<option value='".$row['product_id']."' id='changeProduct".$row['product_id']."'>".$row['product_name']."</option>";
										 	}  

			  						?>
		  						</select>
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="rate[]" id="rate<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" />			  					
			  					<input type="hidden" name="rateValue[]" id="rateValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
			  				</td>
							<td style="padding-left:20px;">
			  					<div class="form-group">
									<p id="available_quantity<?php echo $x; ?>"></p>
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">
			  					<div class="form-group">
			  					<input type="number" name="quantity[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" />
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" />			  					
			  					<input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
			  				</td>
			  				<td>

			  					<button class="btn btn-danger removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
			  				</td>
			  			</tr>
		  			<?php
		  			$arrayNumber++;
			  		} 
			  		?>
			  	</tbody>			  	
			  </table>

			  <div class="col-md-6">
			  	<div class="form-group">
				    <label for="subTotal" class="col-sm-3 control-label">Montant HT</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true" />
				      <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" />
				    </div>
				  </div> 			  
				   			  
				  <div class="form-group">
				    <label for="totalAmount" class="col-sm-3 control-label">Montant avec taxes</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true"/>
				      <input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue" />
				    </div>
				  </div> 			  
				  <div class="form-group">
				    <label for="discount" class="col-sm-3 control-label">Réduction</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="discount" name="discount" onkeyup="discountFunc()" autocomplete="off" />
				    </div>
				  </div> 	
				  <div class="form-group">
				    <label for="grandTotal" class="col-sm-3 control-label">Montant total</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="grandTotal" name="grandTotal" disabled="true" />
				      <input type="hidden" class="form-control" id="grandTotalValue" name="grandTotalValue" />
				    </div>
				  </div> 	
				  <div class="form-group">
				    <label for="vat" class="col-sm-3 control-label gst">TVA 18%</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="vat" name="gstn" readonly="true" />
				      <input type="hidden" class="form-control" id="vatValue" name="vatValue" />
				    </div>
				  </div>	  		  
			  </div> 

			  <div class="col-md-6">
			  	<div class="form-group">
				    <label for="paid" class="col-sm-3 control-label">Montant payé</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="paid" name="paid" autocomplete="off" onkeyup="paidAmount()" />
				    </div>
				  </div> 			  
				  <div class="form-group">
				    <label for="due" class="col-sm-3 control-label">Montant a payé</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="due" name="due" disabled="true" />
				      <input type="hidden" class="form-control" id="dueValue" name="dueValue" />
				    </div>
				  </div> 		
				  <div class="form-group">
				    <label for="clientContact" class="col-sm-3 control-label">Type de paiement</label>
				    <div class="col-sm-9">
				      <select class="form-control" name="paymentType" id="paymentType">
				      	<option value="">~~Selectionner~~</option>
				      	<option value="1">Chèque</option>
				      	<option value="2">Liquide</option>
				      	<option value="3">Carte de credit</option>
				      </select>
				    </div>
				  </div> 							  
				  <div class="form-group">
				    <label for="clientContact" class="col-sm-3 control-label">Statut du paiement</label>
				    <div class="col-sm-9">
				      <select class="form-control" name="paymentStatus" id="paymentStatus">
				      	<option value="">~~Selectionner~~</option>
				      	<option value="1">Payé totalement</option>
				      	<option value="2">Payé en plusieurs fois</option>
				      	<option value="3">Pas de paiement</option>
				      </select>
				    </div>
				  </div> 
				  <div class="form-group">
				    <label for="clientContact" class="col-sm-3 control-label">Endroit de la transaction</label>
				    <div class="col-sm-9">
				      <select class="form-control" name="paymentPlace" id="paymentPlace">
				      	<option value="">~~Selectionner~~</option>
				      	<option value="1">National</option>
				      	<option value="2">International</option>
				      </select>
				    </div>
				  </div> 							  
			  </div> 


			  <div class="form-group submitButtonFooter">
			    <div class="col-sm-offset-2 col-sm-10">
			    <button type="button" class="btn btn-success" onclick="addRow()" id="addRowBtn" data-loading-text="Chargement..."> <i class="glyphicon glyphicon-plus-sign"></i> Ajouter un produit </button>

			      <button type="submit" id="createOrderBtn" data-loading-text="Chargement..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Sauvegarder</button>

			      <button type="reset" class="btn btn-danger" onclick="resetOrderForm()"><i class="glyphicon glyphicon-erase"></i> Effacer</button>
			    </div>
			  </div>
			</form>
		<?php } else if($_GET['o'] == 'manord') { 
			
			?>

			<div id="success-messages"></div>
			
			<table class="table table-hover table-striped table-bordered" id="manageOrderTable">
				<thead>
					<tr>
						<th>#</th>
						<th>Date de la commande</th>
						<th>Client</th>
						<th>Contact</th>
						<th>Nombre de produits commandés</th>
						<th>Statut du paiement</th>
						<th>Options</th>
					</tr>
				</thead>
			</table>

		<?php 
		
		} else if($_GET['o'] == 'editOrd') {
			
			?>
			
			<div class="success-messages"></div> 

  		<form class="form-horizontal" method="POST" action="php_action/editOrder.php" id="editOrderForm">

  			<?php $orderId = $_GET['i'];

  			$sql = "SELECT orders.order_id, orders.order_date, orders.client_name, orders.client_contact, orders.sub_total, orders.vat, orders.total_amount, orders.discount, orders.grand_total, orders.paid, orders.due, orders.payment_type, orders.payment_status,orders.payment_place,orders.gstn FROM orders 	
					WHERE orders.order_id = {$orderId}";

				$result = $connect->query($sql);
				$data = $result->fetch_row();
  			?>

			  <div class="form-group">
			    <label for="orderDate" class="col-sm-2 control-label">Date de la commande</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="orderDate" name="orderDate" autocomplete="off" value="<?php echo $data[1] ?>" />
			    </div>
			  </div> 
			  <div class="form-group">
			    <label for="clientName" class="col-sm-2 control-label">Nom du client</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="clientName" name="clientName" placeholder="Nom du client" autocomplete="off" value="<?php echo $data[2] ?>" />
			    </div>
			  </div> 
			  <div class="form-group">
			    <label for="clientContact" class="col-sm-2 control-label">Numéro du client</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="clientContact" name="clientContact" placeholder="Numéro du client" autocomplete="off" value="<?php echo $data[3] ?>" />
			    </div>
			  </div> 			  

			  <table class="table" id="productTable">
			  	<thead>
			  		<tr>			  			
			  			<th style="width:40%;">Produit</th>
			  			<th style="width:20%;">Prix</th>
			  			<th style="width:15%;">Quantité disponible</th>			  			
			  			<th style="width:15%;">Quantité</th>			  			
			  			<th style="width:15%;">Total</th>			  			
			  			<th style="width:10%;"></th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php

			  		$orderItemSql = "SELECT order_item.order_item_id, order_item.order_id, order_item.product_id, order_item.quantity, order_item.rate, order_item.total FROM order_item WHERE order_item.order_id = {$orderId}";
						$orderItemResult = $connect->query($orderItemSql);
												
						
						
			  		$arrayNumber = 0;
			  		
			  		$x = 1;
			  		while($orderItemData = $orderItemResult->fetch_array()) { 
			  			 ?>
			  			<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">			  				
			  				<td style="margin-left:20px;">
			  					<div class="form-group">

			  					<select class="form-control" name="productName[]" id="productName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)" >
			  						<option value="">~~Selectionner~~</option>
			  						<?php
			  							$productSql = "SELECT * FROM product WHERE active = 1 AND status = 1 AND quantity != 0";
			  							$productData = $connect->query($productSql);

			  							while($row = $productData->fetch_array()) {									 		
			  								$selected = "";
			  								if($row['product_id'] == $orderItemData['product_id']) {
			  									$selected = "selected";
			  								} else {
			  									$selected = "";
			  								}

			  								echo "<option value='".$row['product_id']."' id='changeProduct".$row['product_id']."' ".$selected." >".$row['product_name']."</option>";
										 	}  

			  						?>
		  						</select>
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="rate[]" id="rate<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" value="<?php echo $orderItemData['rate']; ?>" />			  					
			  					<input type="hidden" name="rateValue[]" id="rateValue<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $orderItemData['rate']; ?>" />			  					
			  				</td>
							<td style="padding-left:20px;">
			  					<div class="form-group">
									<?php
			  							$productSql = "SELECT * FROM product WHERE active = 1 AND status = 1 AND quantity != 0";
			  							$productData = $connect->query($productSql);

			  							while($row = $productData->fetch_array()) {									 		
			  								$selected = "";
			  								if($row['product_id'] == $orderItemData['product_id']) { 
			  									echo "<p id='available_quantity".$row['product_id']."'>".$row['quantity']."</p>";
											}
			  								 else {
			  									$selected = "";
			  								}

			  								
										 	}  

			  						?>
									
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">
			  					<div class="form-group">
			  					<input type="number" name="quantity[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" value="<?php echo $orderItemData['quantity']; ?>" />
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" value="<?php echo $orderItemData['total']; ?>"/>			  					
			  					<input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $orderItemData['total']; ?>"/>			  					
			  				</td>
			  				<td>

			  					<button class="btn btn-danger removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
			  				</td>
			  			</tr>
		  			<?php
		  			$arrayNumber++;
		  			$x++;
			  		} 
			  		?>
			  	</tbody>			  	
			  </table>

			  <div class="col-md-6">
			  	<div class="form-group">
				    <label for="subTotal" class="col-sm-3 control-label">Montant HT</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true" value="<?php echo $data[4] ?>" />
				      <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" value="<?php echo $data[4] ?>" />
				    </div>
				  </div> 			  
				  			  
				  <div class="form-group">
				    <label for="totalAmount" class="col-sm-3 control-label">Montant avec taxes</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true" value="<?php echo $data[6] ?>" />
				      <input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue" value="<?php echo $data[6] ?>"  />
				    </div>
				  </div> 			  
				  <div class="form-group">
				    <label for="discount" class="col-sm-3 control-label">Réduction</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="discount" name="discount" onkeyup="discountFunc()" autocomplete="off" value="<?php echo $data[7] ?>" />
				    </div>
				  </div> 	
				  <div class="form-group">
				    <label for="grandTotal" class="col-sm-3 control-label">Montant total</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="grandTotal" name="grandTotal" disabled="true" value="<?php echo $data[8] ?>"  />
				      <input type="hidden" class="form-control" id="grandTotalValue" name="grandTotalValue" value="<?php echo $data[8] ?>"  />
				    </div>
				  </div> 	
				  <div class="form-group">
				    <label for="vat" class="col-sm-3 control-label gst"><?php if($data[13] == 2) {echo "IGST 18%";} else echo "GST 18%"; ?></label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="vat" name="vat" disabled="true" value="<?php echo $data[5] ?>"  />
				      <input type="hidden" class="form-control" id="vatValue" name="vatValue" value="<?php echo $data[5] ?>"  />
				    </div>
				  </div> 
				  <div class="form-group">
				  </div>		  		  
			  </div> 

			  <div class="col-md-6">
			  	<div class="form-group">
				    <label for="paid" class="col-sm-3 control-label">Montant payé</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="paid" name="paid" autocomplete="off" onkeyup="paidAmount()" value="<?php echo $data[9] ?>"  />
				    </div>
				  </div> 			  
				  <div class="form-group">
				    <label for="due" class="col-sm-3 control-label">Montant a payé</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="due" name="due" disabled="true" value="<?php echo $data[10] ?>"  />
				      <input type="hidden" class="form-control" id="dueValue" name="dueValue" value="<?php echo $data[10] ?>"  />
				    </div>
				  </div> 		
				  <div class="form-group">
				    <label for="clientContact" class="col-sm-3 control-label">Type de paiement</label>
				    <div class="col-sm-9">
				      <select class="form-control" name="paymentType" id="paymentType" >
				      	<option value="">~~Selectionner~~</option>
				      	<option value="1" <?php if($data[11] == 1) {
				      		echo "selected";
				      	} ?> >Chèque</option>
				      	<option value="2" <?php if($data[11] == 2) {
				      		echo "selected";
				      	} ?>  >Liquide</option>
				      	<option value="3" <?php if($data[11] == 3) {
				      		echo "selected";
				      	} ?> >Carte de crédit</option>
				      </select>
				    </div>
				  </div> 							  
				  <div class="form-group">
				    <label for="clientContact" class="col-sm-3 control-label">Statut du paiement</label>
				    <div class="col-sm-9">
				      <select class="form-control" name="paymentStatus" id="paymentStatus">
				      	<option value="">~~Selectionner~~</option>
				      	<option value="1" <?php if($data[12] == 1) {
				      		echo "selected";
				      	} ?>  >Payé totalement</option>
				      	<option value="2" <?php if($data[12] == 2) {
				      		echo "selected";
				      	} ?> >Payé en plusieurs fois</option>
				      	<option value="3" <?php if($data[10] == 3) {
				      		echo "selected";
				      	} ?> >Pas de paiement</option>
				      </select>
				    </div>
				  </div> 
				  <div class="form-group">
				    <label for="clientContact" class="col-sm-3 control-label">Endroit de la transaction</label>
				    <div class="col-sm-9">
				      <select class="form-control" name="paymentPlace" id="paymentPlace">
				      	<option value="">~~Selectionner~~</option>
				      	<option value="1" <?php if($data[13] == 1) {
				      		echo "selected";
				      	} ?>  >National</option>
				      	<option value="2" <?php if($data[13] == 2) {
				      		echo "selected";
				      	} ?> >International</option>
				      </select>
				    </div>
				  </div>							  
			  </div> 


			  <div class="form-group editButtonFooter">
			    <div class="col-sm-offset-2 col-sm-10">
			    <button type="button" class="btn btn-success" onclick="addRow()" id="addRowBtn" data-loading-text="Chargement..."> <i class="glyphicon glyphicon-plus-sign"></i> Ajouter un produit </button>

			    <input type="hidden" name="orderId" id="orderId" value="<?php echo $_GET['i']; ?>" />

			    <button type="submit" id="editOrderBtn" data-loading-text="Chargement..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Sauvegarder</button>
			      
			    </div>
			  </div>
			</form>

			<?php
		}   ?>


	</div> 	
</div> 	



<div class="modal fade" tabindex="-1" role="dialog" id="paymentOrderModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-edit"></i> Modifier le paiement</h4>
      </div>      

      <div class="modal-body form-horizontal" style="max-height:500px; overflow:auto;" >

      	<div class="paymentOrderMessages"></div>

      	     				 				 
			  <div class="form-group">
			    <label for="due" class="col-sm-3 control-label">Montant a payé</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control" id="due" name="due" disabled="true" />					
			    </div>
			  </div> 		
			  <div class="form-group">
			    <label for="payAmount" class="col-sm-3 control-label">Montant payé</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control" id="payAmount" name="payAmount"/>					      
			    </div>
			  </div> 		
			  <div class="form-group">
			    <label for="clientContact" class="col-sm-3 control-label">Type de paiement</label>
			    <div class="col-sm-9">
			      <select class="form-control" name="paymentType" id="paymentType" >
			      	<option value="">~~Selectionner~~</option>
			      	<option value="1">Chèque</option>
			      	<option value="2">Liquide</option>
			      	<option value="3">Carte de crédit</option>
			      </select>
			    </div>
			  </div> 							  
			  <div class="form-group">
			    <label for="clientContact" class="col-sm-3 control-label">Statut du paiement</label>
			    <div class="col-sm-9">
			      <select class="form-control" name="paymentStatus" id="paymentStatus">
			      	<option value="">~~Selectionner~~</option>
			      	<option value="1">Payé totalement</option>
			      	<option value="2">Payé en plusieurs fois</option>
			      	<option value="3">Pas de paiement</option>
			      </select>
			    </div>
			  </div> 							  				  
      	        
      </div> 
      <div class="modal-footer">
      	<button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Fermer</button>
        <button type="button" class="btn btn-primary" id="updatePaymentOrderBtn" data-loading-text="Chargement..."> <i class="glyphicon glyphicon-ok-sign"></i> Sauvegarder</button>	
      </div>           
    </div>
  </div>
</div>



<div class="modal fade" tabindex="-1" role="dialog" id="removeOrderModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Supprimer la commande</h4>
      </div>
      <div class="modal-body">

      	<div class="removeOrderMessages"></div>

        <p>Voulez vous vraiment supprimer cette commande ?</p>
      </div>
      <div class="modal-footer removeProductFooter">
        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Fermer</button>
        <button type="button" class="btn btn-primary" id="removeOrderBtn" data-loading-text="Chargement..."> <i class="glyphicon glyphicon-ok-sign"></i> Sauvegarder</button>
      </div>
    </div>
  </div>
</div>



<script src="custom/js/order.js"></script>

<?php require_once 'includes/footer.php'; ?>


	