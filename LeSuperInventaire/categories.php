<?php require_once 'includes/header.php'; ?>


<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Tableau de bord</a></li>		  
		  <li class="active">Catégorie</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Gestionnaire des catégories</div>
			</div> 
			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-success button1" data-toggle="modal" id="addCategoriesModalBtn" data-target="#addCategoriesModal"> <i class="glyphicon glyphicon-plus-sign"></i> Ajouter une catégorie </button>
				</div> 			
				
				<table class="table table-hover table-striped table-bordered" id="manageCategoriesTable">
					<thead>
						<tr>							
							<th>Nom</th>
							<th>Statut</th>
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
				</table>
				

			</div> 
		</div> 		
	</div> 
</div> 



<div class="modal fade" id="addCategoriesModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

    	<form class="form-horizontal" id="submitCategoriesForm" action="php_action/createCategories.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Fermer"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Ajouter catégorie</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="add-categories-messages"></div>

	        <div class="form-group">
	        	<label for="categoriesName" class="col-sm-4 control-label">Nom de la catégorie: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-7">
				      <input type="text" class="form-control" id="categoriesName" placeholder="Nom de la catégorie" name="categoriesName" autocomplete="off">
				    </div>
	        </div> 	         	        
	        <div class="form-group">
	        	<label for="categoriesStatus" class="col-sm-4 control-label">Statut: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-7">
				      <select class="form-control" id="categoriesStatus" name="categoriesStatus">
				      	<option value="">~~Selectionner~~</option>
				      	<option value="1">Disponible</option>
				      	<option value="2">Indisponible</option>
				      </select>
				    </div>
	        </div> 	         	        
	      </div> 
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Fermer</button>
	        
	        <button type="submit" class="btn btn-primary" id="createCategoriesBtn" data-loading-text="Chargement..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Confirmer</button>
	      </div> 	      
     	</form> 	     
    </div>     
  </div> 
</div> 




<div class="modal fade" id="editCategoriesModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editCategoriesForm" action="php_action/editCategories.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Fermer"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Brand</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-categories-messages"></div>

	      	<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Chargement...</span>
					</div>

		      <div class="edit-categories-result">
		      	<div class="form-group">
		        	<label for="editCategoriesName" class="col-sm-4 control-label">Nom de la catégorie: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-7">
					      <input type="text" class="form-control" id="editCategoriesName" placeholder="Nom de la catégorie" name="editCategoriesName" autocomplete="off">
					    </div>
		        </div> 	         	        
		        <div class="form-group">
		        	<label for="editCategoriesStatus" class="col-sm-4 control-label">Statut: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-7">
					      <select class="form-control" id="editCategoriesStatus" name="editCategoriesStatus">
					      	<option value="">~~Selectionner~~</option>
					      	<option value="1">Disponible</option>
					      	<option value="2">Indisponible</option>
					      </select>
					    </div>
		        </div> 	 
		      </div>         	        
		      

	      </div> 
	      
	      <div class="modal-footer editCategoriesFooter">
	        <button type="button" class="btn btn-success" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Fermer</button>
	        
	        <button type="submit" class="btn btn-success" id="editCategoriesBtn" data-loading-text="Chargement..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Confirmer</button>
	      </div>
	      
     	</form>
	     
    </div>
    
  </div>
  
</div>



<div class="modal fade" tabindex="-1" role="dialog" id="removeCategoriesModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Supprimer</h4>
      </div>
      <div class="modal-body">
        <p>Voulez vous vraiment supprimer cette catégorie ?</p>
      </div>
      <div class="modal-footer removeCategoriesFooter">
        <button type="button" class="btn btn-success" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Fermer</button>
        <button type="button" class="btn btn-primary" id="removeCategoriesBtn" data-loading-text="Chargement..."> <i class="glyphicon glyphicon-ok-sign"></i> Confirmer</button>
      </div>
    </div>
  </div>
</div>



<script src="custom/js/categories.js"></script>

<?php require_once 'includes/footer.php'; ?>