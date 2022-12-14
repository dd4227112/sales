<?php if($this->session->userdata('id') == NULL) {
?>
<script type="text/javascript">
  window.location.href="<?=base_url()?>";
  alert("Please login");
</script>
<?php } 
$expire=$this->db->query('SELECT Expire_date FROM system_confg')->row();
$expire_date=$expire->Expire_date;
if(date('Y-m-d')>$expire_date) {
?>
<script type="text/javascript">
  alert("The system has expired.... Contact  system developer 0743414770 or 0710097797");
  window.location.href="<?=base_url()?>";
</script>
<?php } 
$access=$this->db->query('SELECT Access FROM system_confg')->row();
if ($access->Access=="No") {
  ?>
  <script type="text/javascript">
    window.location.href="<?=base_url()?>index.php/Welcome/Access";
  </script>
<?php } ?>