<?php include('header.php');?>
<div class="row">
  <div class="col-md-1"></div>
  <div class="col-md-10">
    <?php echo form_open("Welcome/Save_Service", ['class'=>'service_form', 'method'=>'POST'])?>
      <div class="form-group">
        <label for="Product">Select Product</label>
        <select class="form-control" name="Product_id" id="Product">
           <option value="" >select....</option>
           <?php 
           foreach($all_products as $products):?>
           <option value="<?php echo $products->Product_id; ?>"><?php echo $products->Product_name;?>-<?php echo $products->Product_description; ?></option>
           <?php endforeach;?>     
        </select>
        <span id="Product_alert" class="text-danger"></span> 
      </div>

      <div class="form-group">
        <label for="Quantity">Quantity</label>
        <input type="text" class="form-control" name="Quantity" id="Quantity">
        <span id="Quantity_alert" class="text-danger"></span>      
      </div>
      
      <div class="form-group">
        <label for="Full_name">Full name</label> 
        <input type="text" class="form-control" id="Full_name" name="Full_name" >
        <span id="Full_name_alert" class="text-danger"></span>   
      </div>

      <div class="form-group">
        <label for="Phone_number">Phone number</label> 
        <input type="text"  class="form-control" name="Phone_number" id="Phone_number">
        <span id="Phone_number_alert" class="text-danger"></span>     
      </div>
        
      <div class="form-group">
        <label for="Reason">Describe reason</label>
        <textarea class="form-control" id="Reason" name="Reason" rows="3"></textarea>
        <span id="Reason_alert" class="text-danger"></span>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-sm btn-info">Save</button>
      </div>
    </form>
  </div>
   <div class="col-md-1"></div>
</div>
<br>
<?php include('footer.php');?>
<script>
  $(document).ready(function(){
    $('input[name=Quantity]').on('keypress', function(event){
      if(event.which<48 || event.which>57){
        event.preventDefault();
      }
    });
    $('input[name=Phone_number]').on('keypress', function(event){
      if(event.which<48 || event.which>57){
        event.preventDefault();
      }
    });
    $('.service_form').on('submit', function(){
      var qntty=document.getElementById('Quantity').value;
      var name=document.getElementById('Full_name').value;
      var phone=document.getElementById('Phone_number').value;
      var reasn=document.getElementById('Reason').value;
      var product=document.getElementById('Product').value;
      if(product==""){
        $('#Product_alert').text('Please select product');
        return false;
      }
      if(qntty==""){
        $('#Quantity_alert').text('Enter the number of products');
        return false;
      }
      if(name==""){
        $('#Full_name_alert').text('Enter full name');
        return false;
      }
      if(phone!="" && phone.length!=10){
        $('#Phone_number_alert').text('Enter  10 digits');
        return false;
      }
      if (phone!="" && (phone.indexOf('0')!=0 &&(phone.indexOf('1')!=6 || phone.indexOf('1')!=7))){
          document.getElementById('Phone_number_alert').innerHTML="Wrong phone number format, must start with 07 or 06";
          return false;
        }
      if(reasn==""){
        $('#Reason_alert').text('Please enter descriptions');
        return false;
      }
      
    
    
    });
  });

</script>