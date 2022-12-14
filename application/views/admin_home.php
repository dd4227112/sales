<?php include('admin_header.php');?>
 <!--Project Activity start-->
 <div class="panel-body progress-panel">
            <div class="row">
              <div class="col-lg-8 task-progress pull-left">
                <h1>All available products</h1>
              </div>
              <div class="col-lg-2 task-progress pull-center">
            <!-- <a class="btn btn-info" href="PrintProduct">Print All</a> -->
              </div>
            <div class="col-lg-2 task-progress pull-right">
            <a class="btn btn-primary" href="<?php echo base_url();?>index.php/Admin_home/new">Add new Product</a>
              </div>
            </div>
          </div>    
            <?php 
          if ($all_products==NULL){
            echo '
            <h4 class="text-center text-succes">No Product Available</h4>';
          } 
          else{
            ?>
          <table class="table table-hover" id="list_products">
          <thead>
            <tr>
              <th scope="col">Product Name</th>
              <th scope="col">Quantity</th>
              <th scope="col">Avaialable in stock</th>
              <th scope="col">Price-jumla(Tsh)</th>
              <th scope="col">Stock after sale @item Price-jumla(Tsh)</th>
              <th scope="col">Price-rejareja(Tsh)</th>
              <th scope="col">Stock after sale @item Price-rejareja</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
            <tbody>
            <?php
             $tolal_jumla=0;
             $tolal_rejareja=0;
            foreach($all_products as $products):?>
              <tr>
                <td><?php echo $products->Product_name." - ".$products->Product_description; ?></td>
                <td class="text-center"><?php echo $products->Quantity_total; ?></td>
                <td class="text-center"><?php echo $products->Quantity_left; ?></td>
                <td class="text-center"><?php echo $products->Cost_total ."/= "; ?></td>
                <td class="text-center"><?php echo $products->Cost_total *$products->Quantity_total."/= "; ?></td>
                <td class="text-center"><?php echo $products->Cost_single."/= "; ?></td>  
                <td class="text-center"><?php echo $products->Cost_single *$products->Quantity_total."/= "; ?></td>
                <td><a class=" update_data btn btn-success btn-sm" href="javascript:;" id="<?php echo $products->Product_id; ?>">Edit</a></td>
                 <td><a class=" delete_data btn btn-danger btn-sm" href="javascript:;" id="<?php echo $products->Product_id;  ?>">Delete</a></td>
              </tr>

            <?php
         $tolal_jumla+=($products->Cost_total *$products->Quantity_total);
         $tolal_rejareja+=($products->Cost_single *$products->Quantity_total);
         endforeach;} ?>
              <tr>
                <td class="text-success">Totals</td>
                <td></td>
                <td></td>
                <td></td>
                <td class="text-center"><?php echo number_format($tolal_jumla)."  /="?></td>
                <td></td>
                <td class="text-center"><?php echo number_format($tolal_rejareja)."  /="?></td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>

    <div class="modal fade" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Add new Student</h5>
	      </div>
	      <div class="modal-body">
			  <?php echo form_open('Admin_home/updateProduct', ['id'=>'update_product', 'method'=>'POST']);?>
	          <div class="form-group">
		          	<div class="row">
		          		<div class="col-md-6">
			          		<label for="Product_name" class="col-form-label">Product name</label>
                    <input type="text" name="Product_name" class="form-control" id="Product_name">
                    <input type="hidden" name="Product_id" class="form-control" id="Product_id">
				            <span id="Product_name_sms"></span>	
		          		</div>
		          		<div class="col-md-6">
							<label for="Product_description" class="col-form-label">Product Description</label>
				            <input type="text" name="Product_description" class="form-control" id="Product_description">
				            <span id="Product_description_sms"></span>
				        </div>
		          	</div>
	          	</div>
	          <div class="form-group">
		          	<div class="row">
			          	<div class="col-md-6">
				            <label for="Quantity_total" class="col-form-label"> Total Quantity </label>
				            <input type="text" name="Quantity_total" class="form-control" id="Quantity_total">
				            <span id="Quantity_total_sms"></span>
			        	</div>
		          		<div class="col-md-6">
                      <label for="Quantity_left" class="col-form-label">Quantity in stock</label>
				            <input type="text" name="Quantity_left" class="form-control" id="Quantity_left">
				            <span id="Quantity_left_sms"></span>
		          		</div>
		          </div>
	          </div>
			  <div class="form-group">
					<div class="row">
						<div class="col-md-6">
				            <label for="Cost_single" class="col-form-label">Price-rejareja</label>
				            <input type="text" name="Cost_single" class="form-control" id="Cost_single">
				            <span id="Cost_single_sms"></span>
						</div>
						<div class="col-md-6">
                  <label for="Cost_total" class="col-form-label">Price-jumla</label>
				            <input type="text" name="Cost_total" class="form-control" id="Cost_total">
							<span id="Cost_total_sms"></span>
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
    $('#list_products').DataTable({
    });
  });
