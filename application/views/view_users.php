 <?php include('admin_header.php');?>
 <div class="panel-body progress-panel">
            <div class="row">
              <div class="col-lg-10 task-progress pull-left">
                <h1 class="color:danger" >All Registerd Users</h1>
              </div>
              <div class="col-lg-2 task-progress pull-left">
                <a class=" btn btn-sm btn-info" href="<?php echo base_url();?>index.php/Admin_home/Add_user">Add new User</a>
              </div>
            </div>          </div>
            <?php 
          if ($available_users==NULL){
            echo '<h4 class="text-center text-success">No user found</h4>';
          }else{?>         
          <table class="table table-hover table-border" width="50%" id="list_users">
          <thead>
            <tr>
              <th scope="col">No.</th>
              <th scope="col">Full name</th>
              <th scope="col">Phone number</th>
              <th scope="col">Role</th>
              <th scope="col">Status</th>
              <th scope="col">Registration date</th>
              <th scope="col">Username</th>
              <th scope="col"></th>
              <th scope="col">Actions</th>
				      <th scope="col"></th>
            </tr>
          </thead>
            <tbody>
          <?php
             $No=1;
            foreach($available_users as $user):?>
               <tr>
                 <td><?php echo $No; ?></td>
                 <td><?php echo $user->Full_name; ?></td>
                 <td ><?php echo $user->Phone_number; ?></td>
                 <td ><?php echo $user->Role; ?></td>
                 <td ><?php echo $user->Status ; ?></td>
                 <td><?php echo $user->Registration_date; ?></td>
                 <td><?php echo $user->Username; ?></td>  
                 <td><a class=" update_data btn btn-success btn-sm" href="javascript:;" id="<?php echo $user->User_id; ?>">Update</a></td>
                 <td><a class=" delete_data_by_ajax btn btn-danger btn-sm" href="javascript:;" id="<?php echo $user->User_id; ?>">Delete</a></td>
                 <td><a class=" reset btn btn-primary btn-sm" href="javascript:;" id="<?php echo $user->User_id; ?>">Reset Password</a></td>
               </tr>
            <?php
         $No++;
          endforeach; } ?>
            </tbody>
          </table>
          	<!-- Add new student modal -->
 <div class="modal fade" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Add new Student</h5>
	      </div>
	      <div class="modal-body">
			  <?php echo form_open('Admin_home/updateUserdata', ['id'=>'insert_data', 'method'=>'POST']);?>
	          <div class="form-group">
		          	<div class="row">
		          		<div class="col-md-6">
		          			<input type="hidden" name="User_id" value="0">
			          		<label for="Full_name" class="col-form-label">first name</label>
				            <input type="text" name="Full_name" class=" has_error form-control" id="Full_name">
				            <input type="hidden" name="User_id" class=" has_error form-control" id="User_id">
				            <span id="Full_name_sms"></span>	
		          		</div>
		          		<div class="col-md-6">
							<label for="Phone_number" class="col-form-label">Phone number</label>
				            <input type="text" name="Phone_number" class="form-control" id="Phone_number">
				            <span id="Phone_number_sms"></span>
				        </div>
		          	</div>
	          	</div>
			  <div class="form-group">
					<div class="row">
						<div class="col-md-6">
				            <label for="Status" class="col-form-label">Status</label>
                    <select id="Status" class=" form-control" name="Status">
                <option value="">Select.....</option>
								<option value="active">active</option>
								<option value="inactive">inactive</option>
							</select>
				            <span id="Status_sms"></span>
						</div>
						<div class="col-md-6">
							<label for="Role" class="col-form-label"> Role</label>
							<select id="Role" class=" form-control" name="Role">
                <option value="">Select.....</option>
								<option value="normal_user">Normal user</option>
								<option value="Admin">Admin</option>
							</select>
							<span id="Role_sms"></span>
						</div>
					</div>
	          </div>
	          <div class="form-group">
					<div class="row">
						<div class="col-md-12">
							<label for="Username" class="col-form-label"> Username</label>
              <input type="text" name="Username" class="form-control" id="Username">
								</select>
								<span id="Username_sms"></span>
						</div>
					</div>
				</div>
				<div class="form-group">
						<input type="submit" class="btn btn-success btn-sm" value="Save ">
						</div>
	        </form>
	      </div>
	      <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
