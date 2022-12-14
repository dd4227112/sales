<?php include('admin_header.php');?>
 <!--Project Activity start-->
 <div class="panel-body progress-panel">
            <div class="row">
              <div class="col-lg-10 task-progress pull-left">
                <h1>All product available in stock</h1>
              </div>
            </div>
          </div>     
            <?php 
          if ($all_products==NULL){
            echo '
            <h4 class="text-center text-success">No Product Available</h4>';
          } 
          else{?>
               <table class="table table-hover table-border" id="Available">
          <thead>
            <tr>
              <th scope="col">No.</th>
              <th scope="col">Product Name</th>
              <th scope="col">Quantity</th>
              <th scope="col">Avaialable in stock</th>
              <th scope="col">Price-jumla(Tsh)</th>
              <th scope="col">Stock after sale @item Price-jumla(Tsh)</th>
              <th scope="col">Price-rejareja(Tsh)</th>
              <th scope="col">Stock after sale @item Price-rejareja</th>
            </tr>
          </thead>
            <tbody>
          <?php
             $tolal_jumla=0;
             $tolal_rejareja=0;
             $No=1;
            foreach($all_products as $products):?>
              <tr>
                <td><?php echo $No; ?></td>
                <td><?php echo $products->Product_name." - ".$products->Product_description; ?></td>
                <td class="text-center"><?php echo $products->Quantity_total; ?></td>
                <td class="text-center"><?php echo $products->Quantity_left; ?></td>
                <td class="text-center"><?php echo $products->Cost_total ."/= "; ?></td>
                <td class="text-center"><?php echo $products->Cost_total *$products->Quantity_total."/= "; ?></td>
                <td class="text-center"><?php echo $products->Cost_single."/= "; ?></td>  
                <td class="text-center"><?php echo $products->Cost_single *$products->Quantity_total."/= "; ?></td>
              </tr>
            <?php
         $tolal_jumla+=($products->Cost_total *$products->Quantity_total);
         $tolal_rejareja+=($products->Cost_single *$products->Quantity_total);
         $No++;
         endforeach;} ?>
            <tr>
                <td class="text-success">Totals</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="text-center"><?php echo $tolal_jumla."  /="?></td>
                <td></td>
                <td class="text-center"><?php echo $tolal_rejareja."  /="?></td>
              </tr>
            </tbody>
          </table>
        
<?php include('admin_footer.php');?>
<script>

  $(document).ready(function(){
    $('#Available').DataTable({
    "paging":true
    });
  });
</script>