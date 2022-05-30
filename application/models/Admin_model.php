<?php 
class Admin_model extends CI_Model{  
	public function __construct(){
	    parent::__construct();
	    $this->user_id = $this->appinfo->admin('_ADMIN_ID');
    }
	 private function move_to_folder_docs($image,$tmp,$path){
         $path_folder = $path.$image;
         copy($tmp, $path_folder);
         return true;
 	 }
	 private function move_to_folder($newimage,$tmp,$path){
        $target_file = $path.basename($newimage);
        return move_uploaded_file($tmp, $target_file);
   }
  	private function Get_Image_Code($table, $column, $key, $length, $image){
      $code = $this->get_code($key, $length);
      if($code){
        $arr_image = explode('.', $image);
        $fileActualExt = strtolower(end($arr_image));
        $newimage = $code."-".str_replace(array( '-', '_', ' ', ',' , '(', ')'), '', $arr_image[0]).".". $fileActualExt;
        $check = $this->Check_Code($table, $column, $newimage);
        while ($check){
          $code = $this->get_code($key, $length);
          if($code){
            $arr_image = explode('.', $image);
            $fileActualExt = strtolower(end($arr_image));
            $newimage = $code."-".str_replace(array( '-', '_', ' ', ',' , '(', ')'), '', $arr_image[0]).".". $fileActualExt;
            $check = $this->Check_Code($table, $column, $newimage);
          }else{
            return false;
          }
        }
      }else{
        return false;
      }
      return $newimage;
   }
	  public function get_code($key, $length) {
	    return  $key.$this->Ac_Code($length);
	  }
	  private function Ac_Code($codelength) { 
	    $random="";srand((double)microtime()*1000000);
	    $data = "ABCDEFGHJKLMNPQRSTUVWXYZ"; 
	    $data .= "123456789"; 
	    $data .= "54321ABCXVXV6789";
	    for($i = 0; $i < $codelength; $i++) {
	      $random .= substr($data, (rand()%(strlen($data))), 1);
	    }
	    return $random; 
	  }
	 private function get_random_code($table, $column, $key, $length){
	  	   $code = $this->get_code($key, $length);
	       if($code){
	           $check = $this->Check_Code($table, $column, $code);
	            while ($check){
				    $code = $this->get_code($key, $length);
				    if($code){
				   	  $check = $this->Check_Code($table, $column, $code);
				    }else{
		              return false;
		            }
				}
	        }else{
	        	return false;
	        }
	        return $code;
	}
	private function Check_Code($table, $column, $code){
        $sql="SELECT ".$column." FROM ".$table." WHERE ".$column."='$code'";
		if($this->db->query($sql)->num_rows() >= 1){ 
        	return true;
	    }else{
        	return false;
        }
	}
		function Design_Stocks($type,$val,$val1,$val2){
		switch ($type) {
			case 'fetch_design_stocks':
				$id = $this->encryption->decrypt($val);
				$data_array = array();
				$sql = "SELECT *,c.id,(SELECT CONCAT(fname,' ',lname) FROM tbl_administrator WHERE id=c.designer) as creator,DATE_FORMAT(c.date_created, '%M %d %Y %r') as date_created FROM tbl_project_color c LEFT JOIN tbl_project_design d ON c.project_no=d.id WHERE c.id='$id'";	
				$row = $this->db->query($sql)->row();
				if($row){
					$data_array['info']=$row;
					$data_array['id']=$this->encryption->encrypt($row->id);
					return $data_array;
				}else{
					return false;
				}
				break;
			case "fetch_design_stocks_status":
				$id = $this->encryption->decrypt($val);
				$sql = "SELECT * FROM tbl_project_color WHERE id='$id'";
				$row = $this->db->query($sql)->row();
				if($row){
					$project_no = $row->project_no;
					$result = $this->db->where('id',$id)->update('tbl_project_color',array('approver'=>$this->user_id,'status'=>$val1,'remark'=>$val2,'date_approved'=>date('Y-m-d H:i:s')));
					if($result){
						if($val1 == '2'){
							$sql ="SELECT * FROM tbl_project_design WHERE id='$project_no' AND project_status !='APPROVED'";
							$rows = $this->db->query($sql)->row();
							if($rows){
								 $result = $this->db->where('id',$project_no)->update('tbl_project_design',array('project_status'=>'APPROVED'));
							}
							return array('type'=>'success','Approve Successfully');
						}else{
							return array('type'=>'success','Cancel Successfully');
						}
						
					}else{

					}
					
				}else{
					return false;
				}	
				break;
			
			default:
				return false;
				break;
		}
	}
	function Design_Project($type,$val,$val1,$val2){
		switch ($type) {
			case 'fetch_design_project':
				$id = $this->encryption->decrypt($val);
				$data_array = array();
				$sql = "SELECT *,c.id,(SELECT CONCAT(fname,' ',lname) FROM tbl_administrator WHERE id=c.designer) as creator,DATE_FORMAT(c.date_created, '%M %d %Y %r') as date_created FROM tbl_project_color c LEFT JOIN tbl_project_design d ON c.project_no=d.id WHERE c.id='$id'";	
				$row = $this->db->query($sql)->row();
				if($row){
					$data_array['info']=$row;
					$data_array['id']=$this->encryption->encrypt($row->id);
					return $data_array;
				}else{
					return false;
				}
				break;
			case "fetch_design_project_status":
				$id = $this->encryption->decrypt($val);
				$sql = "SELECT * FROM tbl_project_color WHERE id='$id'";
				$row = $this->db->query($sql)->row();
				if($row){
					$result = $this->db->where('id',$id)->update('tbl_project_color',array('approver'=>$this->user_id,'status'=>$val1,'remark'=>$val2,'date_approved'=>date('Y-m-d H:i:s')));
					if($result){
						if($val1 == '2'){
							return array('type'=>'success','Approve Successfully');
						}else{
							return array('type'=>'success','Cancel Successfully');
						}
					}else{

					}
				}else{
					return false;
				}	
				break;
			
			default:
				return false;
				break;
		}
	}
	function Inspection_Stocks($type,$val,$val1,$val2){
		switch ($type) {
			case 'fetch_inspection_stocks':
				$id = $this->encryption->decrypt($val);
				$data_array = array();
				$sql = "SELECT *,
				(SELECT CONCAT(fname,' ',lname) FROM tbl_administrator WHERE id=p.assigned) as creator,
				(SELECT title FROM tbl_project_design WHERE id=p.project_no) as title,
				(SELECT c_name FROM tbl_project_color WHERE id=p.c_code) as c_name,
				DATE_FORMAT(p.date_created, '%M %d %Y %r') as date_created FROM tbl_project p WHERE p.production_no='$id'";	
				$row = $this->db->query($sql)->row();
				$data_array['info']=$row;
				$sql = "SELECT * FROM tbl_project_inspection WHERE production_no='$id'";	
				$query = $this->db->query($sql);
				if($query){
					foreach($query->result() as $row){
						$data_array['inspection'][]=array('image'=>$row->images);
					}
					return $data_array;
				}else{
					return false;
				}
				break;
			case 'fetch_inspection_stocks_approved':
					$id = $this->encryption->decrypt($val);
					$id1 = $this->encryption->decrypt($val1);
					$data_array = array();
					$sql = "SELECT *,
					(SELECT CONCAT(fname,' ',lname) FROM tbl_administrator WHERE id=p.assigned) as creator,
					(SELECT title FROM tbl_project_design WHERE id=p.project_no) as title,
					(SELECT c_name FROM tbl_project_color WHERE id=p.c_code) as c_name,
					DATE_FORMAT(p.date_created, '%M %d %Y %r') as date_created FROM tbl_project p WHERE p.production_no='$id'";	
					$row = $this->db->query($sql)->row();
					$data_array['info']=$row;
					$sql = "SELECT * FROM tbl_project_inspection WHERE production_no='$id' AND ins_no='$id1'";	
					$query = $this->db->query($sql);
					if($query){
						foreach($query->result() as $row){
							$data_array['inspection'][]=array('image'=>$row->images);
						}
						return $data_array;
					}else{
						return false;
					}
					break;	
			case "fetch_inspection_stocks_status":
				$id = $this->encryption->decrypt($val);
				$value=$this->get_random_code('tbl_project_inspection', 'ins_no', "INSPXID", 8);
	      $data = array('ins_no'=>$value,
	                    'status'=>$val1,
	                    'remarks'=> $val2,
	                    'latest_update' => date('Y-m-d H:i:s'),
	                    'update_by'=>$this->user_id);
	      $result = $this->db->where('ins_no','0')->where('production_no',$id)->update('tbl_project_inspection',$data);
				if($result){
					if($val1 == '2'){
						return array('type'=>'success','Approve Successfully');
					}else{
						return array('type'=>'success','Cancel Successfully');
					}
				}else{
					return false;
				}
				break;
			
			default:
				return false;
				break;
		 }
	 }
	function Inspection_Project($type,$val,$val1,$val2){
		switch ($type) {
			case 'fetch_inspection_project':
				$id = $this->encryption->decrypt($val);
				$data_array = array();
				$sql = "SELECT *,
				(SELECT CONCAT(fname,' ',lname) FROM tbl_administrator WHERE id=p.assigned) as creator,
				(SELECT title FROM tbl_project_design WHERE id=p.project_no) as title,
				DATE_FORMAT(p.date_created, '%M %d %Y %r') as date_created FROM tbl_project p WHERE p.production_no='$id'";	
				$row = $this->db->query($sql)->row();
				$data_array['info']=$row;
				$sql = "SELECT * FROM tbl_project_inspection WHERE production_no='$id'";	
				$query = $this->db->query($sql);
				if($query){
					foreach($query->result() as $row){
						$data_array['inspection'][]=array('image'=>$row->images);
					}
					return $data_array;
				}else{
					return false;
				}
				break;
		case 'fetch_inspection_project_approved':
				$id = $this->encryption->decrypt($val);
				$id1 = $this->encryption->decrypt($val1);
				$data_array = array();
				$sql = "SELECT *,
				(SELECT CONCAT(fname,' ',lname) FROM tbl_administrator WHERE id=p.assigned) as creator,
				(SELECT title FROM tbl_project_design WHERE id=p.project_no) as title,
				DATE_FORMAT(p.date_created, '%M %d %Y %r') as date_created FROM tbl_project p WHERE p.production_no='$id'";	
				$row = $this->db->query($sql)->row();
				$data_array['info']=$row;
				$sql = "SELECT * FROM tbl_project_inspection WHERE production_no='$id' AND ins_no='$id1'";	
				$query = $this->db->query($sql);
				if($query){
					foreach($query->result() as $row){
						$data_array['inspection'][]=array('image'=>$row->images);
					}
					return $data_array;
				}else{
					return false;
				}
				break;
			case "fetch_inspection_project_status":
				$id = $this->encryption->decrypt($val);
				$value=$this->get_random_code('tbl_project_inspection', 'ins_no', "INSPXID", 8);
	      $data = array('ins_no'=>$value,
	                    'status'=>$val1,
	                    'remarks'=> $val2,
	                    'latest_update' => date('Y-m-d H:i:s'),
	                    'update_by'=>$this->user_id);
	      $result = $this->db->where('production_no',$id)->where('ins_no','0')->update('tbl_project_inspection',$data);
				if($result){
					if($val1 == '2'){
						return array('type'=>'success','Approve Successfully');
					}else{
						return array('type'=>'success','Cancel Successfully');
					}
				}else{
					return false;
				}
				break;
			
			default:
				return false;
				break;
		 }
	 }


}