var manageCategoriesTable;

$(document).ready(function() {
	$('#navCategories').addClass('active');	

	manageCategoriesTable = $('#manageCategoriesTable').DataTable({
		'ajax' : 'php_action/fetchCategories.php',
		'order': []
	}); 

	
	$('#addCategoriesModalBtn').unbind('click').bind('click', function() {
		
		$("#submitCategoriesForm")[0].reset();
		
		$(".text-danger").remove();
		
		$('.form-group').removeClass('has-error').removeClass('has-success');

		
		$("#submitCategoriesForm").unbind('submit').bind('submit', function() {

			var categoriesName = $("#categoriesName").val();
			var categoriesStatus = $("#categoriesStatus").val();

			if(categoriesName == "") {
				$("#categoriesName").after('<p class="text-danger">Veuillez entrer une catégorie</p>');
				$('#categoriesName').closest('.form-group').addClass('has-error');
			} else {
				
				$("#categoriesName").find('.text-danger').remove();
				
				$("#categoriesName").closest('.form-group').addClass('has-success');	  	
			}

			if(categoriesStatus == "") {
				$("#categoriesStatus").after('<p class="text-danger">Veuillez entrer un statut</p>');
				$('#categoriesStatus').closest('.form-group').addClass('has-error');
			} else {
				
				$("#categoriesStatus").find('.text-danger').remove();
				
				$("#categoriesStatus").closest('.form-group').addClass('has-success');	  	
			}

			if(categoriesName && categoriesStatus) {
				var form = $(this);
				
				$("#createCategoriesBtn").button('loading');

				$.ajax({
					url : form.attr('action'),
					type: form.attr('method'),
					data: form.serialize(),
					dataType: 'json',
					success:function(response) {
						
						$("#createCategoriesBtn").button('reset');

						if(response.success == true) {
							 
							manageCategoriesTable.ajax.reload(null, false);						

	  	  			
							$("#submitCategoriesForm")[0].reset();
							
							$(".text-danger").remove();
							
							$('.form-group').removeClass('has-error').removeClass('has-success');
	  	  			
	  	  			$('#add-categories-messages').html('<div class="alert alert-success">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

	  	  			$(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); 
						}  

					} 
				}); 	
			} 

			return false;
		}); 
	}); 	

}); 


function editCategories(categoriesId = null) {
	if(categoriesId) {
		 
		$('#editCategoriesId').remove();
		
		$("#editCategoriesForm")[0].reset();
		
		$(".text-danger").remove();
				
		$('.form-group').removeClass('has-error').removeClass('has-success');

		
		$("#edit-categories-messages").html("");
		
		$('.modal-loading').removeClass('div-hide');
		
		$('.edit-categories-result').addClass('div-hide');
		
		$(".editCategoriesFooter").addClass('div-hide');		

		$.ajax({
			url: 'php_action/fetchSelectedCategories.php',
			type: 'post',
			data: {categoriesId: categoriesId},
			dataType: 'json',
			success:function(response) {

				
				$('.modal-loading').addClass('div-hide');
				
				$('.edit-categories-result').removeClass('div-hide');
				
				$(".editCategoriesFooter").removeClass('div-hide');	

				
				$("#editCategoriesName").val(response.categories_name);
				
				$("#editCategoriesStatus").val(response.categories_active);
				 
				$(".editCategoriesFooter").after('<input type="hidden" name="editCategoriesId" id="editCategoriesId" value="'+response.categories_id+'" />');


				
				$("#editCategoriesForm").unbind('submit').bind('submit', function() {
					var categoriesName = $("#editCategoriesName").val();
					var categoriesStatus = $("#editCategoriesStatus").val();

					if(categoriesName == "") {
						$("#editCategoriesName").after('<p class="text-danger">Veuillez entrer une marque</p>');
						$('#editCategoriesName').closest('.form-group').addClass('has-error');
					} else {
						
						$("#editCategoriesName").find('.text-danger').remove();
						
						$("#editCategoriesName").closest('.form-group').addClass('has-success');	  	
					}

					if(categoriesStatus == "") {
						$("#editCategoriesStatus").after('<p class="text-danger">Veuillez entrer une marque</p>');
						$('#editCategoriesStatus').closest('.form-group').addClass('has-error');
					} else {
						
						$("#editCategoriesStatus").find('.text-danger').remove();
						
						$("#editCategoriesStatus").closest('.form-group').addClass('has-success');	  	
					}

					if(categoriesName && categoriesStatus) {
						var form = $(this);
						
						$("#editCategoriesBtn").button('chargement');

						$.ajax({
							url : form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								
								$("#editCategoriesBtn").button('reset');

								if(response.success == true) {
									 
									manageCategoriesTable.ajax.reload(null, false);									  	  			
									
									
									$(".text-danger").remove();
									
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-categories-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
				          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); 
								}  

							} 
						}); 	
					} 


					return false;
				}); 

			} 
		}); 

	} else {
		alert('Erreur, rafraichissez la page');
	}
} 


function removeCategories(categoriesId = null) {
		
	$.ajax({
		url: 'php_action/fetchSelectedCategories.php',
		type: 'post',
		data: {categoriesId: categoriesId},
		dataType: 'json',
		success:function(response) {			

			
			$("#removeCategoriesBtn").unbind('click').bind('click', function() {
				
				$("#removeCategoriesBtn").button('loading');

				$.ajax({
					url: 'php_action/removeCategories.php',
					type: 'post',
					data: {categoriesId: categoriesId},
					dataType: 'json',
					success:function(response) {
						if(response.success == true) {
 							
							$("#removeCategoriesBtn").button('reset');
							 
							$("#removeCategoriesModal").modal('hide');
							
							manageCategoriesTable.ajax.reload(null, false);
							
							$('.remove-messages').html('<div class="alert alert-success">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

	  	  			$(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); 
 						} else {
 							 
							$("#removeCategoriesModal").modal('hide');

 							
							$('.remove-messages').html('<div class="alert alert-success">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

	  	  			$(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); 
 						} 
						
						
					} 
				}); 
			}); 

		} 
	}); 
} 