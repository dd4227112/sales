<?php include('admin_header.php');?>
 <div class="panel-body progress-panel">
            <div class="row">
              <div class="col-lg-10 task-progress pull-left">
                <h1>All Assets</h1>
              </div>
              <div class="col-lg-2 task-progress pull-left">
                <a class=" btn btn-sm btn-info" href="<?php echo base_url();?>index.php/Admin_home/Add_asset">Add new Asset</a>
              </div>
            </div>
          </div>

            <?php 
          if ($available_assets==NULL){
            echo '
            <h3 class="text-center text-success" colspan="10">No asset found</h3>
         ';
          }else{?>
                   <table class="table table-hover product_list table-border" id="dataTables-example">
          <thead>
            <tr>
              <th scope="col">No.</th>
              <th scope="col">Asset Name</th>
              <th scope="col">Description</th>
              <th scope="col">Status</th>
              <th scope="col">Costs</th>
              <th scope="col">Date</th>
              <th scope="col"></th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
            <tbody>

          <?php
             $No=1;
            foreach($available_assets as $asset):?>
               <tr>
                 <td><?php echo $No; ?></td>
                 <td><?php echo $asset->Asset_name; ?></td>
                 <td ><?php echo $asset->Description; ?></td>
                 <td ><?php echo $asset->Status; ?></td>
                 <td><?php echo $asset->Costs; ?></td>  
                 <td><?php echo $asset->Date; ?></td>
                 <td><a class=" update_data btn btn-success btn-sm" href="javascript:;" id="<?php echo $asset->Asset_id; ?>">Edit</a></td>
                 <td><a class=" delete btn btn-danger btn-sm" href="javascript:;" id="<?php echo $asset->Asset_id; ?>">Delete</a></td> 
               </tr>
            <?php
         $No++;
          endforeach; } ?>
                    	<!-- Add new student modal -->
 <div class="modal fade" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Add new Student</h5>
	      </div>
	      <div class="modal-body">
			  <?php echo form_open('Admin_home/updateAsset', ['id'=>'insert_data', 'method'=>'POST']);?>
	          <div class="form-group">
		          	<div class="row">
		          		<div class="col-md-6">
			          		<label for="Asset_name" class="col-form-label">Asset name</label>
                    <input type="text" name="Asset_name" class="form-control" id="Asset_name">
				            <input type="hidden" name="Asset_id" class="form-control" id="Asset_id">             
				            <span id="Asset_name_sms"></span>	
		          		</div>
		          		<div class="col-md-6">
							<label for="Description" class="col-form-label">Asset Description</label>
				            <input type="text" name="Description" class="form-control" id="Description">
				            <span id="Description_sms"></span>
				        </div>
		          	</div>
	          	</div>
	          <div class="form-group">
		          	<div class="row">
			          	<div class="col-md-6">
				            <label for="Costs" class="col-form-label"> Costs </label>
				            <input type="text" name="Costs" class="form-control" id="Costs">
				            <span id="Costs_sms"></span>
			        	</div>
		          		<div class="col-md-6">
                      <label for="Status" class="col-form-label">Status/Condition</label>
                      <select id="Status" name="Status" class="form-control">
                        <option value="">.....</option>
                        <option value="Good">Good</option>
                        <option value="Not in use">Not in use</option>
                     </select>
				         <span id="Status_sms"></span>
		          		</div>
		          </div>
	          </div>
			  <div class="form-group">
					<div class="row">
						<div class="col-md-6">
				            <label for="Date" class="col-form-label">Date</label>
				            <input type="date" required name="Date" class="form-control" id="Date">
				            <span id="Date_sms"></span>
						</div>
					</div>
             </div>
             <button  type="submit" class=" save_data btn btn-primary">Save</button>
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
    $('input[name=Costs]').on('keypress', function(event){
         if(event.which<48 || event.which>57){
            event.preventDefault();
         }
      });
    $(".update_data").click(function(){	
        var id=$(this).attr('id');
        $('#studentModal').modal("show");
        $('#studentModal').find('.modal-title').text("Edit Asset's detail").addClass('text-success');

      $.ajax({
        method: 'get',
        url: '<?php echo base_url();?>index.php/Admin_home/getAssetdata',
        data: {id:id},
        async:'false',
        dataType:'json',
          success:function(data){
          	$('input[name=Asset_id]').val(data.Asset_id);
            $('input[name=Asset_name]').val(data.Asset_name);
            $('input[name=Description]').val(data.Description);
            $('input[name=Costs]').val(data.Costs);
            $('select[name=Status]').val(data.Status);
            $('input[name=Date]').val(data.Date);
            $('#studentModal').find('.modal-title').text("Edit asset's detail").addClass('text-success');
		  	$('#studentModal').find('.save_data').text("update");
        },
        error:function(){
          alert("Could not edit employee");
        }
      });
    });
    $(".save_data").click(function(){	
         var Asset_name=document.getElementById('Asset_name').value;
         var Description=document.getElementById('Description').value;
         var Costs=document.getElementById('Costs').value;
         var Status=document.getElementById('Status').value;

         if (Asset_name=="") {
            $('#Asset_name_sms').text("Enter asset name").css('color','red');
            return false;
         }
           if (Description=="") {
            $('#Description_sms').text("Fill this field").css('color','red');
            return false;
         }
         if (Costs=="") {
            $('#Costs_sms').text("Fill this field").css('color','red');
            return false;
         }
         if (isNaN(Costs)) {
            $('#Costs_sms').text("Only numbers are required").css('color','red');
            return false;
         }
         if (Status=="") {
            $('#Status_sms').text("Fill this field").css('color','red');
            return false;
         }
      }); 

      // delete assets
      $(".delete").click(function(){
  			var id=$(this).attr("id");
  			if (confirm("Are you sure,you want to delete asset?? ")) {
  				$.ajax({
					method: 'get',
        			url: '<?php echo base_url();?>index.php/Admin_home/deleteAsset',
  					data:{id:id},
  					success:function(data){
  						alert(data);
  						window.location="<?php echo base_url();?>index.php/Admin_home/Assets";
  					}
  				});
  	
  			}
  			else {return false;}

  		});

  });
</script>