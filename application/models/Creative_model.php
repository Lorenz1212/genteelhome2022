<?php 
class Creative_model extends CI_Model{  
	public function __construct(){
	    parent::__construct();
     		if($this->appinfo->creative('_DESIGNER_ID') != false){
          $this->user_id = $this->appinfo->creative('_DESIGNER_ID');
          $this->role_name = $this->appinfo->creative('_DESIGNER_ROLE');
        }else if($this->appinfo->production('_PRODUCTION_ID') != false){
          $this->user_id = $this->appinfo->production('_PRODUCTION_ID');
          $this->role_name = $this->appinfo->creative('_PRODUCTION_ROLE');
        }else if($this->appinfo->supervisor('_SUPERVISOR_ID') != false){
          $this->user_id = $this->appinfo->supervisor('_SUPERVISOR_ID');
          $this->role_name = $this->appinfo->creative('_SUPERVISOR_ROLE');
        }else if($this->appinfo->sales('_SALES_ID') != false){
          $this->user_id = $this->appinfo->sales('_SALES_ID');
          $this->role_name = $this->appinfo->creative('_SALES_ROLE');
        }else if($this->appinfo->superuser('_SUPERUSER_ID') != false){
          $this->user_id = $this->appinfo->superuser('_SUPERUSER_ID');
          $this->role_name = $this->appinfo->creative('_SUPERUSER_ROLE');
        }else if($this->appinfo->accounting('_ACCOUNTING_ID') != false){
         $this->user_id = $this->appinfo->accounting('_ACCOUNTING_ID');
         $this->role_name = $this->appinfo->creative('_ACCOUNTING_ROLE');
        }else if($this->appinfo->webmodifier('_WEBMODIFIER_ID') != false){
          $this->user_id = $this->appinfo->webmodifier('_WEBMODIFIER_ID');
          $this->role_name = $this->appinfo->creative('_WEBMODIFIER_ROLE');
        }else if($this->appinfo->admin('_ADMIN_ID') != false){
          $this->user_id = $this->appinfo->admin('_ADMIN_ID');
          $this->role_name = $this->appinfo->creative('_ADMIN_ROLE');
        }
    }
     private function setCookies($token, $data, $days,$type,$role){
        $auth = array('name' =>$type.'_'.$role.'_auth','value'=> $token,'expire' => time() + (86400 * $days),'secure' => FALSE);
        $this->input->set_cookie($auth);
        $user = array('name' => $type.'_'.$role.'_user','value'=> $this->encryption->encrypt(json_encode($data)),'expire' => time() + (86400 * $days),'secure' => TRUE);
        $this->input->set_cookie($user);
    }
     private function TODAY(){
       date_default_timezone_set('Asia/Manila');
       $datestamp = date("Y-m-d");
       $timestamp = date("H:i:s");
       return $now = $datestamp.' '.$timestamp;
    }
    private function _set_data($type,$role,$result){
        $data = array(
          $type.'_'.$role.'_ID'=>$result->id,
          $type.'_'.$role.'_FNAME'=>$result->fname, 
          $type.'_'.$role.'_LNAME'=> $result->lname, 
          $type.'_'.$role.'_UNAME'=>$result->username, 
          $type.'_'.$role.'_EMAIL'=>$result->email, 
          $type.'_'.$role.'_PROFILE' =>$result->profile_img, 
          $type.'_'.$role.'_AdSTATUS'=>md5("active"), 
          $type.'_'.$role.'_TYPE'=>md5($role),
          $type.'_'.$role.'_COUNTRY'=>$result->country, 
          $type.'_'.$role.'_ROLE'=>$role  
        );
        $this->session->set_userdata($data);
        return $data;
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
	function Profile($type,$val,$val1,$image,$tmp){
		$userid = $this->user_id;
		$role = $this->role_name;
		switch($type){
			case"fetch_profile":{
				$sql = "SELECT * FROM tbl_administrator WHERE id='$userid'";
				$row = $this->db->query($sql)->row();
				if($row){
					return $row;
				}else{
					return false;
				}
				break;
			}
			case "fetch_profile_update":{
				$sql = "SELECT * FROM tbl_administrator WHERE id='$userid'";
				$row = $this->db->query($sql)->row();
				if($row){
					$sql = "SELECT * FROM tbl_administrator WHERE id!='$userid' AND $val1='$val'";
					$row = $this->db->query($sql)->row();
					if($row){
						if($val1 != 'password'){
								return array('type'=>'info','message'=> $val.' is already existing');
								exit();
						}
					}
					if($val1 == 'password'){
						$result = $this->db->where('id',$userid)->update('tbl_administrator',array($val1=>md5($val)));
					}else{
						$result = $this->db->where('id',$userid)->update('tbl_administrator',array($val1=>$val));
					}
					if($result){
						$this->Login_Pass($userid,$role);
						return array('type'=>'success','message'=>'Save Changes');
					}else{
						return array('type'=>'success','message'=>'Nothing Changes');
					}
				}else{
					return false;
				}
				break;
			}
			case "fetch_profile_update_image":{
				$sql = "SELECT * FROM tbl_administrator WHERE id='$userid'";
				$row = $this->db->query($sql)->row();
				if($row){
						$newimage = $row->profile_img;
					if($image){	
					    if($row->profile_img != 'default.jpg'){
					    	if(file_exists("assets/images/profile/".$row->profile_img)){
					    			unlink("assets/images/profile/".$row->profile_img);
					    	}
					    }
					    $newimage=$this->Get_Image_Code('tbl_administrator', 'profile_img', 'IMAGE', 14, $image);
					    $this->move_to_folder($newimage,$tmp,"assets/images/profile/");
					}
					$result = $this->db->where('id',$userid)->update('tbl_administrator',array('profile_img'=>$newimage));
					if($result){
						$this->Login_Pass($userid,$role);
						return array('type'=>'success','message'=>'Save Changes');
					}else{
						return array('type'=>'success','message'=>'Nothing Changes');
					}
				}else{
					return false;
				}
				break;
			}
		}
	}
	private function Login_Pass($userid,$role_name){
            $remember = 30;
            //GET first 9 digit of NEW IP ADDRESS
            $ip_address_main=$this->input->ip_address();
            $arr = explode(".",$ip_address_main);
            unset($arr[3]);
            $ip_address = implode(".",$arr);

            $data_response = array();
            $admin = $this->db->select('*')->from('tbl_administrator')->where('id',$userid)->get()->row();
            if($admin){
             	$email=$admin->email;
              $token="";
              $data = array();
              //GET first 9 digit of OLD IP ADDRESS
              $arr = explode(".",$admin->ipadd_prev);
              unset($arr[3]);
              $ip_address_prev = implode(".",$arr);
              $this->db->where('email',$email);
              $this->db->update('tbl_administrator',array('ipadd_prev'=>$ip_address_main));
              $token = md5($admin->username.''.$this->TODAY().''.$ip_address_main);
              $device = "setupbrowsecap";
              $admin_id=$admin->id;
              $data = $this->_set_data($this->appinfo->sess_name(),strtoupper($role_name),$admin);
              $this->setCookies($token, $data, $remember,$this->appinfo->sess_name(),$role_name);
           }
	}
	function Design_Stocks($type,$val){
		switch ($type) {
			case "fetch_design_stocks_list":
				$data_array = array();
				$sql = "SELECT * FROM tbl_project_design WHERE project_status='APPROVED' AND type=1";	
				$query = $this->db->query($sql);
				if($query){
					foreach($query->result() as $row){
						$data_array[]=array('id'=>$row->id,'title'=>$row->title);
					}
					return $data_array;
				}else{
					return false;
				}
				break;
			case 'fetch_design_stocks_edit':
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
			

			default:
				return false;
				break;
		}
	}
	function Submit_Design_Stocks($type,$title,$pallet_name,$image,$tmp,$docs,$docs_tmp,$pallet_image,$pallet_tmp,$id){
		$path_image ="assets/images/design/project_request/images/";
		$path_pallet  =  "assets/images/palettecolor/";
		$path_docs  =  "assets/images/design/project_request/docx/";
		switch ($type) {
			case 'edit_design-stocks':
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
					$newpalletimage = $row->c_image;
					if($pallet_image){	
					    if($row->c_image != 'default.png'){
					    	unlink($path_pallet.$row->c_image);
					    }
					    $newpalletimage=$this->Get_Image_Code('tbl_project_color', 'c_image', 'PALLET', 14, $pallet_image);
					    $this->move_to_folder($newpalletimage,$pallet_tmp,$path_pallet);
					}
					$docs_file = $row->docs;
					if($docs){
					    if($row->docs != 'default.png'){
					    	unlink($path_docs.$row->docs);
					    }
					   	$docs_file=$this->Get_Image_Code('tbl_project_color', 'docs', 'DOCS', 14, $docs);
					    $this->move_to_folder($docs_file,$docs_tmp,$path_docs);
					}
					$this->db->where('id',$row->id)->update('tbl_project_design',array('title'=>$title));
					$this->db->where('id',$id)->update('tbl_project_color',array('c_name'=>$pallet_name,'c_image'=>$newpalletimage,'image'=>$newimage,'docs'=>$docs_file));
					return array('type'=>'success','message'=>'Save Changes');	
				}else{
					return false;
				}
				break;
			case "add_design_stocks":
				if($image){
					$newimage=$this->Get_Image_Code('tbl_project_color', 'image', 'IMAGE', 14, $image);
					$this->move_to_folder($newimage,$tmp,$path_image);
				}else{
					return array('type'=>'info','message'=>'Please upload image of your project');
				}
				if($pallet_image){	
					   $newpalletimage=$this->Get_Image_Code('tbl_project_color', 'c_image', 'PALLET', 14, $pallet_image);
					   $this->move_to_folder($newpalletimage,$pallet_tmp,$path_pallet);
				}else{
						return array('type'=>'info','message'=>'Please upload pallet color of your item');
				}
				if($docs){
					$docs_file=$this->Get_Image_Code('tbl_project_color', 'docs', 'DOCS', 14, $docs);
					$this->move_to_folder($docs_file,$docs_tmp,$path_docs);
				}else{
					return array('type'=>'info','message'=>'Please upload specification of your project');
				}
				if($image && $docs  && $pallet_image){
					$project_no=$this->get_random_code('tbl_project_design', 'project_no', "STXID", 8);
					$c_code=$this->get_random_code('tbl_project_color', 'c_code', "STXCODE", 8);
					$this->db->insert('tbl_project_design',array('project_no'=>$project_no,'title'=>$title,'type'=>1));
					$last_id = $this->db->insert_id();
					$data = array('designer'=> $this->user_id,
					   					  'project_no'=> $last_id,
					   					  'c_code'=>$c_code,
					   					  'c_name' => $pallet_name,
					   					  'c_image' => $newpalletimage,
					   					  'image' => $newimage,
					   					  'docs' => $docs_file,				  			
					              'status' => 1,
					               'type' => 1,
					   					  'date_created'=> date('Y-m-d H:i:s'),
					   					  'created_by'=> $this->user_id);
				$this->db->insert('tbl_project_color',$data);
				return array('type'=>'success','message'=>'Create Successfully');
			  }
				break;
				case "add_design_stocks-existing":
				if($pallet_image){	
					   $newpalletimage=$this->Get_Image_Code('tbl_project_color', 'c_image', 'PALLET', 14, $pallet_image);
					   $this->move_to_folder($newpalletimage,$pallet_tmp,$path_pallet);
				}else{
						return array('type'=>'info','message'=>'Please upload pallet color of your item');
				}
				if($docs){
					$docs_file=$this->Get_Image_Code('tbl_project_color', 'docs', 'DOCS', 14, $docs);
					$this->move_to_folder($docs_file,$docs_tmp,$path_docs);
				}else{
					return array('type'=>'info','message'=>'Please upload specification of your project');
				}
				if($docs  && $pallet_image){
					$row= $this->db->query("SELECT * FROM tbl_project_color WHERE project_no='$title' LIMIT 1")->row();
					$c_code=$this->get_random_code('tbl_project_design', 'project_no', "STXCODE", 8);
					$data = array('designer'=> $this->user_id,
					   					  'project_no'=> $title,
					   					  'c_code'=>$c_code,
					   					  'image' => $row->image,
					   					  'c_name' => $pallet_name,
					   					  'c_image' => $newpalletimage,
					   					  'docs' => $docs_file,				  			
					              'status' => 1,
					              'type' => 1,
					   					  'date_created'=> date('Y-m-d H:i:s'),
					   					  'created_by'=> $this->user_id);
					$this->db->insert('tbl_project_color',$data);
					return array('type'=>'success','message'=>'Create Successfully');
			  }
				break;
			default:
				return false;
				break;
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
					$this->db->where('id',$row->id)->update('tbl_project_design',array('title'=>$title));
					$this->db->where('id',$id)->update('tbl_project_color',array('image'=>$newimage,'docs'=>$docs_file));
					return array('type'=>'success','message'=>'Save Changes');	
				}else{
					return false;
				}
				break;
			case "add_design_project":
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
				if($image && $docs){
					$project_no=$this->get_random_code('tbl_project_design', 'project_no', "PNXID", 8);
					$this->db->insert('tbl_project_design',array('project_no'=>$project_no,'title'=>$title,'type'=>2));
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
			default:
				return false;
				break;
		}
	}

}