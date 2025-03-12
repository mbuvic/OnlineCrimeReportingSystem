<?php session_start() ?>
<div class="container-fluid">
	<form action="" id="login-frm">
		<div class="form-group">
			<label for="" class="control-label">Email</label>
			<input type="email" name="email" required="" class="form-control">
		</div>
		<div class="form-group">
			<label for="" class="control-label">Password</label>
			<input type="password" name="password" required="" class="form-control">
			<small><a href="javascript:void(0)" id="new_account">Create New Account</a></small>
		</div>
		<button class="button btn btn-primary btn-sm">Login</button>
		<button class="button btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
	</form>
</div>

<style>
	#uni_modal .modal-footer{
		display:none;
	}

	.form-group {
		margin-bottom: 1.5rem;
		animation: slideUp 0.5s ease-out forwards;
		opacity: 0;
	}

	.form-group:nth-child(1) { animation-delay: 0.1s; }
	.form-group:nth-child(2) { animation-delay: 0.2s; }
	
	.form-control {
		border-radius: 8px;
		border: 2px solid #eee;
		padding: 0.8rem;
		transition: all 0.3s ease;
	}

	.form-control:focus {
		border-color: #007bff;
		box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.15);
	}

	.btn {
		border-radius: 8px;
		padding: 0.8rem 2rem;
		font-weight: 600;
		transition: all 0.3s ease;
	}

	.btn:hover {
		transform: translateY(-2px);
		box-shadow: 0 5px 15px rgba(0,0,0,0.2);
	}

	@keyframes slideUp {
		from { 
			opacity: 0;
			transform: translateY(20px);
		}
		to {
			opacity: 1;
			transform: translateY(0);
		}
	}
</style>

<script>
	$('#new_account').click(function(){
		uni_modal("Create an Account",'signup.php?redirect=index.php?page=checkout')
	})
	$('#login-frm').submit(function(e){
		e.preventDefault()
		start_load()
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'admin/ajax.php?action=login2',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		end_load()

			},
			success:function(resp){
				if(resp == 1){
					location.href ='<?php echo isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php?page=home' ?>';
				}else{
					$('#login-frm').prepend('<div class="alert alert-danger">Email or password is incorrect.</div>')
		end_load()
				}
			}
		})
	})
</script>