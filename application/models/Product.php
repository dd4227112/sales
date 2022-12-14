<?php
   class Product extends CI_Model
   {
      //users methods
      public function Check_user($username, $password){
         $this->db->where(['Username'=>$username, 'Password'=>$password]);
         $query=$this->db->get('user');
         if($query->num_rows()>0){
            return $query->row();
         }
      }
      public function CheckUserPassword($currPass, $User_id){
         $this->db->where(['User_id'=>$User_id, 'Password'=>$currPass]);
         $query=$this->db->get('user');
         if($query->num_rows()==1){
            return $query->row();
         }
      }
      public function UpdatePassword($User_id, $newPass){
         $this->db->set('Password', $newPass);
         $this->db->where('User_id', $User_id);
         $this->db->update('user');
      }


      // product methods
      public function fetchAllProduct(){
        $query=$this->db->query('SELECT * FROM product ORDER BY Product_name ASC');
        if($query->num_rows()>0){
          return $query->result();
        }
      }
      public function fetchSingleProduct($product_id){
         $this->db->where('Product_id', $product_id);
         $query=$this->db->get('Product');
         if($query->num_rows()>0){
            return $query->row();
         }
      }
      public function SaveSoldProduct($data){
         return $this->db->insert('sales', $data);
      }
      public function Saveborrowedcredit($data){
         return $this->db->insert('credits', $data);
      }
      public function FetchTodaySaleJumla($date){
         $query=$this->db->query(' SELECT P.Product_id, P.Product_name, P.Product_description, P.Quantity_left, Sum(s.Quantity) as Quantity, SUM(s.Total) as Total, s.selling_mode, s.Date FROM product P, sales s WHERE s.Date="'.$date.'" AND P.Product_id=s.Product_id AND s.selling_mode="jumla" GROUP BY s.Product_id');
         return $query->result();
      }
      public function FetchTodaySaleRejareja($date){
         $query=$this->db->query(' SELECT P.Product_id, P.Product_name, P.Product_description, P.Quantity_left, Sum(s.Quantity) as Quantity, SUM(s.Total) as Total, s.selling_mode, s.Date FROM product P, sales s WHERE s.Date="'.$date.'" AND P.Product_id=s.Product_id AND s.selling_mode="rejareja" GROUP BY s.Product_id');
         return $query->result();
      }
      public function FetchSpecificSaleRejareja($date){
         $query=$this->db->query(' SELECT P.Product_id, P.Product_name,U.Full_name, P.Product_description, P.Quantity_left, Sum(s.Quantity) as Quantity, SUM(s.Total) as Total, s.selling_mode, s.Date FROM product P, sales s, user U WHERE s.Date="'.$date.'" AND P.Product_id=s.Product_id AND s.User_id=U.User_id AND s.selling_mode="rejareja" GROUP BY s.Product_id');
         return $query->result();
      }
      public function FetchSpecificSaleJumla($date){
         $query=$this->db->query(' SELECT P.Product_id, P.Product_name, U.Full_name, P.Product_description, P.Quantity_left, Sum(s.Quantity) as Quantity, SUM(s.Total) as Total, s.selling_mode, s.Date FROM product P, sales s, user U WHERE s.Date="'.$date.'" AND P.Product_id=s.Product_id AND s.User_id=U.User_id AND s.selling_mode="jumla" GROUP BY s.Product_id');
         return $query->result();
      }
      public function SaveService($data){
         return $this->db->insert('service', $data);
      }
      public function getsalesdetailsrejareja($date){
         $product_id=$this->input->get('id');
         $query=$this->db->query(' SELECT P.Product_id, s.Product_id, P.Product_name, P.Product_description, s.Date, s.Quantity, s.Price, s.Description, s.Total FROM product P, sales s WHERE s.Date="'.$date.'" AND s.selling_mode="rejareja" AND s.Product_id=P.Product_id AND s.Product_id='.$product_id);
      
         return $query->result();
        
      }
      public function FetchDurationSaleRejareja($date1, $date2){
         $query=$this->db->query(' SELECT P.Product_id, P.Product_name,U.Full_name, P.Product_description, P.Quantity_left, Sum(s.Quantity) as Quantity, SUM(s.Total) as Total, s.selling_mode, s.Date FROM product P, sales s, user U WHERE s.Date >= "'.$date1.'" AND s.Date <= "'.$date2.'"  AND P.Product_id=s.Product_id AND s.User_id=U.User_id AND s.selling_mode="rejareja" GROUP BY s.Product_id');
         return $query->result();
      }
      public function FetchDurationSalejumla($date1, $date2){
         $query=$this->db->query(' SELECT P.Product_id, P.Product_name,U.Full_name, P.Product_description, P.Quantity_left, Sum(s.Quantity) as Quantity, SUM(s.Total) as Total, s.selling_mode, s.Date FROM product P, sales s, user U WHERE s.Date >= "'.$date1.'" AND s.Date <= "'.$date2.'"  AND P.Product_id=s.Product_id AND s.User_id=U.User_id AND s.selling_mode="jumla" GROUP BY s.Product_id');
         return $query->result();
      }
      public function getsalesdetailsjumla($date){
         $product_id=$this->input->get('id');
         $query=$this->db->query(' SELECT P.Product_id, s.Product_id, P.Product_name, P.Product_description, s.Date, s.Quantity, s.Price, s.Description, s.Total FROM product P, sales s WHERE s.Date="'.$date.'" AND s.selling_mode="jumla" AND s.Product_id=P.Product_id AND s.Product_id='.$product_id);
         return $query->result();   
      }
      // Mkopo
      public function fetchIncLoan(){
         $q=$this->db->query('SELECT c.Product_id, c.credit_id, c.Borrower, c.Phone_number, c.Mode, c.Quantity_borrowed, c.Amount_total, c.Amount_payed,c.Borrowing_date,c.Status, c.Amount_left, c.Maelezo, P.Product_name, P.Product_description FROM credits c, product P WHERE  c.Product_id=P.Product_id AND c.Status="Incomplete" ORDER BY c.Borrowing_date DESC');
         return $q->result();

      }
      //Fetch print
      public function TodayPrint($date){
         $query=$this->db->query(' SELECT P.Product_id, P.Product_name, P.Product_description, P.Quantity_left, Sum(s.Quantity) as Quantity, SUM(s.Total) as Total, s.selling_mode, s.Date FROM product P, sales s WHERE s.Date="'.$date.'" AND P.Product_id=s.Product_id AND s.selling_mode="rejareja" GROUP BY s.Product_id');
         $data=$this->db->query(' SELECT P.Product_id as Pid, P.Product_name as Pname , P.Product_description as Pdec, P.Quantity_left as Pleft, Sum(s.Quantity) as PQuantity, SUM(s.Total) as PTotal, s.selling_mode , s.Date FROM product P, sales s WHERE s.Date="'.$date.'" AND P.Product_id=s.Product_id AND s.selling_mode="jumla" GROUP BY s.Product_id');
         $user=$this->db->query('SELECT DISTINCT  U.Full_name FROM user u, sales S WHERE u.User_id=S.User_id AND S.Date="'.$date.'"')->row();
         $service=$this->db->query('SELECT S.service_id, P.Product_id, P.Product_name, P.Product_description, S.Quantity, S.Full_name, S.Phone_number, S.Reason, S.Amount, S.Date FROM Product P, service S WHERE S.Product_id=P.Product_id AND S.Date="'.$date.'"')->result();
         $madeni=$this->db->query('SELECT c.Product_id, c.credit_id, c.Borrower, c.Phone_number, c.Mode, c.Quantity_borrowed, c.Amount_total, c.Amount_payed, c.Amount_left, c.Maelezo, P.Product_name, P.Product_description FROM credits c, product P WHERE  c.Product_id=P.Product_id AND Borrowing_date="'.$date.'"');
         $payed_credit=$this->db->query('SELECT sum(Amount_payed) as payed FROM loandetails WHERE date LIKE "'.$date.'%"')->row();
         $output='<div class="panel-body progress-panel">
         <div class="row">
           <div class="col-lg-8 task-progress pull-left">
             <h4 style="text-transform:uppercase; text-align:center"><u>All products sold/service provided by '.$user->Full_name. " on ". $date.'</u></h4>
           </div>
         </div>
         <div class="row">
           <div class="col-lg-8 task-progress pull-left">
             <h5><u>Bei za Reja Reja</u></h5>
           </div>
         </div>';
         if ($query->result()==NULL){
            $output.='<h5>No Product sold today</h5>
            ';
            $rejareja_jumla=0;
         }else{
            $output.='<table style=" width:100%">
            <thead>
              <tr>
              <td>No.</td>
                <th>Product Name</th>
                <th>Quantity sold</th>
                <th>Avaialable in stock</th>
                <th>Total Amount</th>
              </tr>
            </thead>
              <tbody>
             '; 
             $rejareja_jumla=0;
             $No=1;
             foreach($query->result() as $products){
               $output.=' 
               <tr>
               <td>'.$No.'.</td>
                 <td>'.$products->Product_name." - ".$products->Product_description.'</td>
                 <td style=" text-align:center">'.$products->Quantity.'</td>
                 <td style=" text-align:center" >'.$products->Quantity_left.'</td>
                 <td style=" text-align:center" >'.$products->Total.'</td>
               </tr>';
               $No++;
               $rejareja_jumla+=$products->Total;
             }
             $output.='
             <tr>
                <td></td>
               <td></td>
               <td></td>
               <td><u>Total-bei za rejareja</u></td>
              <td style=" text-align:center"><u>'.$rejareja_jumla.'</u></td>
             </tr>
             </tbody>
             </table>
             <hr>
             ';
         } 
         $output.='
         <div class="row">
           <div class="col-lg-8 task-progress pull-left">
             <h5><u>Bei za jumla</u></h5>
           </div>
         </div>';
         if ($data->result()==NULL){
            $output.='
            <h3>No Product sold today</h3>
            ';
            $jumla=0;
         }else{
            $output.='<table style="width:100%">
            <thead>
              <tr>
              <td>No.</td>
                <th>Product Name</th>
                <th style=" text-align:center">Quantity sold</th>
                <th style=" text-align:center">Avaialable in stock</th>
                <th style=" text-align:center">Total Amount</th>
              </tr>
            </thead>
              <tbody>
             '; 
             $jumla=0;
             $No=1;
             foreach($data->result() as $product_jumla){
               $output.=' 
               <tr>
               <td>'.$No.'.</td>
                 <td>'.$product_jumla->Pname." - ".$product_jumla->Pdec.'</td>
                 <td style=" text-align:center">'.$product_jumla->PQuantity.'</td>
                 <td style=" text-align:center" >'.$product_jumla->Pleft.'</td>
                 <td style=" text-align:center" >'.$product_jumla->PTotal.'</td>
               </tr>';
               $No++;
               $jumla+=$product_jumla->PTotal;
             }
             $output.='
             <tr>
               <td></td>
               <td></td>
               <td></td>
               <td><u>Total- bei za jumla</u></td>
              <td style=" text-align:center"><u>'.$jumla.'</u></td>
             </tr>
             </tbody>
             </table>
             <hr>
             ';
         } 
         // Fetch services
         $output.='
             <h5><u>Other services</u></h5>';
         if ($service==NULL){
            $output.='
            <h3>No data found</h3>
            ';
            $service_total=0;
         }else{
            $output.='<table style="width:100%">
            <thead>
              <tr>
               <th>No.</th>
                <th>Product Name</th>
                <th style=" text-align:center">Quantity</th>
                <th style=" text-align:center">Given to</th>
                <th style=" text-align:center">Phone number</th>
                <th style=" text-align:center">Reason</th>
                <th style=" text-align:center">Service costs</th>

              </tr>
            </thead>
              <tbody>
             '; 
             $service_total=0;
             $No=1;
             foreach($service as $serice_data){
               $output.='
               <tr>
                  <td>'.$No.'.</td>
                 <td>'.$serice_data->Product_name." - ".$serice_data->Product_description.'</td>                   
                 <td style=" text-align:center">'.$serice_data->Quantity.'</td>
                 <td style=" text-align:center">'.$serice_data->Full_name.'</td>
                 <td style=" text-align:center">'.$serice_data->Phone_number.'</td>
                 <td style=" text-align:center">'.$serice_data->Reason.'</td>
                 <td style=" text-align:center">'. $serice_data->Amount.'</td>
               </tr>';
               $No++;
               $service_total+=$serice_data->Amount;
             }
             $output.='
             <tr>            
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td><u>Total-other service</u></td>
               <td></td>
              <td style=" text-align:center" ><u>'.$service_total.'</u></td>
             </tr>
             </tbody>
             </table>
             <hr>
             ';             
         }
              // Fetch madeni
              $output.='
              <h5><u>Madeni</u></h5>';
          if ($madeni->result()==NULL){
             $output.='
             <h3>No data found</h3>
             ';
             $madeni_jumla=0;
          }else{
            $output.='<table style="width:100%">
            <thead>
              <tr>
               <th>Borrower\'s name.</th>
                <th>Phone number</th>
                <th >Product name</th>
                <th style=" text-align:center">Quantity</th>
                <th style=" text-align:center">Mode</th>
                <th style=" text-align:center">Total</th>
                <th style=" text-align:center">Payed</th>
                <th style=" text-align:center">Left</th>
                <th style=" text-align:center">Description</th>
              </tr>
            </thead>
              <tbody>
             ';
             $madeni_jumla=0;
             foreach($madeni->result() as $deni){
               $output.='
               <tr>
                  <td>'.$deni->Borrower.'</td>
                  <td>'.$deni->Phone_number.'</td>
                 <td>'.$deni->Product_name." - ".$deni->Product_description.'</td>                   
                 <td style=" text-align:center">'.$deni->Quantity_borrowed.'</td>
                 <td style=" text-align:center">'.$deni->Mode.'</td>
                 <td style=" text-align:center">'.$deni->Amount_total.'</td>
                 <td style=" text-align:center">'.$deni->Amount_payed.'</td>
                 <td style=" text-align:center">'.$deni->Amount_left.'</td>
                 <td style=" text-align:center">'.$deni->Maelezo.'</td>

               </tr>';
               $madeni_jumla+=$deni->Amount_left;
             }
             $output.='
             <tr>            
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td><u>Madeni(Total)</u></td>
               <td></td>
              <td style=" text-align:center" ><u>'.$madeni_jumla.'</u></td>
              <td></td>
             </tr>
             </tbody>
             </table>
             <hr>
             ';   
          }
           //Process payed
         $output.='
         <h3>Credit payed today ';
         if ($payed_credit->payed==NULL OR $payed_credit->payed<=0 ) {
            $output.=number_format(0,2).'Tsh<h3>';
         }else{
         $output.=number_format($payed_credit->payed,2).' Tsh</h3>';
         }
         $sum1=$service_total+$jumla+$rejareja_jumla+$madeni_jumla+$payed_credit->payed;
         $sum2=$jumla+$rejareja_jumla+$payed_credit->payed;
         $output.='
            <div>
            <h4>Total today\'s sales +credit payed '.number_format($sum2, 2).'/=</h4>
            <h3><u>Total today\'s sales + Other service costs+ credit payed  '.number_format($sum1, 2).'/=</u></h3>
            </div>
         ';
   
         return $output;
      }
      // print periodic report
      public function PrintInterval($date1, $date2){
         $query1=$this->db->query(' SELECT P.Product_id, P.Product_name,U.Full_name, P.Product_description, P.Quantity_left, Sum(s.Quantity) as Quantity, SUM(s.Total) as Total, s.selling_mode, s.Date FROM product P, sales s, user U WHERE s.Date BETWEEN "'.$date1.'" AND "'.$date2.'"  AND P.Product_id=s.Product_id AND s.User_id=U.User_id AND s.selling_mode="rejareja" GROUP BY s.Product_id')->result();
         $query2=$this->db->query(' SELECT P.Product_id, P.Product_name,U.Full_name, P.Product_description, P.Quantity_left, Sum(s.Quantity) as Quantity, SUM(s.Total) as Total, s.selling_mode, s.Date FROM product P, sales s, user U WHERE s.Date BETWEEN "'.$date1.'" AND "'.$date2.'"  AND P.Product_id=s.Product_id AND s.User_id=U.User_id AND s.selling_mode="jumla" GROUP BY s.Product_id')->result();
         $service_report=$this->db->query('SELECT S.service_id, P.Product_id, P.Product_name, P.Product_description, S.Quantity, S.Full_name, S.Phone_number, S.Reason, S.Amount, S.Date FROM product P, service S WHERE S.Product_id=P.Product_id AND S.Date BETWEEN "'.$date1.'" AND "'.$date2.'"')->result();
		   $madeni=$this->db->query('SELECT c.Product_id, c.credit_id, c.Borrower, c.Phone_number, c.Mode, c.Quantity_borrowed, c.Borrowing_date, c.Amount_total, c.Amount_payed, c.Amount_left, c.Maelezo, P.Product_name, P.Product_description FROM credits c, product P WHERE  c.Product_id=P.Product_id AND c.Status="Incomplete" AND Borrowing_date BETWEEN "'.$date1.'" AND "'.$date2.'"')->result();
         $payed_credit=$this->db->query('SELECT sum(Amount_payed) as payed FROM loandetails WHERE date >="'.$date1.'" AND date <= "'.$date2.'"')->row();
         $print='<h3 style="text-align:center; text-transform:uppercase;"><u>Sales report from  '.$date1.' to '.$date2.'</u></h3>';
         $print.='<h4><u>Bei ya rejareja</u></h4>';
         if ($query1==NULL) {
            $rejareja_jumla=0;
            $print.='<h5>No data found</h5>';
         }else{
            $print.='<table style=" width:100%">
            <thead>
              <tr>
                <th>Product Name</th>
                <th style="text-align:center;">Quantity sold</th>
                <th style="text-align:center;">Avaialable in stock</th>
                <th style="text-align:center;">Total Amount</th>
              </tr>
            </thead>
              <tbody>';
              $rejareja_jumla=0;
                foreach($query1 as $products){
                  $print.='
                  <tr>
                    <td >'.$products->Product_name.'-'.$products->Product_description.'</td>
                    <td style="text-align:center;">'.$products->Quantity.'</td>
                    <td style="text-align:center;">'.$products->Quantity_left.'</td>
                     <td style="text-align:center;">'.number_format($products->Total,2).'</td>                   
                  </tr>';
                $rejareja_jumla+=$products->Total;
              }
              $print.='<tr>
                          <td></td>
                          <td style="text-align:center;"><u><b>Total(Tsh)</b></u></td>
                          <td></td>
                          <td style="text-align:center;"><u><b>'.number_format($rejareja_jumla,2).'</b></u></td>                        
                      </tr>
                      </tbody>
                      </table>
                      <hr>';

         }
         $print.=
                '
                <h4><u>Bei ya jumla</u></h4>
               ';
           if ($query2==NULL) {
              $print.='<h5>No data found</h5>';
              $jumla_jumla=0;
            }
            else
            {
              $print.='<table style=" width:100%">
            <thead>
              <tr>
                <th>Product Name</th>
                <th style="text-align:center;">Quantity sold</th>
                <th style="text-align:center;">Avaialable in stock</th>
                <th style="text-align:center;">Total Amount</th>
              </tr>
            </thead>
              <tbody>';
              $jumla_jumla=0;             
                 foreach($query2 as $products){
                  $print.='
                  <tr>
                    <td >'.$products->Product_name.'-'.$products->Product_description.'</td>
                    <td style="text-align:center;">'.$products->Quantity.'</td>
                    <td style="text-align:center;">'.$products->Quantity_left.'</td>
                     <td style="text-align:center;">'.number_format($products->Total,2).'</td>                   
                  </tr>';
                $jumla_jumla+=$products->Total;
            }
            $print.='<tr>
                          <td></td>
                          <td style="text-align:center;"><u><b>Total(Tsh)</b></u></td>
                          <td></td>
                          <td style="text-align:center;"><u><b>'.number_format($jumla_jumla,2).'</b></u></td>                        
                      </tr>
                      </tbody>
                      </table>
                      <hr>';
          }
          $print.=
                '
                <h4><u>Other services</u></h4>
               ';
           if ($query2==NULL) {
              $print.='<h5>No data found</h5>';
              $costs=0;
            }
            else
            {
              $print.='<table style=" width:100%">
               <thead>
                <tr>
                  <th scope="col" >Product Name</th>
                  <th style="text-align:center;">Quantity</th>
                  <th style="text-align:center;">Given to </th>
                  <th style="text-align:center;">Phone number </th>
                  <th style="text-align:center;">Reasons </th>
                  <th style="text-align:center;">Total Costs</th>
                </tr>
              </thead>
              <tbody>';
              $costs=0;
              foreach($service_report as $serice){
                $print.='
                <tr>
                    <td>'.$serice->Product_name.'-'.$serice->Product_description.'</td>                   
                    <td style="text-align:center;">'.$serice->Quantity.'</td>
                    <td style="text-align:center;">'.$serice->Full_name.'</td>
                    <td style="text-align:center;">'.$serice->Phone_number.'</td>
                    <td style="text-align:center;">'. $serice->Reason.'</td>
                    <td style="text-align:center;">'.$serice->Amount.'</td>
                  </tr>';
                  $costs+=$serice->Amount;
              }
                $print.='<tr>
                          <td></td>
                          <td></td>
                          <td style="text-align:center;"><u><b>Service cost(Tsh)</b></u></td>
                          <td></td>
                          <td></td>                      
                          <td style="text-align:center;"><u><b>'.number_format($costs,2).'</b></u></td>                        
                      </tr>
                      </tbody>
                      </table>
                      <hr>';
            }
            $print.=
                '
                <h4><u>Madeni</u></h4>
               ';
           if ($madeni==NULL) {
              $print.='<h5>No data found</h5>';
              $madeni_jumla=0;
            }
            else
            {
              $print.='<table style=" width:100%">
               <thead>
                  <tr>
                    <th style="font-size:12px">Borrower\'s name</th>
                    <th style="text-align:center; font-size:12px">Phone number</th>
                    <th style="font-size:12px">Product Name</th>
                    <th style="text-align:center; font-size:12px">Quantity</th>
                    <th style="text-align:center; font-size:12px">Mode</th>
                    <th style="text-align:center; font-size:12px">Total</th>
                    <th style="text-align:center; font-size:12px">Payed</th>
                    <th style="text-align:center; font-size:12px">Left</th>
                    <th style="text-align:center; font-size:12px">Borrowing date</th>
                    <th style="text-align:center; font-size:12px">Description</th>
                  </tr>
                </thead>
                <tbody>';
                $madeni_jumla=0;
                foreach($madeni as $deni){
                  $print.='
                    <tr>
                      <td style="font-size:12px">'.$deni->Borrower.'</td>
                      <td class="text-center;font-size:12px">'.$deni->Phone_number.'</td>
                      <td style="font-size:12px;">'.$deni->Product_name.'-'.$deni->Product_description.'</td>
                      <td style="text-align:center; font-size:12px">'.$deni->Quantity_borrowed.'</td>
                      <td style="text-align:center; font-size:12px">'.$deni->Mode.'</td>
                      <td style="text-align:center; font-size:12px">'.$deni->Amount_total.'</td>
                      <td style="text-align:center; font-size:12px">'.$deni->Amount_payed.'</td>
                      <td style="text-align:center; font-size:12px">'.$deni->Amount_left.'</td>
                      <td style="text-align:center; font-size:12px">'.$deni->Borrowing_date.'</td>
                      <td style="font-size:12px">'.$deni->Maelezo.'</td>
                    </tr>';
                   $madeni_jumla+=$deni->Amount_left;
                }
                     $print.='<tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>                          
                          <td style="text-align:center; font-size:12px"><u><b>Total(Tsh)</b></u></td>
                          <td></td>
                          <td></td>                      
                          <td style="text-align:center; font-size:12px"><u><b>'.number_format($madeni_jumla,2).'</b></u></td>
                          <td></td>
                          <td></td>                                                
                      </tr>
                      </tbody>
                      </table>
                      <hr>';
            }
                     $print.='<h4>Total Credit payed is  ';
              if ($payed_credit==NULL OR $payed_credit->payed<=0){
                $print.='</h4><h5>No data found</h5';
              } 
              else{
                $print.=number_format($payed_credit->payed, 2).'/=</h4><br>';
              }
                $print.='<h4><u>Total sales+ credit payed '.number_format($rejareja_jumla+$jumla_jumla+$payed_credit->payed ,2).'/=</u></h4>
                    <h4><u>Total sales + Other service costs + credits '.number_format($rejareja_jumla+$jumla_jumla+$costs+$madeni_jumla+$payed_credit->payed ,2).'/=</u></h4>';
         return $print;
      }
      public function Print_total(){
        $data1=$this->db->query('Select SUM(Costs) AS SUM FROM assets')->row();
        $data2=$this->db->query('SELECT SUM(Quantity_left*Cost_single) AS rejareja FROM product')->row();
        $data3=$this->db->query('SELECT SUM(Quantity_left*Cost_total) AS jumla FROM product')->row();
        $output='<h3 style="text-transform:uppercase; text-align:center"><u><b>Total costs</b></u></h3>';
        $output.='
          <div 
            <div  style="
              height:150px;
              color:black;
              border:1px solid black;
              text-align:center;
              margin-top:0px;          
            "><p style="height:35px"></p>
            <b>PRODUCTS(REJAREJA)\'s COSTS <br>'.number_format($data2->rejareja,2).'/=
            </div>
            <br>
              <div  style="
              height:150px;
              color:black;
              margin-top:0px;
              border:1px solid black;
              text-align:center;

            "><p style="height:35px"></p>
            <b> PRODUCTS(JUMLA)\'s COSTS <br>'.number_format($data3->jumla,2).'/=
            </div>
            <br>
              <div  style="
              height:150px;
              color:black;
              border:1px solid black;
              text-align:center;
              margin-top:0px;

            "><p style="height:35px"></p>
            <b>ASSTES\'s COSTS <br>'.number_format($data1->SUM).'/=
            </div>
                  <br>
              <div  style="
              height:150px;
              color:black;
              margin-top:0px;
              border:1px solid black;
              text-align:center;

            "><p style="height:35px"></p>
            <b>GRAND TOTAL(REJAREJA)<br>'.number_format($data2->rejareja+$data1->SUM,2).'/=
            </div>
            <br>
              <div  style="
              height:150px;
              color:black;
              border:1px solid black;
              text-align:center;
              margin-top:0px;

            "><p style="height:35px"></p>
            <b>GRAND TOTAL(JUMLA) <br>'.number_format($data3->jumla+$data1->SUM).'/=
            </div>
          </div>
          <p style="text-align:right; font-size:13px;"><i><b>Printed on '.date('d-m-Y h:i').'</b></i></p>
        ';

        return $output;

    }
    public function PrintAll(){
      $query=$this->db->query('SELECT * FROM product ORDER BY Product_name ASC')->result();
      $html='<h3 style="text-transform:uppercase; text-align:center"><u><b>All available products</b></u></h3>';
      if ($query==NULL) {
        $html.='<h5 style="text-align:center">No data found</h5>';
      }else{
        $html.='<table style="width:100%; font-size:12px" border="1px" cellspacing="0px">
        <thead>
        <tr>
          <th>Product Name</th>
          <th>Quantity</th>
          <th>Avaialable in stock</th>
          <th>Price-jumla(Tsh)</th>
          <th>Stock after sale @item Price-jumla(Tsh)</th>
          <th>Price-rejareja(Tsh)</th>
          <th>Stock after sale @item Price-rejareja</th>
        </tr>
      </thead>
        <tbody>';
        $tolal_jumla=0;
        $tolal_rejareja=0;
        foreach($query as $products){
          $html.='<tr>
          <td>'.$products->Product_name.'-'.$products->Product_description.'</td>
          <td style="text-align:center">'.$products->Quantity_total.'</td>
          <td style="text-align:center">'.$products->Quantity_left.'</td>
          <td style="text-align:center">'.$products->Cost_total.'</td>
          <td style="text-align:center">'. $products->Cost_total *$products->Quantity_total.'</td>
          <td style="text-align:center">'. $products->Cost_single.'</td>  
          <td style="text-align:center">'. $products->Cost_single *$products->Quantity_total.'</td>
        </tr>';
        $tolal_jumla+=($products->Cost_total *$products->Quantity_total);
        $tolal_rejareja+=($products->Cost_single *$products->Quantity_total);
        }
        $html.=' <tr>
          <td colspan="4">Totals</td>         
          <td style="text-align:center">'.number_format($tolal_jumla,2).'/=</td>
          <td></td>
          <td style="text-align:center">'.number_format($tolal_rejareja,2).'/=</td>
        </tr>
      </tbody>
      </table>';    
      }
      return $html;
    }
    public function selectLoan(){
      $id=$this->input->get('id');
      $query=$this->db->query('SELECT c.Product_id, c.credit_id, c.Borrower, c.Phone_number, c.Mode, c.Quantity_borrowed, c.Amount_total, c.Amount_payed, c.Amount_left, c.Maelezo, P.Product_name, P.Product_description FROM credits c, product P WHERE  c.Product_id=P.Product_id AND c.credit_id='.$id);
      return $query->row();
    }
    public function saveloandetail($data){
      return $this->db->insert('loandetails', $data);
    }
    public function getpaymentdetail(){
      $credit_id=$this->input->get('id');
      $query=$this->db->query(' SELECT P.Product_id, c.Product_id, P.Product_name, P.Product_description, s.date, s.Amount_payed FROM product P, loandetails s, credits c WHERE c.Product_id=P.Product_id AND s.credit_id=c.credit_id AND s.credit_id='.$credit_id);
      return $query->result();   
    }
    public function loandatatoday($date){
      $query=$this->db->query(' SELECT P.Product_id, c.Product_id, P.Product_name, P.Product_description, s.date, s.Amount_payed, c.Borrower, c.Phone_number FROM product P, loandetails s, credits c WHERE c.Product_id=P.Product_id AND s.credit_id=c.credit_id AND s.date LIKE "'.$date.'%"');
      return $query->result();   
    }
  }
?>
