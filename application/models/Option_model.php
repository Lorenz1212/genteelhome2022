<?php
class Option_model extends CI_Model
{  
   //Fetch Data
	function pallet_color($id){        
     $query = $this->db->select('*')->from('tbl_project_color')->where('type',1)->where('status',2)->where('project_no',$this->encryption->decrypt($id))->order_by('date_created','DESC')->get();
	    if(!$query){return false;}else{ 
	        foreach($query->result() as $row){  
	          $data[] = array('id'=> $this->encryption->encrypt($row->id),'name'=>$row->c_name);
	        }  
	        return $data;   
	    }
	}
	function pallet_docs($id){        
     $query = $this->db->select('*')->from('tbl_project_color')->where('type',1)->where('status',2)->where('id',$this->encryption->decrypt($id))->order_by('date_created','DESC')->get();  
	  return $query->row();   
	   
	}  
	function design_project_docs($id){        
     $query = $this->db->select('*')->from('tbl_project_color')->where('type',2)->where('status',2)->where('project_no',$this->encryption->decrypt($id))->order_by('date_created','DESC')->get();  
	  return $query->row();   
	   
	}  
	function Purchased_Item($item,$supplier){
		$query_supplier = $this->db->select('*')->from('tbl_supplier')->where('id',$this->encryption->decrypt($supplier))->get();
		$query_item = $this->db->select('*,p.id as id,m.id as item_id,m.item as item')
					->from('tbl_purchasing_project as p')
					->join('tbl_materials as m','p.item_no=m.id','LEFT')
					->where('p.id',$item)->get();
		$data_array = array('supplier'=> $query_supplier->row(),
							'item'=>$query_item->row());
		return $data_array;   
	}
   function supplier_option(){        
     $this->db->select('*')->from('tbl_supplier')->where('status', 'ACTIVE')->order_by('date_created','DESC');
     $query = $this->db->get();
	    if(!$query){return false;}else{   
	        foreach($query->result() as $row)  
	        {  
	          $data[] = array('id'=> $row->id,'name' => $row->name);
	          
	        }  
	        return $data;   
	    }
	} 
	function Item_option(){        
     $this->db->select('*,(stocks+production_stocks) as stocks')->from('tbl_materials')->where('status', 'ACTIVE')->order_by('date_created','DESC');
     $query = $this->db->get();
	    if(!$query){return false;}else{ 
	        foreach($query->result() as $row)  
	        {  
	          $data[] = array('id'=> $row->id,'item_no'=>$row->item_no,'name' => $row->item,'qty' =>$row->stocks);
	          
	        }  
	        return $data;   
	    }
	} 
	function Designer_option(){
		$this->db->select('*')->from('tbl_project_design')->WHERE('project_status', 'APPROVED')->order_by('date_created','DESC');
        $query = $this->db->get();
	    if(!$query){return false;}else{ 
	        foreach($query->result() as $row)  
	        {  
	          $data[] = array('project_no' => $row->project_no,'title'=> $row->title);
	        }  
	        return $data;   
	    }
	}
	function Color_option($id){
		$this->db->select('*')->from('tbl_project_color')->where('id',$this->encryption->decrypt($id))->where('status', 2)->where('type',1)->order_by('date_created','DESC');
     $query = $this->db->get();
	    if(!$query){return false;}else{ 
	        foreach($query->result() as $row){  
	          $data[] = array('c_code' => $row->c_code,'c_name'=> $row->c_name,'stocks' => $row->stocks);
	        }  
	        return $data;   
	    }
	}
	function Image_option($id){
		 $query =  $this->db->select('*')->from('tbl_project_color')->where('c_code',$id)->get();
     	 return $query->row();
	}
	function imageproject_option($id){
		 $query =  $this->db->select('*')->from('tbl_project_color')->where('project_no',$this->encryption->decrypt($id))->get();
     	 return $query->row();
	}
	function Project_option(){
		$this->db->select('*')->from('tbl_project')->where('status', 'REQUEST')->order_by('date_created','ASC');
     $query = $this->db->get();
	    if(!$query){return false;}else{ 
	        foreach($query->result() as $row){  
	          $data[] = array('production_no'=> $row->production_no,'title'=> $row->title,'unit'=> $row->unit);
	        }  
	        return $data;   
	    }
	}
	function Product_option(){
		$query =$this->db->select('*')->from('tbl_project_design')->WHERE('type', 1)->get();
	    if(!$query){return false;}else{ 
	        foreach($query->result() as $row)  
	        {  
	          $data[] = array('id' => $this->encryption->encrypt($row->id),'title'=> $row->title);
	        }  
	        return $data;   
	    }
	}
	function Finishproduct_option($project_no,$c_code){
		$this->db->select('*')->from('tbl_project_color as c')
		->join('tbl_project_design as d','d.project_no=c.project_no','LEFT')
		->where('c.project_no', $project_no)->where('c.c_code',$c_code);
     $query = $this->db->get();
	   return $query->row();   
	}
	function User_option(){
		   $query = $this->db->select('*')->from('tbl_users')->get();
 			 $row = $query->row();
 			 return $row;
	}
	function UserUpdate_option($id,$username){
		   $query = $this->db->select('*')->from('tbl_users')->where('id',$id)->get();
		   $row = $query->row();
		   if(!$row){
		   	   $query1 = $this->db->select('*')->from('tbl_users')->where('username',$username)->get();
		   	   $row1 = $query1->row();
		   	   if(!$row1){
		   	   			$status = 'success';
		   	   	}else{
		   	   			$status = 'error';
		   	   	}
		   }else{
		   	 	 if($username == $row->username){
		   	   		$status = 'warning';
		   	   }else{
		   	   	  $query1 = $this->db->select('*')->from('tbl_users')->where('username',$username)->get();
		   	   		$row1 = $query1->row();
		   	   		if(!$row1){
		   	   			$status = 'success';
		   	   		}else{
		   	   			$status = 'error';
		   	   		}
		   	   		
		   	   }
		   }
 			 return $status;
 			
	}
	function Password_option($id,$password){
			$query = $this->db->selet('*')->from('tbl_users')->where('id',$id)->where('password',$password)->get();
		  $row = $query->row();
		  return $row;
	}
	function SO_option(){
	  	$query = $this->db->select('*')->from('tbl_salesorder')->where('status','DELIVERED')->get();
		   if(!$query){return false;}else{ 
	        foreach($query->result() as $row)  
	        {  
	          $data[] = array('so_no'	 => $row->so_no);
	          
	        }  
	        return $data;   
	    }
	}
	function ItemQty_option($id){
		  $query = $this->db->select('*')->from('tbl_materials')->where('id',$id)->get();
		  $row = $query->row();
		  return $row;
	}
	function Spare_Option(){
		$query= $this->db->select('*')->from('tbl_spares')->where('status', 'ACTIVE')->order_by('date_created','DESC')->get();
	     if($query !== FALSE && $query->num_rows() > 0){
	        foreach($query->result() as $row)  
	        {  
	          $data[] = array('id'=> $row->id,'name' => $row->item,'qty' =>$row->stocks);
	        }  
	        return $data;   
	    }else{
	    	return false;
	    }
	}
	function Office_Option(){
		 $this->db->select('*')->from('tbl_office_janitorial')->where('status', 'ACTIVE')->order_by('date_created','DESC');
     $query = $this->db->get();
	    if(!$query){return false;}else{ 
	        foreach($query->result() as $row)  
	        {  
	          $data[] = array('id'=> $row->id,'name' => $row->item,'qty' =>$row->stocks);
	          
	        }  
	        return $data;   
	    }
	}
	function UserJobOrder_option()
   {        
     $this->db->select('*')->from('tbl_users')->where('status', 'ACTIVE')->order_by('date_created','DESC');
     $query = $this->db->get();
	    if(!$query){return false;}else{ 
	        foreach($query->result() as $row)  
	        {  
	        	$fullname = $row->lastname.' '.$row->firstname;
	          $data[] = array('id'=> $row->id,'name' => $fullname);
	          
	        }  
	        return $data;   
	    }
	}
	   function Category_option(){
        $query = $this->db->select('*')->from('tbl_category')->get();
        if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row)  
            {
             $data[] = array(
                      'id'           => $row->id,
                      'name'         => $row->cat_name);
            }  
        }else{
            $data = false;
        }
         return $data;   
     }
     function SubCategory_option($id){
     	 $query = $this->db->select('*')->from('tbl_category_sub')->where('cat_id',$this->encryption->decrypt($id))->get();
        if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row)  
            {
             $data[] = array('id'  => $this->encryption->encrypt($row->id),
                      		'name' => $row->sub_name);
            }  
        }else{
            $data = false;
        }
         return $data; 
     }
     function SubCategory_Update_option($id){
     	 $query = $this->db->select('*')->from('tbl_category_sub')->where('cat_id',$id)->get();
        if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row)  
            {
             $data[] = array('id'  => $row->id,
                      		'name' => $row->sub_name);
            }  
        }else{
            $data = false;
        }
         return $data; 
     }
     function SubCategory_Edit_option($id){
     	 $query = $this->db->select('*')->from('tbl_category_sub')->where('id',$id)->get();
        if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row)  
            {
             $data[] = array('id'  => $row->id,
                      		'name' => $row->sub_name);
            }  
        }else{
            $data = false;
        }
         return $data; 
     }
     function email_option($id){
		$query = $this->db->select('*')->from('tbl_customer_online')->where('email',$id)->get();
		$row = $query->row();
		if(!$row){return 'success';}else{return 'error';}	  
     }
     function email_update($id,$email){
     	$query = $this->db->select('*')->from('tbl_customer_online')->where('id',$id)->get();
		$row = $query->row();
		if($row->email == $email){
			return 'success';
		}else{
			$query = $this->db->select('*')->from('tbl_customer_online')->where('id !=',$id)->where('email',$email)->get();
			$row = $query->row();
			if(!$row){
				return 'success';
			}else{
				return 'error';
			}
		} 
     }
      function voucher_option(){
      			 $coupon = substr(str_shuffle(str_repeat('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',10-2)),0,10-2);
				     $ret = $coupon.date('md');
				     return $ret;
     }
     function region_option(){
     	 $query = $this->db->select('*')->from('tbl_region_shipping')->get();
        if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row)  
            {
             $data[] = array(
                      'id'           => $row->id,
                      'name'         => $row->region);
            }  
        }else{
            $data = false;
        }
         return $data; 
     }
     function shipping_option($id){
     	 $query = $this->db->select('*')->from('tbl_region_shipping')->where('id',$id)->get();
     	 return $query->row();
     }
     function Joborder_Option(){
     	$names = array('REQUEST', 'COMPLETE', 'PARTIAL');
     	 $query = $this->db->select('*')->from('tbl_project')->where_in('status',$names)->order_by('production_no','DESC')->get();
     	 if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row)  
            {
             $data[] = array(
                      'id'           					=> $row->id,
                      'production_no'         => $row->production_no);
            }  
        }else{
            $data = false;
        }
         return $data; 
     }
     function Joborder1_Option(){
     	$names = array('REQUEST', 'COMPLETE', 'PARTIAL','PENDING');
     	 $query = $this->db->select('*')->from('tbl_project')->where_in('status',$names)->order_by('production_no','DESC')->get();
     	 if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row)  
            {
             $data[] = array(
                      'id'           					=> $row->id,
                      'production_no'         => $row->production_no);
            }  
        }else{
            $data = false;
        }
         return $data; 
     }
     function Material_Request_Option($id){        
	    $query = $this->db->select('*')->from('tbl_materials')->where('id',$id)->get();
		 return $query->row();   
	} 
	
	function Customer_Name(){
		 $data =array();
		 $query = $this->db->select('*')->from('tbl_salesorder_customer')->get();
     	 if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row){
	             $data[] = array('id'=>$this->encryption->encrypt($row->id),
	                      		 'name'=>$row->fullname);
	           }  
        }
        return $data;
	}
	function customer_info($id){
		$query = $this->db->select('*')->from('tbl_salesorder_customer')->where('id',$this->encryption->decrypt($id))->get();
		return $query->row();
	}
	function Material_option($id){
		$query = $this->db->select('*')->from('tbl_materials')->where('id',$id)->get();
		return $query->row();
	}
	function Purchase_option($id){
		$query = $this->db->select('*')->from('tbl_materials')->where('id',$id)->get();
		return $query->row();
	}
	function Option_other_expenses(){
     	 $query = $this->db->select('*')->from('tbl_category_expenses')->order_by('id','DESC')->get();
     	 if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row){
	             $data[] = array('id'=> $row->id,'name' => $row->name);
	           }  
        }else{
            $data = false;
        }
         return $data; 
	}
	function Option_Income_Statement(){
     	 $query = $this->db->select('*')->from('tbl_category_income')->order_by('id','ASC')->get();
     	 if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row){
	             $data[] = array('id'=> $row->id,'name'=> $row->name);
	           }  
        }else{
            $data = false;
        }
         return $data; 
	}
	function item_list($type){
		if($type == 1){
			$query = $this->db->select('*')->from('tbl_materials')->get();
		}else if($type == 2){
			$query = $this->db->select('*')->from('tbl_other_materials')->where('type',1)->get();
		}else {
			$query = $this->db->select('*')->from('tbl_other_materials')->where('type',2)->get();
		}
		$data = false;
	    
	     if($query !== FALSE && $query->num_rows() > 0){
              foreach($query->result() as $row){
	             $data[] = array('id'=> $row->id,
	             				 'name'=> $row->item);
	           }  
        }
		return $data;
	}
}
?>
