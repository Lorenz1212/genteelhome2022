<?php 
class Web_model extends CI_Model{  
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
		private function formatMoney($number, $cents = 1) { // cents: 0=never, 1=if needed, 2=always
		  if (is_numeric($number)) { // a number
		    if (!$number) { // zero
		      $money = ($cents == 2 ? '0.00' : '0'); // output zero
		    } else { // value
		      if (floor($number) == $number) { // whole number
		        $money = number_format($number, ($cents == 2 ? 2 : 0)); // format
		      } else { // cents
		        $money = number_format(round($number, 2), ($cents == 0 ? 0 : 2)); // format
		      } // integer or decimal
		    } // value
		    return '₱'.$money;
		  } // numeric
		} 

	public function Company($type,$val){
		switch($type){
			case 'fetch_company_profile':{
				$sql = "SELECT * FROM tbl_company_owner LIMIT 1";
				$row = $this->db->query($sql)->row();
				if($row){
					return $row;
				}else{
					return false;
				}
				break;
			}
			case"fetch_company_info":{
				$sql = "SELECT * FROM tbl_company_profile";
				$row = $this->db->query($sql)->row();
				if($row){
					return $row;
				}else{
					return false;
				}
				break;
			}

		}

	}
	public function Categories($type,$val){
		switch($type){
			case "fetch_categories_list":{
				$data = array();
				 $query = $this->db->query("SELECT * FROM tbl_category WHERE status='ACTIVE'");
          if($query){
           foreach($query->result() as $row){
            $cat_id = $row->id;
            $cat_name = $row->cat_name;
            $sub ="";
              $query = $this->db->query("SELECT * FROM tbl_category_sub WHERE status='ACTIVE' AND cat_id='$cat_id'");
              if($query){
              	foreach($query->result() as $row){
              		$sub .='<li><a href="javascript:;" class="view-product-list" data-id="'.base64_encode($this->encryption->encrypt($row->id)).'">'.$row->sub_name.'</a></li>';
              	}
              }
              $data[] = array(
                'id'   => base64_encode($this->encryption->encrypt($cat_id)),
                'cat_name' => $cat_name,
                'sub' => $sub);
            }   
            return $data;   
         }else{
            return false;
        }
				break;
			}
			case "fetch_cart_list":{
				$userid = $this->session->userdata('userId');
				$data =array();
				 $sql = "SELECT *,
				  (SELECT c_name FROM tbl_project_color WHERE id=tbl_cart_add.c_code) as pallet_name,
				  (SELECT images FROM tbl_project_image i  
				  	LEFT JOIN tbl_project_color d ON d.c_code=i.c_code WHERE d.id=tbl_cart_add.c_code LIMIT 1) as image,
				  (SELECT title FROM tbl_project_color c  
				  	LEFT JOIN tbl_project_design d ON d.id=c.project_no WHERE c.id=tbl_cart_add.c_code) as title
				 FROM tbl_cart_add WHERE customer='$userid' AND status='cart'";
				$query = $this->db->query($sql);
				if($query){
						$sql = "SELECT * FROM tbl_cart_add WHERE customer='$userid' AND status='cart'";
						$count = $this->db->query($sql)->num_rows();
						if($count > 0){
							$data['count']=$count;
						}
						foreach($query->result() as $row){
							$data['cart'][]=array('image'=>$row->image,
														'title'=>$row->title,
														'pallet_name'=>$row->pallet_name,
														'quantity'=>$row->qty,
														'price'=>$this->formatMoney($row->price,2),
														 'id'=>base64_encode($this->encryption->encrypt($row->id)),

						);
					}
					return $data;
				}else{
					return false;
				}
				break;
			}
		}
	}
	public function Dashboard($type,$val){
		switch($type){
			case"fetch_popular_product":{
				$data =array();
				$sql = "SELECT *,(SELECT images FROM tbl_project_image WHERE project_no=tbl_project_design.id LIMIT 1) as image FROM tbl_project_design WHERE d_status='DISPLAYED' AND type=1 AND popular >= 0 ORDER BY popular DESC LIMIT 9";
				$query = $this->db->query($sql);
				if($query){
					foreach($query->result() as $row){
						$data[]=array('title'=>$row->title,
									  'image'=>$row->image,
									  'id'=> base64_encode($this->encryption->encrypt($row->id)));
					}
					return $data;
				}else{
					return false;
				}
				break;
			}
			case "fetch_popular_product_list":{
				$data =array();
				$sql = "SELECT *,(SELECT images FROM tbl_project_image WHERE project_no=tbl_project_design.id LIMIT 1) as image FROM tbl_project_design WHERE d_status='DISPLAYED' AND type=1 AND popular >= 0 ORDER BY popular DESC";
				$query = $this->db->query($sql);
				if($query){
					foreach($query->result() as $row){
						$data[]=array('title'=>$row->title,
									  'image'=>$row->image,
									  'id'=> base64_encode($this->encryption->encrypt($row->id)));
					}
					return $data;
				}else{
					return false;
				}
				break;
			}
			case "fetch_blog_list_latest":{
				$data = array();
				$sql = "SELECT *,DATE_FORMAT(date_event, '%d') AS day_name,DATE_FORMAT(date_event, '%Y') AS year_name,DATE_FORMAT(date_event, '%b') AS month_name FROM tbl_events WHERE status='ACTIVE' ORDER BY date_event DESC LIMIT 6";
				 $query = $this->db->query($sql);
				 if($query){
					 	foreach($query->result() as $row){
					 		$data[]=array('image'=>$row->image,
					 									'month_name'=>$row->month_name,
					 									'day_name'=>$row->day_name,
					 									'year_name'=>$row->year_name,
					 									'title'=>$row->title,
					 									'id'=>base64_encode($this->encryption->encrypt($row->id))
					 								);
					 	}
					 	return $data;
				 }else{
				 	return false;
				 }
				break;
			}

		}
	}
		public function Blogs($type,$val){
		switch($type){
			case "fetch_blog_list":{
				$data = array();
				$sql = "SELECT *,IFNULL(description,'NO DESCRIPTION') as description,
				DATE_FORMAT(date_event, '%d') AS day_name,DATE_FORMAT(date_event, '%Y') AS year_name,DATE_FORMAT(date_event, '%b') AS month_name FROM tbl_events WHERE status='ACTIVE' ORDER BY date_event DESC";
				 $query = $this->db->query($sql);
				 if($query){
					 	foreach($query->result() as $row){
					 		$data[]=array('image'=>$row->image,
					 									'month_name'=>$row->month_name,
					 									'day_name'=>$row->day_name,
					 									'year_name'=>$row->year_name,
					 									'description'=>$row->description,
					 									'title'=>$row->title,
					 									'id'=>base64_encode($this->encryption->encrypt($row->id))
					 								);
					 	}
					 	return $data;
				 }else{
				 	return false;
				 }
				break;
			}

		}
	}
	public function Collection($type,$val,$val1,$val2){
		switch($type){
			case "fetch_collection_list":{
					$userid = $this->session->userdata('userId');
					$data =array();
					$sql = "SELECT * FROM tbl_cart_collection WHERE customer='$userid'";
					$query = $this->db->query($sql);
					if($query){
						foreach($query->result() as $row){
								$project_no = $row->project_no;
								$sql = "SELECT *,(SELECT images FROM tbl_project_image WHERE project_no=tbl_project_design.id LIMIT 1) as image FROM tbl_project_design WHERE d_status='DISPLAYED' AND type=1 AND id='$project_no' ORDER BY id DESC";
									$query = $this->db->query($sql);
									if($query){
										foreach($query->result() as $row){
											$data['details'][]=array('title'=>$row->title,
														  'image'=>$row->image,
														  'id'=> base64_encode($this->encryption->encrypt($row->id)));
										}
								}

						}
						return $data;
					}
				break;
			}

		}
	}
	public function Product($type,$val,$val1,$val2){
		switch($type){
			case"fetch_product_list":{
				$data =array();
				$data_cat =array();
				$id = $this->encryption->decrypt(base64_decode($val));
				$sql = "SELECT *,(SELECT cat_name FROM tbl_category WHERE id=tbl_category_sub.cat_id) as cat_name,
				(SELECT image FROM tbl_category WHERE id=tbl_category_sub.cat_id) as image
				 FROM tbl_category_sub WHERE id='$id'";
				$row = $this->db->query($sql)->row();
				if($row){
					$data_cat['cat']=$row;
					$sql = "SELECT *,(SELECT images FROM tbl_project_image WHERE project_no=tbl_project_design.id LIMIT 1) as image FROM tbl_project_design WHERE d_status='DISPLAYED' AND type=1 AND sub_id='$id' ORDER BY id DESC";
					$query = $this->db->query($sql);
					if($query){
						foreach($query->result() as $row){
							$data['details'][]=array('title'=>$row->title,
										  'image'=>$row->image,
										  'id'=> base64_encode($this->encryption->encrypt($row->id)));
						}
						return array_merge($data,$data_cat);
					}
				}else{
					return false;
				}
				break;
			}
			case"fetch_product_details":{
				$id = $this->encryption->decrypt(base64_decode($val));
				$data=array();
				$sql = "SELECT * FROM tbl_project_design WHERE id='$id'";
				$row = $this->db->query($sql)->row();
				if($row){
					$project_no = $row->id;
					$data['info']=$row;
					$data['id']=base64_encode($this->encryption->encrypt($row->id));
					
					$userid = $this->session->userdata('userId');
					$sql = "SELECT * FROM tbl_cart_collection WHERE project_no='$id' AND customer='$userid'";
					$result = $this->db->query($sql)->row();
					if($result){
						$data['collection']='insert';
					}else{
						$data['collection']='delete';
					}
					$sql = "SELECT * FROM tbl_project_color WHERE project_no='$project_no' AND display_status='displayed' ORDER BY date_created ASC";
					$query = $this->db->query($sql);
					if($query){
						foreach($query->result() as $row){
							$data['pallet'][]=array('pallet_color'=>$row->c_image,'stocks'=>$row->stocks,
								  'id'=> base64_encode($this->encryption->encrypt($row->c_code))
								);
						}
					}
					return $data;
				}else{
					return false;
				}
				break;
			}
			case "fetch_product_image":{
				$id = $this->encryption->decrypt(base64_decode($val));
				$data_info=array();
				$data_pallet=array();
				$sql = "SELECT * FROM tbl_project_color WHERE c_code='$id'";
				$row = $this->db->query($sql)->row();
				if($row){
					$data_info['info']=$row;
					$data_info['price']=$this->formatMoney($row->c_price,2);
					if($row->stocks == 0){
						$data_info['availability'] = 1;
					}else{
						$data_info['availability'] = 2;	
					}
				}
				$sql = "SELECT * FROM tbl_project_image WHERE c_code='$id'";
				$query = $this->db->query($sql);
				if($query){
					foreach($query->result() as $row){
						 $data_pallet['pallet'][] = array('images'=> $row->images);
					}
				}
				return array_merge($data_info,$data_pallet);
				break;
			}
			case "fetch_product_gallery":{
				$id = $this->encryption->decrypt(base64_decode($val));
				$data = array();
				$sql = "SELECT * FROM tbl_project_image WHERE project_no='$id'";
				$query = $this->db->query($sql);
				if($query){
					foreach($query->result() as $row){
						 $data[] = array('images'=> $row->images);
					}
					return $data;
				}
				return false;
				break;
			}
			case "add_product_cart":{
				$id = $this->encryption->decrypt(base64_decode($val));
				$userid = $this->session->userdata('userId');
				$sql = "SELECT * FROM tbl_project_color WHERE c_code='$id'";
				$row = $this->db->query($sql)->row();
				if($row){
					$price = $row->c_price;
					$c_code = $row->id;
					$sql = "SELECT * FROM tbl_cart_add WHERE c_code='$c_code' AND customer='$userid' AND status='cart'";
					$result = $this->db->query($sql)->row();
						if($result){
							$cart_id = $result->id;
							$qty_total = $result->qty + $val1;
		          $total = $qty_total*$price;
		          $data = array('qty'          => $qty_total,
		                        'price'        => $total,
		                        'date_created' => date('Y-m-d H:i:s'));
		          $result = $this->db->where('id',$cart_id)->update('tbl_cart_add',$data);
						}else{
							$total = floatval($val1 * $price);
							$data = array(  'customer'     => $userid,
		                          'c_code'       => $c_code,
		                          'qty'          => $val1,
		                          'price'        => $total,
		                          'status'       => 'cart',
		                          'type'         => $val2,
		                          'date_created' => date('Y-m-d H:i:s'));
							$result = $this->db->insert('tbl_cart_add',$data);
						}
						if($result){
							return true;
						}else{
							return false;
						}
				}else{
					 return false;
				}
			break;
			}
				case "add_product_collection":{
					$id = $this->encryption->decrypt(base64_decode($val));
					$userid = $this->session->userdata('userId');
					$sql = "SELECT * FROM tbl_cart_collection WHERE project_no='$id' AND customer='$userid'";
					$row = $this->db->query($sql)->row();
					if($row){
						$col_id = $row->id;
						$result = $this->db->where('id',$col_id)->delete('tbl_cart_collection');
						if($result){
							return 'delete';
						}else{
							return false;
						}
					}else{
						$data = array('project_no'=>$id,'customer'=>$userid,'date_created' => date('Y-m-d H:i:s'));
						$result = $this->db->insert('tbl_cart_collection',$data);
						if($result){
							return 'insert';
						}else{
							return false;
						}
					}
					break;
				}
			case "update_product_cart":{
			$id = $this->encryption->decrypt(base64_decode($val));
			$sql = "SELECT * FROM tbl_cart_add WHERE id='$id'";
			$result = $this->db->query($sql)->row();
				if($result){
					$c_code = $result->c_code;
					$sql = "SELECT * FROM tbl_project_color WHERE id='$c_code'";
					$row = $this->db->query($sql)->row();
					$price=0;
					if($row){
						$price = $row->c_price;
					}
					$cart_id = $result->id;
          $total = $val1*$price;
          $data = array('qty'          => $val1,
                        'price'        => $total,
                        'date_created' => date('Y-m-d H:i:s'));
          	$result = $this->db->where('id',$id)->update('tbl_cart_add',$data);
          	if($result){
						return true;
					}else{
						return false;
					}
				}else{
					return false;
				}
				break;
			}
			case "delete_product_cart":{
			$id = $this->encryption->decrypt(base64_decode($val));
			$sql = "SELECT * FROM tbl_cart_add WHERE id='$id'";
			$result = $this->db->query($sql)->row();
				if($result){
          	$result = $this->db->where('id',$id)->delete('tbl_cart_add');
          	if($result){
							return true;
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
	public function Interior($type,$val,$val1,$val2){
		switch($type){
			case "fetch_interior_list":{
				$data = array();
				if($val=='residential-projects'){
					$cat_id = 1;
					$data['cat_name']='Residential Project';
				}else if($val =='commerial-projects'){
					$cat_id = 2;
					$data['cat_name']='Commerial Project';
				}
				$data['cat_id']=$val;
				$sql = "SELECT * FROM tbl_interior_design WHERE cat_id='$cat_id' AND status ='ACTIVE'";
				$query= $this->db->query($sql);
				if($query){
					foreach($query->result() as $row){
						$data['data'][]=array('project_name'=>$row->project_name,
													'image'=>$row->image,
													'id'=>base64_encode($this->encryption->encrypt($row->id))
												);
					}
					return $data;
				}else{
					return false;
				}
				break;
			}
			case "fetch_interior_details":{
				$id = $this->encryption->decrypt(base64_decode($val));
				$sql = "SELECT * FROM tbl_interior_design WHERE id='$id'";
				$row= $this->db->query($sql)->row();
				if($row){
					return $row;
				}else{
					return false;
				}
				break;
			}
		}
	}
	public function Cart($type,$val,$val1,$val2){
		switch($type){
			case "fetch_cart_list_view":{
				$userid = $this->session->userdata('userId');
				$data =array();
				 $sql = "SELECT *,
				  (SELECT c_name FROM tbl_project_color WHERE id=tbl_cart_add.c_code) as pallet_name,
				  (SELECT images FROM tbl_project_image i  
				  	LEFT JOIN tbl_project_color d ON d.c_code=i.c_code WHERE d.id=tbl_cart_add.c_code LIMIT 1) as image,
				  (SELECT title FROM tbl_project_color c  
				  	LEFT JOIN tbl_project_design d ON d.id=c.project_no WHERE c.id=tbl_cart_add.c_code) as title
				 FROM tbl_cart_add WHERE customer='$userid' AND status='cart'";
				$query = $this->db->query($sql);
				if($query){
						$sql = "SELECT * FROM tbl_cart_add WHERE customer='$userid' AND status='cart'";
						$count = $this->db->query($sql)->num_rows();
						if($count > 0){
							$data['count']=$count;
						}
						foreach($query->result() as $row){
							$data['cart'][]=array('image'=>$row->image,
														'title'=>$row->title,
														'pallet_name'=>$row->pallet_name,
														'quantity'=>$row->qty,
														'price'=>$this->formatMoney($row->price,2),
														 'id'=>base64_encode($this->encryption->encrypt($row->id)),

						);
					}
					return $data;
				}else{
					return false;
				}
				break;
			}
			case "update_check_out":{
			 $id = $this->encryption->decrypt(base64_decode($val));
				$sql = "SELECT * FROM tbl_cart_add WHERE id='$id' AND status='cart'";
				$result = $this->db->query($sql)->row();
					if($result){
	          	$result = $this->db->where('id',$id)->update('tbl_cart_add',array('status'=>'process'));
	          	if($result){
								return true;
							}else{
								return false;
							}
					}else{
						return false;
					}
				break;
			}
			case "fetch_checkout_list":{
				$userid = $this->session->userdata('userId');
				$data =array();
				$data_cart=array();
				 $sql = "SELECT *,
				  (SELECT c_name FROM tbl_project_color WHERE id=tbl_cart_add.c_code) as pallet_name,
				  (SELECT images FROM tbl_project_image i  
				  	LEFT JOIN tbl_project_color d ON d.c_code=i.c_code WHERE d.id=tbl_cart_add.c_code LIMIT 1) as image,
				  (SELECT title FROM tbl_project_color c  
				  	LEFT JOIN tbl_project_design d ON d.id=c.project_no WHERE c.id=tbl_cart_add.c_code) as title
				 FROM tbl_cart_add WHERE customer='$userid' AND status='process'";
				$query = $this->db->query($sql);
				if($query){
					$sql = "SELECT sum(price) as total FROM tbl_cart_add WHERE customer='$userid' AND status='process'";
						$row = $this->db->query($sql)->row();
						if($row){
							$data['total']=$this->formatMoney($row->total,2);
						}
						foreach($query->result() as $row){
							$data_cart['cart'][]=array('image'=>$row->image,
														'title'=>$row->title,
														'pallet_name'=>$row->pallet_name,
														'quantity'=>$row->qty,
														'price'=>$this->formatMoney($row->price,2),
														 'id'=>base64_encode($this->encryption->encrypt($row->id)),

						);
						
					}
					return array_merge($data,$data_cart);
				}else{
					return false;
				}
				break;
			}
			case"delete_cart_list_view":{
				$id = $this->encryption->decrypt(base64_decode($val));
				$sql = "SELECT * FROM tbl_cart_add WHERE id='$id'";
				$result = $this->db->query($sql)->row();
					if($result){
	          	$result = $this->db->where('id',$id)->delete('tbl_cart_add');
	          	if($result){
								return true;
							}else{
								return false;
							}
					}else{
						return false;
					}
				break;
			}
			case "update_product_cart_list":{
				$id = $this->encryption->decrypt(base64_decode($val));
				$sql = "SELECT * FROM tbl_cart_add WHERE id='$id'";
				$result = $this->db->query($sql)->row();
					if($result){
						$c_code = $result->c_code;
						$sql = "SELECT * FROM tbl_project_color WHERE id='$c_code'";
						$row = $this->db->query($sql)->row();
						$price=0;
						if($row){
							$price = $row->c_price;
						}
						$cart_id = $result->id;
	          $total = $val1*$price;
	          $data = array('qty'          => $val1,
	                        'price'        => $total,
	                        'date_created' => date('Y-m-d H:i:s'));
	          	$result = $this->db->where('id',$id)->update('tbl_cart_add',$data);
	          	if($result){
							return true;
						}else{
							return false;
						}
					}else{
						return false;
					}
					break;
				}
				case "update_checkout_list":{
							$id = $this->encryption->decrypt(base64_decode($val));
					$sql = "SELECT * FROM tbl_cart_add WHERE id='$id'";
					$result = $this->db->query($sql)->row();
						if($result){
							$c_code = $result->c_code;
							$sql = "SELECT * FROM tbl_project_color WHERE id='$c_code'";
							$row = $this->db->query($sql)->row();
							$price=0;
							if($row){
								$price = $row->c_price;
							}
							$cart_id = $result->id;
		          $total = $val1*$price;
		          $data = array('qty'          => $val1,
		                        'price'        => $total,
		                        'date_created' => date('Y-m-d H:i:s'));
		          	$result = $this->db->where('id',$id)->update('tbl_cart_add',$data);
		          	if($result){
								return true;
							}else{
								return false;
							}
						}else{
							return false;
						}
						break;
					}
					case"delete_checkout_list_view":{
						$id = $this->encryption->decrypt(base64_decode($val));
						$sql = "SELECT * FROM tbl_cart_add WHERE id='$id'";
						$result = $this->db->query($sql)->row();
							if($result){
			          	$result = $this->db->where('id',$id)->delete('tbl_cart_add');
			          	if($result){
										return true;
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

}