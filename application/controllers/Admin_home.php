<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_home extends CI_Controller{
   public function __construct(){
      parent:: __construct();
      error_reporting(0);
      // Load model
      $this->load->model('Admin');
      $this->load->model('Product');
      // $this->load->library('pdf');
		date_default_timezone_set("Africa/Dar_es_Salaam");
   }
   public function index(){
      $data['sum']=$this->db->query('Select SUM(Costs) AS SUM FROM assets')->row();
      $data['sum_rejareja']=$this->db->query('SELECT SUM(Quantity_left*Cost_single) AS rejareja FROM product')->row();
      $data['sum_jumla']=$this->db->query('SELECT SUM(Quantity_left*Cost_total) AS jumla FROM product')->row();
      $this->load->view('grand_total', $data);
   }
   public function AllProduct(){
      $data['all_products']=$this->Product->fetchAllProduct();
      $this->load->view('admin_home', $data);
   }
   public function Available(){
      $data['all_products']=$this->Admin->fetchAvailableProduct();
      $this->load->view('availableproduct', $data);
   }
   public function Missing(){
      $data['all_products']=$this->Admin->fetchmissingProduct();
      $this->load->view('outofstock', $data);
   }
   public function Today_report(){
      $date=date('Y-m-d');
      $data['rejareja']=$this->Product->FetchTodaySaleRejareja($date);
      $data['jumla']=$this->Product->FetchTodaySaleJumla($date);
      $data['service_report']=$this->db->query('SELECT S.service_id, P.Product_id, P.Product_name, P.Product_description, S.Quantity, S.Full_name, S.Phone_number, S.Reason, S.Amount, S.Date FROM product P, service S WHERE S.Product_id=P.Product_id AND S.Date="'.$date.'"')->result();
      $data['user']=$this->db->query('SELECT U.Full_name, U.User_id, S.User_id, S.Date FROM user U, sales S WHERE U.User_id=S.User_id AND S.Date="'.$date.'" GROUP BY S.User_id')->row();
      $data['madeni']=$this->db->query('SELECT c.Product_id, c.credit_id, c.Borrower, c.Phone_number, c.Mode, c.Quantity_borrowed, c.Amount_total, c.Amount_payed, c.Amount_left, c.Maelezo, P.Product_name, P.Product_description FROM credits c, product P WHERE  c.Product_id=P.Product_id AND Borrowing_date="'.$date.'"')->result();
      $data['payed_credit']=$this->db->query('SELECT sum(Amount_payed) as payed FROM loandetails WHERE date LIKE "'.$date.'%"')->row();
      $data['deni_leo']=$this->Product->loandatatoday($date);
      $this->load->view('admin_today_report',$data);
   }
  
      public function Report(){
      $date=$this->input->post('date_report');
      $data['rejareja']=$this->Product->FetchTodaySaleRejareja($date);
      $data['jumla']=$this->Product->FetchTodaySaleJumla($date);
      $data['service_report']=$this->db->query('SELECT S.service_id, P.Product_id, P.Product_name, P.Product_description, S.Quantity, S.Full_name, S.Phone_number, S.Reason, S.Amount, S.Date FROM product P, service S WHERE S.Product_id=P.Product_id AND S.Date="'.$date.'"')->result();
      $data['user']=$this->db->query('SELECT U.Full_name, U.User_id, S.User_id, S.Date FROM user U, sales S WHERE U.User_id=S.User_id AND S.Date="'.$date.'" GROUP BY S.User_id')->row();
      $data['madeni']=$this->db->query('SELECT c.Product_id, c.credit_id, c.Borrower, c.Phone_number, c.Mode, c.Quantity_borrowed, c.Amount_total, c.Amount_payed, c.Amount_left, c.Maelezo, P.Product_name, P.Product_description FROM credits c, product P WHERE  c.Product_id=P.Product_id AND Borrowing_date="'.$date.'"')->result();
      $data['payed_credit']=$this->db->query('SELECT sum(Amount_payed) as payed FROM loandetails WHERE date LIKE "'.$date.'%"')->row();
      $data['deni_leo']=$this->Product->loandatatoday($date);
      $data['date']=$this->input->post('date_report');
      $this->load->view('admin_specific_report', $data);
      }
      public function Duration(){ 
      $date1=$this->input->post('date1');
      $date2=$this->input->post('date2');
      $data['rejareja']=$this->Product->FetchDurationSaleRejareja($date1, $date2);
      $data['jumla']=$this->Product->FetchDurationSalejumla($date1, $date2);
      $data['service_report']=$this->db->query('SELECT S.service_id, P.Product_id, P.Product_name, P.Product_description, S.Quantity, S.Full_name, S.Phone_number, S.Reason, S.Amount, S.Date FROM product P, service S WHERE S.Product_id=P.Product_id AND S.Date BETWEEN "'.$date1.'" AND "'.$date2.'"')->result();
      $data['madeni']=$this->db->query('SELECT c.Product_id, c.credit_id, c.Borrower, c.Phone_number, c.Mode, c.Quantity_borrowed, c.Amount_total, c.Amount_payed, c.Amount_left, c.Maelezo, P.Product_name, c.Borrowing_date, P.Product_description FROM credits c, product P WHERE  c.Product_id=P.Product_id AND c.Status="Incomplete" AND c.Borrowing_date BETWEEN "'.$date1.'" AND "'.$date2.'"')->result();
      $data['payed_credit']=$this->db->query('SELECT sum(Amount_payed) as payed FROM loandetails WHERE date >="'.$date1.'" AND date <= "'.$date2.'"')->row();
      $data['date1']=$date1;
      $data['date2']=$date2;
      $this->load->view('admin_interval', $data);  
   }
   public function Save_Product(){
      $data=[
         'Product_name'=>$this->input->post('Product_name'),
         'Product_description'=>$this->input->post('Product_description'),
         'Quantity_total'=>$this->input->post('Quantity_total'),
         'Quantity_left'=>$this->input->post('Quantity_left'),
         'Cost_single'=>$this->input->post('Cost_single'),
         'Cost_total'=>$this->input->post('Cost_total'),
      ];
      if($this->Admin->Save_Product($data)){
         ?>
         <script type="text/javascript">
            alert("Product Added successfully");
            window.location='<?php echo base_url();?>index.php/Admin_home/AllProduct';
         </script>
         <?php
      }
   }
   public function New(){
      $this->load->view('add_newproduct');
   }
   public function Add_user(){
      $this->load->view('adduser');
   }
   public function Save_user(){
      $data=[
         'Full_name'=>$this->input->post('Full_name'),
         'Phone_number'=>$this->input->post('Phone_number'),
         'Role'=>$this->input->post('Role'),
         'Status'=>'active',
         'Username'=>$this->input->post('Username'),
         'Password'=>md5($this->input->post('Password'))
      ];
      if($this->Admin->Save_user($data)){
         return redirect('Admin_home/View_users');
      }
   }
   public function View_users(){
      $data['available_users'] = $this->Admin->Fetch_users();
      $this->load->view('view_users', $data);
   }
   public function Change_password(){
      $this->load->view('admin_change_password');
   }
   public function Save_Password(){
      $currPass=md5($this->input->post('Current_Password'));
		$newPass=md5($this->input->post('New_Password'));
		$User_id=$this->session->userdata('id');
		if($current=$this->Product->CheckUserPassword($currPass, $User_id)){
			if($newPass==$current->Password){
				$this->session->set_flashdata("message","Enter new different password");
				return redirect('Admin_home/Change_password');
			}
			$this->Product->UpdatePassword($User_id, $newPass);
			$this->session->set_flashdata("success","Your password changed successfully");
			return redirect('Welcome/Logout');
		}
		else{
			$this->session->set_flashdata("message","Wrong current password");
			return redirect('Admin_home/Change_password');
		}
   }
   public function Assets(){
      $data['available_assets']=$this->Admin->FechAssets();
      $this->load->view('view_assets', $data);

   }
   public function Add_asset(){
      $this->load->view('add_asset');
   }
    public function Save_Asset(){
      $data=[
         'Asset_name'=>$this->input->post('Asset_name'),
         'Description'=>$this->input->post('Description'),
         'Costs'=>$this->input->post('Costs'),
         'Status'=>$this->input->post('Status'),
         'Date'=>$this->input->post('Date')
      ];
      if($this->Admin->Save_asset($data)){
         return redirect('Admin_home/Assets');
      }
   }
   public function getAssetdata(){
      $output=$this->Admin->selectAsset();
      echo json_encode($output);
   }

   public function Print_total(){
      $data2=$this->Product->Print_total();
      $this->pdf->loadHtml( $data2);
      $this->pdf->render();
      $this->pdf->stream("Total_cost.pdf", array("Attachment"=>0));
   }
   public function PrintProduct(){
      // echo "Print all here" ;
      $data2=$this->Product->PrintAll();
      $this->pdf->loadHtml($data2);
      $this->pdf->render();
      $this->pdf->stream("All_product.pdf", array("Attachment"=>0));

   }
   public function updateUserdata(){
      $data=[
         'User_id'=>$this->input->post('User_id'),
         'Full_name'=>$this->input->post('Full_name'),
         'Phone_number'=>$this->input->post('Phone_number'),
         'Role'=>$this->input->post('Role'),
         'Status'=>$this->input->post('Status'),
         'Username'=>$this->input->post('Username')
      ];
      $this->Admin->UpdateUser($data);
      ?>
      <script type="text/javascript">
         alert("User Updated successfully");
         window.location='<?php echo base_url();?>index.php/Admin_home/view_users';
      </script>
      <?php
   }
   public function getUserdata(){
      $output=$this->Admin->selectUser();
      echo json_encode($output);
   }
   public function deleteUser(){
      $id=$this->input->get('id');
      if ($this->Admin->deleteUser($id)) {
         echo "User deleted";
      }  
   }
   public function Reset_Password(){
      $id=$this->input->get('id');
      $username=$this->db->query('SELECT Username FROM user WHERE User_id='.$id)->row();
      $data=[
         'User_id'=>$id,
         'Password'=>md5($username->Username)
      ];
      if ($this->Admin->Reset_Password($data)){
         echo "Success";
      }  
   }
   public function deleteProduct(){
      $id=$this->input->get('id');
      if ($this->Admin->deleteProduct($id)) {
         echo "Product deleted";
      }
   }
   public function deleteAsset(){
      $id=$this->input->get('id');
      if ($this->Admin->deleteAsset($id)) {
         echo "Asset deleted";
      }
   }
   
   public function getProductdata(){
      $id = $this->input->get('id');
     $output=$this->Admin->selectProduct($id);
      echo json_encode($output);
   }
   public function updateProduct(){
      $data=[
         'Product_id'=>$this->input->post('Product_id'),
         'Product_name'=>$this->input->post('Product_name'),
         'Product_description'=>$this->input->post('Product_description'),
         'Quantity_total'=>$this->input->post('Quantity_total'),
         'Quantity_left'=>$this->input->post('Quantity_left'),
         'Cost_single'=>$this->input->post('Cost_single'),
         'Cost_total'=>$this->input->post('Cost_total'),
      ];
      $this->Admin->UpdateProduct($data);
      ?>
      <script type="text/javascript">
         alert("Product Updated successfully");
         window.location='<?php echo base_url();?>index.php/Admin_home/AllProduct';
      </script>
      <?php
   }
    public function updateSingleProduct(){
      $data=[
         'Product_id'=>$this->input->post('Product_id'),
         'Quantity_total'=>$this->input->post('Quantity_total'),
         'Quantity_left'=>$this->input->post('Quantity_left'),
      ];
      $this->Admin->UpdateSigleProduct($data);
      ?>
      <script type="text/javascript">
         alert("Product's Quantity added successfully");
         window.location='<?php echo base_url();?>index.php/Admin_home/AllProduct';
      </script>
      <?php
   }
   public function updateAsset(){
      $data=[
         'Asset_id'=>$this->input->post('Asset_id'),
         'Asset_name'=>$this->input->post('Asset_name'),
         'Description'=>$this->input->post('Description'),
         'Costs'=>$this->input->post('Costs'),
         'Status'=>$this->input->post('Status'),
         'Date'=>$this->input->post('Date')
      ];
      $this->Admin->UpdateAssett($data);
      ?>
      <script type="text/javascript">
         alert("Asset updated successfully");
         window.location='<?php echo base_url();?>index.php/Admin_home/Assets';
      </script>
      <?php
     
   }
   public function mkopo(){
      $data['madeni']=$this->Product->fetchIncLoan();
      $this->load->view('view_mkopo', $data);
   }
}
?>
