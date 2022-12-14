<?php include('admin_header.php');?>

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
                  <td  class="text-primary"><?php echo number_format($madeni_jumla ,2) ."/=";?></td>
                  <td></td>
                  <td></td>
                </tr>
                </tbody>
              </table>
              <?php }?>           
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
<?php include('admin_footer.php');?>
<script>
  $(document).ready(function(){
    $('.mkopo_list').DataTable();
      $('.mkopo_list').on('click','.track_deni',function (event) {   
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