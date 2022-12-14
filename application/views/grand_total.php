<?php include('admin_header.php');?>
<div class="row" height="3000px">
   <div class="col-lg-12 task-progress">
      <h2 class="text-center">DASHBOARD</h2>
   </div>
</div>

<div class="row">
          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="info-box green-bg">
              <!-- <i class=""></i> -->
              <div class="count"><?php echo  number_format($sum_rejareja->rejareja, 2);?>/=</div>
              <div class="title"><h4>Products(rejareja)'s costs</h4></div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="info-box blue-bg">
              <!-- <i class=""></i> -->
              <div class="count"><?php echo number_format( $sum_jumla->jumla,2);?>/=</div>
              <div class="title"><h4>Products(jumla)'s costs</h4></div>
            </div>
          </div>

          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="info-box green-bg">
              <!-- <i class=""></i> -->
              <div class="count"><?php  echo number_format( $sum->SUM,2);?>/=</div>
              <div class="title"><h4>Asstes's costs</h4></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
            <div class="info-box dark-bg">
              <div class="count"><?php echo  number_format($sum_rejareja->rejareja+$sum->SUM, 2);?>/=</div>
              <div class="title"><h3>Grand total(rejareja)</h3></div>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="info-box dark-bg">
              <div class="count"><?php echo  number_format($sum_jumla->jumla+$sum->SUM, 2);?>/=</div>
              <div class="title"><h3>Grand total(jumla)</h3></div>
            </div>
          </div>
</div>
<div class="row">
  <div class="col-md-1">
  </div>
  <!-- <div class="col-md-11" >
    <a href="Print_total" class="btn btn-sm btn-success">Print</a>
  </div> -->
</div>
<br>
<?php include('admin_footer.php');?>