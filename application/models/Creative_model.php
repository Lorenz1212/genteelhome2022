<?php 
class Creative_model extends CI_Model{  
	public function __construct(){
	    parent::__construct();
	    $this->user_id = $this->appinfo->creative('_DESIGNER_ID');
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
	function Design_Project($type,$val){
		switch ($type) {
			case 'fetch_design_project_edit':
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
			
			default:
				return false;
				break;
		}
	}
	function Submit_Design_Project($type,$title,$image,$tmp,$docs,$docs_tmp,$id){
		$path_image ="assets/images/design/project_request/images/";	
		$path_docs  =  "assets/images/design/project_request/docx/";
		switch ($type) {
			case 'edit_design-project':
				$id = $this->encryption->decrypt($id);
				$sql = "SELECT * FROM tbl_project_color c LEFT JOIN tbl_project_design d ON c.project_no=d.id WHERE c.id='$id'";
				$row = $this->db->query($sql)->row();
				if($row){
					$newimage = $row->image;
					if($image){	
					    if($row->image != 'default.png'){
					    	unlink($path_image.$row->image);
					    }
					    $newimage=$this->Get_Image_Code('tbl_project_color', 'image', 'IMAGE', 14, $image);
					    $this->move_to_folder($newimage,$tmp,$path_image);
					}
					$docs_file = $row->docs;
					if($docs){
					    if($row->docs != 'default.png'){
					    	unlink($path_docs.$row->docs);
					    }
					   	$docs_file=$this->Get_Image_Code('tbl_project_color', 'docs', 'DOCS', 14, $docs);
					    $this->move_to_folder($docs_file,$docs_tmp,$path_docs);
					}
					if($image || $docs){
						$this->db->where('id',$row->id)->update('tbl_project_design',array('title'=>$title));
						$this->db->where('id',$id)->update('tbl_project_color',array('image'=>$newimage,'docs'=>$docs_file));
					}
					return array('type'=>'success','message'=>'Save Changes');	
				}else{
					return false;
				}
			   return $tmp;
				break;
			case "add_design_project":{
				if($image){
					$newimage=$this->Get_Image_Code('tbl_project_color', 'image', 'IMAGE', 14, $image);
					$this->move_to_folder($newimage,$tmp,$path_image);
				}else{
					return array('type'=>'info','message'=>'Please upload image of your project');
				}
				if($docs){
					$docs_file=$this->Get_Image_Code('tbl_project_color', 'docs', 'DOCS', 14, $docs);
					$this->move_to_folder($docs_file,$docs_tmp,$path_docs);
				}else{
					return array('type'=>'info','message'=>'Please upload specification of your project');
				}
				if($image || $docs){
					$project_no=$this->get_random_code('tbl_project_design', 'project_no', "PNXID", 8);
					$this->db->insert('tbl_project_design',array('project_no'=>$project_no,'title'=>$title));
					$last_id = $this->db->insert_id();
					$data = array('designer'=> $this->user_id,
			   					  'project_no'=> $last_id,
			   					  'image' => $newimage,
			   					  'docs' => $docs_file,   					  			
			                      'status' => 1,
			                      'type' => 2,
			   					  'date_created'=>  date('Y-m-d H:i:s'),
			   					  'created_by'=> $this->user_id);
					$this->db->insert('tbl_project_color',$data);
					return array('type'=>'success','message'=>'Create Successfully');
				}
				break;
			}
			
			default:
				// code...
				break;
		}
	}

}