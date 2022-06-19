<?php 
class Webmodifier_model extends CI_Model{  
	public function __construct(){
	    parent::__construct();
	    $this->user_id = $this->appinfo->webmodifier('_WEBMODIFIER_ID');
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
	public function Product_List($type,$val){
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
				$sql = $this->db->query("SELECT *,(SELECT title FROM tbl_project_design WHERE id=tbl_project_color.project_no) AS title FROM tbl_project_color WHERE id='$id'")->row();
		        $query = $this->db->select('*')->from('tbl_project_image')->where('c_code', $sql->c_code)->get();
			        if($query !== FALSE && $query->num_rows() > 0){
		            foreach($query->result() as $row)  {
		             $data[] = array('id' => $row->id,
		                             'images'=> $row->images);
		            }  
       			 } 
         		return array('data'=>$data,'row' => $sql);
				break;
			}
			default:
				return false;
				break;
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
	public function Testimony_List($type,$val){
		switch ($type) {
			case 'fetch_testimony_list':{
				 $data =array();  
				 $query = $this->db->query("SELECT *,DATE_FORMAT(date_created, '%M %d %Y') as date_created FROM tbl_customer_testimony");
	        	if($query){
	              $no =1;
	              foreach($query->result() as $row){
	              $image = '<div class="symbol symbol-40 symbol-circle symbol-sm"><img class="" id="myImg" src="'.base_url().'assets/images/testimony/'.$row->image.'" alt="'.$row->name.'"></div>';
	              $action =  $this->Action('action3',$row->id,'btn-create','btn_delete',false,false);   		           
	            	$string = strip_tags($row->description);
		           	 if (strlen($string) > 500) {
			                $stringCut = substr($string, 0, 80);
			                $endPoint = strrpos($stringCut, ' ');
			                $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
			                $string .= '... <a class="btn-create" data-id="'.$this->encryption->encrypt($row->id).'" data-action="update" data-toggle="modal" data-target="#staticBackdrop">Read More</a>';
			            }
		             $data[] = array('no'               => $no,
		                            'image'             => $image,
		                            'name'              => $row->name,
		                            'description'       => $string,
		                            'date_created'      => $row->date_created,
		                            'action'            => $action);
		             $no++;
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
										<a href="javascript:;" class="btn btn-icon btn-light btn-hover-primary btn-sm m-1 '.$class2.'"  data-id="'.$this->encryption->encrypt($id).'" title="View description">
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
