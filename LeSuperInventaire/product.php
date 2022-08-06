<?php require_once 'php_action/db_connect.php' ?>
<?php require_once 'includes/header.php'; ?>

<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Tableau de bord</a></li>		  
		  <li class="active">Produit</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Gestionnaire des produits</div>
			</div> 
			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-success button1" data-toggle="modal" id="addProductModalBtn" data-target="#addProductModal"> <i class="glyphicon glyphicon-plus-sign"></i> Ajouter un produit </button>
				</div> 			
				
				<table class="table table-hover table-striped table-bordered" id="manageProductTable">
					<thead>
						<tr>
							<th style="width:10%;">Photo</th>							
							<th>Nom du produit</th>
							<th>Prix</th>							
							<th>Quantité</th>
							<th>Marque</th>
							<th>Categorie</th>
							<th>Statut</th>
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
				</table>
				

			</div> 
		</div> 		
	</div> 
</div> 



<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

    	<form class="form-horizontal" id="submitProductForm" action="php_action/createProduct.php" method="POST" enctype="multipart/form-data">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Ajouter produit</h4>
	      </div>

	      <div class="modal-body" style="max-height:450px; overflow:auto;">

	      	<div id="add-product-messages"></div>

	      	<div class="form-group">
	        	<label for="productImage" class="col-sm-3 control-label">Image du produit: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
					    
							<div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>							
					    <div class="kv-avatar center-block">					        
					        <input type="file" class="form-control" id="productImage" placeholder="Nom du produit" name="productImage" class="file-loading" style="width:auto;"/>
					    </div>
				      
				    </div>
	        </div> 	     	           	       

	        <div class="form-group">
	        	<label for="productName" class="col-sm-3 control-label">Nom du produit: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="productName" placeholder="Nom du produit" name="productName" autocomplete="off">
				    </div>
	        </div> 	    

	        <div class="form-group">
	        	<label for="quantity" class="col-sm-3 control-label">Quantité: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="quantity" placeholder="Quantité" name="quantity" autocomplete="off">
				    </div>
	        </div> 	        	 

	        <div class="form-group">
	        	<label for="rate" class="col-sm-3 control-label">Prix: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="rate" placeholder="Prix" name="rate" autocomplete="off">
				    </div>
	        </div> 	     	        

	        <div class="form-group">
	        	<label for="brandName" class="col-sm-3 control-label">Nom du produit: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select class="form-control" id="brandName" name="brandName">
				      	<option value="">~~Selectionner~~</option>
				      	<?php 
				      	$sql = "SELECT brand_id, brand_name, brand_active, brand_status FROM brands WHERE brand_status = 1 AND brand_active = 1";
								$result = $connect->query($sql);

								while($row = $result->fetch_array()) {
									echo "<option value='".$row[0]."'>".$row[1]."</option>";
								} 
								
				      	?>
				      </select>
				    </div>
	        </div> 	

	        <div class="form-group">
	        	<label for="categoryName" class="col-sm-3 control-label">Nom de la catégorie: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select type="text" class="form-control" id="categoryName" placeholder="Nom du produit" name="categoryName" >
				      	<option value="">~~Selectionner~~</option>
				      	<?php 
				      	$sql = "SELECT categories_id, categories_name, categories_active, categories_status FROM categories WHERE categories_status = 1 AND categories_active = 1";
								$result = $connect->query($sql);

								while($row = $result->fetch_array()) {
									echo "<option value='".$row[0]."'>".$row[1]."</option>";
								} 
								
				      	?>
				      </select>
				    </div>
	        </div> 					        	         	       

	        <div class="form-group">
	        	<label for="productStatus" class="col-sm-3 control-label">Status: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select class="form-control" id="productStatus" name="productStatus">
				      	<option value="">~~Selectionner~~</option>
				      	<option value="1">Disponible</option>
				      	<option value="2">Indisponible</option>
				      </select>
				    </div>
	        </div> 	         	        
	      </div> 
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Fermer</button>
	        
	        <button type="submit" class="btn btn-primary" id="createProductBtn" data-loading-text="Chargement..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Confirmer</button>
	      </div> 	      
     	</form> 	     
    </div>     
  </div> 
</div> 




