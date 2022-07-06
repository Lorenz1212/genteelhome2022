<?php 
class Webmodifier_model extends CI_Model{  
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
    private function move_to_folder1($newimage,$tmp,$path){
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
   private function move_to_folder4($newfilename,$image,$tmp,$path,$targetWidth,$targetHeight){
   			$extension=pathinfo($image, PATHINFO_EXTENSION);
        $path_folder = $path.$newfilename;
        list($width, $height) = getimagesize($tmp);
        $file = $this->imageType($extension,$path_folder,$tmp,$targetWidth,$targetHeight,$width,$height);
        if($file == true){
            return $newfilename;
        }else{
            return false;
        }
    }
    private function move_to_folder5($newfilename,$image,$tmp,$path,$targetWidth,$targetHeight){
        $extension=pathinfo($image, PATHINFO_EXTENSION);
        $path_folder = $path.$newfilename;
        list($width, $height) = getimagesize($tmp);
        $file = $this->imageType($extension,$path_folder,$tmp,$targetWidth,$targetHeight,$width,$height);
        if($file == true){
            return $newfilename;
        }else{
            return false;
        }
    }
    private function imageType($extension,$path_folder,$tmp,$targetWidth,$targetHeight,$width,$height){
         if($extension=='png' || $extension=='PNG'){
               $targetLayer=imagecreatetruecolor($targetWidth,$targetHeight);
               $imageResourceId = imagecreatefrompng($tmp); 
               if(!imagecopyresampled($targetLayer,$imageResourceId,0,0,0,0,$targetWidth,$targetHeight,$width,$height)){
                     return false;
               }else{
                    imagepng($targetLayer,$path_folder);
                    return true;
               }
         }else if($extension=='jpg'  || $extension=='jpeg' || $extension=='JPG' || $extension=='JPEG'){
                $targetLayer=imagecreatetruecolor($targetWidth,$targetHeight);
                $imageResourceId = imagecreatefromjpeg($tmp); 
                if(!imagecopyresampled($targetLayer,$imageResourceId,0,0,0,0,$targetWidth,$targetHeight,$width,$height)){
                     return false;
               }else{
                    imagejpeg($targetLayer,$path_folder);
                    return true;
               }
         }
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
	public function Banner($type,$val){
		switch($type){
			case "fetch_banner_list":{
				$data = array();
				$sql = "SELECT *,IFNULL(sub_title,'No Subtitle') as sub_title,IFNULL(title,'No title') as title,DATE_FORMAT(date_created, '%M %d %Y %r') as date_created FROM tbl_website_banner ORDER BY type ASC,date_created DESC";
				$query = $this->db->query($sql);
				if($query){
					foreach($query->result() as $row){
						$stat ='';
						if($row->status=='ACTIVE'){
							$stat ='checked';
						}
						$action =  $this->Action('action1',$row->id,'update_status_banner','view-banner','delete-banner',$stat);
						$status = array('INACTIVE'=>array('state'=>'Inactive','color'=>'danger'),
                 								'ACTIVE'=>array('state'=>'Active','color'=>'success'));
            $status_data ='<span style="width: 112px;"><span class="label label-'.$status[$row->status]['color'].' label-dot mr-2"></span><span class="font-weight-bold text-'.$status[$row->status]['color'].'">'.$status[$row->status]['state'].'</span></span>';
            $image = '<span style="width: 250px;"><div class="d-flex align-items-center">
					                <div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/banner/'.$row->image.'" alt="photo"></div></span>';

						$data[]=array(
							'image'=>$image,
							'title'=>$row->title,
							'sub_title'=>$row->sub_title,
							'type'=>$row->type,
							'date_created'=>$row->date_created,
							'status'=>$status_data,
							'action'=>$action);
					}
					return $data;
				}else{
					return false;
				}
				break;
			}
			case "fetch_banner_details":{
				$id = $this->encryption->decrypt($val);
				$sql = "SELECT * FROM tbl_website_banner WHERE id='$id'";
				$row = $this->db->query($sql)->row();
				if($row){
					return $row;
				}else{
					return false;
				}
				break;
			}
				case "fetch_banner_status":{
				$id = $this->encryption->decrypt($val);
				$sql = "SELECT * FROM tbl_website_banner WHERE id='$id'";
				$row = $this->db->query($sql)->row();
				if($row){
					$status = 'INACTIVE';
					if($row->status == 'INACTIVE'){
						$status ='ACTIVE';
					}
					$data = array('status'=>$status);
					$result = $this->db->where('id',$id)->update('tbl_website_banner',$data);
					if($result){
						$response = $this->Banner('fetch_banner_list',false);
						return array('type'=>'success','message'=>'Save Changes','data'=>$response);
					}else{
						return false;
					}
				}else{
					return false;
				}
				break;
			}
			case "fetch_banner_delete":{
				$id = $this->encryption->decrypt($val);
				$sql = "SELECT * FROM tbl_website_banner WHERE id='$id'";
				$row = $this->db->query($sql)->row();
				if($row){
					 if($row->image != 'default.png'){
							if(file_exists('assets/images/banner/'.$row->image)){
								unlink('assets/images/banner/'.$row->image);
							}
				   }
				   $result = $this->db->where('id',$id)->delete('tbl_website_banner');
				   if($result){
				   		$response = $this->Banner('fetch_banner_list',false);
						  return array('type'=>'success','message'=>'Delete Successfully','data'=>$response);
				   }else{
				   	return false;
				   }
				}else{
					return false;
				}
				break;
			}
		}
	}

	public function Submit_Banner($type,$id,$title,$sub_title,$slide,$image,$tmp){
		switch($type){
			case "add_banner":{
				$sql = "SELECT * FROM tbl_website_banner WHERE type='$slide'";
				$row = $this->db->query($sql)->row();
				if($row){
					if($slide != 'OFF'){
						$this->db->where('type',$slide)->update('tbl_website_banner',array('type'=>'OFF'));
					}
				}
				$newimage = 'default.png';
				if($image){	
				    $newimage=$this->Get_Image_Code('tbl_website_banner', 'image', 'IMAGE', 14, $image);
				    $this->move_to_folder($newimage,$tmp,'assets/images/banner/');
				}
				$result = $this->db->insert('tbl_website_banner',array('title'=>$title,'sub_title'=>$sub_title,'type'=>$slide,'image'=>$newimage));
				if($result){
					$response = $this->Banner('fetch_banner_list',false);
					return array('type'=>'success','message'=>'Create Successfully','data'=>$response);
				}else{
					return false;
				}
				break;
			}
			case "update_banner":{
				$sql = "SELECT * FROM tbl_website_banner WHERE type='$slide' LIMIT 1";
				$row = $this->db->query($sql)->row();
				if($row){
					$this->db->where('type',$slide)->where('id !=',$id)->update('tbl_website_banner',array('type'=>'OFF'));
					$result = true;
				}else{
					 $result = true;
				}
				if($result == true){
					$sql = "SELECT * FROM tbl_website_banner WHERE id='$id'";
					$row = $this->db->query($sql)->row();
					if($row){
						$newimage = $row->image;
						if($image){	
								if($row->image != 'default.png'){
									if(file_exists('assets/images/banner/'.$row->image)){
										unlink('assets/images/banner/'.$row->image);
									}
						    }
						    $newimage=$this->Get_Image_Code('tbl_website_banner', 'image', 'IMAGE', 14, $image);
						    $this->move_to_folder($newimage,$tmp,'assets/images/banner/');
						}
						$data = array('title'=>$title,'sub_title'=>$sub_title,'type'=>$slide,'image'=>$newimage);
						$result = $this->db->where('id',$id)->update('tbl_website_banner',$data);
						if($result){
							$response = $this->Banner('fetch_banner_list',false);
							return array('type'=>'success','message'=>'Save Changes','data'=>$response);
						}else{
							return array('type'=>'info','message'=>'Nothing Changes');
						}
					}else {
						return false;
					}
				}
				
				break;
			}

		}
	}
	public function Interiors($type,$val){
		switch($type){
			case "fetch_interior_list":{
				$data = array();
				$sql = "SELECT *,IFNULL(project_name,'No title') as project_name,DATE_FORMAT(date_created, '%M %d %Y %r') as date_created FROM tbl_interior_design ORDER BY  date_created DESC";
				$query = $this->db->query($sql);
				if($query){
					foreach($query->result() as $row){
						$stat ='';
						if($row->status=='ACTIVE'){
							$stat ='checked';
						}
						$action =  $this->Action('action1',$row->id,'update_status_interior','view-interior','delete-interior',$stat);
						$status = array('INACTIVE'=>array('state'=>'Inactive','color'=>'danger'),
                 								'ACTIVE'=>array('state'=>'Active','color'=>'success'));
            $status_data ='<span style="width: 112px;"><span class="label label-'.$status[$row->status]['color'].' label-dot mr-2"></span><span class="font-weight-bold text-'.$status[$row->status]['color'].'">'.$status[$row->status]['state'].'</span></span>';
            $image = '<span style="width: 250px;"><div class="d-flex align-items-center">
					                <div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/interior/'.$row->image.'" alt="photo"></div><div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/interior/'.$row->bg.'" alt="photo"></div></span>';
					  $category = array(1=>array('state'=>'RESIDENTIAL PROJECT'),
                 							2=>array('state'=>'COMMERCIAL PROJECT'));              
						$data[]=array(
							'image'=>$image,
							'project_name'=>$row->project_name,
							'category'=>$category[$row->cat_id]['state'],
							'date_created'=>$row->date_created,
							'status'=>$status_data,
							'action'=>$action);
					}
					return $data;
				}else{
					return false;
				}
				break;
			}
			case "fetch_interior_details":{
				$id = $this->encryption->decrypt($val);
				$sql = "SELECT * FROM tbl_interior_design WHERE id='$id'";
				$row = $this->db->query($sql)->row();
				if($row){
					return $row;
				}else{
					return false;
				}
				break;
			}
			case "fetch_interior_status":{
				$id = $this->encryption->decrypt($val);
				$sql = "SELECT * FROM tbl_interior_design WHERE id='$id'";
				$row = $this->db->query($sql)->row();
				if($row){
					$status = 'INACTIVE';
					if($row->status == 'INACTIVE'){
						$status ='ACTIVE';
					}
					$data = array('status'=>$status);
					$result = $this->db->where('id',$id)->update('tbl_interior_design',$data);
					if($result){
						$response = $this->Interiors('fetch_interior_list',false);
						return array('type'=>'success','message'=>'Save Changes','data'=>$response);
					}else{
						return false;
					}
				}else{
					return false;
				}
				break;
			}
			case "fetch_interior_delete":{
				$id = $this->encryption->decrypt($val);
				$sql = "SELECT * FROM tbl_interior_design WHERE id='$id'";
				$row = $this->db->query($sql)->row();
				if($row){
					 if($row->image != 'default.png'){
							if(file_exists('assets/images/interior/'.$row->image)){
								unlink('assets/images/interior/'.$row->image);
							}
				   }
				   if($row->bg != 'default.png'){
							if(file_exists('assets/images/interior/'.$row->bg)){
								unlink('assets/images/interior/'.$row->bg);
							}
				   }
				   $result = $this->db->where('id',$id)->delete('tbl_interior_design');
				   if($result){
				   		$response = $this->Interiors('fetch_interior_list',false);
						  return array('type'=>'success','message'=>'Delete Successfully','data'=>$response);
				   }else{
				   	return false;
				   }
				}else{
					return false;
				}
				break;
			}
		}
	}
		public function Submit_Interior($type,$id,$project_name,$description,$cat_id,$image,$tmp,$bg_image,$bg_tmp){
		switch($type){
			case "add_interior":{
				$newimage = 'default.png';
				$bgnewimage = 'default.png';
				if($image){	
				    $newimage=$this->Get_Image_Code('tbl_interior_design', 'image', 'IMAGE', 14, $image);
				    $this->move_to_folder($newimage,$tmp,'assets/images/interior/');
				}
				if($bg_image){	
				    $bgnewimage=$this->Get_Image_Code('tbl_interior_design', 'bg', 'BG', 14, $bg_image);
				    $this->move_to_folder($bgnewimage,$bg_tmp,'assets/images/interior/');
				}
				$data = array('cat_id'=>$cat_id,'project_name'=>$project_name,'description'=>$description,'image'=>$newimage,'bg'=>$bgnewimage);
				$result = $this->db->insert('tbl_interior_design',$data);
				if($result){
					$response = $this->Interiors('fetch_interior_list',false);
					return array('type'=>'success','message'=>'Create Successfully','data'=>$response);
				}else{
					return false;
				}
				break;
			}
			case "update_interior":{
				$sql = "SELECT * FROM tbl_interior_design WHERE id='$id'";
				$row = $this->db->query($sql)->row();
				if($row){
					$newimage = $row->image;
					$bgnewimage = $row->bg;
					if($image){	
							if($row->image != 'default.png'){
								if(file_exists('assets/images/interior/'.$row->image)){
									unlink('assets/images/interior/'.$row->image);
								}
					    }
					    $newimage=$this->Get_Image_Code('tbl_website_banner', 'image', 'IMAGE', 14, $image);
					    $this->move_to_folder($newimage,$tmp,'assets/images/interior/');
					}
					if($bg_image){
						if($row->bg != 'default.png'){
								if(file_exists('assets/images/interior/'.$row->bg)){
									unlink('assets/images/interior/'.$row->bg);
								}
					   }
				    $bgnewimage=$this->Get_Image_Code('tbl_interior_design', 'bg', 'BG', 14, $bg_image);
				    $this->move_to_folder1($bgnewimage,$bg_tmp,'assets/images/interior/');
			  	}
					$data = array('cat_id'=>$cat_id,'project_name'=>$project_name,'description'=>$description,'image'=>$newimage,'bg'=>$bgnewimage);
					$result = $this->db->where('id',$id)->update('tbl_interior_design',$data);
					if($result){
						$response = $this->Interiors('fetch_interior_list',false);
						return array('type'=>'success','message'=>'Save Changes','data'=>$response);
					}else{
						return array('type'=>'info','message'=>'Nothing Changes');
					}
				}else {
					return false;
				}
				break;
			}

		}
	}
	public function Events($type,$val){
		switch($type){
			case "fetch_events_list":{
				$data = array();
				$sql = "SELECT *,IFNULL(title,'No Title') as title,DATE_FORMAT(date_event, '%M %d %Y') as date_event 
				FROM tbl_events ORDER BY date_event DESC";
				$query = $this->db->query($sql);
				if($query){
					foreach($query->result() as $row){
						$stat ='';
						if($row->status=='ACTIVE'){
							$stat ='checked';
						}
						$action =  $this->Action('action1',$row->id,'update_status_event','view-event','delete-event',$stat);
						$status = array('INACTIVE'=>array('state'=>'Inactive','color'=>'danger'),
                 								'ACTIVE'=>array('state'=>'Active','color'=>'success'));
            $status_data ='<span style="width: 112px;"><span class="label label-'.$status[$row->status]['color'].' label-dot mr-2"></span><span class="font-weight-bold text-'.$status[$row->status]['color'].'">'.$status[$row->status]['state'].'</span></span>';
            $image = '<span style="width: 250px;"><div class="d-flex align-items-center">
					                <div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/events/'.$row->image.'" alt="photo"></div></span>';

						$data[]=array(
							'image'=>$image,
							'title'=>$row->title,
							'date_created'=>$row->date_event,
							'status'=>$status_data,
							'action'=>$action);
					}
					return $data;
				}else{
					return false;
				}
				break;
			}
			case "fetch_event_details":{
				$id = $this->encryption->decrypt($val);
				$sql = "SELECT * FROM tbl_events WHERE id='$id'";
				$row = $this->db->query($sql)->row();
				if($row){
					return $row;
				}else{
					return false;
				}
				break;
			}
				case "fetch_event_status":{
				$id = $this->encryption->decrypt($val);
				$sql = "SELECT * FROM tbl_events WHERE id='$id'";
				$row = $this->db->query($sql)->row();
				if($row){
					$status = 'INACTIVE';
					if($row->status == 'INACTIVE'){
						$status ='ACTIVE';
					}
					$data = array('status'=>$status);
					$result = $this->db->where('id',$id)->update('tbl_events',$data);
					if($result){
						$response = $this->Events('fetch_events_list',false);
						return array('type'=>'success','message'=>'Save Changes','data'=>$response);
					}else{
						return false;
					}
				}else{
					return false;
				}
				break;
			}
			case "fetch_event_delete":{
				$id = $this->encryption->decrypt($val);
				$sql = "SELECT * FROM tbl_events WHERE id='$id'";
				$row = $this->db->query($sql)->row();
				if($row){
					 if($row->image != 'default.png'){
							if(file_exists('assets/images/events/'.$row->image)){
								unlink('assets/images/events/'.$row->image);
							}
				   }
				   $result = $this->db->where('id',$id)->delete('tbl_events');
				   if($result){
				   		$response = $this->Events('fetch_events_list',false);
						  return array('type'=>'success','message'=>'Delete Successfully','data'=>$response);
				   }else{
				   	return false;
				   }
				}else{
					return false;
				}
				break;
			}
		}
	}
	public function Submit_Events($type,$id,$title,$description,$date_event,$image,$tmp){
			switch($type){
			case "add_events":{
				$newimage = 'default.jpg';
				if($image){	
				    $newimage=$this->Get_Image_Code('tbl_events', 'image', 'IMAGE', 14, $image);
				    $this->move_to_folder($newimage,$tmp,'assets/images/events/');
				}
				$data = array('title'=>$title,'description'=>$description,'date_event'=>$date_event,'image'=>$newimage);
				$result = $this->db->insert('tbl_events',$data);
				if($result){
					$response = $this->Events('fetch_events_list',false);
					return array('type'=>'success','message'=>'Create Successfully','data'=>$response);
				}else{
					return false;
				}
				break;
			}
			case "update_events":{
				$sql = "SELECT * FROM tbl_events WHERE id='$id'";
				$row = $this->db->query($sql)->row();
				if($row){
					$newimage = $row->image;
					if($image){	
							if($row->image != 'default.jpg'){
								if(file_exists('assets/images/events/'.$row->image)){
									unlink('assets/images/events/'.$row->image);
								}
					    }
				    $newimage=$this->Get_Image_Code('tbl_events', 'image', 'IMAGE', 14, $image);
				    $this->move_to_folder($newimage,$tmp,'assets/images/events/');
					}
					$data = array('title'=>$title,'description'=>$description,'date_event'=>$date_event,'image'=>$newimage);
					$result = $this->db->where('id',$id)->update('tbl_events',$data);
					if($result){
							$response = $this->Events('fetch_events_list',false);
						return array('type'=>'success','message'=>'Save Changes','data'=>$response);
					}else{
						return array('type'=>'info','message'=>'Nothing Changes');
					}
				}else {
					return false;
				}
				break;
			}

		}
	}
	public function Testimony_List($type,$val){
		switch ($type) {
			case 'fetch_testimony_list':{
				 $data =array();  
				 $query = $this->db->query("SELECT *,DATE_FORMAT(date_created, '%M %d %Y %r') as date_created FROM tbl_customer_testimony");
	        	if($query){
	              $no =1;
	              foreach($query->result() as $row){
	              ++$no;
	              $stat ='';
								if($row->status=='ACTIVE'){
									$stat ='checked';
								}
	             	$action =  $this->Action('action1',$row->id,'update_status_testimony','view-testimony','delete-testimony',$stat);
								$status = array('INACTIVE'=>array('state'=>'Inactive','color'=>'danger'),
		                 								'ACTIVE'=>array('state'=>'Active','color'=>'success'));
		            $status_data ='<span style="width: 112px;"><span class="label label-'.$status[$row->status]['color'].' label-dot mr-2"></span><span class="font-weight-bold text-'.$status[$row->status]['color'].'">'.$status[$row->status]['state'].'</span></span>';
		            $image = '<span style="width: 250px;"><div class="d-flex align-items-center">
							                <div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/testimony/'.$row->image.'" alt="photo"></div></span>'; 		           
	            	$string = strip_tags($row->description);
		           	 if (strlen($string) > 500) {
			                $stringCut = substr($string, 0, 80);
			                $endPoint = strrpos($stringCut, ' ');
			                $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
			                $string .= '... <a class="view-testimony" data-id="'.$this->encryption->encrypt($row->id).'">Read More</a>';
			            }
		             $data[] = array('no'               => $no,
		                            'image'             => $image,
		                            'name'              => $row->name,
		                            'description'       => $string,
		                            'date_created'      => $row->date_created,
		                            'status'						=> $status_data,
		                            'action'            => $action);
		            }  
	        	}
         		return $data; 
				break;
			}
			case "fetch_testimony_details":{
				$id = $this->encryption->decrypt($val);
				$sql = "SELECT * FROM tbl_customer_testimony WHERE id='$id'";
				$row = $this->db->query($sql)->row();
				if($row){
					return $row;
				}else{
					return false;
				}
				break;
			}
			case "fetch_testimony_status":{
				$id = $this->encryption->decrypt($val);
				$sql = "SELECT * FROM tbl_customer_testimony WHERE id='$id'";
				$row = $this->db->query($sql)->row();
				if($row){
					$status = 'INACTIVE';
					if($row->status == 'INACTIVE'){
						$status ='ACTIVE';
					}
					$data = array('status'=>$status);
					$result = $this->db->where('id',$id)->update('tbl_customer_testimony',$data);
					if($result){
						$response = $this->Testimony_List('fetch_testimony_list',false);
						return array('type'=>'success','message'=>'Save Changes','data'=>$response);
					}else{
						return false;
					}
				}else{
					return false;
				}
				break;
			}
			case "fetch_testimony_delete":{
				$id = $this->encryption->decrypt($val);
				$sql = "SELECT * FROM tbl_customer_testimony WHERE id='$id'";
				$row = $this->db->query($sql)->row();
				if($row){
					 if($row->image != 'default.jpg'){
							if(file_exists('assets/images/testimony/'.$row->image)){
								unlink('assets/images/testimony/'.$row->image);
							}
				   }
				   $result = $this->db->where('id',$id)->delete('tbl_customer_testimony');
				   if($result){
				   		$response = $this->Testimony_List('fetch_testimony_list',false);
						  return array('type'=>'success','message'=>'Delete Successfully','data'=>$response);
				   }else{
				   	return false;
				   }
				}else{
					return false;
				}
				break;
			}
			default:
				return false;
				break;
		}
	}
		public function Submit_Testimony($type,$id,$name,$description,$image,$tmp){
			switch($type){
			case "add_testimony":{
				$newimage = 'default.jpg';
				if($image){	
				    $newimage=$this->Get_Image_Code('tbl_customer_testimony', 'image', 'IMAGE', 14, $image);
				    $this->move_to_folder($newimage,$tmp,'assets/images/testimony/');
				}
				$data = array('name'=>$name,'description'=>$description,'image'=>$newimage);
				$result = $this->db->insert('tbl_customer_testimony',$data);
				if($result){
					$response = $this->Testimony_List('fetch_testimony_list',false);
					return array('type'=>'success','message'=>'Create Successfully','data'=>$response);
				}else{
					return false;
				}
				break;
			}
			case "update_testimony":{
				$sql = "SELECT * FROM tbl_customer_testimony WHERE id='$id'";
				$row = $this->db->query($sql)->row();
				if($row){
					$newimage = $row->image;
					if($image){	
							if($row->image != 'default.jpg'){
								if(file_exists('assets/images/testimony/'.$row->image)){
									unlink('assets/images/testimony/'.$row->image);
								}
					    }
				    $newimage=$this->Get_Image_Code('tbl_customer_testimony', 'image', 'IMAGE', 14, $image);
				    $this->move_to_folder($newimage,$tmp,'assets/images/testimony/');
					}
					$data = array('name'=>$name,'description'=>$description,'image'=>$newimage);
					$result = $this->db->where('id',$id)->update('tbl_customer_testimony',$data);
					if($result){
							$response = $this->Testimony_List('fetch_testimony_list',false);
						return array('type'=>'success','message'=>'Save Changes','data'=>$response);
					}else{
						return array('type'=>'info','message'=>'Nothing Changes');
					}
				}else {
					return false;
				}
				break;
			}

		}
	}
	public function Lookbook($type,$val,$val1){
		switch($type){
			case "fetch_lookbookcategory_list":{
				$data =array();
				$sql = "SELECT *,DATE_FORMAT(date_created, '%M %d %Y %r') as date_created  FROM tbl_lookbook_category ORDER BY id DESC";
				$query = $this->db->query($sql);
				if($query){
					foreach($query->result() as $row){
						$stat ='';
						if($row->status==1){
							$stat ='checked';
						}
		             	$action =  $this->Action('action1',$row->id,'update_status_lookcategory','view-lookcategory','delete-lookcategory',$stat);
						$status = array(0=>array('state'=>'Inactive','color'=>'danger'),
			                 			1=>array('state'=>'Active','color'=>'success'));
			            $status_data ='<span style="width: 112px;"><span class="label label-'.$status[$row->status]['color'].' label-dot mr-2"></span><span class="font-weight-bold text-'.$status[$row->status]['color'].'">'.$status[$row->status]['state'].'</span></span>';
						$data[]=array('name'=>$row->look_cat_name,
									 'date_created'=>$row->date_created,
									  'status'=>$status_data,
									  'action'=>$action);
					}
					return $data;
				}else{
					return false;
				}
				break;
			}
			case "fetch_lookbook_list":{
				$data =array();
				$sql = "SELECT *,DATE_FORMAT(date_created, '%M %d %Y %r') as date_created ,(SELECT look_cat_name FROM tbl_lookbook_category WHERE id=tbl_lookbook_details.look_cat_id) as category FROM tbl_lookbook_details ORDER BY date_created DESC";
				$query = $this->db->query($sql);
				if($query){
					foreach($query->result() as $row){
						$stat ='';
						if($row->status==1){
							$stat ='checked';
						}
		             	$action =  $this->Action('action1',$row->id,'update_status_lookbook','view-lookbook','delete-lookbook',$stat);
						$status = array(0=>array('state'=>'Inactive','color'=>'danger'),
			                 			1=>array('state'=>'Active','color'=>'success'));
			            $status_data ='<span style="width: 112px;"><span class="label label-'.$status[$row->status]['color'].' label-dot mr-2"></span><span class="font-weight-bold text-'.$status[$row->status]['color'].'">'.$status[$row->status]['state'].'</span></span>';
			             $image = '<span style="width: 250px;"><div class="d-flex align-items-center">
							                <div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/lookbook/'.$row->image.'" alt="photo"></div></span>'; 
						$data[]=array('image'=>$image,
									  'name'=>$row->look_name,
									  'category'=>$row->category,
									  'date_created'=>$row->date_created,
									  'status'=>$status_data,
									  'action'=>$action);
					}
					return $data;
				}else{
					return false;
				}
				break;
			}
			case "fetch_lookbook_details":{
				$id = $this->encryption->decrypt($val);
				$sql = "SELECT * FROM tbl_lookbook_details WHERE id='$id'";
				$row = $this->db->query($sql)->row();
				if($row){
					return $row;
				}else{
					return false;
				}
				break;
			}
			case "fetch_lookbook_category_select":{
				$data =array();
				$sql = "SELECT * FROM tbl_lookbook_category ORDER BY id DESC";
				$query = $this->db->query($sql);
				if($query){
					foreach($query->result() as $row){
						$data[]=array('name'=>$row->look_cat_name,
									  'id'=>$row->id);
					}
					return $data;
				}else{
					return false;
				}
				break;
			}
			case "fetch_lookbook_category_add":{
				$result = $this->db->insert('tbl_lookbook_category',array('look_cat_name'=>$val));
				if($result){
					$response = $this->Lookbook('fetch_lookbookcategory_list',false,false);
					return array('type'=>'success','message'=>'Save Changes','data'=>$response);
				}else{
					return false;
				}
				break;
			}
			case "fetch_lookbookcategory_status":{
				$id = $this->encryption->decrypt($val);
				$sql = "SELECT * FROM tbl_lookbook_category WHERE id='$id'";
				$row = $this->db->query($sql)->row();
				if($row){
					$status = 0;
					if($row->status == 0){
						$status =1;
					}
					$data = array('status'=>$status);
					$result = $this->db->where('id',$id)->update('tbl_lookbook_category',$data);
					if($result){
						$response = $this->Lookbook('fetch_lookbookcategory_list',false,false);
						return array('type'=>'success','message'=>'Create Successfully','data'=>$response);
					}else{
						return false;
					}
				}else{
					return false;
				}
				break;
			}
			case "fetch_lookbookcategory_delete":{
				$id = $this->encryption->decrypt($val);
				$sql = "SELECT * FROM tbl_lookbook_category WHERE id='$id'";
				$row = $this->db->query($sql)->row();
				if($row){
					if($image){	
						if($row->image != 'default.jpg'){
							if(file_exists('assets/images/lookbook/'.$row->image)){
								unlink('assets/images/lookbook/'.$row->image);
							}
						}
				    }
				   $result = $this->db->where('id',$id)->delete('tbl_lookbook_category');
				   if($result){
				   		$response = $this->Lookbook('fetch_lookbookcategory_list',false,false);
						 return array('type'=>'success','message'=>'Delete Successfully','data'=>$response);
				   }else{
				   	return false;
				   }
				}else{
					return false;
				}
				break;
			}
			case "fetch_lookbookcategory_details":{
				$id = $this->encryption->decrypt($val);
				$sql = "SELECT * FROM tbl_lookbook_category WHERE id='$id'";
				$row = $this->db->query($sql)->row();
				if($row){
					return $row;
				}else{
					return false;
				}
				break;
			}
			case "fetch_lookbook_category_update":{
				$result = $this->db->where('id',$val)->update('tbl_lookbook_category',array('look_cat_name'=>$val1));
				$response = $this->Lookbook('fetch_lookbookcategory_list',false,false);
				if($result){
					return array('type'=>'success','message'=>'Save Changes','data'=>$response);
				}else{
					return array('type'=>'success','message'=>'Nothing Changes','data'=>$response);
				}
				break;
			}
				case "fetch_lookbook_status":{
				$id = $this->encryption->decrypt($val);
				$sql = "SELECT * FROM tbl_lookbook_details WHERE id='$id'";
				$row = $this->db->query($sql)->row();
				if($row){
					$status = 0;
					if($row->status == 0){
						$status =1;
					}
					$data = array('status'=>$status);
					$result = $this->db->where('id',$id)->update('tbl_lookbook_details',$data);
					if($result){
						$response = $this->Lookbook('fetch_lookbook_list',false,false);
						return array('type'=>'success','message'=>'Create Successfully','data'=>$response);
					}else{
						return false;
					}
				}else{
					return false;
				}
				break;
			}
			case "fetch_lookbook_delete":{
				$id = $this->encryption->decrypt($val);
				$sql = "SELECT * FROM tbl_lookbook_details WHERE id='$id'";
				$row = $this->db->query($sql)->row();
				if($row){
				   $result = $this->db->where('id',$id)->delete('tbl_lookbook_details');
				   if($result){
				   		$response = $this->Lookbook('fetch_lookbook_list',false,false);
						 return array('type'=>'success','message'=>'Delete Successfully','data'=>$response);
				   }else{
				   	return false;
				   }
				}else{
					return false;
				}
				break;
			}
		}
	}
	public function Submit_Lookbook($type,$id,$title,$cat_id,$image,$tmp){
		switch($type){
			case "add_lookbook":{
				$newimage = 'default.jpg';
				if($image){	
				    $newimage=$this->Get_Image_Code('tbl_lookbook_details', 'image', 'IMAGE', 14, $image);
				    $this->move_to_folder4($newimage,$image,$tmp,'assets/images/lookbook/',1000,1000);
				}
				$data = array('look_name'=>$title,'look_cat_id'=>$cat_id,'image'=>$newimage);
				$result = $this->db->insert('tbl_lookbook_details',$data);
				if($result){
					$response = $this->Lookbook('fetch_lookbook_list',false,false);
					return array('type'=>'success','message'=>'Create Successfully','data'=>$response);
				}else{
					return false;
				}
				break;
			}
			case "update_lookbook":{
				$sql = "SELECT * FROM tbl_lookbook_details WHERE id='$id'";
				$row = $this->db->query($sql)->row();
				if($row){
					$newimage = $row->image;
					if($image){	
						if($row->image != 'default.jpg'){
							if(file_exists('assets/images/lookbook/'.$row->image)){
								unlink('assets/images/lookbook/'.$row->image);
							}
				    }
					    $newimage=$this->Get_Image_Code('tbl_lookbook_details', 'image', 'IMAGE', 14, $image);
					    $this->move_to_folder4($newimage,$image,$tmp,'assets/images/lookbook/',1000,1000);
					}
					$data = array('look_name'=>$title,'look_cat_id'=>$cat_id,'image'=>$newimage);
					$result = $this->db->where('id',$id)->update('tbl_lookbook_details',$data);
					if($result){
						$response = $this->Lookbook('fetch_lookbook_list',false,false);
						return array('type'=>'success','message'=>'Save Changes','data'=>$response);
					}else{
						return array('type'=>'info','message'=>'Nothing Changes');
					}
				}else {
					return false;
				}
				break;
			}
		}
	}
	public function Product_List($type,$val,$val1,$val2,$val3,$image,$tmp){
		switch ($type) {
			case 'fetch_product_list':{
				 $data = array();
				 $query = $this->db->query("SELECT *, DATE_FORMAT(date_created, '%M %d %Y %r') as date_created,
			            (SELECT title FROM tbl_project_design WHERE id=tbl_project_color.project_no) AS title,
			            (SELECT CONCAT(fname, ' ',lname) FROM tbl_administrator WHERE id=tbl_project_color.designer) AS requestor FROM tbl_project_color WHERE status=2 AND type=1");
					 if($query){
							 	foreach($query->result() as $row){
							 		$action = '<button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm mr-2 view-product" data-id="'.$this->encryption->encrypt($row->id).'"><i class="la la-eye"></i></button>';
					            $title = '<span style="width: 250px;"><div class="d-flex align-items-center">
					                <div class="symbol symbol-40 symbol-sm flex-shrink-0 mr-1"><img class="" id="myImg" src="'.base_url().'assets/images/design/project_request/images/'.$row->image.'" alt="photo"></div><div class="d-flex align-items-center"><div class="symbol symbol-40 symbol-sm flex-shrink-0"><img class="" id="myImg" src="'.base_url().'assets/images/palettecolor/'.$row->c_image.'" alt="photo"> </div><div class="ml-4"><div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->title.'</div><a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->c_name.'</a></div></div></div></span>';
					                 if($row->display_status=='n/a'){$status ='<span style="width: 112px;"><span class="label label-danger label-dot mr-2"></span><span class="font-weight-bold text-danger">Inactive</span></span>';
                     			}else{$status='<span style="width: 112px;"><span class="label label-success label-dot mr-2"></span><span class="font-weight-bold text-success">Active</span></span>';}
							 		 			$data[] = array('id'=>$row->id,
							                      'c_code'=> $row->c_code,
							                      'title' => $title,
							                      'created_by' => $row->requestor,
							                      'date_created' => $row->date_created,
							                   		'status'=>$status,
							                      'action'  => $action);
							 	}
				 		}
				 return $data;
				break;
			}
			case "fetch_product_details":{
				$data = array();
				$id = $this->encryption->decrypt($val);
				$sql = $this->db->query("SELECT *,
					(SELECT tearsheet FROM tbl_project_design WHERE id=tbl_project_color.project_no) AS tearsheet,
					(SELECT cat_id FROM tbl_project_design WHERE id=tbl_project_color.project_no) AS cat_id,
					(SELECT sub_id FROM tbl_project_design WHERE id=tbl_project_color.project_no) AS sub_id,
					(SELECT title FROM tbl_project_design WHERE id=tbl_project_color.project_no) AS title FROM tbl_project_color WHERE id='$id'")->row();
					if($sql){
						 $c_code= $sql->c_code;
		      	 $cat_id = $sql->cat_id;
		      	  $query = $this->db->query("SELECT * FROM tbl_project_image WHERE c_code='$c_code' ORDER BY id DESC");
			        if($query){
		            foreach($query->result() as $row) {
		             $data[] = array('id' => $row->id,
		                             'images'=> $row->images);
		            }  
       			 } 
       			$sub = $this->Category_List('fetch_sub_category_select',$cat_id,false,false,false);
         		return array('data'=>$data,'row' => $sql,'sub'=>$sub);
					}else{
						return false;
					}	       
				break;
			}
			case "fetch_product_update":{
				$sql = "SELECT * FROM tbl_project_color WHERE id='$val'";
				$row = $this->db->query($sql)->row();
				if($row){
					$project_no = $row->project_no;
					if($val2 == 1){
						$result = $this->db->where('id',$project_no)->update('tbl_project_design',array('title'=>$val1));
					}else{
						$result = $this->db->where('id',$val)->update('tbl_project_color',array($val3=>$val1));
					}
					$response = $this->Product_List('fetch_product_list',false,false,false,false,false,false,false);
					if($result){
						if($val3 == 'display_status'){
							$sql = "SELECT * FROM tbl_project_color WHERE project_no='$project_no' AND display_status='displayed' GROUP BY project_no";
							$count = $this->db->query($sql)->num_rows();
							if($count == 0){
								$this->db->where('id',$project_no)->update('tbl_project_design',array('d_status'=>'n/a'));
							}else{
								$sql = "SELECT * FROM tbl_project_design WHERE id='$project_no' AND d_status='n/a'";
								$row = $this->db->query($sql)->row();
								if($row){
									$this->db->where('id',$project_no)->update('tbl_project_design',array('d_status'=>'DISPLAYED'));
								}
							}
						}
						return array('type'=>'success','message'=>'Save Changes','data'=>$response,'count'=>$count);
					}else{
						return array('type'=>'info','message'=>'Nothing Changes','data'=>$response);
					}
				}else{
					return $val;
				}
				break;
			}
			case "fetch_product_pallet":{
						$sql ="SELECT * FROM tbl_project_color WHERE id='$val'";
						$row = $this->db->query($sql)->row();
						if($row){
							$path_color  =  "assets/images/palettecolor/";
							$palletnewimage = $row->c_image;
							if($image){	
									if($row->c_image != 'default.jpg'){
										if(file_exists($path_color.$row->c_image)){
											unlink($path_color.$row->c_image);
										}
									}
							    $palletnewimage=$this->Get_Image_Code('tbl_project_color', 'c_image', 'COLOR', 14, $image);
							    $this->move_to_folder($palletnewimage,$tmp,$path_color);
							}
							$result = $this->db->where('id',$val)->update('tbl_project_color',array('c_image'=>$palletnewimage));
							$response = $this->Product_List('fetch_product_list',false,false,false,false,false,false,false);
							if($result){
								return array('type'=>'success','message'=>'Save Changes','data'=>$response);
							}else{
								return array('type'=>'info','message'=>'Nothing Changes','data'=>$response);
							}
						}else{
							return false;
						}
				break;
			}
			case "fetch_product_category_update":{
						$sql ="SELECT * FROM tbl_project_color WHERE id='$val'";
						$row = $this->db->query($sql)->row();
						if($row){
							$project_no = $row->project_no;
							$result = $this->db->where('id',$project_no)->update('tbl_project_design',array('cat_id'=>$val1,'sub_id'=>$val2));
							$response = $this->Product_List('fetch_product_list',false,false,false,false,false,false,false);
							if($result){
								return array('type'=>'success','message'=>'Save Changes','data'=>$response);
							}else{
								return array('type'=>'info','message'=>'Nothing Changes','data'=>$response);
							}
						}else{
							return false;
						}
				break;
			}
			case "fetch_product_tearsheet":{
						$sql ="SELECT * FROM tbl_project_color WHERE id='$val' LIMIT 1";
						$row = $this->db->query($sql)->row();
						if($row){
							$project_no = $row->project_no;
							$sql = "SELECT * FROM tbl_project_design WHERE id='$project_no'";
							$row = $this->db->query($sql)->row();
							if($row){
									$path_docs  =  "assets/images/tearsheet/";
									$tearsheet = $row->tearsheet;
									if($image){	
											if($row->tearsheet != 'default.jpg'){
												if(file_exists($path_docs.$row->tearsheet)){
													unlink($path_docs.$row->tearsheet);
												}
											}
									    $tearsheet=$this->Get_Image_Code('tbl_project_design', 'tearsheet', 'TEARSHEET', 14, $image);
									    $this->move_to_folder($tearsheet,$tmp,$path_docs);
									}
									$result = $this->db->where('id',$project_no)->update('tbl_project_design',array('tearsheet'=>$tearsheet));
									$response = $this->Product_List('fetch_product_list',false,false,false,false,false,false,false);
									if($result){
										return array('type'=>'success','message'=>'Save Changes','data'=>$response);
									}else{
										return array('type'=>'info','message'=>'Nothing Changes','data'=>$response);
									}
							}else{
								return false;
							}
						}else{
							return false;
						}
				break;
			}
			case "fetch_product_save_image":{
					 $data_response = array();
					 $sql = "SELECT * FROM tbl_project_color WHERE id='$val'";
					 $row = $this->db->query($sql)->row();
					 if($row){
					 	  $project_no = $row->project_no;
					 	  $c_code = $row->c_code;
							if($image){	
									$path_image = "assets/images/finishproduct/product/";
									$path_image_size = "assets/images/finishproduct/product600x600/";
								$extension=pathinfo($image, PATHINFO_EXTENSION);
       							$newfilename=  'IMG'.date('YmdHis').'-PRODUCT'.mt_rand(1000, 999999).'.'.$extension;
   								$this->move_to_folder4($newfilename,$image,$tmp,$path_image,400,400);
   								$this->move_to_folder4($newfilename,$image,$tmp,$path_image_size,1000,1000);
							    $data = array('project_no'=>$project_no,
							    							'c_code'=>$c_code,
							    							'images'=>$newfilename);
							    $result = $this->db->insert('tbl_project_image',$data);
							    $sql ="SELECT * FROM tbl_project_image WHERE c_code='$c_code' ORDER BY id DESC";
							    $query = $this->db->query($sql);
					        if($query !== FALSE && $query->num_rows() > 0){
				            foreach($query->result() as $row) {
				             $data_response[] = array('id' => $row->id,
				                             'images'=> $row->images);
				            }  
		       			 } 
							   return array('type'=>'success','message'=>'Upload Successfully','data'=>$data_response);
							}else{
									return array('type'=>'info','message'=>'Please input file to upload');
							}
					 }
				   return $json;
				break;
			}
			case "fetch_product_delete_image":{
					 $data_response = array();
					 $sql = "SELECT * FROM tbl_project_image WHERE id='$val'";
					 $row = $this->db->query($sql)->row();
					 if($row){
						 		$c_code = $row->c_code;	
						 		$path_image = "assets/images/finishproduct/product/";
						 		$path_image_size = "assets/images/finishproduct/product600x600/";
				 				if($row->images != 'default.jpg'){
				 					if(file_exists($path_image.$row->images)){
				 						unlink($path_image.$row->images);
				 						if(file_exists($path_image_size.$row->images)){
				 							unlink($path_image_size.$row->images);
				 						}
				 					}
				 				}
						    $result = $this->db->where('id',$val)->delete('tbl_project_image');
						    if($result){
						    	  $sql ="SELECT * FROM tbl_project_image WHERE c_code='$c_code' ORDER BY id DESC";
								    $query = $this->db->query($sql);
						        if($query !== FALSE && $query->num_rows() > 0){
						            foreach($query->result() as $row) {
						             $data_response[] = array('id' => $row->id,
						                             'images'=> $row->images);
						            }  
			       			 	 } 
								   return array('type'=>'success','message'=>'Delete Successfully','data'=>$data_response);
								 }else{
								 	return false;
								 }
						}else{
								return false;
						}
				break;
			}
			default:
				return false;
				break;
		}
	}
	public function Submit_Product($type,$id,$title,$pallet_name,$cat_id,$sub_id,$amount,$image,$tmp,$pallet_image,$pallet_tmp,$docs_image,$docs_tmp){
			$path_image = "assets/images/design/project_request/images/";
			$path_color  =  "assets/images/palettecolor/";
		  $path_docs  =  "assets/images/tearsheet/";
			switch($type){
				case "add_product":{
						$newimage = 'default.png';
						$palletnewimage = 'default.jpg';
						$docsnewimage = 'default.jpg';
						if($image){	
						    $newimage=$this->Get_Image_Code('tbl_project_color', 'image', 'IMAGE', 14, $image);
						    $this->move_to_folder($newimage,$tmp,$path_image);
						}
						if($pallet_image){	
						    $palletnewimage=$this->Get_Image_Code('tbl_project_color', 'c_image', 'COLOR', 14, $pallet_image);
						    $this->move_to_folder($palletnewimage,$pallet_tmp,$path_color);
						}
						if($docs_image){	
						    $docsnewimage=$this->Get_Image_Code('tbl_project_design', 'tearsheet', 'TEARSHEET', 14, $docs_image);
						    $this->move_to_folder($palletnewimage,$docs_tmp,$path_docs);
						}
						$project_no=$this->get_random_code('tbl_project_design', 'project_no', "STXID", 8);
						$c_code=$this->get_random_code('tbl_project_color', 'c_code', "STXCODE", 8);
						$data = array('project_no'      => $project_no,
					                  'title'         => $title,
					                  'tearsheet'	    => $docsnewimage,
					                  'project_Status'=> 'APPROVED',
					                  'type'		      => 1,
					                  'cat_id'		    => $cat_id,
					                  'sub_id'		    => $sub_id,
					   				  			'date_created'  =>  date('Y-m-d H:i:s'));
						 $this->db->insert('tbl_project_design',$data);
						 $insert_id = $this->db->insert_id();
						if($insert_id){
							$data = array('designer'      => $this->user_id,
							   					  'project_no'    => $insert_id,
							   					  'c_code'    	  => $c_code,
							   					  'c_name'        => $pallet_name,
							   					  'c_price'		  	=> $amount,
							              'c_image'       => $palletnewimage,
										  		  'image'         => $newimage,
							              'status'        => 2,
							              'type'       		=> 1,
							   					  'date_created'  =>  date('Y-m-d H:i:s'),
							   					  'created_by'	  => $this->user_id);
							$result = $this->db->insert('tbl_project_color',$data);
							if($result){
								$response = $this->Product_List('fetch_product_list',false,false,false,false,false,false,false);
								return array('type'=>'success','message'=>'Create Successfully!','data'=>$response);
							}else{
								return false;
							}
						}else{
							return false;
						}
				break;
			}
			case "add_existing":{
						$project_no = $this->encryption->decrypt($title);
						$palletnewimage = 'default.jpg';
							if($pallet_image){	
							    $palletnewimage=$this->Get_Image_Code('tbl_project_color', 'c_image', 'COLOR', 14, $pallet_image);
							    $this->move_to_folder($palletnewimage,$pallet_tmp,$path_color);
							}
							$sql ="SELECT * FROM tbl_project_color WHERE project_no='$project_no' LIMIT 1";
							$row = $this->db->query($sql)->row();
							if($row){
								$newimage = $row->image;
								$c_code=$this->get_random_code('tbl_project_color', 'c_code', "STXCODE", 8);
								$data = array('designer'      => $this->user_id,
								   					  'project_no'    => $project_no,
								   					  'c_code'    	  => $c_code,
								   					  'c_name'        => $pallet_name,
								   					  'c_price'		  	=> $amount,
								              'c_image'       => $palletnewimage,
											  		  'image'         => $newimage,
								              'status'        => 2,
								              'type'       		=> 1,
								   					  'date_created'  =>  date('Y-m-d H:i:s'),
								   					  'created_by'	  => $this->user_id);
								$result = $this->db->insert('tbl_project_color',$data);
								if($result){
								$response = $this->Product_List('fetch_product_list',false,false,false,false,false,false,false);
									return array('type'=>'success','message'=>'Create Successfully!','data'=>$response);
								}else{
									return false;
								}
							}
				break;
			}


		}
	}
	public function Voucher_List($type,$val){
		switch ($type) {
			case 'fetch_voucher_list':{
			$data =array(); 
			$query = $this->db->query("SELECT *,DATE_FORMAT(date_from ,'%M %d %Y') as date_from,DATE_FORMAT(date_to ,'%M %d %Y') as date_to FROM tbl_code_promo");
        		$s = 1;
		        if($query){
		           foreach($query->result() as $row){
		                $exp_date = strtotime($row->date_to);
		                $now = new DateTime();
		                $now = $now->format('Y-m-d');
		                $now = strtotime($now);
		                    if ($exp_date < $now) {
		                     	 $disable = 'disabled';
		                        $status = '<span class="label label-lg label-light-danger label-inline font-weight-bold py-4">Already Expired</span>';
		                        $query1 = $this->db->select('*')->from('tbl_code_promo')->where('id',$row->id)->get();
		                        $row1 = $query1->row();
		                        if(!$row1->status){
		                            $data1 = array('status' => 'EXPIRED');
		                            $this->db->where('id',$row->id);
		                            $this->db->update('tbl_code_promo',$data1);  
		                        }
		                    } 
		                    else if ($exp_date == $now) {
		                     $disable = 'disabled';  
		                        $status = '<span class="label label-lg label-light-warning label-inline font-weight-bold py-4">Will Expire Today</span>';
		                        $query1 = $this->db->select('*')->from('tbl_code_promo')->where('id',$row->id)->get();
		                        $row1 = $query1->row();
		                        if(!$row1->status){
		                           $data1 = array('status' => 'EXPIRED');
		                           $this->db->where('id',$row->id);
		                           $this->db->update('tbl_code_promo',$data1);  
		                        }
		                    }
		                    else if ($exp_date > $now) {
		                        $disable = "";
		                        $status = '<span class="label label-lg label-light-success label-inline font-weight-bold py-4">ACTIVE</span>';
		                    }
		             $action = '<button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm mr-2" id="form-request" data-id="'.$this->encryption->encrypt($row->id).'" "'.$disable.'"><i class="la la-eye"></i></button>'; 
		             $dis = floatval(($row->discount*100)/1);
		             $discount = $dis.'%';
		             $data[] = array(
		                      'no'           => $s,
		                      'promo_code'   => $row->promo_code,
		                      'discount'     => $discount,
		                      'date_from'    => $row->date_from,
		                      'date_to'      => $row->date_to,
		                      'status'       => $status,
		                      'action'       => $action);
		                $s++;
		            }      
		         }
        	    return $data;  
				break;
			}
			default:
				return false;
				break;
		}
	}
	public function Shipping_List($type,$val){
		switch ($type) {
			case 'fetch_shipping_list':{
				 $data =array();   
				  $query = $this->db->query("SELECT * FROM tbl_region_shipping");
		        if($query){
		              foreach($query->result() as $row){
		              $action = '
		              <button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm mr-2 " data-action="info" data-toggle="modal" id="form-request" data-id="'.$row->id.'" data-target="#requestModal"><i class="la la-eye"></i></button>';
		             	$data[] = array(
			                      'id'                    => $row->id,
			                      'region'                => $row->region,
			                      'shipping_range'        => $row->shipping_range,
			                      'action'                => $action);
		            }  
		         }
		         return $data; 
				break;
			}
			default:
				return false;
				break;
		}
	}
	
	public function Category_List($type,$val,$val1,$image,$tmp){
		switch ($type) {
			case "fetch_category_option":
			case 'fetch_category_list':{
				 $data =array();  
				 $query = $this->db->query("SELECT *,DATE_FORMAT(date_created, '%M %d %Y %r') as date_created FROM tbl_category ORDER BY id DESC");
	        	if($query){
	              foreach($query->result() as $row){
	              	$stat='';
									if($row->status=='ACTIVE'){
										$stat='checked';
									}
	               $image = '<div class="symbol symbol-40  flex-shrink-0"><img class="border border-dark" id="myImg" src="'.base_url().'assets/images/category/'.$row->image.'" alt="'.$row->cat_name.'"></div>';
	               $status = array('INACTIVE'=>array('state'=>'Inactive','color'=>'danger'),
                 								'ACTIVE'=>array('state'=>'Active','color'=>'success'));
                 $status_data ='<span style="width: 112px;"><span class="label label-'.$status[$row->status]['color'].' label-dot mr-2"></span><span class="font-weight-bold text-'.$status[$row->status]['color'].'">'.$status[$row->status]['state'].'</span></span>';
                 $action =  $this->Action('action2',$row->id,'update_status','view_details','view_subcategories',$stat); 			
		             $data[] = array('image'=> $image,
		                            'name'=> $row->cat_name,
		                            'date_created'=> $row->date_created,
		                            'status'=>$status_data,
		                            'action'=> $action,
		                          	'id'=>$row->id);
		            }  
	        	}
         		return $data; 
						break;
			}
			case"fetch_category_details":{
				$id = $this->encryption->decrypt($val);
				$result = $this->db->query("SELECT * FROM tbl_category WHERE id='$id'")->row();
				if($result){
					return $result;
				}else{
					return false;
				}
				break;
			}
			case "fetch_category_update":{
				$row = $this->db->query("SELECT * FROM tbl_category WHERE id='$val'")->row();
				if($row){
					$newimage = $row->image;
					if($image){	
					    if($row->image != 'default.jpg'){
					    	unlink('assets/images/category/'.$row->image);
					    }
					    $newimage=$this->Get_Image_Code('tbl_category', 'image', 'IMAGE', 14, $image);
					    $this->move_to_folder($newimage,$tmp,'assets/images/category/');
					}
					$result = $this->db->where('id',$val)->update('tbl_category',array('cat_name'=>$val1,'image'=>$newimage));
					if($result){
						return array('type'=>'success','message'=>'Save Changes!');
					}else{
						return array('type'=>'info','message'=>'Nothing Changes!');
					}
				}else{
					return false;
				}
				break;
			}
			case "fetch_category_status":{
				$id = $this->encryption->decrypt($val);
				$row = $this->db->query("SELECT * FROM tbl_category WHERE id='$id'")->row();
				if($row){
					$status = 'INACTIVE';
					if($row->status =='INACTIVE'){
						$status = 'ACTIVE';
					}
					$result = $this->db->where('id',$id)->update('tbl_category',array('status'=>$status));
					if($result){
						return array('type'=>'success','message'=>'Save Changes!');
					}else{
						return array('type'=>'info','message'=>'Nothing Changes!');
					}
				}else{
					return false;
				}
				break;
			}
			case "fetch_sub_category_list":{
				 $id = $this->encryption->decrypt($val);
				 $data =array();  
				 $row = $this->db->query("SELECT * FROM tbl_category WHERE id='$id'")->row();
				 if($row){
				 		$data['cat']=$row;
				 		$query = $this->db->query("SELECT *,DATE_FORMAT(date_created, '%M %d %Y %r') as date_created FROM tbl_category_sub WHERE cat_id='$id'");
	        	if($query){
	              foreach($query->result() as $row){
	              	$stat='';
									if($row->status=='ACTIVE'){
										$stat='checked';
									}
                 $status = array('INACTIVE'=>array('state'=>'Inactive','color'=>'danger'),
                 								'ACTIVE'=>array('state'=>'Active','color'=>'success'));
                 $status_data ='<span style="width: 112px;"><span class="label label-'.$status[$row->status]['color'].' label-dot mr-2"></span><span class="font-weight-bold text-'.$status[$row->status]['color'].'">'.$status[$row->status]['state'].'</span></span>';
                 $action =  $this->Action('action1',$row->id,'update_status_sub','view_sub_details','delete-sub-cat',$stat); 			
		             $data['sub'][] = array('name'=> $row->sub_name,
		                             'date_created'=> $row->date_created,
		                             'status'=>$status_data,
		                             'action'=> $action);
		            }  
	        	}
				 }
         return $data; 
				break;
			}
			case "fetch_sub_category_details":{
				$id = $this->encryption->decrypt($val);
				$result = $this->db->query("SELECT *,(SELECT cat_name FROM tbl_category WHERE id=tbl_category_sub.cat_id) as cat_name FROM tbl_category_sub WHERE id='$id'")->row();
				if($result){
					return $result;
				}else{
					return false;
				}
				break;
			}
			case "fetch_sub_category_update":{
				$id = $this->encryption->decrypt($val);
				$row = $this->db->query("SELECT * FROM tbl_category_sub WHERE id='$val'")->row();
				if($row){
					$result = $this->db->where('id',$val)->update('tbl_category_sub',array('sub_name'=>$val1));
					$cat_id = $row->cat_id;
					$data=array();
					$query = $this->db->query("SELECT *,DATE_FORMAT(date_created, '%M %d %Y %r') as date_created FROM tbl_category_sub WHERE cat_id='$cat_id'");
        	if($query){
              foreach($query->result() as $row){
              	$stat='';
								if($row->status=='ACTIVE'){
									$stat='checked';
								}
               $status = array('INACTIVE'=>array('state'=>'Inactive','color'=>'danger'),
               								'ACTIVE'=>array('state'=>'Active','color'=>'success'));
               $status_data ='<span style="width: 112px;"><span class="label label-'.$status[$row->status]['color'].' label-dot mr-2"></span><span class="font-weight-bold text-'.$status[$row->status]['color'].'">'.$status[$row->status]['state'].'</span></span>';
               $action =  $this->Action('action1',$row->id,'update_status_sub','view_sub_details','delete-sub-cat',$stat);    			
	             $data[] = array('name'=> $row->sub_name,
	                             'date_created'=> $row->date_created,
	                             'status'=>$status_data,
	                             'action'=> $action);
	            }  
        	}
					if($result){
						return array('type'=>'success','message'=>'Save Changes!','sub'=>$data);
					}else{
						return array('type'=>'info','message'=>'Nothing Changes!','sub'=>$data);
					}
				}else{
					return false;
				}
				break;
			}
			case "fetch_sub_category_status":{
				$id = $this->encryption->decrypt($val);
				$row = $this->db->query("SELECT * FROM tbl_category_sub WHERE id='$id'")->row();
				if($row){
					$status = 'INACTIVE';
					if($row->status =='INACTIVE'){
						$status = 'ACTIVE';
					}
					$result = $this->db->where('id',$id)->update('tbl_category_sub',array('status'=>$status));
					$cat_id = $row->cat_id;
					$data=array();
					$query = $this->db->query("SELECT *,DATE_FORMAT(date_created, '%M %d %Y %r') as date_created FROM tbl_category_sub WHERE cat_id='$cat_id'");
        	if($query){
              foreach($query->result() as $row){
              	$stat='';
								if($row->status=='ACTIVE'){
									$stat='checked';
								}
               $status = array('INACTIVE'=>array('state'=>'Inactive','color'=>'danger'),
               								'ACTIVE'=>array('state'=>'Active','color'=>'success'));
               $status_data ='<span style="width: 112px;"><span class="label label-'.$status[$row->status]['color'].' label-dot mr-2"></span><span class="font-weight-bold text-'.$status[$row->status]['color'].'">'.$status[$row->status]['state'].'</span></span>';
               $action =  $this->Action('action1',$row->id,'update_status_sub','view_sub_details','delete-sub-cat',$stat);   			
	             $data[] = array('name'=> $row->sub_name,
	                             'date_created'=> $row->date_created,
	                             'status'=>$status_data,
	                             'action'=> $action);
	            }  
        	}
					if($result){
						return array('type'=>'success','message'=>'Save Changes!','sub'=>$data);
					}else{
						return array('type'=>'info','message'=>'Nothing Changes!','sub'=>$data);
					}
				}else{
					return false;
				}
				break;
			}
			case "fetch_sub_category_delete":{
				$id = $this->encryption->decrypt($val);
				$data_array=array();
				$count = $this->db->query("SELECT * FROM tbl_project_design WHERE sub_id='$id'")->num_rows();
				if($count == 0){
					  $row = $this->db->query("SELECT * FROM tbl_category_sub WHERE id='$id'")->row();
					  if($row){
					  	$cat_id = $row->cat_id;
					  }
						$result = $this->db->where('id',$id)->delete('tbl_category_sub');
						if($result){
							$query = $this->db->query("SELECT *,DATE_FORMAT(date_created, '%M %d %Y %r') as date_created FROM tbl_category_sub WHERE cat_id='$cat_id'");
		        	if($query){
		              foreach($query->result() as $row){
		              	$stat='';
										if($row->status=='ACTIVE'){
											$stat='checked';
										}
		               $status = array('INACTIVE'=>array('state'=>'Inactive','color'=>'danger'),
		               								'ACTIVE'=>array('state'=>'Active','color'=>'success'));
		               $status_data ='<span style="width: 112px;"><span class="label label-'.$status[$row->status]['color'].' label-dot mr-2"></span><span class="font-weight-bold text-'.$status[$row->status]['color'].'">'.$status[$row->status]['state'].'</span></span>';
		               $action =  $this->Action('action1',$row->id,'update_status_sub','view_sub_details','delete-sub-cat',$stat);   			
			             $data_array[] = array('name'=> $row->sub_name,
			                             'date_created'=> $row->date_created,
			                             'status'=>$status_data,
			                             'action'=> $action);
			            }  
		        	}
							$data=	array('type'=>'success','message'=>'Remove Successfully!','sub'=>$data_array);
						}
				}else{
					 $data=	array('type'=>'info','message'=>'Oopps, This category used by the existing product(s), cannot be deleted.');
				}
				return $data;
				break;
			}
			case "fetch_category_add":{
					if($image){	
					    $newimage=$this->Get_Image_Code('tbl_category', 'image', 'IMAGE', 14, $image);
					    $this->move_to_folder($newimage,$tmp,'assets/images/category/');
					}else{
							$newimage = 'default.jpg';
					}
					$result = $this->db->insert('tbl_category',array('cat_name'=>$val1,'image'=>$newimage));
					if($result){
						return array('type'=>'success','message'=>'Create Successfully!');
					}else{
						return false;
					}
				break;
			}
			case "fetch_sub_category_add":{
					$data_array = array();
					$result = $this->db->insert('tbl_category_sub',array('cat_id'=>$val,'sub_name'=>$val1));
					if($result){
						return array('type'=>'success','message'=>'Create Successfully!');
					}else{
						return false;
					}
				break;
			}
			case "fetch_sub_category_select":{
				 $data =array();  
				 $result = $this->db->query("SELECT * FROM tbl_category WHERE id='$val'")->row();
				 if($result){
				 		$query = $this->db->query("SELECT * FROM tbl_category_sub WHERE cat_id='$val'");
	        	if($query){
	              foreach($query->result() as $row){
		             $data[] = array('name'=> $row->sub_name,
					                       'id'=> $row->id);
		            }  
		            return $data;
	        	}else{
	        		return false;
	        	}
				 }else{
				 		return false;
				 }
				break;
			}
			default:
				return false;
				break;
		}
	}

	private function Action($type,$id=false,$class=false,$class1=false,$class2=false,$check=false){
		switch($type){
			case"action1":{
				return '<div class="d-flex flex-row">
										<div class="dropdown dropdown-inline">
											<a href="javascript:;" id="dropdownMenuButton" class="btn btn-icon btn-light btn-hover-primary btn-sm m-1" data-toggle="dropdown" aria-expanded="true">
		        									<i class="la la-cog"></i>
		        									</a>
									        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style="z-index: 9999;">
											    <ul class="nav nav-hoverable flex-column">
											        <li class="nav-item">
											            <a class="nav-link" href="javascript:;">
											                <i class="nav-icon la la-leaf"></i>
											                <span class="nav-text">Status</span>
											                <span class="switch switch-sm switch-icon">
											                    <label>
											                        <input type="checkbox" class="'.$class.'" '.$check.' data-id="'.$this->encryption->encrypt($id).'"><span></span>
											                    </label>
											                </span>
											            </a>
											        </li>
											    </ul>
											</div>
										</div>
										<a href="javascript:;" class="btn btn-icon btn-light btn-hover-primary btn-sm m-1 '.$class1.'" data-id="'.$this->encryption->encrypt($id).'" title="View Subtitle">
											<i class="la la-eye"></i>
										</a>
										<a href="javascript:;" class="btn btn-icon btn-light btn-hover-danger btn-sm m-1 '.$class2.'"  data-id="'.$this->encryption->encrypt($id).'" title="Remove">
											<i class="la la-trash"></i>
										</a>
									</div>';
				break;
			}
			case "action2":{
				return '<div class="d-flex flex-row">
										<div class="dropdown dropdown-inline">
											<a href="javascript:;" id="dropdownMenuButton" class="btn btn-icon btn-light btn-hover-primary btn-sm m-1" data-toggle="dropdown" aria-expanded="true">
		        									<i class="la la-cog"></i>
		        									</a>
									        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
											    <ul class="nav nav-hoverable flex-column">
											        <li class="nav-item">
											            <a class="nav-link" href="javascript:;">
											                <i class="nav-icon la la-leaf"></i>
											                <span class="nav-text">Status</span>
											                <span class="switch switch-sm switch-icon">
											                    <label>
											                        <input type="checkbox" class="'.$class.'" '.$check.' data-id="'.$this->encryption->encrypt($id).'"><span></span>
											                    </label>
											                </span>
											            </a>
											        </li>
											    </ul>
											</div>
										</div>
										<a href="javascript:;" class="btn btn-icon btn-light btn-hover-primary btn-sm m-1 '.$class1.'" data-id="'.$this->encryption->encrypt($id).'" title="View Package">
											<i class="la la-eye"></i>
										</a>
										<a href="javascript:;" class="btn btn-icon btn-light btn-hover-primary btn-sm m-1 '.$class2.'"  data-id="'.$this->encryption->encrypt($id).'" title="View Sub category">
											<i class="flaticon2 flaticon2-document "></i>
										</a>
									</div>';
				break;
			}
			case"action3":{
				return '<button type="button" class="btn btn-light btn-hover-dark btn-icon btn-sm mr-2 '.$class.'" data-id="'.$this->encryption->encrypt($id).'" data-action="update" data-toggle="modal" data-target="#staticBackdrop"><i class="la la-eye"></i></button>
	        <button type="button" class="btn btn-sm btn-icon btn-light btn-hover-danger '.$class1.'" data-id="'.$this->encryption->encrypt($id).'" data-action="delete"><i class="la la-trash"></i></button>';
				break;
			}

		}
	}


}
