<?php include('admin_header.php');?>
<div class="panel-body progress-panel">
            <div class="row">
              <div class="col-lg-10 task-progress pull-left">
                <h1>Add new Products</h1>
              </div>
            </div>
          </div>
          <br>
          <!-- form start-->
          <?php echo form_open("Admin_home/Save_Product", ['class'=>'form_report container', 'method'=>'POST']);?>
	          <div class="form-group">
		          	<div class="row">
		          		<div class="col-md-6">
			          		<label for="Product_name" class="col-form-label">Product name</label>
				            <input type="text" name="Product_name" class="form-control" id="Product_name">
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
           <br>
          <!--form end -->
<?php include('admin_footer.php');?>
<script>
   $(document).ready(function(){
      $('input[name=Quantity_total]').on('keypress', function(event){
         if(event.which<48 || event.which>57){
            event.preventDefault();
         }
      });
      $('input[name=Quantity_left]').on('keypress', function(event){
         if(event.which<48 || event.which>57){
            event.preventDefault();
         }
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