<?php include('header.php');?>
        <!--Project Activity start-->
          <div class="panel-body progress-panel">
            <div class="row">
              <div class="col-lg-8 task-progress pull-left">
                <h1>All available products</h1>
              </div>
            </div>
          </div>
          <table class="table table-hover" id="dataTables-example">
          <thead>
            <tr>
              <th scope="col">No.</th>
              <th scope="col">Product Name</th>
              <th scope="col">Quantity</th>
              <th scope="col">Avaialable in stock</th>
              <th scope="col">Price-jumla(Tsh)</th>
              <th scope="col">Price-rejareja(Tsh)</th>
              <th scope="col"></th>
              <th scope="col">Action</th>
            </tr>
          </thead>
            <tbody>
            <?php 
          if ($all_products==NULL){
            echo '<tr>
            <td class="text-center text-success" colspan="10">No Product Available</td>
            </tr>';
          } 
          else{
		  $number=1;
            foreach($all_products as $products):?>
			
              <tr>
                <td><?php echo $number; ?></td>
                <td><?php echo $products->Product_name." - ".$products->Product_description; ?></td>
                <td class="text-center"><?php echo $products->Quantity_total; ?></td>
                <td class="text-center"><?php echo $products->Quantity_left; ?></td>
                <td class="text-center"><?php echo $products->Cost_total ."/= "; ?></td>
                <td class="text-center"><?php echo $products->Cost_single."/= "; ?></td>  
                <?php if($products->Quantity_left!=0){?>
                  <td><?php echo anchor("Welcome/sell/{$products->Product_id}", "sell",['class'=>'btn btn-sm btn-info']); ?></td>
                  <td><?php  echo anchor("Welcome/loan/{$products->Product_id}", "borrow",['class'=>'btn btn-sm btn-success']); ?></td>
                <?php }
                else{
                  echo'<td></td><td></td>';
                }?>           
              </tr>
			  
            <?php
			$number++;
			endforeach;} ?>
            </tbody>
          </table>
        
        <!--Project Activity end-->
<!--main content end-->
<?php include('footer.php');?>
