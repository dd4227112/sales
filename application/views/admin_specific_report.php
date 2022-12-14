<?php include('admin_header.php');?>
 <!--Project Activity start-->
 <?php if($user!=NULL){?>
<div class="panel-body progress-panel">

                <div class="row">
                  <div class="col-lg-8 task-progress pull-left">
                    <h1>All products sold by <?php echo $user->Full_name. " on ".$date;?></h1>                   
                  </div>
                </div>
 <?php }?>
                <br>
                <!-- Reja reja -->
                <div class="row">
                  <div class="col-lg-8 task-progress pull-left">
                    <h1>Bei ya Reja Reja</h1>
                  </div>
                </div>
                <?php 
				    	if ($rejareja==NULL){
				    		echo '<h4 class="text-center text-success">No data found</h4><br>';
                      $rejareja_jumla=0;
				    	} 
				    	else{
                      ?>
            <table class="table table-hover product_list">
              <thead>
                <tr>
                  <th scope="col">Product Name</th>
                  <th scope="col"  class="text-center">Quantity sold</th>
                  <th scope="col"  class="text-center">Avaialable in stock</th>
                  <th scope="col"  class="text-center">Total Amount</th>
                  <th scope="col"  class="text-center"></th>
                </tr>
              </thead>
                <tbody><?php
                $rejareja_jumla=0;
				    		foreach($rejareja as $products):?>
                  <tr>
                    <td ><?php echo $products->Product_name." - ".$products->Product_description; ?></td>
                    <td class="text-center"><?php echo $products->Quantity; ?></td>
                    <td class="text-center"><?php echo $products->Quantity_left; ?></td>
                     <td class="text-center"><?php echo $products->Total; ?></td>
                     <td><a class="view_detail btn btn-success btn-sm" href="javascript:;" id="<?php echo $products->Product_id; ?>">More Details</a></td>
                     <?php $rejareja_jumla+=$products->Total;?>
                  </tr>
                <?php endforeach;?>
                <tr>
                <td colspan="2"></td>
                <td class="text-center">Total(Rejareja)Tsh.</td>
                <td class="text-center"><?php echo $rejareja_jumla."/=";?></td>
                <td class="text-center"></td>
                
                </tr>
                </tbody>
              </table>
              <?php }?>
              <br>
              <!-- Jumla -->
              <div class="row">
                  <div class="col-lg-8 task-progress pull-left">
                    <h1>Bei ya Jumla</h1>
                  </div>
                </div>
                <?php 
				    	if ($jumla==NULL){
				    		echo '<h4 class="text-center text-success">No data found</h4><br>';
                      $jumla_jumla=0;
				    	} 
				    	else{
                      ?>
            <table class="table table-hover product_list">
              <thead>
                <tr>
                  <th scope="col" >Product Name</th>
                  <th scope="col"  class="text-center">Quantity sold</th>
                  <th scope="col"  class="text-center">Avaialable in stock</th>
                  <th scope="col"  class="text-center">Total Amount</th>
                </tr>
              </thead>
                <tbody><?php
                $jumla_jumla=0;
				    		foreach($jumla as $products):?>
                  <tr>
                    <td><?php echo $products->Product_name." - ".$products->Product_description; ?></td>
                    <td class="text-center"><?php echo $products->Quantity; ?></td>
                    <td class="text-center"><?php echo $products->Quantity_left; ?></td>
                     <td class="text-center"><?php echo $products->Total; ?></td>
                     <td><a class="view_details btn btn-success btn-sm" href="javascript:;" id="<?php echo $products->Product_id; ?>">More Details</a></td>
                  </tr>
                  <?php $jumla_jumla+=$products->Total;?>
                <?php endforeach;?>
                <tr>
                <td colspan="2"></td>
                <td class="text-center">Total(Jumla)Tsh.</td>
                <td class="text-center"><?php echo $jumla_jumla."/=";?></td>
                <td class="text-center"></td>
                </tr>
                </tbody>
                </table>
                <?php } ?>
                <!-- Other service report -->
                <div class="row">
                  <div class="col-lg-8 task-progress pull-left">
                    <h1>Other service Report</h1>
                  </div>
                </div>
                <?php 
				    	if ($service_report==NULL){
				    	echo '<h4 class="text-center text-success">No data found</h4><br>';
                      $costs=0;
				    	} 
				    	else{
                      ?>
            <table class="table table-hover product_list">
              <thead>
                <tr>
                  <th scope="col" >Product Name</th>
                  <th scope="col"  class="text-center">Quantity</th>
                  <th scope="col"  class="text-center">Given to </th>
                  <th scope="col"  class="text-center">Phone number </th>
                  <th scope="col"  class="text-center">Reasons </th>
                  <th scope="col"  class="text-center">Total Costs</th>
                </tr>
              </thead>
                <tbody><?php
                $costs=0;
				    		foreach($service_report as $serice):?>
                  <tr>
                    <td><?php echo $serice->Product_name." - ".$serice->Product_description; ?></td>                   
                    <td class="text-center"><?php echo $serice->Quantity; ?></td>
                    <td class="text-center"><?php echo $serice->Full_name; ?></td>
                    <td class="text-center"><?php echo $serice->Phone_number; ?></td>
                    <td class="text-center"><?php echo $serice->Reason; ?></td>
                     <td class="text-center"><?php echo $serice->Amount; ?></td>
                  </tr>
                  <?php $costs+=$serice->Amount;?>
                <?php endforeach;?>
                <tr>
                <td colspan="4"></td>
                <td class="text-center">Service cost(total)Tsh.</td>
                <td class="text-center"><?php echo $costs."/=";?></td>
                </tr>
                </tbody>
                </table>
                <?php }?>
                <br>
                                <!-- Mkopo -->
                <div class="row">
                  <div class="col-lg-8 task-progress pull-left">
                    <h1>Madeni</h1>
                  </div>
                </div>
                <?php 
              if ($madeni==NULL){
              echo '<h4 class="text-center text-success">No data found</h4><br>';
                      $madeni_jumla=0;
              } 
              else{
                      ?>
            <table class="table table-hover product_list">
              <thead>
                <tr>
                  <!-- <th scope="col"  class="text-center">No.</th> -->
                  <th scope="col"  class="text-center">Borrower's name</th>
                  <th scope="col"  class="text-center">Phone number</th>
                  <th scope="col">Product Name</th>
                  <th scope="col"  class="text-center">Quantity</th>
                  <th scope="col"  class="text-center">Mode</th>
                  <th scope="col"  class="text-center">Total</th>
                  <th scope="col"  class="text-center">Payed</th>
                  <th scope="col"  class="text-center">Left</th>
                  <th scope="col"  class="text-center">Description</th>
                </tr>
                
              </thead>
                <tbody><?php
                $madeni_jumla=0;
                foreach($madeni as $deni):?>
                  <tr>
                    <!-- <td  class="text-center"><?php // echo $deni->Product_id; ?></td> -->
                    <td class="text-center"><?php echo $deni->Borrower; ?></td>
                    <td class="text-center"><?php echo $deni->Phone_number; ?></td>
                    <td><?php echo $deni->Product_name." - ".$deni->Product_description; ?></td>
                    <td class="text-center"><?php echo $deni->Quantity_borrowed; ?></td>
                    <td class="text-center"><?php echo $deni->Mode; ?></td>
                     <td class="text-center"><?php echo $deni->Amount_total; ?></td>
                     <td class="text-center"><?php echo $deni->Amount_payed; ?></td>
                     <td class="text-center"><?php echo $deni->Amount_left; ?></td>
                     <td class="text-center"><?php echo $deni->Maelezo; ?></td>
                     <?php $madeni_jumla+=$deni->Amount_left;?>
                  </tr>
                <?php endforeach; ?>
                <tr>
                <td colspan="5"></td>
                <td class="text-center">Total(Madeni)Tsh.</td>
                <td class="text-center"><?php echo $madeni_jumla."/=";?></td>
                <td></td>
                <td></td>
                </tr>
                </tbody>
              </table>
              <?php }?>
                            <!-- Credit payed today -->
                              <div class="row">
                  <div class="col-lg-6 task-progress pull-left">
                    <h1 class="bg-success">Credit payed today is 
                    <?php 
              if ($payed_credit==NULL OR $payed_credit->payed<=0){
                echo '<h4 class="text-center text-success">No data found</h4><br>';
              } 
              else{
                echo  number_format($payed_credit->payed, 2)."/=</h1>";
                      ?>
                  </div>
                  <div class="col-lg-6 task-progress pull-left">
                   <button class="btn btn-sm btn-primary viewpay">View credit payed</button>
                  </div>
                </div>
              <?php } ?>
              <br>
                    <?php
                if(($rejareja_jumla+$jumla_jumla+$costs)>0){ ?>
                <br>
                <div class="row">
                  <div class="col-lg-8 task-progress pull-left">
                  <h1>Total today's sales+ credit payed <?php echo number_format($rejareja_jumla+$jumla_jumla+$payed_credit->payed ,2) ;?>/=</h1>
                    <h1>Total today's sales + Other service costs + credits  <?php echo number_format($rejareja_jumla+$jumla_jumla+$costs+$madeni_jumla+$payed_credit->payed ,2);?>/=</h1>
                 </div>
                </div>
                <br>
                <br>
                <div class="row">
                <div class="col-md-12">
                <?php echo form_open('Welcome/Print_specific', ['class'=>'print']);?>
                <input type="hidden" id="date" name="Date" value="<?php echo $date;?>">
                <!-- <input type="submit" class="btn btn-success btn-sm" value="Print "> -->
               </form>
                </div>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header">
                    <h4 style="text-transform:uppercase;"> Sale Details</h4>
                  </div>
                  <div class="modal-body">
                    <table class="table table-hover">
                      <thead class="thead">
                        <tr>
                          <th scope="col">No.</th>
                          <th scope="col">Product name</th>
                          <th scope="col">Quantity sold</th>
                          <th scope="col">Price</th>
                          <th scope="col">Total</th>
                          <th scope="col">Description</th>
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
<div class="modal fade" id="viewtodaypayment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h4 style="text-transform:uppercase;"> credit payed info</h4>
      </div>
        <div class="modal-body">
          <table class="table table-hover">
            <thead class="thead">
              <tr>
                <th scope="col">Borrower</th>
                <th scope="col">Phone number</th>               
                <th scope="col">Product name</th>
                <th scope="col">Amount payed(Tsh)</th>

              </tr>
            </thead>
            <tbody>
              <?php
              if($deni_leo==NULL){
                echo'<tr>

                      <td class="text-center"></td>
                      <td class="text-center">No data found</td>
                      <td class="text-center"></td>
                <td class="text-center"></td>
                  </tr>';
              }else{
                $leo_total=0;
            foreach($deni_leo as $leo):?>
                    <tr>
                      <td class="text-center"><?php echo $leo->Borrower; ?></td>
                      <td class="text-center"><?php echo $leo->Phone_number; ?></td>
                      <td><?php echo $leo->Product_name." - ".$leo->Product_description; ?></td>
            <td class="text-center"><?php echo number_format($leo->Amount_payed,2); ?>/=</td>
            <?php $leo_total+=$leo->Amount_payed;?>
                  </tr>
                  <?php endforeach; } ?>
                  <tr><td></td><td colspan="2" class="text-success"><b>Total</b></td><td class="text-center text-success"><b><?php echo number_format($leo_total, 2); ?>/=</b></td></tr>
            </tbody>
          </table>
        </div> 
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
<?php } include('admin_footer.php');?>
<script>
    $(document).ready(function(){
    // get detail for rejareja sales
    $('.view_detail').on("click", function(){     
      var id=$(this).attr("id");
      var date=document.getElementById('date').value;
        $.ajax({
        method: 'get',
        url: '<?php echo base_url();?>index.php/Welcome/getsalesdetailrejareja_specific',
        data: {id:id, date:date},
        async:'false',
        dataType:'json',
          success:function(data){
          var html="";
          for (var i =0; i<data.length; i++){
          html+='<tr>'+
          '<td>'+data[i].Product_id+'</td>'+
          '<td>'+data[i].Product_name+'-'+data[i].Product_description+'</td>'+
          '<td>'+data[i].Quantity+'</td>'+
          '<td>'+data[i].Price+'</td>'+
          '<td>'+data[i].Total+'</td>'+
          '<td>'+data[i].Description+'</td>'+
          '</tr>';
          }
          $('.output').html(html);
          $('#exampleModal').modal("show");
        }
      });
    });
    $('.viewpay').on("click", function(){
    	$('#viewtodaypayment').modal("show");
    });

    // get detail for jumla sales

    $('.view_details').on("click", function(){     
      var id=$(this).attr("id");
      var date=document.getElementById('date').value;
        $.ajax({
        method: 'get',
        url: '<?php echo base_url();?>index.php/Welcome/getsalesdetailjumla_specific',
        data: {id:id, date:date},
        async:'false',
        dataType:'json',
          success:function(data){
          var html="";
          for (var i =0; i<data.length; i++){
          html+='<tr>'+
          '<td>'+data[i].Product_id+'</td>'+
          '<td>'+data[i].Product_name+'-'+data[i].Product_description+'</td>'+
          '<td>'+data[i].Quantity+'</td>'+
          '<td>'+data[i].Price+'</td>'+
          '<td>'+data[i].Total+'</td>'+
          '<td>'+data[i].Description+'</td>'+
          '</tr>';
          }
          $('.output').html(html);
          $('#exampleModal').modal("show");
        }
      });
      
    });
  });
</script>                
