<?php include('admin_header.php');?>
 <!--Project Activity start-->
 <div class="panel-body progress-panel">
            <div class="row">
              <div class="col-lg-10 task-progress pull-left">
                <h1>Products out of stock </h1>
              </div>
            </div>
          </div>

            <?php 
          if ($all_products==NULL){
            echo '<h2 class="text-center text-success" colspan="10">No data found</h2>';
          } 
          else{
             $No=1;
              ?>
                      <table class="table table-hover product_list table-border" id="Missing">
          <thead>
            <tr>
              <th scope="col">No.</th>
              <th scope="col">Product Name</th>
              <th scope="col">Quantity</th>
              <th scope="col">Avaialable in stock</th>
              <th scope="col">Price-jumla(Tsh)</th>
              <th scope="col">Price-rejareja(Tsh)</th>
              <th scope="col"></th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
            <tbody>
            <?php foreach($all_products as $products):?>
              <tr>
                <td><?php echo $No; ?></td>
                <td><?php echo $products->Product_name." - ".$products->Product_description; ?></td>
                <td class="text-center"><?php echo $products->Quantity_total; ?></td>
                <td class="text-center"><?php echo $products->Quantity_left; ?></td>
                <td class="text-center"><?php echo $products->Cost_total ."/= "; ?></td>
                <td class="text-center"><?php echo $products->Cost_single."/= "; ?></td>  
                <td><a class=" update_data btn btn-success btn-sm" href="javascript:;" id="<?php echo $products->Product_id; ?>">Add</a></td>
                 <td><a class=" delete_data btn btn-danger btn-sm" href="javascript:;" id="<?php echo $products->Product_id;  ?>">Delete</a></td>
              
              </tr>
            <?php
         $No++;
         endforeach; ?>
            </tbody>
          </table>
          <?php } ?>

          <div class="modal fade" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Add new Student</h5>
	      </div>
	      <div class="modal-body">
			  <?php echo form_open('Admin_home/updateSingleProduct', ['id'=>'update_product', 'method'=>'POST']);?>
	          <div class="form-group">
		          	<div class="row">
			          	<div class="col-md-6">
				            <label for="Quantity_total" class="col-form-label"> Total Quantity </label>
                    <input type="text" name="Quantity_total" class="form-control" id="Quantity_total">
                    <input type="hidden" name="Product_id" class="form-control" id="Product_id">
				            <span id="Quantity_total_sms"></span>
			        	</div>
		          		<div class="col-md-6">
                      <label for="Quantity_left" class="col-form-label">Quantity in stock</label>
				            <input type="text" name="Quantity_left" class="form-control" id="Quantity_left">
				            <span id="Quantity_left_sms"></span>
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
    $('#Missing').DataTable({
    "paging":false
    });
   // Delete product
   $(".delete_data").click(function(){
  			var id=$(this).attr("id");
  			if (confirm("Are you sure,you want to delete this product?? ")) {
  				$.ajax({
					method: 'get',
        			url: '<?php echo base_url();?>index.php/Admin_home/deleteProduct',
  					data:{id:id},
  					success:function(data){
  						alert(data);
  						window.location="<?php echo base_url();?>index.php/Admin_home/index";
  					}
  				});
  	
  			}
  			else {return false;}

  		});
      // Validate input
      $(".save_data").click(function(){	
          var Quantity_total=document.getElementById('Quantity_total').value;
          var Quantity_left=document.getElementById('Quantity_left').value;

          if (Quantity_total=="") {
              $('#Quantity_total_sms').text("Fill this field").css('color','red');
              return false;
          }
          if (isNaN(Quantity_total)) {
              $('#Quantity_total_sms').text("Only numbers are required").css('color','red');
              return false;
          }
          if (Quantity_left=="") {
              $('#Quantity_left_sms').text("Fill this field").css('color','red');
              return false;
          }
          if (isNaN(Quantity_left)) {
              $('#Quantity_left_sms').text("Only numbers are required").css('color','red');
              return false;
          }
          if(Quantity_left>Quantity_total){
            $('#Quantity_left_sms').text("Can not be greater than the total quantity").css('color', 'red');
            return false;
          }
      });
      $(".update_data").click(function(){	
        var id=$(this).attr('id');
        $('#studentModal').modal("show");
        $('#studentModal').find('.modal-title').text("Update Product").addClass('text-success');

          	$('input[name=Product_id]').val(id);
    });
  });
</script>