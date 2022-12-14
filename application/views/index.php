<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>sale management system</title>
		<link rel="shortcut icon" href="<?php echo base_url();?>images/system_icon.png">
		<!-- Bootstrap core CSS -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('vendor/bootstrap/css/bootstrap.min.css'); ?>">
	</head>
	<body class="container"> 
		<main role="main">
			<div class="jumbotron">
				<div>
					<h1 class="display-5 text-center"> Sales Record Management System(SRMS)</h1>  
				</div>
			</div>
			<?php if ($message = $this->session->flashdata('message')){?>
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<?php echo $message;?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
					</div>
					<div class="col-md-3"></div>
				</div>
			<?php } ?>	
			<?php if ($success = $this->session->flashdata('success')){?>
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<?php echo $success;?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
					</div>
					<div class="col-md-3"></div>
				</div>
			<?php } ?>	

			<div class="row">
				<div class="col-md-3">

				</div>
				<div class="col-md-6">
				<?php echo form_open('Welcome/login', ['class'=>'login_form']);?>
						<div class="form-group">
							<div class="form-label-group">
								<label for="Username">Username</label>
								<input type="text" id="Username" class="form-control" name="Username" placeholder="Enter your username" autofocus="autofocus">
								<span id="username_alert" class="text-danger"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="form-label-group">
								<label for="Password">Password</label>
								<input type="password" id="Password" class="form-control" name="Password" placeholder="Enter your password">
								<span id="password_alert" class="text-danger"> </span>			    
							</div>
						</div>
						<div class="form-group">
						<input type="submit" class="btn btn-dark btn-block" value="Log in">
							<p>Forget password?<span class='text-info'>Please contact your administrator</span></p>
						</div>
				  </form>
				</div>
				<div class="col-md-3">
				    
				</div>
			</div>
	      <hr>
		</main>
		<footer>
				<div class="row">
				<div class="col-3">&copy; Wise Stationary 2020</div>
				<div class="col-9 text-info" style="text-align: end; font-size:13px; font-style:italic; margin:0px">
					<p  style="margin:0px" >Developed by David Daniel</p>
					<p style="margin:0px">+255743414770 / +255710097797/+255621514716</p>
					<p style="margin:0px">dd4227112@gmail.com</p>
				</div>
				</div>
		</footer>
	<script src="<?php echo base_url();?>js/jquery.js"></script>
  <script src="<?php echo base_url();?>js/jquery-ui-1.10.4.min.js"></script>
  <script src="<?php echo base_url();?>js/jquery-1.8.3.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui-1.9.2.custom.min.js"></script>
  <!-- bootstrap -->
  <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('.login_form').on('submit', function(){
					var username=document.getElementById('Username').value;
					var password=document.getElementById('Password').value;
					var data=$('.login_form').serialize();
					//alert(data);
					if(username==""){
						$('#username_alert').text("Please enter your username");
						return false;
					}
					if(password==""){
						$('#password_alert').text("Please enter your password");
						return false;
					}
					
					$.ajax({
						url:'<?php echo base_url();?>Welcome/login',
						method:'POST',
						async: false,
						data: data,
						success:function(){
							$('.login_form')[0].reset();
						},
					});
					
				});
			});
		</script>

	</body>
</html>
