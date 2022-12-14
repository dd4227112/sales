<?php
   class Admin extends CI_Model
   {

      public function fetchAvailableProduct(){
         $this->db->where('Quantity_left >', 0);
         $query=$this->db->get('product');
         return $query->result();
      }
      public function fetchmissingProduct(){
         $this->db->where('Quantity_left =', 0);
         $query=$this->db->get('product');
         return $query->result();
      }
      public function Save_Product($data){
         return $this->db->insert('product', $data);
      }
      public function Save_user($data){
         return $this->db->insert('user', $data);
      }
      public function Fetch_users(){
         $query=$this->db->get('user');
         return $query->result();
      }
      public function FechAssets(){
         $query=$this->db->get('assets');
         return $query->result();
      }
      public function Save_asset($data){
         return $this->db->insert('assets', $data);
      }

      public function selectUser(){
			$id=$this->input->get('id');
			$this->db->where("User_id",$id);
			$query=$this->db->get('user');
			return $query->row();
      }
      public function UpdateUser($data){
         $this->db->where('User_id', $data['User_id']);
         $this->db->update('user', $data);
      }
      public function Reset_Password($data){
         $this->db->where('User_id', $data['User_id']);
         return $this->db->update('user', $data);
      }
      public function deleteUser($id){
         $this->db->where('User_id', $id);
         return $this->db->delete('user');
      }
      public function deleteProduct($id){
         $this->db->where('Product_id', $id);
         return $this->db->delete('product');
      }
      public function deleteAsset($id){
         $this->db->where('Asset_id', $id);
         return $this->db->delete('assets');
      }
       public function UpdateProduct($data){
         $this->db->where('Product_id', $data['Product_id']);
         $this->db->update('product', $data);
      }
      public function UpdateSigleProduct($data){
         $this->db->where('Product_id', $data['Product_id']);
         $this->db->update('product', $data);
      }
      public function selectProduct($id){
			$this->db->where("Product_id",$id);
			$query=$this->db->get('product');
			return $query->row();
      }
      public function selectAsset(){
         $id=$this->input->get('id');
			$this->db->where("Asset_id",$id);
			$query=$this->db->get('assets');
         return $query->row();
      }
      public function UpdateAssett($data){
         $this->db->where('Asset_id', $data['Asset_id']);
         $this->db->update('assets', $data);
      }
   }
?>