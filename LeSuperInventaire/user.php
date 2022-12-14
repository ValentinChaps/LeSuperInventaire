<?php require_once 'php_action/db_connect.php' ?>
<?php require_once 'includes/header.php'; ?>

<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Tableau de bord</a></li>		  
		  <li class="active">Gérer les utilisateurs</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Gestionnaire des utilisateurs</div>
			</div> 
			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-success button1" data-toggle="modal" id="addUserModalBtn" data-target="#addUserModal"> <i class="glyphicon glyphicon-plus-sign"></i> Ajouter une utilisateur </button>
				</div> 			
				
				<table class="table table-hover table-striped table-bordered" id="manageUserTable">
					<thead>
						<tr>
							<th style="width:10%;">Nom d'utilisateur</th>
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
				</table>
				

			</div> 
		</div> 		
	</div> 
</div> 



<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

    	<form class="form-horizontal" id="submitUserForm" action="php_action/createUser.php" method="POST" enctype="multipart/form-data">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Ajouter un utilisateur</h4>
	      </div>

	      <div class="modal-body" style="max-height:450px; overflow:auto;">

	      	<div id="add-user-messages"></div>

	      		     	           	       

	        <div class="form-group">
	        	<label for="userName" class="col-sm-3 control-label">Nom d'utilisateur: </label>
	        	
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="userName" placeholder="Nom d'utilisateur" name="userName" autocomplete="off">
				    </div>
	        </div> 	    

	        <div class="form-group">
	        	<label for="upassword" class="col-sm-3 control-label">Mot de passe: </label>
	        	
				    <div class="col-sm-8">
				      <input type="password" class="form-control" id="upassword" placeholder="Mot de passe" name="upassword" autocomplete="off">
				    </div>
	        </div> 	        	 

	        <div class="form-group">
	        	<label for="uemail" class="col-sm-3 control-label">Email: </label>
	        	
				    <div class="col-sm-8">
				      <input type="email" class="form-control" id="uemail" placeholder="Email" name="uemail" autocomplete="off">
				    </div>
	        </div> 	 
	        	         	        
	      </div> 
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Fermer</button>
	        
	        <button type="submit" class="btn btn-primary" id="createUserBtn" data-loading-text="Chargement..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Sauvegarder</button>
	      </div> 	      
     	</form> 	     
    </div>     
  </div> 
</div> 




<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	    	
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Fermer"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Modifier l'utilisateur</h4>
	      </div>
	      <div class="modal-body" style="max-height:450px; overflow:auto;">

	      	<div class="div-loading">
	      		<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Chargement...</span>
	      	</div>

	      	<div class="div-result">

				  
				  <ul class="nav nav-tabs" role="tablist">
				    <li role="presentation" class="active"><a href="#userInfo" aria-controls="profile" role="tab" data-toggle="tab">Informations sur l'utilisateur</a></li>    
				  </ul>

				  
				  <div class="tab-content">

				  	
				    
				    
				    <div role="tabpanel" class="tab-pane active" id="userInfo">
				    	<form class="form-horizontal" id="editUserForm" action="php_action/editUser.php" method="POST">				    
				    	<br />

				    	<div id="edit-user-messages"></div>

				    	<div class="form-group">
			        		<label for="edituserName" class="col-sm-3 control-label">Nom d'utilisateur: </label>
			        	
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="edituserName" placeholder="Nom d'utilisateur" name="edituserName" autocomplete="off">
						    </div>
			        	</div> 	    

				        <div class="form-group">
				        	<label for="editPassword" class="col-sm-3 control-label">Mot de passe: </label>
				        	
							    <div class="col-sm-8">
							      <input type="password" class="form-control" id="editPassword" placeholder="Mot de passe" name="editPassword" autocomplete="off">
							    </div>
				        </div> 	        	 

			         
         	        

			        <div class="modal-footer editUserFooter">
				        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Fermer</button>
				        
				        <button type="submit" class="btn btn-success" id="editProductBtn" data-loading-text="Chargement..."> <i class="glyphicon glyphicon-ok-sign"></i> Sauvegarder</button>
				      </div> 				     
			        </form> 				     	
				    </div>    
				    
				  </div>

				</div>
	      	
	      </div> 
	      	      
     	
    </div>
    
  </div>
  
</div>



<div class="modal fade" tabindex="-1" role="dialog" id="removeUserModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Supprimer l'utilisateur</h4>
      </div>
      <div class="modal-body">

      	<div class="removeUserMessages"></div>

        <p>Voulez vous supprimer l'utilisateur ?</p>
      </div>
      <div class="modal-footer removeProductFooter">
        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Fermer</button>
        <button type="button" class="btn btn-primary" id="removeProductBtn" data-loading-text="Chargement..."> <i class="glyphicon glyphicon-ok-sign"></i> Sauvegarder</button>
      </div>
    </div>
  </div>
</div>


<script src="custom/js/user.js"></script>

<?php require_once 'includes/footer.php'; ?>