</section>
</div>
        </div>

      </section>
    </section>
</section>
<!-- Modal -->
<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Select date to view report</h5>
      </div>
      <div class="modal-body">
       <?php echo form_open("Admin_home/Report", ['class'=>'form_report', 'method'=>'POST']);?>
          <div class="form-group">
            <label for="date_report" class="col-form-label">Enter date</label>
            <input type="date" class="form-control" name="date_report" id="date_report" required>
          </div>
          <div>
            <input type="submit" value="View Report" class=" btn btn-sm btn-info">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
    </div>
</div>
    <div class="modal fade" id="durationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Select date interval to view report</h5>
      </div>
      <div class="modal-body">
       <?php echo form_open("Admin_home/Duration", ['class'=>'interval_report', 'method'=>'POST']);?>
      <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label for="date_report" class="col-form-label">From</label>
                <input type="date" class="form-control" required name="date1" id="date1">
          </div>
          <div class="col-md-6">
            <label for="date_report" class="col-form-label">To</label>
            <input type="date" class="form-control" name="date2" required  id="date2">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <span class="text-danger text-center" id="notification"></span>
        </div>
      </div>
      <div>
        <input type="submit" value="View Report" class=" btn btn-sm btn-info">
      </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>
</body>
</html>
<script>
 $(document).ready(function () {
  $('.specific_report').click(function(){
    $('#reportModal').modal("show");
  });
    $('.duration_report').click(function(){
    $('#durationModal').modal("show");
  });
  $('.interval_report').on('submit', function(){
    var date1=document.getElementById('date1').value;
    var date2=document.getElementById('date2').value;
    if (date1==date2) {
       $('#notification').text("The date can't be the same");
      return false;
    }
    if (date1>=date2) {
      $('#notification').text("Incorrect date choosen");
      return false;
    }


  });
});
</script>
