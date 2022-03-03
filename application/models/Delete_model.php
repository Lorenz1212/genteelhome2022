<?php
class Delete_model extends CI_Model
{  
   function Delete_Web_Project_Image($id){        
      $query = $this->db->select('*')->from('tbl_project_image')->where('id',$id)->get();
      $row = $query->row();
      unlink("./assets/images/finishproduct/product/".$row->images);
      $this->db->where('id',$id);
	  $this->db->delete('tbl_project_image');
   } 
   function Delete_Web_Project_Gallery($id){        
      $query = $this->db->select('*')->from('tbl_project_gallery')->where('id',$id)->get();
      $row = $query->row();
      unlink("./assets/images/finishproduct/product/".$row->g_images);
      $this->db->where('id',$id);
      $this->db->delete('tbl_project_gallery');
   } 
   function Delete_Web_Cart($id){        
      $this->db->where('id',$id);
      $this->db->delete('tbl_cart_add');
   } 
   function Delete_Collection($id){        
      $this->db->where('id',$id);
      $this->db->delete('tbl_cart_collection');
   } 
    function Delete_Web_Interior_Image($id){        
      $query = $this->db->select('*')->from('tbl_interior_image')->where('id',$id)->get();
      $row = $query->row();
      unlink("./assets_website/images/".$row->images);
      $this->db->where('id',$id);
      $this->db->delete('tbl_interior_image');
   } 
   function Delete_Cash_Position($id){
      $decrypt_id = $this->encryption->decrypt($id);
      $this->db->where('id',$decrypt_id);
      $this->db->delete('tbl_cash_position');
   }
   function Delete_Testimony($id){
      $query = $this->db->select('*')->from('tbl_customer_testimony')->where('id',$this->encryption->decrypt($id))->get();
      $row = $query->row();
      unlink("./assets/images/testimony/".$row->image);
      $this->db->where('id',$this->encryption->decrypt($id));
      $this->db->delete('tbl_customer_testimony');
   }
   function Delete_Inspection_Image($id){
      $query = $this->db->select('*')->from('tbl_product_inspection')->where('id',$id)->get();
      $row = $query->row();
      unlink("./assets/images/inspection/".$row->images);
      $this->db->where('id',$id);
      $this->db->delete('tbl_product_inspection');
   }
}
?>
