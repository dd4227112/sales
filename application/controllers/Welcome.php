<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
		parent::__construct();
		error_reporting(0);
		// load models
		$this->load->model('Product');
		// $this->load->library('pdf');
		date_default_timezone_set("Africa/Dar_es_Salaam");
	}
	public function index()
	{ 
		$this->load->view('index');
	}
	public function home()
	{
		$data['all_products']=$this->Product->fetchAllProduct();
		$this->load->view('home', $data);
	}
	
	public function Access()
	{
		$this->load->view('Access');
	} 

	public function login(){
	 $username=$this->input->post('Username');
	 
	 $password=md5($this->input->post('Password'));
	//  var_dump($username)."<br>";
	//  var_dump($password)."<br>";

	 $user_detail=$this->Product->Check_user($username, $password);
	// var_dump($user_detail)."<br>";


	 if($user_detail){
		 $session_data=[
				'id'=>$user_detail->User_id,
				'name'=>$user_detail->Full_name,
				'role'=>$user_detail->Role,
				'status'=>$user_detail->Status,

			];
			$this->session->set_userdata($session_data);
			if($session_data['role']=='normal_user' && $session_data['status']=='active'){
				return redirect('Welcome/home');
			}
			if($session_data['role']=='Admin' && $session_data['status']=='active'){
				return redirect('Admin_home/index');
			}
			if($session_data['status']!='active'){
				$this->session->set_flashdata("message","You have been disabled by admin");
				return redirect('Welcome/index');
			}
	
		}else{
			$this->session->set_flashdata("message","Username or Password is Incorrect");
				return redirect('Welcome/index');
		}
	}

	public function Logout(){
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('name');
		$this->session->unset_userdata('role');
		$this->session->unset_userdata('status');
		return redirect('Welcome/index');
	}
	public function Sell(){
		$product_id=$this->uri->segment(3);
		$data['products']=$this->Product->fetchSingleProduct($product_id);
		$this->load->view('sell', $data);
	}
	public function loan(){
		$product_id=$this->uri->segment(3);
		$data['products']=$this->Product->fetchSingleProduct($product_id);
		$this->load->view('loan', $data);
	}
	public function Save_credit(){
		$data=[
			'Product_id'=>$this->input->post('Product_id'),
			'Borrower'=>$this->input->post('Borrower'),
			'Phone_number'=>$this->input->post('Phone_number'),
			'Quantity_borrowed'=>$this->input->post('Quantity_borrowed'),
			'Price'=>$this->input->post('Price'),
			'Mode'=>$this->input->post('selling_mode'),
			'Amount_total'=>$this->input->post('Amount_total'),
			'Amount_payed'=>0,
			'Amount_left'=>$this->input->post('Amount_total'),
			'Status'=>'Incomplete',
			'Maelezo'=>$this->input->post('Maelezo'),
			'Borrowing_date'=>date('Y-m-d'),
			'User_id'=>$this->session->userdata('id')
		];
		$quantity=$this->db->query('SELECT Quantity_left FROM product WHERE Product_id='.$data['Product_id'])->row();
		if($data['Quantity_borrowed']>$quantity->Quantity_left){
			?>
			<script type="text/javascript">
			alert("The amoount of product you entered is not available in stock!!! Please try again");
			window.location='<?php echo base_url();?>index.php/Welcome/home';
			</script>	
			<?php		
		}
		else{
			$this->Product->Saveborrowedcredit($data);
			$total_product=$this->db->query('SELECT Quantity_left FROM product WHERE Product_id='.$data['Product_id'])->row();
			$product_left=$total_product->Quantity_left  - $data['Quantity_borrowed'];
			$this->db->query('UPDATE product SET Quantity_left='.$product_left.' WHERE Product_id='.$data['Product_id']);
			?>
			<script type="text/javascript">
			alert("Data saved successfully");
			window.location='<?php echo base_url();?>index.php/Welcome/home';
			</script>
			<?php		
		}

	}
	public function Sell_product(){
		// return redirect('Welcome/home');
		$data=[
			'User_id'=>$this->session->userdata('id'),
			'Product_id'=>$this->input->post('Product_id'),
			'selling_mode'=>$this->input->post('selling_mode'),
			'Quantity'=>$this->input->post('Quantity'),
			'Price'=>$this->input->post('Price'),
			'Description'=>$this->input->post('Description'),
			'Total'=>$this->input->post('Total'),
			'Date'=>date('Y-m-d')

		];
		$quantity=$this->db->query('SELECT Quantity_left FROM product WHERE Product_id='.$data['Product_id'])->row();
		if($data['Quantity']>$quantity->Quantity_left){
			?>
			<script type="text/javascript">
			alert("The amoount of product you entered is not available in stock!!! Please try again");
			window.location='<?php echo base_url();?>index.php/Welcome/home';
			</script>	
			<?php		
		}
		else{
			$this->Product->SaveSoldProduct($data);
			$total_product=$this->db->query('SELECT Quantity_left FROM product WHERE Product_id='.$data['Product_id'])->row();
			$product_left=$total_product->Quantity_left  - $data['Quantity'];
			$this->db->query('UPDATE product SET Quantity_left='.$product_left.' WHERE Product_id='.$data['Product_id']);
			?>
			<script type="text/javascript">
			alert("Data saved successfully");
			window.location='<?php echo base_url();?>index.php/Welcome/home';
			</script>
			<?php		
		}
	}
	public function Change_password(){
		$this->load->view('change_password');
	}
	public function Save_Password(){
		$currPass=md5($this->input->post('Current_Password'));
		$newPass=md5($this->input->post('New_Password'));
		$User_id=$this->session->userdata('id');
		if($current=$this->Product->CheckUserPassword($currPass, $User_id)){
			if($newPass==$current->Password){
				$this->session->set_flashdata("message","Enter new different password");
				return redirect('Welcome/Change_password');
			}
			$this->Product->UpdatePassword($User_id, $newPass);
			$this->session->set_flashdata("success","Your password changed successfully");
			return redirect('Welcome/Logout');
		}
		else{
			$this->session->set_flashdata("message","Wrong current password");
			return redirect('Welcome/Change_password');
		}
	}
	 public function Today_report(){ 
		$date=date('Y-m-d');
		$data['rejareja']=$this->Product->FetchTodaySaleRejareja($date);
		$data['jumla']=$this->Product->FetchTodaySaleJumla($date);
		$data['service_report']=$this->db->query('SELECT S.service_id, P.Product_id, P.Product_name, P.Product_description, S.Quantity, S.Full_name, S.Phone_number, S.Reason, S.Amount, S.Date FROM product P, service S WHERE S.Product_id=P.Product_id AND S.Date="'.$date.'"')->result();
		$data['madeni']=$this->db->query('SELECT c.Product_id, c.credit_id, c.Borrower, c.Phone_number, c.Mode, c.Quantity_borrowed, c.Amount_total, c.Amount_payed, c.Amount_left, c.Maelezo, P.Product_name, P.Product_description FROM credits c, product P WHERE  c.Product_id=P.Product_id AND Borrowing_date="'.$date.'"')->result();
		$data['payed_credit']=$this->db->query('SELECT sum(Amount_payed) as payed FROM loandetails WHERE date LIKE "'.$date.'%"')->row();
		$data['deni_leo']=$this->Product->loandatatoday($date);
		$this->load->view('today_report', $data);		
	}

	public function Report(){ 
		$date=$this->input->post('date_report');
		$data['rejareja']=$this->Product->FetchSpecificSaleRejareja($date);
		$data['jumla']=$this->Product->FetchSpecificSaleJumla($date);
		$data['service_report']=$this->db->query('SELECT S.service_id, P.Product_id, P.Product_name, P.Product_description, S.Quantity, S.Full_name, S.Phone_number, S.Reason, S.Amount, S.Date FROM product P, service S WHERE S.Product_id=P.Product_id AND S.Date="'.$date.'"')->result();
		$data['madeni']=$this->db->query('SELECT c.Product_id, c.credit_id, c.Borrower, c.Phone_number, c.Mode, c.Quantity_borrowed, c.Amount_total, c.Amount_payed, c.Amount_left, c.Maelezo, P.Product_name, P.Product_description FROM credits c, product P WHERE  c.Product_id=P.Product_id AND Borrowing_date="'.$date.'"')->result();
		$data['payed_credit']=$this->db->query('SELECT sum(Amount_payed) as payed FROM loandetails WHERE date LIKE "'.$date.'%"')->row();
		$data['deni_leo']=$this->Product->loandatatoday($date);
		$data['date']=$date;
		$this->load->view('specific_report', $data);	
	
	}
	public function Duration(){ 
		$date1=$this->input->post('date1');
		$date=$this->input->post('date2');
		$date2=date("Y-m-d h:s", strtotime($date)) ;
		// echo $date1."    ".$date2;
		$data['rejareja']=$this->Product->FetchDurationSaleRejareja($date1, $date2);
		$data['jumla']=$this->Product->FetchDurationSalejumla($date1, $date2);
		$data['service_report']=$this->db->query('SELECT S.service_id, P.Product_id, P.Product_name, P.Product_description, S.Quantity, S.Full_name, S.Phone_number, S.Reason, S.Amount, S.Date FROM product P, service S WHERE S.Product_id=P.Product_id AND S.Date >= "'.$date1.'" AND S.Date <= "'.$date2.'"')->result();
		$data['madeni']=$this->db->query('SELECT c.Product_id, c.credit_id, c.Borrower, c.Phone_number, c.Mode, c.Quantity_borrowed, c.Borrowing_date, c.Amount_total, c.Amount_payed, c.Amount_left, c.Maelezo, P.Product_name, P.Product_description FROM credits c, product P WHERE  c.Product_id=P.Product_id AND c.Status="Incomplete" AND c.Borrowing_date >="'.$date1.'" AND  c.Borrowing_date <= "'.$date2.'"')->result();
		$data['payed_credit']=$this->db->query('SELECT sum(Amount_payed) as payed FROM loandetails WHERE date >="'.$date1.'" AND date <= "'.$date2.'"')->row();
		$data['date1']=$date1;
		$data['date2']=$date;
		$this->load->view('interval', $data);	
	}
	public function Services(){
		$data['all_products']=$this->Product->fetchAllProduct();
		$this->load->view('service', $data);
	}
	public function Save_Service(){
		$Product_id=$this->input->post('Product_id');
		$quantity_posted=$this->input->post('Quantity');
	
		$quantity=$this->db->query('SELECT Quantity_left, Cost_single  FROM product WHERE Product_id='.$Product_id)->row();
		if($quantity_posted>$quantity->Quantity_left){
			?>
			<script type="text/javascript">
			alert("The amoount of product you entered is not available in stock!!! Please try again");
			window.location='<?php echo base_url();?>index.php/Welcome/Services';
			</script>
			<?php		
		}
		else
		{
			$amnt=$quantity_posted*$quantity->Cost_single;
			$data=[
				'Product_id'=>$this->input->post('Product_id'),
				'Quantity'=>$this->input->post('Quantity'),
				'Full_name'=>$this->input->post('Full_name'),
				'Phone_number'=>$this->input->post('Phone_number'),
				'Reason'=>$this->input->post('Reason'),
				'Date'=>date('Y-m-d'),
				'Amount'=>$amnt,
				'User_id'=>$this->session->userdata('id')				
			] ;
			$this->Product->SaveService($data);
			$product_left=$quantity->Quantity_left-$data['Quantity'];
			$this->db->query('UPDATE product SET Quantity_left='.$product_left.' WHERE Product_id='.$data['Product_id']);
			?>
			<script type="text/javascript">
			alert("Data saved successfully");
			window.location='<?php echo base_url();?>index.php/Welcome/Services';
			</script>
			<?php
		}
		
	}
	public function getsalesdetailrejareja(){
      	$date=date('Y-m-d');
		$data=$this->Product->getsalesdetailsrejareja($date);
		echo  json_encode($data);
	}
	public function getsalesdetailrejareja_specific(){
      	$date=$this->input->get('date');
		$data=$this->Product->getsalesdetailsrejareja($date);
		echo  json_encode($data);
	}
	public function getsalesdetailjumla(){
      	$date=date('Y-m-d');
		$data=$this->Product->getsalesdetailsjumla($date);
		echo  json_encode($data);
	}
	public function getsalesdetailjumla_specific(){
      	$date=$this->input->get('date');
		$data=$this->Product->getsalesdetailsjumla($date);
		echo  json_encode($data);
	}

	//Print report
	public function Print(){
		$date=date('Y-m-d');
		$data2=$this->Product->TodayPrint($date);
		$this->pdf->loadHtml( $data2);
		$this->pdf->render();
		$this->pdf->stream("Report_$date.pdf", array("Attachment"=>0));
	}
	public function Print_specific(){
		$date=$this->input->post('Date');
		$data2=$this->Product->TodayPrint($date);
		$this->pdf->loadHtml($data2);
		$this->pdf->render();
		$this->pdf->stream("Report_$date.pdf", array("Attachment"=>0));
	}
	public function Print_periodic(){
		$date1= $this->input->post('Date1');
		$date2= $this->input->post('Date2');
		$data2=$this->Product->PrintInterval($date1, $date2);
		$this->pdf->loadHtml($data2);
		$this->pdf->render();
		$this->pdf->stream("Report_$date1-$date2.pdf", array("Attachment"=>0));
	}
	// Mkopo
	public function mkopo(){
		$data['madeni']=$this->Product->fetchIncLoan();
		$this->load->view('mkopo', $data);
	}
	public function getloandata(){
      $output=$this->Product->selectLoan();
      echo json_encode($output);
	}
	public function payloan(){
		$id=$this->input->post('credit_id');
		$payamount=$this->input->post('Payable_amount');
		$date=date('Y-m-d h:i');
		$amount=$this->db->query('SELECT Amount_payed FROM credits WHERE credit_id='.$id)->row();
		$payed=$amount->Amount_payed+$payamount;
		$this->db->query('UPDATE credits SET Amount_payed='.$payed.' WHERE credit_id='.$id);
		$data=['Amount_payed'=>$payamount,
				'date'=>$date,
				'credit_id'=>$id];
		$this->Product->saveloandetail($data);
		$amount=$this->db->query('SELECT Amount_payed, Amount_left, Amount_total FROM credits WHERE credit_id='.$id)->row();
		$left=$amount->Amount_total-$amount->Amount_payed;
		$this->db->query('UPDATE credits SET Amount_left='.$left.' WHERE credit_id='.$id);
	if ($amount->Amount_total==$amount->Amount_payed) {
		$this->db->query('UPDATE credits SET Status="complete" WHERE credit_id='.$id);
	}
		return redirect('Welcome/mkopo');

	}
	public function getpaymentdetails(){
	$data=$this->Product->getpaymentdetail();
	echo  json_encode($data);
}
}
?>