$(document).ready( function() {

	$('#message_btn').click(function(){
		
		let name = $('#name').val();
		let email = $('#email').val();
		let message = $('#message').val();

		if(name){
			$('#name-warning').html('')
		} else {
			$('#name-warning').html('Name is required')
		}

		if(email){
			$('#email-warning').html('')
		} else {
			$('#email-warning').html('Email is required')
		}

		if(message){
			$('#message-warning').html('')
		} else {
			$('#message-warning').html('Message is required')
		}

		if(name && email && message){
			$.ajax({
				method: 'POST',
				url: 'phpmailer.php',
				data: {
					name : name,
					email : email,
					message : message
				},
				beforeSend: function(){
			        Swal.fire({
					  html: 'Sending your message. Please wait..',
					  allowOutsideClick: false,
					  allowEscapeKey: false,
					  onBeforeOpen: () => {
					    Swal.showLoading();
					  }
					});
			    },
			    complete: function(){
			        swal.close();
			        Swal.fire({
			        	html: 'Successfully Sent. Please check your Email',
			        	showConfirmButton: true,
			        	confirmButtonClass: 'btn confirm-message-btn',
			        	allowEnterKey: false
			        });
			    }
			});	
		}

	});


});