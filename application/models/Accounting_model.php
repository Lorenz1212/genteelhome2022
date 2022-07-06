<?php 
class Accounting_model extends CI_Model{  
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
	function Reports_Projectmonitoring($type,$val,$val1){
		switch ($type) {
			case "fetch_project_monitoring_joborder":{
				$query = $this->db->query("SELECT * FROM tbl_project ORDER BY production_no DESC"); 
		     	if($query){
		     		 $data=array();
		              foreach($query->result() as $row)  {
				             $data[] = array('id'=> $row->id,
				                      		 'production_no'=> $row->production_no);
		               }  
		              return $data; 
		        }else{
		        	return false;
		        }
				break;
			}
			case "fetch_project_monitoring_type":{
				$id = $this->encryption->decrypt($val);
				$type = $val1;
				$row = $this->db->query("SELECT * FROM tbl_project WHERE id='$id'")->row();
				if($row){
					$production_no = $row->production_no;
					$query = $this->db->query("SELECT *,(SELECT CONCAT(item,' ',unit) FROM tbl_materials WHERE id=tbl_material_project.item_no) as item_name FROM tbl_material_project WHERE production_no='$production_no' AND mat_type='$type'");
					if($query){
						foreach($query->result() as $row){
							$data[]=array('id'=>$row->id,
										  'item'=>$row->item_name);
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
			case "fetch_project_monitoring_material":{
				$row = $this->db->query("SELECT * FROM tbl_material_project WHERE id='$val'")->row();
				if($row){
					return $row;
				}else{
					return false;
				}
				break;
			}
			case 'fetch_project_monitoring':{
			 $data_info=array();
             $data_framing=array();
             $data_mechanism=array();
             $data_finishing=array();
             $data_sulihiya=array();
             $data_upholstery =array();
             $data_others=array();
             $row = $this->db->query("SELECT *,DATE_FORMAT(start_date, '%M %d %Y') as start_date_name,DATE_FORMAT(due_date, '%M %d %Y') as due_date_name FROM tbl_project WHERE id='$val'")->row();
             if($row){
             	 $data_info['id']=$this->encryption->encrypt($row->id);
	             $data_info['info']=$row;
	             $production_no = $row->production_no;
	             $query = $this->db->query("SELECT *,(total_qty*cost) as amount_costing,(production_quantity*cost) as amount_actual,(SELECT item FROM tbl_materials WHERE id=tbl_material_project.item_no) as item_name,
	             	(SELECT unit FROM tbl_materials WHERE id=tbl_material_project.item_no) as item_unit FROM tbl_material_project WHERE production_no='$production_no' AND mat_type=1");
	                 if($query){
	                     foreach($query->result() as $row){
	                        $data_framing['framing'][] = $row;
	                     }
	                 }
	            $query = $this->db->query("SELECT *,(total_qty*cost) as amount_costing,(production_quantity*cost) as amount_actual,(SELECT item FROM tbl_materials WHERE id=tbl_material_project.item_no) as item_name,
	             	(SELECT unit FROM tbl_materials WHERE id=tbl_material_project.item_no) as item_unit FROM tbl_material_project WHERE production_no='$production_no' AND mat_type=2");
	                 if($query){
	                     foreach($query->result() as $row){
	                        $data_mechanism['mechanism'][] = $row;
	                     }
	                 }
	            $query = $this->db->query("SELECT *,(total_qty*cost) as amount_costing,(production_quantity*cost) as amount_actual,(SELECT item FROM tbl_materials WHERE id=tbl_material_project.item_no) as item_name,
	             	(SELECT unit FROM tbl_materials WHERE id=tbl_material_project.item_no) as item_unit FROM tbl_material_project WHERE production_no='$production_no' AND mat_type=3");
	                 if($query){
	                     foreach($query->result() as $row){
	                        $data_finishing['finishing'][] = $row;
	                     }
	                 }
	             $query = $this->db->query("SELECT *,(total_qty*cost) as amount_costing,(production_quantity*cost) as amount_actual,(SELECT item FROM tbl_materials WHERE id=tbl_material_project.item_no) as item_name,
	             	(SELECT unit FROM tbl_materials WHERE id=tbl_material_project.item_no) as item_unit FROM tbl_material_project WHERE production_no='$production_no' AND mat_type=4");
	                 if($query){
	                     foreach($query->result() as $row){
	                        $data_sulihiya['sulihiya'][] = $row;
	                     }
	                 }
	            $query = $this->db->query("SELECT *,(total_qty*cost) as amount_costing,(production_quantity*cost) as amount_actual,(SELECT item FROM tbl_materials WHERE id=tbl_material_project.item_no) as item_name,
	             	(SELECT unit FROM tbl_materials WHERE id=tbl_material_project.item_no) as item_unit FROM tbl_material_project WHERE production_no='$production_no' AND mat_type=5");
	                 if($query){
	                     foreach($query->result() as $row){
	                        $data_upholstery['upholstery'][] = $row;
	                     }
	                 }
	            $query = $this->db->query("SELECT *,(total_qty*cost) as amount_costing,(production_quantity*cost) as amount_actual,(SELECT item FROM tbl_materials WHERE id=tbl_material_project.item_no) as item_name,
	             	(SELECT unit FROM tbl_materials WHERE id=tbl_material_project.item_no) as item_unit FROM tbl_material_project WHERE production_no='$production_no' AND mat_type=6");
	                 if($query){
	                     foreach($query->result() as $row){
	                        $data_others['others'][] = $row;
	                     }
	                 }  
             }
            return array_merge($data_info,$data_framing,$data_mechanism,$data_finishing,$data_sulihiya,$data_upholstery,$data_others);
			break;
			}
			default:
			return false;
			break;
		}
    }
    function Submit_Report_Projectmontoring($type,$customer,$address,$amount,$labor,$start,$end,$id){
       switch($type){
       	case"edit_project_monitoring_details":{
       		$id = $this->encryption->decrypt($id);
       		$amount = floatval(str_replace(',', '', $amount));
       		$labor = floatval(str_replace(',', '', $labor));
       		$start_date =  date('Y-m-d',strtotime($start));
       		$end_date =  date('Y-m-d',strtotime($end));
       		$data = array(
			        'customer' => $customer,
			        'address' => $address,
			        'amount' => $amount,
			        'labor' => $labor,
			        'start_date' => $start_date,
			        'due_date'=> $end_date);
			$result = $this->db->where('id', $id)->update('tbl_project', $data);
			if($result){
				return array('type'=>'success','message'=>'Save Changes');
			}else{
				return array('type'=>'info','message'=>'Nothing Changes');
			}
       		break;
       	}
       }
    }
     function Submit_Report_Projectmontoring_Material($type,$id,$quantity_costing,$cost){
       switch($type){
       	case "edit_project_monitoring_materials":{
       		$cost = floatval(str_replace(',', '', $cost));
       		$data = array(
			        'total_qty' => $quantity_costing,
			        'cost' => $cost);
			$result = $this->db->where('id', $id)->update('tbl_material_project', $data);
			if($result){
				return array('type'=>'success','message'=>'Save Changes');
			}else{
				return array('type'=>'info','message'=>'Nothing Changes');
			}
       		break;
       	}

       }
    }
    function Sales_Collection($type,$val,$val1,$val2){
    	switch ($type) {
    		case 'fetch_sales_collection_status':{
    			$id = $this->encryption->decrypt($val);
					$sql = "SELECT *,CONCAT(firstname, ' ',lastname) AS customer FROM tbl_customer_deposite WHERE id='$id'";
					$row = $this->db->query($sql)->row();
					if($row){
						$order_no = $row->order_no;
						$customer = $row->customer;
						$amount = $row->amount;
						$bank = $row->bank;
						$date_deposite = $row->date_deposite;
						$result = $this->db->where('id',$id)->update('tbl_customer_deposite',array('status'=>$val1,'remarks'=>$val2,'latest_update'=>date('Y-m-d H:i:s')));
						if($result){
							if($val1 == 'A'){
							
								$data = array('so_no'=>$order_no,'customer'=>$customer,'amount'=>$amount,'bank'=>$bank,'date_collect'=>$date_deposite);
								$this->db->insert('tbl_sales_collection',$data);
								return array('type'=>'success','Approve Successfully');
							}else{
								return array('type'=>'success','Cancel Successfully');
							}
						}else{
							return false;
						}
				}else{
					return false;
				}	
    			break;
    		}
    		default:
    			// code...
    			break;
    	}

    }

    function Submit_Sales_Collection($type,$firstname,$lastname,$mobile,$email,$amount,$order_no,$date_deposite,$bank,$image,$tmp){
    	 $path_image =  "assets/images/deposit/";
    	 switch($type){
    	 	case "add_sales_collection":{
	    	 	if($image){
						$newimage=$this->Get_Image_Code('tbl_customer_deposite', 'image', 'DEPOSITE', 10, $image);
						$this->move_to_folder($newimage,$tmp,$path_image);
						$data = array('order_no'=>$order_no,'firstname'=>$firstname,'lastname'=>$lastname,'email'=>$email,'mobile'=>$mobile,'amount'=>$amount,'bank'=>$bank,'image'=>$newimage,'date_deposite'=>$date_deposite);
    	 			$result = $this->db->insert('tbl_customer_deposite',$data);
    	 			if($result){
    	 				return array('type'=>'success','message'=>'Create Successfully');
    	 			}else{
    	 				return array('type'=>'info','message'=>'Oops! Something went wrong.');
    	 			}
					}else{
						return array('type'=>'info','message'=>'Please upload image of deposite slip');
					}
    	 		break;
    	 	}
    	 }
    }
    function Find($val){
    	$sql = $this->db->query("SELECT * FROM tbl_salesorder_stocks WHERE so_no='$val'")->row();
    	if($sql){
    		return $val;
    	}else{
    		$sql = $this->db->query("SELECT * FROM tbl_salesorder_project WHERE so_no='$val'")->row();
    		if($sql){
    			return $val;
    		}else{
    			return false;
    		}
    	}
   }


}