var manageUserTable;

$(document).ready(function() {
	 
	$('#topNavUser').addClass('active');
	
	manageUserTable = $('#manageUserTable').DataTable({
		'ajax': 'php_action/fetchUser.php',
		'order': []
	});

	
	$("#addUserModalBtn").unbind('click').bind('click', function() {
		
		$("#submitUserForm")[0].reset();		

		 
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

		
		$("#submitUserForm").unbind('submit').bind('submit', function() {
			
			var userName = $("#userName").val();
			var upassword = $("#upassword").val();
	
			if(userName == "") {
				$("#userName").after('<p class="text-danger">Veuillez entrer un nom</p>');
				$('#userName').closest('.form-group').addClass('has-error');
			}	else {
				
				$("#userName").find('.text-danger').remove();
				
				$("#userName").closest('.form-group').addClass('has-success');	  	
			}	

			

			if(upassword == "") {
				$("#upassword").after('<p class="text-danger">Veuillez entrer un mot de passe</p>');
				$('#upassword').closest('.form-group').addClass('has-error');
			}	else {
				
				$("#upassword").find('.text-danger').remove();
				
				$("#upassword").closest('.form-group').addClass('has-success');	  	
			}	

			
				

			if(upassword && userName) {
				
				$("#createUserBtn").button('loading');

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
							
							$("#createUserBtn").button('reset');
							
							$("#submitUserForm")[0].reset();

							$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																	
							
							$('#add-user-messages').html('<div class="alert alert-success">'+
		            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
		            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

							
		          $(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); 

		          
							manageUserTable.ajax.reload(null, true);

							 
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

function editUser(userid = null) {

	if(userid) {
		$("#userid").remove();		
		 
		$(".text-danger").remove();
		
		$(".form-group").removeClass('has-error').removeClass('has-success');
		
		$('.div-loading').removeClass('div-hide');
		
		$('.div-result').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedUser.php',
			type: 'post',
			data: {"userid": userid},
			dataType: 'json',
			success:function(response) {		
			
				
				$('.div-loading').addClass('div-hide');
				
				$('.div-result').removeClass('div-hide');				
				
				$(".editUserFooter").append('<input type="hidden" name="userid" id="userid" value="'+response.user_id+'" />');				
				$(".editUserPhotoFooter").append('<input type="hidden" name="userid" id="userid" value="'+response.user_id+'" />');				
				
				
				$("#edituserName").val(response.username);
				
				
				
				
				$("#editUserForm").unbind('submit').bind('submit', function() {

					
					var username = $("#edituserName").val();
					var userpassword = $("#editPassword").val();
								

					if(username == "") {
						$("#edituserName").after('<p class="text-danger">Veuillez entrer un nom</p>');
						$('#edituserName').closest('.form-group').addClass('has-error');
					}	else {
						
						$("#edituserName").find('.text-danger').remove();
						
						$("#edituserName").closest('.form-group').addClass('has-success');	  	
					}	

					if(userpassword == "") {
						$("#editPassword").after('<p class="text-danger">Veuillez entrer un mot de passe</p>');
						$('#editPassword').closest('.form-group').addClass('has-error');
					}	else {
						
						$("#editPassword").find('.text-danger').remove();
						
						$("#editPassword").closest('.form-group').addClass('has-success');	  	
					}	
				

					if(userpassword && username) {
						
						$("#editUserBtn").button('loading');

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
									
									$("#editUserBtn").button('reset');																		

									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																			
									
									$('#edit-user-messages').html('<div class="alert alert-success">'+
				            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
				          '</div>');

									
				          $(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); 

				          
									manageUserTable.ajax.reload(null, true);

									 
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

				          
									manageUserTable.ajax.reload(null, true);

									$(".fileinput-remove-button").click();

									$.ajax({
										url: 'php_action/fetchProductImageUrl.php?i='+userid,
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


function removeUser(userid = null) {
	if(userid) {
		
		$("#removeProductBtn").unbind('click').bind('click', function() {
			
			$("#removeProductBtn").button('loading');
			$.ajax({
				url: 'php_action/removeUser.php',
				type: 'post',
				data: {userid: userid},
				dataType: 'json',
				success:function(response) {
					
					$("#removeProductBtn").button('reset');
					if(response.success == true) {
						
						$("#removeUserModal").modal('hide');

						
						manageUserTable.ajax.reload(null, false);

						
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

						
						$(".removeUserMessages").html('<div class="alert alert-success">'+
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