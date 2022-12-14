<?php include('header.php');?>

<div class="panel-body progress-panel">
   <div class="row">
      <div class="col-lg-8 task-progress pull-left">
         <h1><?php echo "All incomplete credits"; ?></h1>
      </div>
   </div>
</div>
<br>
                <?php 
				    	if ($madeni==NULL){
                echo '<h4 class="text-center text-success">No data found</h4><br>';
                      $madeni_jumla=0;
				    	} 
				    	else{
                      ?>
            <table class="table table-hover mkopo_list">
              <thead>
                <tr>
                  <th scope="col"  class="text-center">Borrower's name</th>
                  <th scope="col"  class="text-center">Phone number</th>
                  <th scope="col">Product Name</th>
                  <th scope="col"  class="text-center">Quantity</th>
                  <th scope="col"  class="text-center">Mode</th>
                  <th scope="col"  class="text-center">Date</th>
                  <th scope="col"  class="text-center">Total</th>
                  <th scope="col"  class="text-center">Payed</th>
                  <th scope="col"  class="text-center">Left</th>
                  <th scope="col"  class="text-center">Description</th>
                  <th scope="col"  class="text-center"></th>
                  <th scope="col"  class="text-center"></th>
                </tr>               
              </thead>
                <tbody><?php
                $madeni_jumla=0;
                $NO=1;
				    	foreach($madeni as $deni):?>
                  <tr>
                    <td class="text-center"><?php echo $deni->Borrower; ?></td>
                    <td class="text-center"><?php echo $deni->Phone_number; ?></td>
                    <td><?php echo $deni->Product_name." - ".$deni->Product_description; ?></td>
                    <td class="text-center"><?php echo $deni->Quantity_borrowed; ?></td>
                    <td class="text-center"><?php echo $deni->Mode; ?></td>
                    <td class="text-center"><?php echo $deni->Borrowing_date; ?></td>
                     <td class="text-center"><?php echo $deni->Amount_total; ?></td>
                     <td class="text-center"><?php echo $deni->Amount_payed; ?></td>
                     <td class="text-center"><?php echo $deni->Amount_left; ?></td>
                     <td class="text-center"><?php echo $deni->Maelezo; ?></td>                    
                     <?php
                     $NO++;
                      $madeni_jumla+=$deni->Amount_left;?>
                     <td><a class="lipa_deni btn btn-success btn-sm" href="javascript:;" id="<?php  echo $deni->credit_id; ?>">Pay</a></td>
                     <td><a class="track_deni btn btn-primary btn-sm" href="javascript:;" id="<?php  echo $deni->credit_id; ?>">Track Payment</a></td>
                  </tr>
                <?php endforeach; ?>             
                <tr>
                  <td class="text-primary">Total(Madeni)Tsh.</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td  class="text-primary"><?php echo number_format($madeni_jumla ,2) ."/=";?></td>
                  <td></td>
                  <td></td>
                </tr>
                </tbody>
              </table>
              <?php }?>
              <!-- Payment Modal -->
               <div class="modal fade" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Loan payment</h5>
                        </div>
                        <div class="modal-body">
                        <?php echo form_open('Welcome/payloan', ['id'=>'loanpay', 'method'=>'POST']);?>
                           <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-6">                  
                                 <input type="text" name="Borrower" class="form-control" id="Borrower" readonly>	
                                    </div>
                                    <div class="col-md-6">
                                       <input type="text" name="Phone_number" class="form-control" id="Phone_number" readonly>
                                    <input type="hidden" id="credit_id" name="credit_id">
                                    <input type="hidden" id="left" name="left">

                                    
                                 </div>
                                 </div>
                              </div>
                           <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-6">
                                       <input type="text" name="Product_name" readonly class="form-control" id="Product_name">
                                 </div>
                                    <div class="col-md-6">
                                    <input type="text" name="Amount_left" readonly class="form-control" id="Amount_left">
                                    </div>
                              </div>
                           </div>
                        <div class="form-group">
                              <div class="row">
                                 <div class="col-md-12">
                                       <label for="Payable_amount" class="col-form-label">Paying Amount</label>
                                       <input type="text" name="Payable_amount" class="form-control" id="Payable_amount">
                                       <span id="Payable_amount_sms" class="text-danger"></span>
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
               <!-- Track payment modal -->
               <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header">
                    <h4 style="text-transform:uppercase;"> Payment info</h4>
                  </div>
                  <div class="modal-body">
                    <table class="table table-hover">
                      <thead class="thead">
                        <tr>
                          <th scope="col">Product name</th>
                          <th scope="col">Date</th>
                          <th scope="col">Amount payed</th>
                          <!-- <th scope="col">Total</th>
                          <th scope="col">Description</th> -->
                       </tr>
                      </thead>
                      <tbody class="output">
                      </tbody>
                    </table>
                  </div> 
                  <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                  </div>
                  </div>
                  </div>
              </div>
<?php include('footer.php');?>
<script>
  $(document).ready(function(){
    //get loan details
      $(".lipa_deni").click(function(){	
         var id=$(this).attr('id');
         $('#studentModal').modal("show");
         $('#studentModal').find('.modal-title').text("Loan Payment").addClass('text-success');
         $.ajax({
            method: 'get',
            url: '<?php echo base_url();?>index.php/Welcome/getloandata',
            data: {id:id},
            async:'false',
            dataType:'json',
               success:function(data){
               $('input[name=credit_id]').val(data.credit_id);
               $('input[name=Borrower]').val(data.Borrower);
                  $('input[name=Phone_number]').val(data.Phone_number);
               $('input[name=Product_name]').val(data.Product_name +"-"+data.Product_description);
               $('input[name=Amount_left]').val("Amount left  "+data.Amount_left+"/=");
               $('input[name=left]').val(data.Amount_left);  

            },
            error:function(){
               alert("Could not edit employee");
            }
         });
      });
      $('input[name=Payable_amount]').on('keypress', function(event){
         if(event.which<48 || event.which>57){
            event.preventDefault();
         }
      });
      $('#loanpay').on('submit', function(){
         var left=document.getElementById('left').value;
         var payable=document.getElementById('Payable_amount').value;
         if (left-payable<0) {
            $('#Payable_amount_sms').text("You entered larger amount than left amount");
            return false;
         }
         if (payable<=0) {
            $('#Payable_amount_sms').text("Invalid amount entered");
            return false;
         }
      });
      $('.track_deni').on("click", function(){     
         var id=$(this).attr("id");
         // var date=document.getElementById('date').value;
         $.ajax({
            method: 'get',
            url: '<?php echo base_url();?>index.php/Welcome/getpaymentdetails',
            // data: {id:id, date:date},
            data: {id:id},
            async:'false',
            dataType:'json',
            success:function(data){
               var html="";
               var total=0;
               for (var i =0; i<data.length; i++){
                  html+='<tr>'+
                  '<td>'+data[i].Product_name+'-'+data[i].Product_description+'</td>'+
                  '<td>'+data[i].date+'</td>'+
                  '<td>'+data[i].Amount_payed+'/=</td>'+
                  '</tr>';
                  total=total+Number(data[i].Amount_payed);
               }
               html+='<tr><td>Total payed</td><td></td><td>' +total+ '/=</td></tr>';
               $('.output').html(html);
               $('#exampleModal').modal("show");
            }
         });  
      });
   });
</script>