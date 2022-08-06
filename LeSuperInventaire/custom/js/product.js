var manageProductTable;

$(document).ready(function() {
	 
	$('#navProduct').addClass('active');
	
	manageProductTable = $('#manageProductTable').DataTable({
		'ajax': 'php_action/fetchProduct.php',
		'order': []
	});

	
	$("#addProductModalBtn").unbind('click').bind('click', function() {
		
		$("#submitProductForm")[0].reset();		

		 
		$(".text-danger").remove();
		
		$(".form-group").removeClass('has-error').removeClass('has-success');

		$("#productImage").fileinput({
	      overwriteInitial: true,
		    maxFileSize: 2500,
		    showClose: false,
		    showCaption: false,
		    browseLabel: '',
		    removeLabel: '',
		    browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
		    removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
		    removeTitle: 'Cancel or reset changes',
		    elErrorContainer: '#kv-avatar-errors-1',
		    msgErrorClass: 'alert alert-block alert-danger',
		    defaultPreviewContent: '<img src="assests/images/photo_default.png" alt="Profile Image" style="width:100%;">',
		    layoutTemplates: {main2: '{preview} {remove} {browse}'},								    
	  		allowedFileExtensions: ["jpg", "png", "gif", "JPG", "PNG", "GIF"]
			});   

		
		$("#submitProductForm").unbind('submit').bind('submit', function() {

			
			var productImage = $("#productImage").val();
			var productName = $("#productName").val();
			var quantity = $("#quantity").val();
			var rate = $("#rate").val();
			var brandName = $("#brandName").val();
			var categoryName = $("#categoryName").val();
			var productStatus = $("#productStatus").val();
	
			if(productImage == "") {
				$("#productImage").closest('.center-block').after('<p class="text-danger">Une photo est nécessaire</p>');
				$('#productImage').closest('.form-group').addClass('has-error');
			}	else {
				
				$("#productImage").find('.text-danger').remove();
				
				$("#productImage").closest('.form-group').addClass('has-success');	  	
			}	

			if(productName == "") {
				$("#productName").after('<p class="text-danger">Veuillez entrer le nom du produit</p>');
				$('#productName').closest('.form-group').addClass('has-error');
			}	else {
				
				$("#productName").find('.text-danger').remove();
				
				$("#productName").closest('.form-group').addClass('has-success');	  	
			}	

			if(quantity == "") {
				$("#quantity").after('<p class="text-danger">Veuillez entrer une quantité</p>');
				$('#quantity').closest('.form-group').addClass('has-error');
			}	else {
				
				$("#quantity").find('.text-danger').remove();
				
				$("#quantity").closest('.form-group').addClass('has-success');	  	
			}	

			if(rate == "") {
				$("#rate").after('<p class="text-danger">Veuillez entrer un prix</p>');
				$('#rate').closest('.form-group').addClass('has-error');
			}	else {
				
				$("#rate").find('.text-danger').remove();
				
				$("#rate").closest('.form-group').addClass('has-success');	  	
			}	

			if(brandName == "") {
				$("#brandName").after('<p class="text-danger">Veuillez entrer une marque</p>');
				$('#brandName').closest('.form-group').addClass('has-error');
			}	else {
				
				$("#brandName").find('.text-danger').remove();
				
				$("#brandName").closest('.form-group').addClass('has-success');	  	
			}	

			if(categoryName == "") {
				$("#categoryName").after('<p class="text-danger">Veuillez entrer une catégorie</p>');
				$('#categoryName').closest('.form-group').addClass('has-error');
			}	else {
				
				$("#categoryName").find('.text-danger').remove();
				
				$("#categoryName").closest('.form-group').addClass('has-success');	  	
			}	

			if(productStatus == "") {
				$("#productStatus").after('<p class="text-danger">Veuillez entrer un statut</p>');
				$('#productStatus').closest('.form-group').addClass('has-error');
			}	else {
				
				$("#productStatus").find('.text-danger').remove();
				
				$("#productStatus").closest('.form-group').addClass('has-success');	  	
			}	

			if(productImage && productName && quantity && rate && brandName && categoryName && productStatus) {
				
				$("#createProductBtn").button('loading');

				var form = $(this);
				var formData = new FormData(this);

				$.ajax({
					url : form.attr('action'),
					type: form.attr('method'),
					data: formData,
					dataType: 'json',
					cache: false,
					contentType: false,
					processData: false,
					success:function(response) {

						if(response.success == true) {
							
							$("#createProductBtn").button('reset');
							
							$("#submitProductForm")[0].reset();

							$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																	
							
							$('#add-product-messages').html('<div class="alert alert-success">'+
		            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
		            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

							
		          $(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); 

		          
							manageProductTable.ajax.reload(null, true);

							 
							$(".text-danger").remove();
							
							$(".form-group").removeClass('has-error').removeClass('has-success');

						} 
						
					} 
				}); 
			}	  					

			return false;
		}); 

	}); 
	

		

}); 

function editProduct(productId = null) {

	if(productId) {
		$("#productId").remove();		
		 
		$(".text-danger").remove();
		
		$(".form-group").removeClass('has-error').removeClass('has-success');
		
		$('.div-loading').removeClass('div-hide');
		
		$('.div-result').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedProduct.php',
			type: 'post',
			data: {productId: productId},
			dataType: 'json',
			success:function(response) {		
			
				
				$('.div-loading').addClass('div-hide');
				
				$('.div-result').removeClass('div-hide');				

				$("#getProductImage").attr('src', 'stock/'+response.product_image);

				$("#editProductImage").fileinput({		      
				});    
				
				$(".editProductFooter").append('<input type="hidden" name="productId" id="productId" value="'+response.product_id+'" />');				
				$(".editProductPhotoFooter").append('<input type="hidden" name="productId" id="productId" value="'+response.product_id+'" />');				
				
				
				$("#editProductName").val(response.product_name);
				
				$("#editQuantity").val(response.quantity);
				
				$("#editRate").val(response.rate);
				
				$("#editBrandName").val(response.brand_id);
				
				$("#editCategoryName").val(response.categories_id);
				
				$("#editProductStatus").val(response.active);

				
				$("#editProductForm").unbind('submit').bind('submit', function() {

					
					var productImage = $("#editProductImage").val();
					var productName = $("#editProductName").val();
					var quantity = $("#editQuantity").val();
					var rate = $("#editRate").val();
					var brandName = $("#editBrandName").val();
					var categoryName = $("#editCategoryName").val();
					var productStatus = $("#editProductStatus").val();
								

					if(productName == "") {
						$("#editProductName").after('<p class="text-danger">Product Name field is required</p>');
						$('#editProductName').closest('.form-group').addClass('has-error');
					}	else {
						
						$("#editProductName").find('.text-danger').remove();
						
						$("#editProductName").closest('.form-group').addClass('has-success');	  	
					}	

					if(quantity == "") {
						$("#editQuantity").after('<p class="text-danger">Veuillez entrer une quantité</p>');
						$('#editQuantity').closest('.form-group').addClass('has-error');
					}	else {
						
						$("#editQuantity").find('.text-danger').remove();
						
						$("#editQuantity").closest('.form-group').addClass('has-success');	  	
					}	

					if(rate == "") {
						$("#editRate").after('<p class="text-danger">Rate field is required</p>');
						$('#editRate').closest('.form-group').addClass('has-error');
					}	else {
						
						$("#editRate").find('.text-danger').remove();
						
						$("#editRate").closest('.form-group').addClass('has-success');	  	
					}	

					if(brandName == "") {
						$("#editBrandName").after('<p class="text-danger">Veuillez entrer une marque</p>');
						$('#editBrandName').closest('.form-group').addClass('has-error');
					}	else {
						
						$("#editBrandName").find('.text-danger').remove();
						
						$("#editBrandName").closest('.form-group').addClass('has-success');	  	
					}	

					if(categoryName == "") {
						$("#editCategoryName").after('<p class="text-danger">Category Name field is required</p>');
						$('#editCategoryName').closest('.form-group').addClass('has-error');
					}	else {
						
						$("#editCategoryName").find('.text-danger').remove();
						
						$("#editCategoryName").closest('.form-group').addClass('has-success');	  	
					}	

					if(productStatus == "") {
						$("#editProductStatus").after('<p class="text-danger">Product Status field is required</p>');
						$('#editProductStatus').closest('.form-group').addClass('has-error');
					}	else {
						
						$("#editProductStatus").find('.text-danger').remove();
						
						$("#editProductStatus").closest('.form-group').addClass('has-success');	  	
					}						

					if(productName && quantity && rate && brandName && categoryName && productStatus) {
						
						$("#editProductBtn").button('loading');

						var form = $(this);
						var formData = new FormData(this);

						$.ajax({
							url : form.attr('action'),
							type: form.attr('method'),
							data: formData,
							dataType: 'json',
							cache: false,
							contentType: false,
							processData: false,
							success:function(response) {
								console.log(response);
								if(response.success == true) {
									
									$("#editProductBtn").button('reset');																		

									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																			
									
									$('#edit-product-messages').html('<div class="alert alert-success">'+
				            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
				          '</div>');

									
				          $(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); 

				          
									manageProductTable.ajax.reload(null, true);

									 
									$(".text-danger").remove();
									
									$(".form-group").removeClass('has-error').removeClass('has-success');

								} 
								
							} 
						}); 
					}	  					

					return false;
				}); 

								
				$("#updateProductImageForm").unbind('submit').bind('submit', function() {					
					
					var productImage = $("#editProductImage").val();					
					
					if(productImage == "") {
						$("#editProductImage").closest('.center-block').after('<p class="text-danger">Une photo est nécessaire</p>');
						$('#editProductImage').closest('.form-group').addClass('has-error');
					}	else {
						
						$("#editProductImage").find('.text-danger').remove();
						
						$("#editProductImage").closest('.form-group').addClass('has-success');	  	
					}	

					if(productImage) {
						
						$("#editProductImageBtn").button('loading');

						var form = $(this);
						var formData = new FormData(this);

						$.ajax({
							url : form.attr('action'),
							type: form.attr('method'),
							data: formData,
							dataType: 'json',
							cache: false,
							contentType: false,
							processData: false,
							success:function(response) {
								
								if(response.success == true) {
									
									$("#editProductImageBtn").button('reset');																		

									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																			
									
									$('#edit-productPhoto-messages').html('<div class="alert alert-success">'+
				            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
				          '</div>');

									
				          $(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); 

				          
									manageProductTable.ajax.reload(null, true);

									$(".fileinput-remove-button").click();

									$.ajax({
										url: 'php_action/fetchProductImageUrl.php?i='+productId,
										type: 'post',
										success:function(response) {
										$("#getProductImage").attr('src', response);		
										}
									});																		

									 
									$(".text-danger").remove();
									
									$(".form-group").removeClass('has-error').removeClass('has-success');

								} 
								
							} 
						}); 
					}	  					

					return false;
				}); 

			} 
		}); 

				
	} else {
		alert('error please refresh the page');
	}
} 


function removeProduct(productId = null) {
	if(productId) {
		
		$("#removeProductBtn").unbind('click').bind('click', function() {
			
			$("#removeProductBtn").button('loading');
			$.ajax({
				url: 'php_action/removeProduct.php',
				type: 'post',
				data: {productId: productId},
				dataType: 'json',
				success:function(response) {
					
					$("#removeProductBtn").button('reset');
					if(response.success == true) {
						
						$("#removeProductModal").modal('hide');

						
						manageProductTable.ajax.reload(null, false);

						
						$(".remove-messages").html('<div class="alert alert-success">'+
		            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
		            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

						
	          $(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); 
					} else {

						
						$(".removeProductMessages").html('<div class="alert alert-success">'+
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
			return false;
		}); 
	} 
} 

function clearForm(oForm) {
	 
}