<?php
class Create_model extends CI_Model{
	public function __construct(){
      parent::__construct();
	      if($this->appinfo->creative('_DESIGNER_ID') != false){
	        $this->user_id = $this->appinfo->creative('_DESIGNER_ID');
	      }else if($this->appinfo->production('_PRODUCTION_ID') != false){
	        $this->user_id = $this->appinfo->production('_PRODUCTION_ID');
	      }else if($this->appinfo->supervisor('_SUPERVISOR_ID') != false){
	        $this->user_id = $this->appinfo->supervisor('_SUPERVISOR_ID');
	      }else if($this->appinfo->sales('_SALES_ID') != false){
	        $this->user_id = $this->appinfo->sales('_SALES_ID');
	      }else if($this->appinfo->superuser('_SUPERUSER_ID') != false){
	        $this->user_id = $this->appinfo->superuser('_SUPERUSER_ID');
	      }else if($this->appinfo->accounting('_ACCOUNTING_ID') != false){
	       $this->user_id = $this->appinfo->accounting('_ACCOUNTING_ID');
	      }else if($this->appinfo->webmodifier('_WEBMODIFIER_ID') != false){
	        $this->user_id = $this->appinfo->webmodifier('_WEBMODIFIER_ID');
	      }else if($this->appinfo->admin('_ADMIN_ID') != false){
	        $this->user_id = $this->appinfo->admin('_ADMIN_ID');
	      }
    }
	private function move_to_folder_docs($image,$tmp,$path){
         $newfilename=  'DOCS'.date('YmdHis').'-'.preg_replace('/[@\;\" "\()]+/', '', $image);
         $path_folder = $path.$newfilename;
         copy($tmp, $path_folder);
         return $newfilename;
  	}
	private function move_to_folder1($image,$tmp,$path){
         $newfilename=  'IMG'.date('YmdHisu').'-'.preg_replace('/[@\;\" "\()]+/', '', $image);
         $path_folder = $path.$newfilename;
         copy($tmp, $path_folder);
         return $newfilename;
  	}
  	private function move_to_folder2($image,$tmp,$path){
         $newfilename=  'IMG'.date('YmdHisu').'-'.preg_replace('/[@\;\" "\()]+/', '', $image);
         $path_folder = $path.$newfilename;
         copy($tmp, $path_folder);
         return $newfilename;
  	}
  	private function move_to_folder3($image,$tmp,$path){
         $newfilename=  'IMG'.date('YmdHisu').'-'.preg_replace('/[@\;\" "\()]+/', '', $image);        
         $path_folder = $path.$newfilename;
         copy($tmp, $path_folder);
         return $newfilename;
  	}
  	private function move_to_folder4($string,$image,$tmp,$path,$targetWidth,$targetHeight){
  		$extension=pathinfo($image, PATHINFO_EXTENSION);
  		$newfilename=  'IMG'.date('YmdHis').'-'.$string.mt_rand(1000, 999999).'.'.$extension;
  		$path_folder = $path.$newfilename;
  		list($width, $height) = getimagesize($tmp);
  		$file = $this->imageType($extension,$path_folder,$tmp,$targetWidth,$targetHeight,$width,$height);
        if($file == true){
        	return $newfilename;
        }else{
        	return false;
        }
  	}
  	private function move_to_folder5($string,$image,$tmp,$path,$targetWidth,$targetHeight){
  		$extension=pathinfo($image, PATHINFO_EXTENSION);
  		$newfilename=  'IMG'.date('YmdHis').'-'.$string.mt_rand(1000, 999999).'.'.$extension;
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
    private function get_code($tbl,$code){
  		$query = $this->db->select('id')->from($tbl)->order_by('id','DESC')->limit(1)->get();
        $row_num = $query->num_rows();
        if($row_num > 0) {if ($row = $query->row()) {$value2 = intval($row->id) + 1;
        	return $code.sprintf('%03s', $value2);}}else {return $code."001";}
  	}
  	private function logs($log_type,$log_action,$log_table,$message){
  	   $user_type = $this->session->userdata('page');
  	   $id = $this->session->userdata('id');
  	   $data = array('log_type'=>$log_type,
  					'user_type'=>$user_type,
  					'user_id'=>$id,
  					'log_location'=>$log_action,
  					'log_table'=>$log_table,
  					'message'=>$message,
  					'show_log'=>1,
  					'date_created'=>date('Y-m-d H:i:s'));
  	   $this->db->insert('tbl_logs',$data);
  	}
	function Create_Design_Stocks($title,$c_name,$image,$tmp,$path_image,$color_image,$color_tmp,$path_color,$docs,$docs_tmp,$path_docs){  
		 if($image){$files1 = $this->move_to_folder1('PRODUCT',$image,$tmp,$path_image);
		 	if($files1 == false){$images = false;}else{$images = $files1;}
		 }else{$images="default.jpg";}

	   	if($color_image){$files2 = $this->move_to_folder1('PALLET',$color_image,$color_tmp,$path_color);
	    	if($files2 == false){$color_images = false;}else{$color_images = $files2;}
	    }else{$color_images="default.jpg";}
   	
   		if($images == false){
   			$message = 'Image is incorrect format';
   			$status = 'error';
   		}else if($color_image == false){
   			$message = 'Pallet Color is incorrect format';
   			$status = 'error';
   		}else{
   			if($docs){$docs_file = $this->move_to_folder_docs('STOCKS'.$docs,$docs_tmp,$path_docs);}else{$docs_file="default.jpg";}
   			$project_no = $this->get_code('tbl_project_design','PCODE');
	     	$value = $this->get_code('tbl_project_color','CCODE');
	   		$data = array('project_no'=> $project_no,
		                  'title'=> $title,
		                  'type'=> 1,
						  'date_created'=> date('Y-m-d H:i:s'));
	   		$this->db->insert('tbl_project_design',$data);
	   		$last_id = $this->db->insert_id();
	   		$data = array('designer' => $this->user_id,
	   			'project_no' => $last_id,
	   			'c_code'  => $value,
	   			'c_name'=> $c_name,
	   			'c_image' => $color_images,
	   			'image'=> $images,
	   			'docs'=> $docs_file,   					  			
	   			'status'=> 1,
	   			'type'=> 1,
	   			'date_created'=>date('Y-m-d H:i:s'),
	   			'created_by'=> $this->user_id);
	   		$this->db->insert('tbl_project_color',$data);
	   		$this->logs('design-stocks','Create Design For Stock','tbl_project_design & tbl_project_color','ITEM:'.$title.'<b>PALLET COLOR: '.$c_name);
   			$message = 'ok';
   			$status ='create';
   		}
   		$data_response = array('status' => $status, 'message' => $message);
   		return $data_response;
   }
   function Create_Design_Existing($project_no,$c_name,$image,$tmp,$path_image,$color_image,$color_tmp,$path_color,$docs,$docs_tmp,$path_docs){    
   	  	$id = $this->encryption->decrypt($project_no);
   		if($image){$files1 = $this->move_to_folder1('PRODUCT',$image,$tmp,$path_image);
		 	if($files1 == false){$images = false;}else{$images = $files1;}
		 }else{$images="default.jpg";}

	   	if($color_image){$files2 = $this->move_to_folder1('PALLET',$color_image,$color_tmp,$path_color);
	    	if($files2 == false){$color_images = false;}else{$color_images = $files2;}
	    }else{$color_images="default.jpg";}
	   		if($images == false){
	   			$message = 'Image is incorrect format';
	   			$status = 'error';
	   		}else if($color_image == false){
	   			$message = 'Pallet Color is incorrect format';
	   			$status = 'error';
	   		}else{
	   			if($docs){$docs_file = $this->move_to_folder_docs('STOCKS'.$docs,$docs_tmp,$path_docs);}else{$docs_file="default.jpg";}
	   			$value = $this->get_code('tbl_project_color','CCODE');
		   		$data = array('designer' => $this->user_id,
		   					  'project_no' => $id,
		   					  'c_code' => $value,
		   					  'c_name'=> $c_name,
		                      'c_image'  => $color_images,
		   					  'image'  => $images,
		   					  'docs'  => $docs_file,
		                      'status'  => 1,
		                      'type' => 1,
		   					  'date_created'=> date('Y-m-d H:i:s'),
		   					  'created_by'=> $this->user_id);
	   			$this->db->insert('tbl_project_color',$data);
	   			$message = 'ok';
	   			$status ='create';
	   			$this->logs('design-existing-stocks','Create New Pallet Color','tbl_project_color','PALLET COLOR: '.$c_name);
	   		}
   		$data_response = array('status' => $status, 'message' => $message);
   		return $data_response;
   }
   function Create_Design_Project($title,$image,$tmp,$path_image,$docs,$docs_tmp,$path_docs){  
		if($image){$files = $this->move_to_folder4('PROJECT',$image,$tmp,$path_image,500,500);
			if($files == false){$images = false;
			}else{$images = $files;}
		}else{$images="default.jpg";}
    	if($images == false){
   			$message = 'Image is incorrect format';
   			$status = 'error';
   		}else{
   			if($docs){$docs_file = $this->move_to_folder3('PROJECT'.$docs,$docs_tmp,$path_docs);}else{$docs_file="default.jpg";}
   			$project_no = $this->get_code('tbl_project_design','PCODE');
	   		$data = array('project_no'=> $project_no,
		                    'title'  => $title,
		                    'type'=> 2,
		   					'date_created' => date('Y-m-d H:i:s'));
	   		$this->db->insert('tbl_project_design',$data);
	   		$last_id = $this->db->insert_id();
	   		$data = array('designer'=> $this->user_id,
	   					  'project_no'=> $last_id,
	   					  'image' => $images,
	   					  'docs' => $docs_file,   					  			
	                      'status' => 1,
	                      'type' => 2,
	   					  'date_created'=>  date('Y-m-d H:i:s'),
	   					  'created_by'=> $this->user_id);
	   		$this->db->insert('tbl_project_color',$data);
	   		$this->logs('design-project','Create Design For Project','tbl_project_design','ITEM: '.$title);
	   		$message = 'ok';
   			$status = 'create';
   		}
   		$data_response = array('status'=> $status,'message'=>$message);
   		return $data_response;
   }
   	 function Create_Joborder_Stocks($project_no,$c_code,$qty,$mat_type,$mat_itemno,$mat_quantity,$mat_remarks,$pur_item,$pur_quantity,$pur_remarks,$pur_type){
	 		 $value = $this->get_code('tbl_project','JO'.date('Ymd').'-');
	 		 	$pur_items = explode(',', $pur_item);
	 		 	$pur_quantitys = explode(',', $pur_quantity);
	 		 	$pur_remarkss = explode(',', $pur_remarks);
	 		 	$pur_types = explode(',', $pur_type);
	    		if($pur_item){
	    			for($i=0; $i<count($pur_items);$i++){
    				     $query = $this->db->select('*')->from('tbl_materials')->where('id',$pur_items[$i])->get();
    				     $row = $query->row();
    				     if(!$row){
    				     	    if($pur_types[$i] == 2){
	    				     	    $new_no = $this->get_code('tbl_materials','RMCODE-');
									$data = array('user_id'=> $this->user_id,'item_no'=> $new_no,'item'=> $pur_items[$i],'status' => 1,'date_created'=> date('Y-m-d H:i:s'));
									$this->db->insert('tbl_materials',$data);
									$item_no = $this->db->insert_id();
    				     	    }
    				     }else{
    				     		$item_no = $row->id;
    				     }
	                 	$purchase_data = array('production_no'=>$value,
				                'item_no'		   =>  $item_no,
				                'quantity'         =>  $pur_quantitys[$i],
				                'balance' 		   =>  $pur_quantitys[$i],
				                'status'           =>  1,
				                'remarks'          =>  $pur_remarkss[$i],
				                'material_type'    =>  $pur_types[$i],
				                'date_created'     =>  date('Y-m-d H:i:s'));
	        			$this->db->insert('tbl_purchasing_project',$purchase_data);
				    }
			    }
					$data = array('production'=>$this->user_id,
				                  'assigned'=>$this->user_id,
				                  'project_no'=>$this->encryption->decrypt($project_no),
				                  'c_code' => $this->encryption->decrypt($c_code),
					 			  'production_no'=>$value,
					 			  'unit' =>$qty,
					 			  'status'=>1,
					 			  'type'=>1,
					 			  'date_created'=>date('Y-m-d H:i:s'));
				$this->db->insert('tbl_project',$data);
				$mat_itemnos = explode(',', $mat_itemno);
	 		 	$mat_quantitys = explode(',', $mat_quantity);
	 		 	$mat_remarkss = explode(',', $mat_remarks);
	 		 	$mat_types = explode(',', $mat_type);	
				for($i=0; $i<count($mat_itemnos);$i++){
				   	$material_data = array('production_no' =>  $value,
						                'production'       =>  $this->user_id,
						                'item_no'		   =>  $mat_itemnos[$i],
						                'total_qty'        =>  $mat_quantitys[$i],
						                'status'           =>  1,
						                'mat_type'		   =>  $mat_types[$i],
						                'remarks'          =>  $mat_remarkss[$i],
						                'date_created'     =>  date('Y-m-d H:i:s'));
       				 $this->db->insert('tbl_material_project',$material_data);
		       	}
	 }
	 function Create_Joborder_Project($project_no,$mat_type,$mat_itemno,$mat_quantity,$mat_remarks,$pur_item,$pur_quantity,$pur_remarks,$pur_type){
	 		   $value = $this->get_code('tbl_project','JO'.date('Ymd').'-');
	 		 	$pur_items = explode(',', $pur_item);
	 		 	$pur_quantitys = explode(',', $pur_quantity);
	 		 	$pur_remarkss = explode(',', $pur_remarks);
	 		 	$pur_types = explode(',', $pur_type);
	    		if($pur_item){
	    			for($i=0; $i<count($pur_items);$i++){
    				     $query = $this->db->select('*')->from('tbl_materials')->where('id',$pur_items[$i])->get();
    				     $row = $query->row();
    				     if(!$row){
    				     	    if($pur_types[$i] == 2){
	    				     	    $new_no = $this->get_code('tbl_materials','RMCODE-');
									$data = array('user_id'=> $this->user_id,'item_no'=> $new_no,'item'=> $pur_items[$i],'status' => 1,'date_created'=> date('Y-m-d H:i:s'));
									$this->db->insert('tbl_materials',$data);
									$item_no = $this->db->insert_id();
    				     	    }
    				     }else{
    				     		$item_no = $row->id;
    				     }
	                 	$purchase_data = array('production_no'=>$value,
				                'item_no'		   =>  $item_no,
				                'quantity'         =>  $pur_quantitys[$i],
				                'balance' 		=>  $pur_quantitys[$i],
				                'status'           =>  1,
				                'remarks'          =>  $pur_remarkss[$i],
				                'material_type'    =>  $pur_types[$i],
				                'date_created'     =>  date('Y-m-d H:i:s'));
	        			$this->db->insert('tbl_purchasing_project',$purchase_data);
				    }
			    }
				$data = array('production_no'=>$value,
							  'production'=>$this->user_id,
			                  'assigned'=>$this->user_id,
			                  'project_no'=>$this->encryption->decrypt($project_no),
				 			  'status'=>1,
				 			  'type'=>2,
				 			  'date_created'=>date('Y-m-d H:i:s'));
				$this->db->insert('tbl_project',$data);
				$mat_itemnos = explode(',', $mat_itemno);
	 		 	$mat_quantitys = explode(',', $mat_quantity);
	 		 	$mat_remarkss = explode(',', $mat_remarks);
	 		 	$mat_types = explode(',', $mat_type);	
				for($i=0; $i<count($mat_itemnos);$i++){
				   	$material_data = array('production_no' =>  $value,
						                'production'       =>  $this->user_id,
						                'item_no'		   =>  $mat_itemnos[$i],
						                'total_qty'        =>  $mat_quantitys[$i],
						                'status'           =>  1,
						                'mat_type'		   =>  $mat_types[$i],
						                'remarks'          =>  $mat_remarkss[$i],
						                'date_created'     =>  date('Y-m-d H:i:s'));
       				 $this->db->insert('tbl_material_project',$material_data);
		       	}
	 }
	 function Create_Joborder_Request($project_no,$c_code,$unit,$type){        
	    	$value = $this->get_code('tbl_project','JO'.date('Ymd').'-');
	    		$data = array('production_no'=>$value,
	    					  'project_no'=>$this->encryption->decrypt($project_no),
	    					  'c_code'=>$this->encryption->decrypt($c_code),
	    					  'production'=>$this->user_id,
	    					  'assigned'=>$this->user_id,
	    					  'unit'=> $unit,
	    					  'status'=>2,
	    					  'type'=>$type,
	    					  'date_created'=>date('Y-m-d H:i:s'));
		 	$result = $this->db->insert('tbl_project',$data);
		 	if($result){
		 		return true;
		 	}else{
		 		return false;
		 	}
	   } 
	    function Create_Users($firstname,$lastname,$middlename,$username,$status,$designer,$production,$supervisor,$superuser,$admin,$password,$accounting,$webmodifier,$sales,$voucher,$profile_avatar,$profile_tmp,$profile_path){
        if($profile_avatar){$images = $this->move_to_folder4('PROFILE',$profile_avatar,$profile_tmp,$profile_path,360,360);}else{$images="default.jpeg";}
        $data = array('username'   		=> $username,
        	   		  'password'   		=> md5($password),
                      'firstname'  		=> $firstname,
                      'lastname'   		=> $lastname,
                      'middlename' 		=> $middlename,
                      'image'      		=> $image,
                      'status'     		=> $status,
                      'coupon_status' 	=> $voucher,
                      'designer'   		=> $designer,
                      'production' 		=> $production,
                      'supervisor' 		=> $supervisor,
                      'superuser'  		=> $superuser,
                      'admin'      		=> $admin,
                      'accounting'		=> $accounting,
                      'webmodifier'		=> $webmodifier,
                      'sales'			=> $sales,
                  	  'date_created' 	=> date('Y-m-d H:i:s'));
        $this->db->insert('tbl_users',$data);
     }
      function Create_Purchase_Request($production_no,$item,$quantity,$remarks){
	 			  for($i=0; $i<count($item);$i++){
                 $items = strtoupper($item[$i]);
	               $query = $this->db->select('*')->from('tbl_materials')->where('item',$items)->get();
                 $row = $query->row();
                 if(!$row){
                 	  $data = array('item' => $items);
                 	  $this->db->insert('tbl_materials',$data);
                 }
                 $data = array(
                  'supervisor'    		=>  $this->user_id,
                  'production_no' 		=>  $production_no,
                  'request_id'    		=>  'PR'.date('YmdHis'),
                  'item'          		=>  $items,
                  'quantity'      		=>  $quantity[$i],
                  'balance' 	=>  $quantity[$i],
                  'status'        		=>  'PENDING',
                  'remarks'       		=>  $remarks[$i],
                  'date_pending'  		=>  date('Y-m-d H:i:s'));
                $this->db->insert('tbl_purchasing_project',$data);
          }
	 }
	 function Create_MaterialUsed($item_no,$production_no,$item,$qty,$unit){
		    $query1 = $this->db->select('*')->from('tbl_materials')->where('item_no',$item_no)->get();
		    foreach($query1->result() as $row)  
        	{
        	  $amount = floatval($qty) * floatval($row->price);
        	  $data = array('supervisor'=>  $this->user_id,
	                      'production_no' =>  $production_no,
	                      'item'=>  $item,
	                      'qty' =>  $qty,
	                      'unit' =>  $unit,
	                      'amount' =>  $amount,
	                      'status'=>  'PENDING',
	                      'date_created' =>  date('Y-m-d H:i:s'));
            $this->db->insert('tbl_material_used',$data);

            $sql = $this->db->select('*')->from('tbl_material_production')->where('item',$item)->get();
            $row_pro = $sql->row();

            $sql_mat = $this->db->select('*')->from('tbl_material_project')->where('item',$item)->where('production_no',$production_no)->get();
            $row_mat = $sql_mat->row();
            $total = $row_mat->total_qty - $qty;
            $stocks = $total + $row_pro->stocks;
            $update = array('stocks'=>$total);

            $this->db->where('id',$row_pro->id);
            $this->db->update('tbl_material_production',$update);
       		}  
	 }
	 function Create_RawMaterial($item,$unit,$price){
	  $value = $this->get_code('tbl_materials','RMCODE-');
      $data = array('user_id' 			=> $this->user_id,
      	 		    'item_no' 			=> $value,
                    'item'    			=> $item,
                    'unit'				=> $unit,
                    'price'   			=> $price,
                    'status'  		 	=> 1,
                    'date_created'	=> date('Y-m-d H:i:s'));
      $this->db->insert('tbl_materials',$data);
    }
    function Create_Production($item_no,$item,$stocks){
    	 $data = array( 'item_no' 			=> $item_no,
	                    'item'    			=> $item,
	                    'stocks'   			=> $stocks,
	                    'date_created'	=> date('Y-m-d H:i:s'));
      $this->db->insert('tbl_material_production',$data);
    }

     function Create_Other_Materials($item,$type){
      $data = array('item' =>$item,'status'=> 1,'type'=>$type,'date_created'=> date('Y-m-d H:i:s'),'created_by'=>$this->user_id);
      $result = $this->db->insert('tbl_other_materials',$data);
      if($result){
      	return true;
      }else{
      	return false;
      }
    }
    function Create_OfficeSupplies($item){
   	  $data = array('item' =>$item,'status'=> 1,'type'=>2,'date_created'=> date('Y-m-d H:i:s'),'created_by'=>$this->user_id);
      $result = $this->db->insert('tbl_other_materials',$data);
      if($result){
      	return true;
      }else{
      	return false;
      }
    }
    function Create_Other_Matrials_Request($item,$quantity,$remarks,$type){
    	 $mr_no = date('YmdHis');
    	 $items = explode(',', $item);
		 $quantities = explode(',', $quantity);
		 $remarkss = explode(',', $remarks);
    	 for($i=0; $i<count($items);$i++){
    	 		$data = array('mr_no' =>$mr_no,
	    	 				 'item_no'=> $items[$i],
	    	 				 'qty'=> $quantities[$i],
	    	 				 'balance'=> $quantities[$i],
	    	 				 'remarks'=> $remarkss[$i],
	    	 				 'status' => 1,
	    	 				 'type'=>$type,
	    	 				 'date_created'=> date('Y-m-d H:i:s'),
	    	 				 'created_by'=>$this->user_id);
    	 		$this->db->insert('tbl_other_material_m_request',$data);
    	 }
    	 return true;
    }

    function Create_Purchase_Request_Stocks($item,$quantity,$remarks,$amount,$unit){
		        $value = $this->get_code('tbl_request_id','RMPR-'.date('Ymd'));
	    		$insert = array('request_id' => $value,
								'purchaser'  => $this->user_id,
								'status'	  => 'PENDING',
								'date_created'=>date('Y-m-d H:i:s'));
	    		$this->db->insert('tbl_request_id',$insert);
    	      for($i=0; $i<count($item);$i++){
	 				if($remarks[$i] == 'Raw Material'){
							$type = 'rawmats';
					}else if($remarks[$i] == 'Office & Janitorial Supplies'){
							$type = 'office';
					}else if($remarks[$i] == 'Production Supplies/Spare Parts'){
							$type = 'production';
					}
					$amounts = floatval(preg_replace('/[^\d.]/', '', $amount[$i]));
    	 			$data = array('request_id'=> $value,
								'purchaser' => $this->user_id,
								'item' => $item[$i],
								'qty'=> $quantity[$i],
								'balance'=> $quantity[$i],
								'amount'=> $amounts,
								'unit'=> $unit[$i],
								'remarks' => $type,
								'status'=> 'PENDING',
								'date_created'=> date('Y-m-d H:i:s'));
    	 		 $this->db->insert('tbl_purchase_stocks',$data);
    	 }
    }


    //WebModifier
    function Create_Web_Banner($type,$image,$tmp,$path_image){
    		if($image){$files1 = $this->move_to_folder4('WEBBANNER',$image,$tmp,$path_image,1600,1200);
			 	if($files1 == false){$images = false;}else{$images = $files1;}
			 }else{$images="default.png";}

	    		if($images == false){
		    		$status = 'error';
		    		$message = 'Image is incorrect format';
	    		}else{
	    			 $value = $this->get_code('tbl_website_banner','WEBBANNER');
		    		if($type == 'none'){
			    	}else{
			    		$update = array('type' => 'none');
			    		$this->db->where('type',$type);
			    		$this->db->update('tbl_website_banner',$update);
			    	}
			    	$data = array('web_no' => $value,
			    				  'image'	=> $images,
			    				  'type' => $type,
			    				  'date_created'=> date('Y-m-d H:i:s'));
			    	$this->db->insert('tbl_website_banner',$data);
			    	$message = 'ok';
			    	$status = 'create';
	    		}
	    	$data_response = array('status'=>$status,'message'=>$message);
    		return $data_response;
    	
    }
    function Create_Web_SubCategory($cat_id,$sub_name){
    	  $sub_names = strtoupper($sub_name);
    	  $query = $this->db->select('*')->from('tbl_category_sub')->where('sub_name',$sub_names)->get();
	    	$row = $query->row();
	    	if($query !== FALSE && $query->num_rows() > 0){
	    		return 'error';
	    	}else{
	    		$data = array('cat_id' 		=> $cat_id,
	    							    'sub_name' 	=> $sub_names);
	      	$this->db->insert('tbl_category_sub',$data);
	      	return 'success';
	    	}	
    }
    function Create_ProductCategory($sub_id,$id){
    	 $query = $this->db->select('*')->from('tbl_category_sub')->where('id',$sub_id)->get();
	     $row = $query->row();
	     $data = array('cat_id'=>$row->cat_id,
	   					'sub_id'=>$row->id);
	     $this->db->where('id',$id);
	     $this->db->update('tbl_project_design',$data);
    }
    function Create_Project_Status($id,$status){
    	 $data = array('display_status' => $status);
    	 $this->db->where('id',$id);
	      $this->db->update('tbl_project_color',$data);
	      $query = $this->db->select('*')->from('tbl_project_color')->where('id',$id)->get();
	      $row = $query->row();

	      $query1 = $this->db->select('*')->from('tbl_project_design')->where('id',$row->project_no)->get();
	      $row1 = $query1->row();
	      if(!$row1->d_status){
	      	 $update = array('d_status' => 'DISPLAYED',
	      					'date_display'=> date('Y-m-d'));
	      	 $this->db->where('id',$row1->id);
	      	 $this->db->update('tbl_project_design',$update);
	      }

    }
    function Create_Project_Title($id,$name,$action){
    	if($action =='save_cname'){
    		 $data = array('c_name' => $name);
	    	 $this->db->where('id',$id);
		     $this->db->update('tbl_project_color',$data);
    	}else{
    		$data = array('title' => $name);
	    	$this->db->where('id',$id);
		    $this->db->update('tbl_project_design',$data);
    	}
    	return 'success';
    }
    function Create_Web_Project_Image($id,$image,$tmp,$path_image){
    	     $status ='no image';
    		 $last_id="";
    		 $images="";
    		 $query = $this->db->select('*')->from('tbl_project_color')->where('id',$id)->get();
			 $row = $query->row();
	    	 $query1 = $this->db->select('count(id) as count')->from('tbl_project_image')->where('id',$id)->get();
	    	 $row1 = $query1->row();
	    	 if($query1 !== FALSE && $query1->num_rows() > 0){
	    	 		if($row1->count == 15){
	    	 			   $statu = 'maximum';
	    	 		}else{
				        if($image){$images = $this->move_to_folder4('GALLERY',$image,$tmp,$path_image,800,800);
				        	$data = array('project_no' => $row->project_no,
						    	 		'c_code'=> $row->c_code,
							    		'images'=> $images);
			 				 $this->db->insert('tbl_project_image',$data);
			 				 $last_id = $this->db->insert_id();
			 				 $status = 'success';
			    		}
	    	 		}
		    	}else{
		    			if($image){$images = $this->move_to_folder4('GALLERY',$image,$tmp,$path_image,800,800);
		    					$data = array('project_no' => $row->project_no,
					    	 				'c_code'=> $row->c_code,
						    				'images' => $images);
				 				 $this->db->insert('tbl_project_image',$data);
				 				 $last_id = $this->db->insert_id();
		    					 $status = 'success';
		    			}
		    	}	
				$json = array('status'=>'success','image' => $images,'id' => $last_id);
		    	return $json;
    }
    function Create_Web_Project_Tearsheet($id,$image,$tmp,$path_image){
    			$query = $this->db->select('*')->from('tbl_project_design')->where('id',$id)->get();
    			$row = $query->row();
    			if(!$row->tearsheet){
    					if($image){$images = $this->move_to_folder3('TEARSHEET'.$image,$tmp,$path_image);
		    					$data = array('tearsheet' => $images);
		    					$this->db->where('project_no',$id);
					 			$this->db->update('tbl_project_design',$data);
					 			$last_id = $id;
		    					$status = 'success';
		    			}else{
		    				$status = 'no image';
		    				$last_id = "";
    						$images="";
		    			}
    			}else{
    				if($image){$images = $this->move_to_folder3('TEARSHEET'.$image,$tmp,$path_image);
    					unlink("./".$path_image.$row->tearsheet);
		    					 $data = array('tearsheet' => $images);
		    					 $this->db->where('project_no',$id);
					 			 $this->db->update('tbl_project_design',$data);
					 			 $last_id = $id;
		    					 $status = 'success';
		    			}else{
		    				$status = 'no image';
		    				$last_id = "";
    						$images="";
		    			}
    			}
    			$json = array('status'=>$status,'image' => $images,'id' => $last_id);
	    	 	return $json;		
    }
    function Create_Web_Project_Price($id,$c_price){
    		$query = $this->db->select('*')->from('tbl_project_color')->where('id',$id)->get();
    		$row = $query->row();
    		if(!$row->c_price){
    			 $data = array('c_price'=> $c_price);
    			 $this->db->where('c_code',$id);
	     		 $this->db->update('tbl_project_color',$data);
    			 return 'success';
    		}else if($row->c_price == $c_price){
    			return 'error';
    		}else{
    		  $data = array('c_price' => $c_price,
    						'r_price' => $row->c_price);
    		  $this->db->where('id',$id);
	          $this->db->update('tbl_project_color',$data);
			  return 'success';
    		}
    }
    function Create_Web_Change_Pallet($id,$image,$tmp,$path_image,$previous){
    	if($image){$images = $this->move_to_folder5($image,$tmp,$path_image,300,300);
    		unlink("./".$path_image.$previous);
			 $data = array('c_image' => $images);
		 	 $this->db->where('id',$id);
			 $this->db->update('tbl_project_color',$data);
			 $status = 'success';
    	}else{
    		$images = $previous;
    		$status = 'error';
    	}
    	 $data_response = array('status' => $status,'c_image'=>$images);
    	 return $data_response;
    }
    function Create_Web_Project_Category($id,$cat_id,$sub_id){
    	$data = array('cat_id' => $cat_id,
    				 'sub_id'=> $sub_id);
    	$this->db->where('id',$id);
    	$this->db->update('tbl_project_design',$data);
    	$data_response = array('status' => 'success');
    	return $data_response;
    }
     function Create_Web_Finishproduct($title,$c_name,$amount,$cat_id,$sub_id,$image,$tmp,$path_image,$color_image,$color_tmp,$path_color,$docs,$docs_tmp,$path_docs){    
   		if($image){$files1 = $this->move_to_folder4('PRODUCT',$image,$tmp,$path_image,500,500);
		 	if($files1 == false){$images = false;}else{$images = $files1;}
		}else{$images="default.jpg";}
	   	
	   	if($color_image){$files2 = $this->move_to_folder5('PALLET',$color_image,$color_tmp,$path_color,300,300);
	    	if($files2 == false){$color_images = false;}else{$color_images = $files2;}
	    }else{$color_images="default.jpg";}


	   		if($images == false || $color_images == false){
	   			if($images == false){
	   				$message = 'Image is incorrect format';
	   				$status = 'error';
	   			}else if($color_image == false){
	   				$message = 'Pallet Color is incorrect format';
	   				$status = 'error';
	   			}
	   		}else{
	   			if($docs){$docs_file = $this->move_to_folder3('TEARSHEET'.$docs,$docs_tmp,$path_docs);}else{$docs_file="default.jpg";}
	   			$project_no = $this->get_code('tbl_project_design','PCODE');
		        $value = $this->get_code('tbl_project_color','CCODE');
		   		$data = array('project_no'    => $project_no,
			                  'title'         => $title,
			                  'tearsheet'	  => $docs_file,
			                  'project_Status'=> 'APPROVED',
			                  'type'		  => 1,
			                  'cat_id'		  => $this->encryption->decrypt($cat_id),
			                  'sub_id'		  => $this->encryption->decrypt($sub_id),
			   				  'date_created'  =>  date('Y-m-d H:i:s'));
		   		$this->db->insert('tbl_project_design',$data);
		   		$last_id = $this->db->insert_id();
		   		$data = array('designer'      => $this->user_id,
		   					  'project_no'    => $last_id,
		   					  'c_code'    	  => $value,
		   					  'c_name'        => $c_name,
		   					  'c_price'		  => $amount,
		                      'c_image'       => $color_images,
					  		  'image'         => $images,
		                      'status'        => 2,
		                      'type'       	  => 1,
		   					  'date_created'  =>  date('Y-m-d H:i:s'),
		   					  'created_by'	  => $this->user_id);
		   		$this->db->insert('tbl_project_color',$data);
	   			$message = 'ok';
	   			$status ='success';
	   		}
	   		$data_response = array('status' => $status, 'message' => $message);
	   		return $data_response;
   }
   function Create_Web_Finishproduct_Pallet($project_no,$c_name,$amount,$image,$tmp,$path_image,$color_image,$color_tmp,$path_color){
   		if($image){$files1 = $this->move_to_folder4('PRODUCT',$image,$tmp,$path_image,500,500);
		 	if($files1 == false){$images = false;}else{$images = $files1;}
		   }else{$images="default.jpg";}

	   	if($color_image){$files2 = $this->move_to_folder5('PALLET',$color_image,$color_tmp,$path_color,300,300);
	    	if($files2 == false){$color_images = false;}else{$color_images = $files2;}
	    }else{$color_images="default.jpg";}

   		if($images == false || $color_images == false){
	   			if($images == false){
	   				$message = 'Image is incorrect format';
	   				$status = 'error';
	   			}else if($color_image == false){
	   				$message = 'Pallet Color is incorrect format';
	   				$status = 'error';
	   			}
   		}else{
   			$id = $this->encryption->decrypt($project_no);
   			$value = $this->get_code('tbl_project_color','CCODE');
	   		$data = array('designer'      => $this->user_id,
	   					  'project_no'    => $this->encryption->decrypt($project_no),
	   					  'c_code'    	  => $value,
	   					  'c_name'        => $c_name,
	   					  'c_price'		  => $amount,
	                      'c_image'       => $color_images,
				  		  'image'         => $images,
	                      'status'        => 2,
	                      'type'       	  => 1,
	   					  'date_created'  =>  date('Y-m-d H:i:s'),
	   					  'created_by'	  => $this->user_id);
	   		$this->db->insert('tbl_project_color',$data);
   			$message = 'ok';
   			$status ='success';
   		}
   		$data_response = array('status' => $status, 'message' => $message);
   		return $data_response;
   }
   
   
    function Create_Web_Voucher($voucher,$discount,$date_from,$date_to){
    	$percent = str_replace('%', '', $discount);
    	$dis = $percent / 100.00;
    	$data = array('promo_code' => $voucher,
    				'discount'   => $dis,
    				'date_from'  => date('Y-m-d',strtotime($date_from)),
    				'date_to'    => date('Y-m-d',strtotime($date_to)));
    	$this->db->insert('tbl_code_promo',$data);
    }
     function Create_Web_Interior($title,$cat_id,$description,$status,$banner_image,$banner_tmp,$bg_image,$bg_tmp,$path_image){
     	if($banner_image){$files1 = $this->move_to_folder4('INTERIORBANNER',$banner_image,$banner_tmp,$path_image,1140,653);
     		if($files1 == false){$banner = false;}else{$banner = $files1;}
     	}else{$banner="default.png";}

     	if($bg_image){$files2 = $this->move_to_folder5('INTERIORBG',$bg_image,$bg_tmp,$path_image,810,457);
     		if($files2 == false){$bg = false;}else{$bg = $files2;}
     	}else{$bg="default.png";}

     	if($banner == false || $bg == false){
     		
     		if($banner == false){
     			$message == 'Banner is incorrect format';
     		$status = 'error';
     		}else if($bg == false){
     			$message == 'Backgroumd is incorrect format';
     			$status = 'error';
     		}
     	}else{
     		$data = array('cat_id' => $cat_id,
    				  'project_name' => $title,
    				  'description'=> $description,
    				  'image'=> $banner,
    				  'bg'=> $bg,
    				  'status' => $status);
    		$this->db->insert('tbl_interior_design',$data);
    		$message = 'ok';
    		$status = 'create';
     	}
     	$data_response = array('status'=>$status,'message'=>$message);
    	return $data_response;
    }
     function Create_Web_Events($title,$status,$description,$id,$date_event,$time_event,$location,$image,$tmp,$path){
     	if($image){$images = $this->move_to_folder1($image,$tmp,$path);}else{$images="default.jpg";}
    	$data = array('title'           => $title,
                      'description'     => $description,
                      'location'        => $location,
                      'date_event'      => date('Y-m-d',strtotime($date_event)),
                      'time_event'      => $time_event,
                      'status'          => $status,
                      'image'           => $images);
    	$this->db->insert('tbl_events',$data);
    }
    function Create_Interior_Status($id,$status){
    	 	$data = array('status' 	=> $status);
    	 	$this->db->where('id',$id);
	      $this->db->update('tbl_interior_design',$data);
    }
    function Create_Web_Interior_Image($id,$image,$tmp,$path_image){
    	   $status ='no image';
    	   $last_id ='';
    	   $images ='';
	 		if($image){
	 			$files = $this->move_to_folder4('INT',$image,$tmp,$path_image,1140,653);
	 			 if($files == false){
	 			 	$status == 'error';
	 			 }else{
	 			 	$images = $files;
	 			 	$data = array('in_id' => $id,
	          				'images' => $files,
	          				'date_created'=> date('Y-m-d H:i:s'));
		     		$this->db->insert('tbl_interior_image',$data);
		     		$last_id = $this->db->insert_id();
		     		$status ='success';
	 			 }
	        }
	        $json = array('status'=>$status,'image' => $images,'id'=> $last_id);
  			return $json;
    }
    function Create_Deposite($firstname,$lastname,$mobile,$email,$order_no,$date_deposite,$amount,$bank,$image,$tmp,$path_image){
          if($image){$images = $this->move_to_folder1($image,$tmp,$path_image);}else{$images='default.jpg';}
	         $type ="";
	        $row = $this->db->select('*')->from('tbl_salesorder_stocks')->where('so_no',$order_no)->get()->row();
	        if($row){
	        	$type = 1;
	        }else{
	        	$row1 = $this->db->select('*')->from('tbl_salesorder_project')->where('so_no',$order_no)->get()->row();
	        	if($row1){
	        	   $type = 2;
	        	}
	        }
           $data = array('order_no' => $order_no,
                         'firstname' => $firstname,
                         'lastname' => $lastname,
                         'mobile'=> $mobile,
                         'email'=> $email,
                         'date_deposite'=> date('Y-m-d',strtotime($date_deposite)),
                         'amount'=> $amount,
                         'bank'=> $bank,
                         'image'=> $images,
                         'type'=>$type,
                     	 'date_created'=> date('Y-m-d H:i:s'),
                     	 'created_by'=>$this->user_id);
            	$this->db->insert('tbl_customer_deposite',$data);
            	return array('status'=>'success');
  	}
  	function Create_Customer($firstname,$lastname,$mobile,$email,$address,$city,$province,$region){
				$data = array('firstname' => $firstname,
							'lastname' => $lastname,
							'mobile' => $mobile,
							'email'	=> $email,
							'address' => $address,
						 	'city'=> $city,
							'province' => $province,
							'region'  => $region,
							'date_created'=> date('Y-m-d H:i:s'),
							'latest_update'=> date('Y-m-d H:i:s'),
							'update_by'=> $this->user_id);
				$this->db->insert('tbl_customer_online',$data);
				return 'create';
  	}
  	function Create_Cash_Position($name,$amount,$date_position,$type,$cat_id){
		 	 $data = array('name'=> $name,
		  					'amount'=> $amount,
		  					'cat_id'=> $cat_id,
		  					'type'=> $type,
		  					'date_position' => date('Y-m-d',strtotime($date_position)),
		  					'date_created'=> date('Y-m-d H:i:s'),
		  					'created_by'=> $this->user_id);
		 	$this->db->insert('tbl_cash_position',$data);
	  		$data_response = array('status' => 'create');
	  		return $data_response;
  	 }
  	 function Create_Web_Testimony($name,$description,$image,$tmp,$path_image){
  	 	 if($image){$files = $this->move_to_folder4('TESTIMONY',$image,$tmp,$path_image,250,250);
  	  	  	 if($files == false){$images = false;}else{$images = $files;}
  	  	  }else{ $images = 'default.jpg';}

  	  	 	 if($images == false){
  	  	  		$status == 'error';
  	  	 	 }else{
	  	  	  	$data = array('name'=> $name,
						'description'=> $description,
						'image'=> $files,
						'date_created'=> date('Y-m-d H:i:s'),
						'created_by'=> $this->user_id);
		 		 $this->db->insert('tbl_customer_testimony',$data);
		 		 $status = 'create';
	  	  	 }
		 	$data_response = array('status' => $status);
	  		return $data_response;
  	 }
  	function Create_Joborder_Inpection_Project_Image($id,$production_no,$image,$tmp,$path_image){
	     $status ='no image';
		 $last_id="";
		 $images="";
		 $query = $this->db->select('count(id) as count')->from('tbl_project_inspection')->where('production_no',$production_no)->get();
	     $row = $query->row();
    	 if($query !== FALSE && $query->num_rows() > 0){
    	 		if($row->count == 15){
    	 			   $status = 'maximum';
    	 		}else{
			        if($image){$images = $this->move_to_folder4('INSPECTION',$image,$tmp,$path_image,500,500);
			        	$data = array('production_no' => $production_no,
			        				  'production'=>$id,
						    		  'images'=> $images,
						    		  'status'=> 1,
						    		  'type'=>2,
						    		  'date_created'=>date('Y-m-d H:i:s'),
						    		  'created_by'=> $id);
		 				 $this->db->insert('tbl_project_inspection',$data);
		 				 $last_id = $this->db->insert_id();
		 				 $status = 'success';
		    		}
    	 		}
    	}else{
			if($image){$images = $this->move_to_folder4('INSPECTION',$image,$tmp,$path_image,500,500);
					$data = array('production_no' => $production_no,
			        				  'production'=>$id,
						    		  'images'=> $images,
						    		  'status'=> 1,
						    		  'type'=>2,
						    		  'date_created'=>date('Y-m-d H:i:s'),
						    		  'created_by'=> $id);
	 				 $this->db->insert('tbl_project_inspection',$data);
	 				 $last_id = $this->db->insert_id();
					 $status = 'success';
			}
    	}	
		$json = array('status'=>'success','image' => $images,'id' => $last_id);
    	return $json;
    }
    function Create_Joborder_Inpection_Stocks_Image($id,$production_no,$image,$tmp,$path_image){
	     $status ='no image';
		 $last_id="";
		 $images="";
		 $query = $this->db->select('count(id) as count')->from('tbl_project_inspection')->where('production_no',$production_no)->get();
	     $row = $query->row();
    	 if($query !== FALSE && $query->num_rows() > 0){
    	 		if($row->count == 15){
    	 			   $status = 'maximum';
    	 		}else{
			        if($image){$images = $this->move_to_folder4('INSPECTION',$image,$tmp,$path_image,500,500);
			        	$data = array('production_no' => $production_no,
			        				  'production'=>$id,
						    		  'images'=> $images,
						    		  'status'=> 1,
						    		  'type'=>1,
						    		  'date_created'=>date('Y-m-d H:i:s'),
						    		  'created_by'=> $id);
		 				 $this->db->insert('tbl_project_inspection',$data);
		 				 $last_id = $this->db->insert_id();
		 				 $status = 'success';
		    		}
    	 		}
    	}else{
			if($image){$images = $this->move_to_folder4('INSPECTION',$image,$tmp,$path_image,500,500);
					$data = array('production_no' => $production_no,
		        				  'production'=>$id,
					    		  'images'=> $images,
					    		  'status'=> 1,
					    		  'type'=>1,
					    		  'date_created'=>date('Y-m-d H:i:s'),
					    		  'created_by'=> $id);
	 				 $this->db->insert('tbl_project_inspection',$data);
	 				 $last_id = $this->db->insert_id();
					 $status = 'success';
			}
    	}	
		$json = array('status'=>'success','image' => $images,'id' => $last_id);
    	return $json;
    }
   
     function Create_Salesorder_Stocks($date_created,$customer,$email,$mobile,$address,$downpayment,$discount,$shipping_fee,$vat,$description,$qty,$unit,$amount,$date_downpayment,$tin,$terms_start,$terms_end){
    	$so_no = $this->get_code('tbl_salesorder_stocks','SO-FS'.date('Ymd'));
    	$row = $this->db->select('*')->from('tbl_salesorder_customer')->where('fullname',$customer)->get()->row();
    	if(!$row){
    		$c_no = $this->get_code('tbl_salesorder_customer','CN'.date('Ymd'));
    		$this->db->insert('tbl_salesorder_customer',array('customer_no'=>$c_no,
    														 'fullname'=>$customer,
    														 'email'=>$email,
    														 'mobile'=>$mobile,
    														 'address'=>$address,
    														 'tin'=>$tin,
    														 'date_created'=>date('Y-m-d H:i:s'),
    														 'created_by'=>$this->user_id));
    		$last_id = $this->db->insert_id();
    	}else{
    		$last_id = $row->id;
    	}
    	$result = $this->db->insert('tbl_salesorder_stocks',array('so_no'=>$so_no,
    				  'customer'=>$last_id,
    				  'email'=>$email,
    				  'mobile'=>$mobile,
    				  'address'=>$address,
    				  'tin'=>$tin,
    				  'downpayment'=>$downpayment,
    				  'discount'=>$discount,
    				  'shipping_fee'=>$shipping_fee,
    				  'vat'=>$vat,
    				  'terms_start'=>$terms_start,
    				  'terms_end'=>$terms_end,
    				  'date_order'=>date('Y-m-d',strtotime($date_created)),
    				  'date_downpayment'=>date('Y-m-d',strtotime($date_downpayment)),
    				  'date_created'=>date('Y-m-d H:i:s'),
    				  'created_by'=>$this->user_id));
    	$last_id_so = $this->db->insert_id();
    	foreach($description as $key => $value){
    		$this->db->insert('tbl_salesorder_stocks_item',array('so_no'=>$last_id_so,
		    				  'c_code'=>$this->encryption->decrypt($description[$key]),
		    				  'qty'=>$qty[$key],
		    				  'unit'=>$unit[$key],
		    				  'amount'=>floatval(str_replace(',', '', $amount[$key]))
    		));
    	}
    	if($result){
    		return true;
    	}else{
    		return false;	
    	}
    }
    function Create_Salesorder_Project($project_no,$date_created,$customer,$email,$mobile,$address,$downpayment,$discount,$shipping_fee,$vat,$description,$qty,$unit,$amount,$date_downpayment,$tin,$terms_start,$terms_end){
    	$so_no = $this->get_code('tbl_salesorder_project','SO-FP'.date('Ymd'));
    	$row = $this->db->select('*')->from('tbl_salesorder_customer')->where('fullname',$customer)->get()->row();
    	if(!$row){
    		$c_no = $this->get_code('tbl_salesorder_customer','CN'.date('Ymd'));
    		$this->db->insert('tbl_salesorder_customer',array('customer_no'=>$c_no,
    														 'fullname'=>$customer,
    														 'email'=>$email,
    														 'mobile'=>$mobile,
    														 'address'=>$address,
    														 'tin'=>$tin,
    														 'date_created'=>date('Y-m-d H:i:s'),
    														 'created_by'=>$this->user_id));
    		$last_id = $this->db->insert_id();
    	}else{
    		$last_id = $row->id;
    	}
    	$data=array();
    	foreach($description as $key => $value){
    		$data[] = array('id'=>$key+1,
    						'description'=>$description[$key],
    						'quantity'=>$qty[$key],
    						'unit'=>$unit[$key],
    						'amount'=>floatval(str_replace(',', '', $amount[$key])),
    						'status'=>1);
    	}
    	$result = $this->db->insert('tbl_salesorder_project',array('so_no'=>$so_no,
    				  'customer'=>$last_id,
    				  'email'=>$email,
    				  'mobile'=>$mobile,
    				  'address'=>$address,
    				  'tin'=>$tin,
    				  'project_no'=>$this->encryption->decrypt($project_no),
    				  'item'=>''.json_encode($data).'',
    				  'downpayment'=>$downpayment,
    				  'discount'=>$discount,
    				  'shipping_fee'=>$shipping_fee,
    				  'vat'=>$vat,
    				  'terms_start'=>$terms_start,
    				  'terms_end'=>$terms_end,
    				  'date_order'=>date('Y-m-d',strtotime($date_created)),
    				  'date_downpayment'=>date('Y-m-d',strtotime($date_downpayment)),
    				  'date_created'=>date('Y-m-d H:i:s'),
    				  'created_by'=>$this->user_id));
    	if($result){
    		return true;
    	}else{
    		return false;	
    	}
    	
    }
    function Create_Return_Item_Warehouse($type,$item_no,$qty,$status,$remarks){
    	if($type == 1){
    		$row = $this->db->select('*')->from('tbl_materials')->where('id',$item_no)->get()->row();
    		$table = 'tbl_materials';
		}else{
			$row = $this->db->select('*')->from('tbl_other_materials')->where('id',$item_no)->get()->row();
			$table = 'tbl_other_materials';
		}
		if($status ==1){
			$stocks = floatval($row->stocks + $qty);
			$this->db->where('id',$item_no);
			$this->db->update($table,array('stocks'=>$stocks));
		}
    	$this->db->insert('tbl_return_item_warehouse',array('item'=>$row->item,'qty'=>$qty,'type'=>$type,'status'=>$status,'remarks'=>$remarks,'date_created'=>date('Y-m-d H:i:s'),'created_by'=>$this->user_id));
    	return $status;
    }
    function Create_Return_Item_Customer($so_no,$item_no,$item,$qty,$status,$remarks){
    	$this->db->insert('tbl_return_item_customer',array('so_no'=>$so_no,'item_no'=>$item_no,'item'=>$item,'qty'=>$qty,'status'=>$status,'remarks'=>$remarks,'date_created'=>date('Y-m-d H:i:s'),'created_by'=>$this->user_id));
    	return $status;
    }
    function Create_Request_Material($item_no,$item,$qty,$type){
    	$mat_itemno = explode(',', $item_no);
    	$mat_item = explode(',', $item);
		$mat_quantity = explode(',', $qty);
		$mat_type = explode(',', $type);	
		for($i=0; $i<count($mat_itemno);$i++){
		 $this->db->insert('tbl_other_material_m_request',array('item_no'=>$mat_itemno[$i],'item'=>$mat_item[$i],'qty'=>$mat_quantity[$i],'type'=>$mat_type[$i],'date_created'=>date('Y-m-d H:i:s'),'created_by'=>$this->user_id));
       	}
    	return true;
    }
     function Create_Request_Purchase($item_no,$item,$qty,$type,$amount){
     	$trans_no = $this->get_code('tbl_other_material_p_header','TNXPR'.date('Ymd'));
     	$this->db->insert('tbl_other_material_p_header',array('request_no'=>$trans_no,'purchaser'=>$this->user_id,'date_created'=>date('Y-m-d H:i:s')));
     	$last_id =$this->db->insert_id();	
		foreach($item_no as $key => $value){
		 $this->db->insert('tbl_other_material_p_request',
		 	array('pr_id'=>$last_id,
		 	'item_no'=>$item_no[$key],
		 	'item'=>$item[$key],
		 	'qty'=>$qty[$key],
		 	'balance'=>$qty[$key],
		 	'amount'=>floatval(str_replace(',', '', $amount[$key])),
		 	'type'=>$type[$key]));
       	}
    	return true;
    }
    function Create_Request_Pre_Order($id){
    	$row = $this->db->select('*')->from('tbl_cart_add')->where('id',$id)->get()->row();
    	if($row){
    		$this->db->insert('tbl_cart_pre_order',array('order_no'=>$row->order_no,'c_code'=>$row->c_code,'qty'=>$row->qty,'status'=>1,'date_created'=>date('Y-m-d H:i:s'),'created_by'=>$this->user_id));
    		$this->db->where('id',$id);
    		$this->db->update('tbl_cart_add',array('type'=>'Request'));
    		return 'success';
    	}else{
    		return 'error';
    	}
    }
    function Create_Customized_Request($subject,$description){
    	$result = $this->db->insert('tbl_customized_request',$data = array('subject'=>$subject,'description'=>$description,'status'=>'P','date_created'=>date('Y-m-d H:i:s'),'created_by'=>$this->user_id));
    	if($result){
    		return array('status'=>true,'type'=>'success','message'=>'Created Successfully');
    	}else{
    		return false;
    	}
    	
    }
    function Create_Material_request_Supervisor($id,$item,$qty,$type){
    	$row = $this->db->select('*')->from('tbl_material_project')->where('production_no',$id)->where('item_no',$item)->get()->row();
    	if($row){
    		return false;
    	}else{
			$material_data = array('production_no' 	  =>  $id,
					               'production'       =>  $this->user_id,
					               'item_no'		  =>  $item,
					               'total_qty'        =>  $qty,
					               'status'           =>  1,
					               'mat_type'		  =>  $type,
					               'date_created'     =>  date('Y-m-d H:i:s'),
					               'created_by'		  =>  $this->user_id);
    		$this->db->insert('tbl_material_project',$material_data);
    		return $id;
    	}
    }
    function Create_Purchase_request_Supervisor($id,$item,$qty,$remarks,$type,$status,$special,$unit){
    	if($status == 1){
    		$row = $this->db->select('*')->from('tbl_purchasing_project')->where('production_no',$id)->where('item_no',$item)->get()->row();
	    	if($row){
	    		return false;
	    	}else{
				$purchase_data = array('production_no'=>  $id,
				                'item_no'		   	  =>  $item,
				                'quantity'            =>  $qty,
				                'balance'    		  =>  $qty,
				                'status'           	  =>  1,
				                'remarks'          	  =>  $remarks,
				                'material_type'    	  =>  $type,
				                'type'    	  		  =>  $type,
				                'date_created'     	  =>  date('Y-m-d H:i:s'));
	    		$this->db->insert('tbl_purchasing_project',$purchase_data);
	    		return $id;
	    	}
    	}else{
				 $row_m = $this->db->select('*')->from('tbl_materials')->where('item',$special)->get()->row();
			     if(!$row_m){
			     	$new_no = $this->get_code('tbl_materials','RMCODE-');
					$data = array('user_id'=> $this->user_id,'item_no'=> $new_no,'item'=> $special,'unit'=>$unit,'status' => 1,'date_created'=> date('Y-m-d H:i:s'));
					$this->db->insert('tbl_materials',$data);
					$purchase_data = array('production_no'		  =>  $id,
							                'item_no'		   	  =>  $this->db->insert_id(),
							                'quantity'            =>  $qty,
							                'balance'    			=>  $qty,
							                'status'           	  =>  1,
							                'remarks'          	  =>  $remarks,
							                'material_type'    	  =>  $type,
							                'date_created'     	  =>  date('Y-m-d H:i:s'));
		    		$this->db->insert('tbl_purchasing_project',$purchase_data);
		    		return $id;
			     }else{
			     	$row_p = $this->db->select('*')->from('tbl_purchasing_project')->where('production_no',$id)->where('item_no',$row_m->id)->get()->row();
		     		if($row_p){
    					return false;
			    	}else{
						$purchase_data = array('production_no'=>  $id,
						                'item_no'		   	  =>  $row_m->id,
						                'quantity'            =>  $qty,
						                'balance'    		  =>  $qty,
						                'status'           	  =>  1,
						                'remarks'          	  =>  $remarks,
						                'material_type'    	  =>  $type,
						                'date_created'     	  =>  date('Y-m-d H:i:s'));
			    		$this->db->insert('tbl_purchasing_project',$purchase_data);
			    		return $id;
			    	}
			    }
    		}
       }
     function Create_Supplier($name,$mobile,$email,$address){
     	$row = $this->db->select('*')->from('tbl_supplier')->where('name',$name)->get()->row();
     	if(!$row){
     		$data = array('name'          =>  $name,
		                  'mobile'        =>  $mobile,
		                  'email'         =>  $email,
		                  'address'       =>  $address,
		                  'date_created'  =>date('Y-m-d H:i:s'),
		              	  'created_by'=>$this->user_id);
	       $this->db->insert('tbl_supplier',$data);
	       return true;
	     }else{
	     	return false;
	     }
    }
    function Create_Supplier_Item($id,$item_no,$item,$amount,$type){
    	$row = $this->db->select('*')->from('tbl_supplier_item')->where('item',$item)->where('supplier',$id)->get()->row();
		if($row){
			return false;
		}else{
			$data = array('item_no'  => $item_no,
						  'item'	 => $item,
		                  'supplier' => $id,
		                  'amount'   => $amount,
		                  'status'         => 1,
		                  'type'         => $type,
		                  'date_created'   => date('Y-m-d H:i:s'),
		                  'created_by'	   => $this->user_id);        
	    	$this->db->insert('tbl_supplier_item',$data);
	    	return $id;
		}
    }
    function Create_Delivery_Receipt($id,$item,$qty,$so_no,$type){
    	$dr_no = $this->get_code('tbl_sales_delivery_item','DRN'.date('Ymd'));
		if($type ==1){
			$row = $this->db->select('*')->from('tbl_salesorder_stocks')->where('so_no',$so_no)->get()->row();
			if($row){
				$this->db->insert('tbl_sales_delivery_header',
			 	array('so_no'=>$so_no,
			 		  'dr_no'=>$dr_no,
			 		  'customer'=>$row->customer,
			 		  'mobile'=>$row->mobile,
			 		  'email'=>$row->email,
			 		  'address'=>$row->address,
			 		  'type'=>1,
			 		  'date_order'=>$row->date_order,
			 		  'date_created'=>date('Y-m-d H:i:s'),
			 		  'created_by'=>$this->user_id
			 		)
			 );
				$last_id = $this->db->insert_id();
				$ids = explode(',', $id);
		    	$items = explode(',', $item);
				$qtys = explode(',', $qty);
				for($i=0; $i<count($ids);$i++){
				 $row_mat = $this->db->select('*')->from('tbl_salesorder_stocks_item')->where('id',$ids[$i])->get()->row();	
				 $this->db->insert('tbl_sales_delivery_item',
				 	array('dr_no'=>$last_id,
				 		  'c_code'=>$row_mat->c_code,
				 		  'item'=>$items[$i],
				 		  'quantity'=>$qtys[$i]));
		       	}
		       	return true;
		       	exit();
			}else{
				return false;
			}
		}else{
			$row_p = $this->db->select('*')->from('tbl_salesorder_project')->where('so_no',$so_no)->get()->row();
			if($row_p){
				$this->db->insert('tbl_sales_delivery_header',
				 	array('so_no'=>$so_no,
				 		  'dr_no'=>$dr_no,
				 		  'customer'=>$row_p->customer,
				 		  'mobile'=>$row_p->mobile,
				 		  'email'=>$row_p->email,
				 		  'address'=>$row_p->address,
				 		  'type'=>2,
				 		  'date_order'=>$row_p->date_order,
				 		  'date_created'=>date('Y-m-d H:i:s'),
				 		  'created_by'=>$this->user_id));
				$last_id = $this->db->insert_id();
				$id = explode(',', $id);
		    	$item = explode(',', $item);
				$qty = explode(',', $qty);
				for($i=0; $i<count($id);$i++){
				    $this->db->insert('tbl_sales_delivery_item',
				 	array('dr_no'=>$last_id,
				 		  'item'=>$item[$i],
				 		  'quantity'=>$qty[$i]));
		       	}
		       	return true;
		       	exit();
			}else{
				return false;
			}	
			
		}
    }
    function Create_Cashposition_Category($name){
    	$row = $this->db->select('*')->from('tbl_category_income')->where('name',$name)->get()->row();
    	if(!$row){
    		$this->db->insert('tbl_category_income',array('name'=>$name,'status'=>0));
    		return array('type'=>'success','message'=>"Create Successfully!");
    	}else{
    		return array('type'=>'info','message'=>"Category Name is already exists");
    	}
    }


  }
?>
