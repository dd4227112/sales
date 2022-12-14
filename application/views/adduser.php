<?php include('admin_header.php');?>
<div class="panel-body progress-panel">
   <div class="row">
      <div class="col-lg-8 task-progress pull-left">
         <h1>Register new User</h1>
      </div>
   </div>
</div>
<div class="row">
				<div class="col-md-1">

				</div>
				<div class="col-md-10">
				<?php echo form_open('Admin_home/Save_user', ['class'=>'add_user']);?>
						<div class="form-group">
							<div class="form-label-group">
                     <label for="Full_name">Full name</label>
								<input type="text" id="Full_name" class="form-control" name="Full_name" placeholder="Enter user's full name" autofocus="autofocus">
								<span id="Full_name_alert" class="text-danger"></span>
							</div>
						</div>
						
						<div class="form-group">
							<div class="form-label-group">
								<label for="Phone_number"> Phone number</label>
								<input type="text" id="Phone_number" class="form-control" name="Phone_number" placeholder="Enter phone number">
								<span id="Phone_number_alert" class="text-danger"> </span>			    
							</div>
						</div>
                  <div class="form-group">
							<div class="form-label-group">
								<label for="Role">Role</label>
                        <select class="form-control" name="Role" id="Role">
                           <option value="normal_user">Normal User</option>
                           <option value="Admin">Admin</option>
                        </select>
								<span id="Role_alert" class="text-danger"> </span>			    
							</div>
                  </div>
                  <div class="form-group">
							<div class="form-label-group">
								<label for="Username"> Username</label>
								<input type="text" id="Username" class="form-control" name="Username" placeholder="Enter user's username">
								<span id="Username_alert" class="text-danger"> </span>			    
							</div>
                  </div>
                  <div class="form-group">
							<div class="form-label-group">
								<label for="Password"> Password</label>
								<input type="text" id="Password" class="form-control" name="Password" placeholder="Enter user's password">
								<span id="Password_alert" class="text-danger"> </span>			    
							</div>
						</div>
						<div class="form-group">
						<input type="submit" class="btn btn-success btn-sm" value="Save ">
						</div>
				  </form>
				</div>
				<div class="col-md-1">
				    
				</div>
			</div>
<?php include('admin_footer.php');?>
<script>
	$(document).ready(function(){
		$('input[name=Phone_number]').on('keypress', function(event){
         if(event.which<48 || event.which>57){
            event.preventDefault();
         }
     	});
		$('.add_user').on("submit",function(){
		var Full_name= document.getElementById('Full_name').value;
		var Phone_number= document.getElementById('Phone_number').value;
		var Role= document.getElementById('Role').value;
		var Phone_number= document.getElementById('Phone_number').value;
		var Username= document.getElementById('Username').value;
		var Password= document.getElementById('Password').value;
		if (Full_name=="") {
			$('#Full_name_alert').text("Enter user's name");
			return false;
		}
		if (Phone_number!="" && Phone_number.length!=10) {
			$('#Phone_number_alert').text("Phone_number must be 10 numbers");
			return false;
		}
		if (Phone_number!="" && (Phone_number.indexOf('0')!=0 &&(Phone_number.indexOf('1')!=6 || Phone_number.indexOf('1')!=7))){
          document.getElementById('Phone_number_alert').innerHTML="Wrong phone number format, must start with 07 or 06";
          return false;
        }
		if (Username=="") {
			$('#Username_alert').text("This field is required");
			return false;
		}
		if (Password=="") {
			$('#Password_alert').text("This field is required");
			return false;
		}
		if (Password.length<4) {
			$('#Password_alert').text("Minimum lenght required is 5");
			return false;
		}
		});
	});
</script>