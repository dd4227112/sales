<?php include('admin_header.php');?>
<div class="panel-body progress-panel">
            <div class="row">
              <div class="col-lg-10 task-progress pull-left">
                <h1>Add new Asset</h1>
              </div>
            </div>
          </div>
          <br>
          <!-- form start-->
          <?php echo form_open("Admin_home/Save_Asset", ['class'=>'save_asset container', 'method'=>'POST']);?>
	          <div class="form-group">
		          	<div class="row">
		          		<div class="col-md-6">
			          		<label for="Asset_name" class="col-form-label">Asset name</label>
				            <input type="text" name="Asset_name" class="form-control" id="Asset_name">
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
           <br>
          <!--form end -->
<?php include('admin_footer.php');?>
<script>
   $(document).ready(function(){
      $('input[name=Costs]').on('keypress', function(event){
         if(event.which<48 || event.which>57){
            event.preventDefault();
         }
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
   });
</script>