<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	    	
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Modifier le produit</h4>
	      </div>
	      <div class="modal-body" style="max-height:450px; overflow:auto;">

	      	<div class="div-loading">
	      		<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Chargement...</span>
	      	</div>

	      	<div class="div-result">

				  
				  <ul class="nav nav-tabs" role="tablist">
				    <li role="presentation" class="active"><a href="#photo" aria-controls="home" role="tab" data-toggle="tab">Photo</a></li>
				    <li role="presentation"><a href="#productInfo" aria-controls="profile" role="tab" data-toggle="tab">Info sur le produit</a></li>    
				  </ul>

				  
				  <div class="tab-content">

				  	
				    <div role="tabpanel" class="tab-pane active" id="photo">
				    	<form action="php_action/editProductImage.php" method="POST" id="updateProductImageForm" class="form-horizontal" enctype="multipart/form-data">

				    	<br />
				    	<div id="edit-productPhoto-messages"></div>

				    	<div class="form-group">
			        	<label for="editProductImage" class="col-sm-3 control-label">Image du produit: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">							    				   
						      <img src="" id="getProductImage" class="thumbnail" style="width:250px; height:250px;" />
						    </div>
			        </div> 	     	           	       
				    	
			      	<div class="form-group">
			        	<label for="editProductImage" class="col-sm-3 control-label">Selectionner une photo: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
							    
									<div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>							
							    <div class="kv-avatar center-block">					        
							        <input type="file" class="form-control" id="editProductImage" placeholder="Nom du produit" name="editProductImage" class="file-loading" style="width:auto;"/>
							    </div>
						      
						    </div>
			        </div> 	     	           	       

			        <div class="modal-footer editProductPhotoFooter">
				        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Fermer</button>
				        
				        
				      </div>
				      
				      </form>
				      
				    </div>
				    
				    <div role="tabpanel" class="tab-pane" id="productInfo">
				    	<form class="form-horizontal" id="editProductForm" action="php_action/editProduct.php" method="POST">				    
				    	<br />

				    	<div id="edit-product-messages"></div>

				    	<div class="form-group">
			        	<label for="editProductName" class="col-sm-3 control-label">Nom du produit: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editProductName" placeholder="Nom du produit" name="editProductName" autocomplete="off">
						    </div>
			        </div> 	    

			        <div class="form-group">
			        	<label for="editQuantity" class="col-sm-3 control-label">Quantité: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editQuantity" placeholder="Quantité" name="editQuantity" autocomplete="off">
						    </div>
			        </div> 	        	 

			        <div class="form-group">
			        	<label for="editRate" class="col-sm-3 control-label">Prix: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editRate" placeholder="Prix" name="editRate" autocomplete="off">
						    </div>
			        </div> 	     	        

			        <div class="form-group">
			        	<label for="editBrandName" class="col-sm-3 control-label">Nom de la marque: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <select class="form-control" id="editBrandName" name="editBrandName">
						      	<option value="">~~Selectionner~~</option>
						      	<?php 
						      	$sql = "SELECT brand_id, brand_name, brand_active, brand_status FROM brands WHERE brand_status = 1 AND brand_active = 1";
										$result = $connect->query($sql);

										while($row = $result->fetch_array()) {
											echo "<option value='".$row[0]."'>".$row[1]."</option>";
										} 
										
						      	?>
						      </select>
						    </div>
			        </div> 	

			        <div class="form-group">
			        	<label for="editCategoryName" class="col-sm-3 control-label">Nom de la catégorie: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <select type="text" class="form-control" id="editCategoryName" name="editCategoryName" >
						      	<option value="">~~Selectionner~~</option>
						      	<?php 
						      	$sql = "SELECT categories_id, categories_name, categories_active, categories_status FROM categories WHERE categories_status = 1 AND categories_active = 1";
										$result = $connect->query($sql);

										while($row = $result->fetch_array()) {
											echo "<option value='".$row[0]."'>".$row[1]."</option>";
										} 
										
						      	?>
						      </select>
						    </div>
			        </div> 					        	         	       

			        <div class="form-group">
			        	<label for="editProductStatus" class="col-sm-3 control-label">Statut: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <select class="form-control" id="editProductStatus" name="editProductStatus">
						      	<option value="">~~Selectionner~~</option>
						      	<option value="1">Disponible</option>
						      	<option value="2">Indisponible</option>
						      </select>
						    </div>
			        </div> 	         	        

			        <div class="modal-footer editProductFooter">
				        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Fermer</button>
				        
				        <button type="submit" class="btn btn-success" id="editProductBtn" data-loading-text="Chargement..."> <i class="glyphicon glyphicon-ok-sign"></i> Confirmer</button>
				      </div> 				     
			        </form> 				     	
				    </div>    
				    
				  </div>

				</div>
	      	
	      </div> 
	      	      
     	
    </div>
    
  </div>
  
</div>



<div class="modal fade" tabindex="-1" role="dialog" id="removeProductModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Fermer"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Supprimer le produit</h4>
      </div>
      <div class="modal-body">

      	<div class="removeProductMessages"></div>

        <p>Voulez vous vraiment supprimer ce produit ?</p>
      </div>
      <div class="modal-footer removeProductFooter">
        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Fermer</button>
        <button type="button" class="btn btn-primary" id="removeProductBtn" data-loading-text="Chargement..."> <i class="glyphicon glyphicon-ok-sign"></i> Confirmer</button>
      </div>
    </div>
  </div>
</div>



<script src="custom/js/product.js"></script>

<?php require_once 'includes/footer.php'; ?>