</script>
<script>
  $(document).ready(function(){

    //get product details
  $('#list_products').on('click','.update_data',function (event) {
            var id=$(this).attr("id");
            event.preventDefault();
        // window.location = '<?php echo base_url();?>index.php/Admin_home/getProductdata';
        $('#studentModal').find('.modal-title').text("Update Product").addClass('text-success');
        $('#studentModal').modal("show");
       // alert(id);
       
        // $('#insert_data').attr('action','<?php echo base_url();?>index.php/Admin_home/updateUserdata')

      $.ajax({
        method: 'get',
        url: '<?php echo base_url();?>index.php/Admin_home/getProductdata',
        data: {id:id},
        async:'false',
        dataType:'json',
          success:function(data){
          // alert(data.Product_name);
          	$('input[name=Product_id]').val(data.Product_id);
            $('input[name=Product_name]').val(data.Product_name);
            $('input[name=Product_description]').val(data.Product_description);
            $('input[name=Quantity_total]').val(data.Quantity_total);  
            $('input[name=Quantity_left]').val(data.Quantity_left);         
            $('input[name=Cost_single]').val(data.Cost_single);
            $('input[name=Cost_total]').val(data.Cost_total);
            $('#studentModal').find('.modal-title').text("Edit Product's details").addClass('text-success');
		  	  	$('#studentModal').find('.save_data').text("update");
           
        },
        error:function(){
          alert("Could not edit employee");
        }
      });
    });



      $('#list_products').on('click','.delete_data',function (event) {
  			var id=$(this).attr("id");
  			if (confirm("Are you sure,you want to delete this product?? ")) {
  				$.ajax({
					method: 'get',
        			url: '<?php echo base_url();?>index.php/Admin_home/deleteProduct',
  					data:{id:id},
  					success:function(data){
  						alert(data);
  						window.location="<?php echo base_url();?>index.php/Admin_home/AllProduct";
  					}
  				});
  	
  			}
  			else {return false;}

  		});
      $(".save_data").click(function(){	
          var Product_name=document.getElementById('Product_name').value;
          var Product_description=document.getElementById('Product_description').value;
          var Quantity_total=document.getElementById('Quantity_total').value;
          var Quantity_left=document.getElementById('Quantity_left').value;
          var Cost_single=document.getElementById('Cost_single').value;
          var Cost_total=document.getElementById('Cost_total').value;

          if (Product_name=="") {
              $('#Product_name_sms').text("Fill this field").css('color','red');
              return false;
          }
            if (Product_description=="") {
              $('#Product_description_sms').text("Fill this field").css('color','red');
              return false;
          }
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
            if (Cost_single=="") {
              $('#Cost_single_sms').text("Fill this field").css('color','red');
              return false;
          }
            if (Cost_total=="") {
              $('#Cost_total_sms').text("Fill this field").css('color','red');
              return false;
          }
      });
  });
</script>