<?php include('admin_footer.php');?>
<script>
  $(document).ready(function(){
  $('#list_users').DataTable({
  });
		$('#list_users').on('click','.update_data',function (event) {
            var id=$(this).attr("id");
            event.preventDefault();
		// alert(id);
      
        $('#studentModal').find('.modal-title').text("Update user's data").addClass('text-success');
        // $('#insert_data').attr('action','<?php echo base_url();?>index.php/Admin_home/updateUserdata')

      $.ajax({
        method: 'POST',
        url: '<?php echo base_url();?>index.php/Admin_home/getUserdata',
        data: {id:id},
        async:'false',
        dataType:'json',
          success:function(data){
			console.log(data);
          	$('input[name=User_id]').val(data.User_id);
            $('input[name=Full_name]').val(data.Full_name);
            $('input[name=Phone_number]').val(data.Phone_number);
            $('select[name=Role]').val(data.Role);
            $('select[name=Status]').val(data.Status);
            $('input[name=Username]').val(data.Username);
            $('#studentModal').find('.modal-title').text("Edit user's data").addClass('text-success');
		  	$('#studentModal').find('.save_data').text("update");
			$('#studentModal').modal("show");
        },
        error:function(){
          alert("Could not edit employee");
        }
      });
    });
		$('input[name=Phone_number]').on('keypress', function(event){
         if(event.which<48 || event.which>57){
            event.preventDefault();
         }
     	});
		$("#insert_data").on("submit", function(){	
  		var url=$('#insert_data').attr('action');
  		var data=$('#insert_data').serialize();
		var Full_name= document.getElementById('Full_name').value;
		var Phone_number= document.getElementById('Phone_number').value;
		var Role= document.getElementById('Role').value;
		var Phone_number= document.getElementById('Phone_number').value;
		var Username= document.getElementById('Username').value;
		if (Full_name=="") {
			$('#Full_name_sms').text("Enter user's name");
			return false;
		}
		if (Phone_number!="" && Phone_number.length!=10) {
			$('#Phone_number_sms').text("Phone_number must be 10 numbers");
			return false;
		}
		if (Phone_number!="" && (Phone_number.indexOf('0')!=0 &&(Phone_number.indexOf('1')!=6 || Phone_number.indexOf('1')!=7))){
          document.getElementById('Phone_number_sms').innerHTML="Wrong phone number format, must start with 07 or 06";
          return false;
        }
		if (Username=="") {
			$('#Username_sms').text("This field is required");
			return false;
		}

		});

		// Delete User
    $(".delete_data_by_ajax").click(function(){
        var id=$(this).attr("id");
        if (confirm("Are you sure,you want to delete this user?? ")) {
          $.ajax({
            method: 'get',
            url: '<?php echo base_url();?>index.php/Admin_home/deleteUser',
            data:{id:id},
            success:function(data){
              alert(data);
                  window.location="<?php echo base_url();?>index.php/Admin_home/view_users";
                }

          });
        } else {
          return false;
        }
      });
		//   Reset user password
		$(".reset").click(function(){
  			var id=$(this).attr("id");
  			if (confirm("Are you sure,you want to reset password for this user?? ")) {
  				$.ajax({
					method: 'get',
        			url: '<?php echo base_url();?>index.php/Admin_home/Reset_Password',
  					data:{id:id},
  					success:function(data){
  						alert(data);
  						window.location="<?php echo base_url();?>index.php/Admin_home/view_users";
  					}
  				});
  	
  			}
  			else {return false;}

  		});

  });
</script>
