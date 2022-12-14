<?php include('header.php');?>

<div class="panel-body progress-panel">
   <div class="row">
      <div class="col-lg-8 task-progress pull-left">
         <h1><?php echo $products->Product_name." - ".$products->Product_description; ?></h1>
      </div>
   </div>
</div>
<table class="table table-hover product_list">
<thead>
   <tr>
   <th scope="col">Quantity Available</th>
   <th scope="col">Price-jumla(Tsh)</th>
   <th scope="col">Price-rejareja(Tsh)</th>
   </tr>
</thead>
   <tbody>
   <tr>
      <td><?php echo $products->Quantity_left; ?></td>
      <td><?php echo $products->Cost_total ."/= "; ?></td>
      <input type="hidden" id="jumla_id" value="<?php echo $products->Cost_total;?>">
      <td ><?php echo $products->Cost_single."/= "; ?></td>  
      <input type="hidden"  id="rejareja_id" value="<?php echo $products->Cost_single; ?>">
   </tr>
   </tbody>
</table>
<br/>

<?php echo form_open("Welcome/Save_credit", ['class'=>'product_form','method'=>'POST']);?>
<div class="form-group col-md-12">
		          	<div class="row">
		          		<div class="col-md-6">
			          		<label for="Borrower" class="col-form-label">Borrower's full name</label>
				            <input type="text" name="Borrower" class=" has_error form-control" id="Borrower">
				            <input type="hidden" name="User_id" class=" has_error form-control" id="User_id">
				            <span id="Borrower_sms"  class="text-danger"></span>	
		          		</div>
		          		<div class="col-md-6">
							<label for="Phone_number" class="col-form-label">Phone number</label>
				            <input type="text" name="Phone_number" class="form-control" id="Phone_number">
				            <span id="Phone_number_sms" class="text-danger"></span>
				        </div>
		          	</div>
	          	</div>
   <div class="form-group col-md-12">
      <label for="select_mode">Select borrowing mode</label>
      <select  id="select_mode" name="selling_mode" class="form-control form-control-lg">
      <option >...........</option>                     
         <option value="jumla">Jumla</option>
         <option value="rejareja">Reja reja</option>
      </select>
   </div>
   <br/>
   <div class=" col-md-12 mode">
         <div class="form-group">
            <div class="row">
               <div class="col-md-4">
                  <label for="Quantity_borrowed">Quantiy</label>
                  <input type="text" class="form-control" name="Quantity_borrowed" value="1" id="Quantity_borrowed" placeholder="Quantity">
                  <span class="text-danger" id="Quantity_borrowed_sms"></span>
               </div>
               <div class="col-md-4">
                  <label for="Price">Price</label>
                  <input type="text" value=""  name="Price" class="form-control" id="Price" placeholder="Price">
               </div>
               <div class="col-md-4">
                  <label for="Amount_total">Total Amount</label>
                  <input type="text" readonly value="0" name="Amount_total" class="form-control" id="Amount_total">  
                  <input type="hidden" readonly value="<?php echo $products->Product_id ;?>" name="Product_id" id="Product_id" class="form-control">
                  <input type="hidden" readonly value="<?php echo $products->Quantity_left ;?>" name="left" id="left" class="form-control">
               </div>
            </div>
         </div>
         
      <div class="form-group col-12">
         <label for="Maelezo">Descriptions</label>
         <textarea class="form-control" name="Maelezo" id="Maelezo" rows="4"></textarea>
      </div>
      <button type="submit" class="btn btn-primary pull-rght">Save</button>
   </div>
</form>
<br>
         
<?php include('footer.php');?>
<script>
$(document).ready(function(){
   $('.mode').hide();
   $('select[name=selling_mode]').on('change', function(){
      var selected_mode=$(this).val();
      var jumla=document.getElementById('jumla_id').value;
      var rejareja=document.getElementById('rejareja_id').value;
      if (selected_mode=='rejareja') {
        $('#Price').val(rejareja);
        calculate_amount();
      }
      if (selected_mode=='jumla') {
        $('#Price').val(jumla);
        calculate_amount();
      }
      $('.mode').show();   
   });
       //Allow number only input
   $('input[name=Price]').on('keypress', function(event){
      if(event.which<48 || event.which>57){
         event.preventDefault();
      }
  });
  $('input[name=Phone_number]').on('keypress', function(event){
    if(event.which<48 || event.which>57){
      event.preventDefault();
    }
  });
  $('input[name=Quantity_borrowed]').on('keypress', function(event){
    if(event.which<48 || event.which>57){
      event.preventDefault();
    }
  });
  // calculate total anount on each keypress
  $('input[name=Quantity_borrowed]').on('keyup', function(event){
      calculate_amount();
   });
   $('input[name=Price]').on('keyup', function(event){
      calculate_amount();
  });
  function calculate_amount(){
     var qntity=document.getElementById('Quantity_borrowed').value;
     var price=document.getElementById('Price').value;
     var amount=qntity*price;
     $('input[name=Amount_total]').val(amount);
  }
  $('.product_form').on("submit", function(){
      var Full_name= document.getElementById('Borrower').value;
		var Phone_number= document.getElementById('Phone_number').value;
     if (Full_name=="") {
        $('#Borrower_sms').text("Please enter borrower's full name");
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
      var data= $('.product_form').serialize();
      $.ajax({
         url:'<?php echo base_url();?>Welcome/Sell_product',
         method:'POST',
         data:data,
         success:function(){
            $('.product_form')[0].reset();
         }
      })
  });
});
</script>