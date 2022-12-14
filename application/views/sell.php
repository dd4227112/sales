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

<?php echo form_open("Welcome/Sell_product", ['class'=>'product_form','method'=>'POST']);?>
   <div class="form-group col-md-12">
      <label for="select_mode">Select selling mode</label>
      <select  id="select_mode" name="selling_mode" class="form-control form-control-lg">
      <option >...........</option>                     
         <option value="jumla">Jumla</option>
         <option value="rejareja">Reja reja</option>
      </select>
   </div>
   <br/>
   <div class="container mode">
         <div class="form-group col-6">
            <label for="Quantity">Quantiy</label>
            <input type="text" class="form-control" name="Quantity" value="1" id="Quantity" placeholder="Quantity">
            <span class="text-danger" id="note"></span>
         </div>
         <div class="form-group col-6">
            <label for="Price">Price</label>
            <input type="text" value=""  name="Price" class="form-control" id="Price" placeholder="Price">
         </div>
         <div class="form-group col-6">
            <label for="Total">Total Amount</label>
            <input type="text" readonly value="0" name="Total" class="form-control" id="Total">  
            <input type="hidden" readonly value="<?php echo $products->Product_id ;?>" name="Product_id" id="Product_id" class="form-control">
            <input type="hidden" readonly value="<?php echo $products->Quantity_left ;?>" name="left" id="left" class="form-control">
         </div>
      <div class="form-group col-12">
         <label for="desciription">Descriptions</label>
         <textarea class="form-control" name="Description" id="desciription" rows="4"></textarea>
      </div>
      <button type="submit" class="btn btn-primary pull-rght">Save</button>
   </div>
</form>
         
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
  $('input[name=Quantity]').on('keypress', function(event){
    if(event.which<48 || event.which>57){
      event.preventDefault();
    }
  });
  // calculate total anount
  $('input[name=Quantity]').on('keyup', function(event){
      calculate_amount();
   });
   $('input[name=Price]').on('keyup', function(event){
      calculate_amount();
  });
  function calculate_amount(){
     var qntity=document.getElementById('Quantity').value;
     var price=document.getElementById('Price').value;
     var amount=qntity*price;
     $('input[name=Total]').val(amount);
  }
  $('.product_form').on("submit", function(){
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