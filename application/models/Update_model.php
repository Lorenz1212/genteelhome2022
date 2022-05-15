<?php
class Update_model extends CI_Model
{  
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

    private function get_code($tbl,$code){
        $query = $this->db->select('id')->from($tbl)->order_by('id','DESC')->limit(1)->get();
        $row_num = $query->num_rows();
        if($row_num > 0) {if ($row = $query->row()) {$value2 = intval($row->id) + 1;
            return $code.sprintf('%03s', $value2);}}else {
            return $code."001";}
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
         $newfilename=  'IMG'.date('YmdHisu').'-'.preg_replace('/[@\;\" "\()]+/', '', $image);         $path_folder = $path.$newfilename;
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

     function Update_Rawmats_Stocks($id,$stocks,$status,$stocks_alert){
        $data = array('stocks' => $stocks,
                      'stocks_alert'=>$stocks_alert,
                      'status' => $status,
                      'date_lastupdate' => date('Y-m-d H:i:s'));
        $this->db->where('id',$id);
        $result = $this->db->update('tbl_materials',$data);
        if($result){return true;}else{return false;};
     }
     function Update_Other_Materials_Stocks($id,$stocks,$status,$stocks_alert){
        $data = array('stocks' => $stocks,
                      'alert'=>$stocks_alert,
                      'status' => $status,
                      'latest_update' => date('Y-m-d H:i:s'),
                      'update_by'=>$this->user_id);
        $this->db->where('id',$id);
        $result = $this->db->update('tbl_other_materials',$data);
        if($result){return true;}else{return false;};
     }
     function Update_Production($id,$stocks){
      $data = array('production_stocks' => $stocks);
      $this->db->where('id',$id);
      $result = $this->db->update('tbl_materials',$data);
      if($result){return true;}else{return false;}
    }
     function Update_Release_SalesOrder($so_no,$si_no){
        $data = array('si_no'    => $si_no,
                      'receiver' => $this->user_id,
                      'status'   => 'DELIVERED',
                      'date_delivered' => date('Y-m-d H:i:s'));
        $this->db->where('so_no',$so_no);
        $this->db->update('tbl_salesorder',$data);
     }

     function Update_Users($id,$firstname,$lastname,$middlename,$username,$status,$designer,$production,$supervisor,$superuser,$admin,$accounting,$webmodifier,$sales,$voucher){
        error_reporting(0);
        if(!$commission && $commission == '%'){
            $dis = '';
        }else{
            $percent = str_replace('%', '', $commission);
            $dis = floatval($percent / 100.00);
        }
        $data = array('username'      => $username,
                      'firstname'     => $firstname,
                      'lastname'      => $lastname,
                      'middlename'    => $middlename,
                      'status'        => $status,
                      'commission'    => $dis,
                      'coupon_status' => $voucher,
                      'designer'      => $designer,
                      'production'    => $production,
                      'supervisor'    => $supervisor,
                      'superuser'     => $superuser,
                      'admin'         => $admin,
                      'accounting'    => $accounting,
                      'webmodifier'   => $webmodifier,
                      'sales'         => $sales);
        $this->db->where('id',$id);
        $this->db->update('tbl_users',$data);
     }
     function Update_Approval_Users($status,$id){
          $data = array('approver'        => $this->user_id,
                        'status'          => $status,
                        'date_lastupdate' =>date('Y-m-d H:i:s'));
        $this->db->where('id',$id);
        $this->db->update('tbl_users',$data);
     }
     function Update_Profile($id,$data,$action){
         if($action == 'image'){
            if($_FILES['file']['size']>0){
              $filename=$_FILES["file"]["name"];
              $extension=end(explode(".", $filename));
              $NewFilename='IMG'.date('YmdHis').".".$extension;
              $destination = $_FILES['file']['tmp_name'];
              $destination2 = "assets/images/avatar/".$NewFilename;
              copy($destination, $destination2);
              $image=$NewFilename;
              $data = array('image' => $image);
              $this->db->where('id',$id);
              $this->db->update('tbl_users',$data);
              return 'success';
            }else{
              return 'no image';
            }
         }else if($action == 'username'){
             $array =array('id'=>$id,$action => $data);
             $query = $this->db->select('*')->from('tbl_users')->where($array)->get();
             $row = $query->row();
             if(!$row){
                $sql = $this->db->select('*')->from('tbl_users')->where('username',$data)->get();
                $rows = $sql->row();
                if(!$rows){
                    $data = array('username'=> $data);
                    $this->db->where('id',$id);
                    $this->db->update('tbl_users',$data);
                    return 'success';
                }else{
                    return 'existing';
                }
             }else{
                 return 'nothing changes';
             }
         }else if($action == 'password'){
              $data = array('password'=> md5($data));
              $this->db->where('id',$id);
              $this->db->update('tbl_users',$data);
              return 'success';
         }else{
             $array =array('id'=>$id, $action => $data);
             $query = $this->db->select('*')->from('tbl_users')->where($array)->get();
             $row = $query->row();
             if(!$row){
                 $data = array($action=> $data);
                 $this->db->where('id',$id);
                 $this->db->update('tbl_users',$data);
                return 'success';
             }else{
               return 'nothing changes';
             }
         }
     }
     function Update_ChangePassword($id,$password){
        $data = array('password'=>$password);
        $this->db->where('id',$id);
        $this->db->update('tbl_users',$data);
     }
     function Update_Return_FinishProduct($id,$so_no,$c_code,$qty,$status,$balance,$totalqty,$total_amount,$balance_price,$add_quantity,$project_no){
            if($status =='GOOD'){
                $update_material = array('stocks' =>$add_quantity);
                $this->db->where('c_code',$c_code);
                $this->db->update('tbl_project_color',$update_material);

                $update = array('balance'       => $balance,
                                'balance_price' => $total_amount);
                $this->db->where('id',$id);
                $this->db->update('tbl_salesorder_item',$update);
            }
           $data = array('returner'    => $this->user_id,
                         'so_no'       => $so_no,
                         'project_no'  => $project_no,
                         'c_code'      => $c_code,
                         'qty'         => $qty,
                         'price'       => $total_amount,
                         'status'      => $status,
                         'date_created'=>date('Y-m-d H:i:s'));
           $this->db->insert('tbl_salesorder_item_return',$data);
     }
        
      function Update_Material_Request_Process($id,$total,$request,$type){
            $row = $this->db->select('*')->from('tbl_material_project')->where('id',$this->encryption->decrypt($id))->get()->row();
            if($row){
                $material = array('receiver'=> $this->user_id,
                              'balance_quantity'=>$total,
                              'project_lock'=>1,
                              'latest_update'=> date('Y-m-d H:i:s'),
                              'update_by'=>$this->user_id);
                $this->db->where('id',$this->encryption->decrypt($id));
               $result = $this->db->update('tbl_material_project',$material);
               if($result){
                    $release = array('production_no'=>$row->production_no,
                                     'item_no' =>$row->item_no,
                                     'quantity' => $request,
                                     'type'=>$type,
                                     'date_created' =>  date('Y-m-d H:i:s'),
                                     'created_by'=>$this->user_id);
                   $this->db->insert('tbl_material_release',$release);
                   $row_m = $this->db->select('*')->from('tbl_materials')->where('id',$row->item_no)->get()->row();
                   if($row_m){
                        $quantity_deduc=0;
                        $quantity_deduct =  floatval($row_m->stocks - $request);
                        $production_stocks =  floatval($row_m->production_stocks + $request);
                        $items = array('stocks' => $quantity_deduct,'production_stocks' => $production_stocks);
                        $this->db->where('id',$row_m->id);
                        $this->db->update('tbl_materials',$items);
                   }
                   $rows = $this->db->select('*')->from('tbl_material_project')->where('id',$this->encryption->decrypt($id))->get()->row();
                   if($rows->balance_quantity == 0){
                        $this->db->where('id',$this->encryption->decrypt($id));
                        $this->db->update('tbl_material_project',array('status'=>3));
                   }
                   return array('status'=>'success','total'=>$total,'stocks'=>$quantity_deduct,'id'=>$row->production_no);
               }else{
                    return false;
               }
            }else{
                return false;
            }
          
        }
        function Update_Material_Request_Process_Status($id,$status){
            $this->db->where('id',$this->encryption->decrypt($id));
            $result = $this->db->update('tbl_material_project',array('status'=>$status,'project_lock'=>1,'date_cancelled'=>date('Y-m-d H:i:s')));
            if($result){
                $row = $this->db->select('*')->from('tbl_material_project')->where('id',$this->encryption->decrypt($id))->get()->row();
                $count = $this->db->select('*')->from('tbl_material_project')->where('production_no',$row->production_no)->where('status',4)->get()->num_rows();
    
                if($status == 2){
                    return array('status'=>'request','id'=>$row->production_no,'count'=>$count);
                }else{
                    return array('status'=>'cancelled','id'=>$row->production_no,'count'=>$count);
                }
            }else{
                return $this->encryption->decrypt($id);
            }
        }
   
      function Update_Approval_SalesOrder($so_no,$status){
                if($status == 'APPROVED'){
                     $query = $this->db->select('*')->from('tbl_salesorder_item')->where('so_no',$so_no)->get();
                     foreach($query->result() as $row){
                        $query1 = $this->db->select('*')->from('tbl_project_color')->where('project_no',$row->project_no)->where('c_code',$row->c_code)->get();
                        $row1 = $query1->row();
                        $balance = floatval($row1->stocks - $row->qty);
                        $update = array('stocks' => $balance);
                        $this->db->where('project_no',$row->project_no);
                        $this->db->where('c_code',$row->c_code);
                        $this->db->update('tbl_project_color',$update);
                        $query2 = $this->db->select('*')->from('tbl_project_design')->where('project_no',$row->project_no)->get();
                        $row2 = $query2->row();
                        $popular = $row2->popular + 1;
                        $datas = array('popular'=>$popular);
                        $this->db->where('project_no',$row->project_no);
                        $this->db->update('tbl_project_design',$datas);
                    }
                    $admin_status = 'SHIPPING';
                    $approval_status = 1;
                }else{
                    $admin_status = 'REJECTED';
                    $approval_status = 2;
                }
                $data1 = array(
                           'approver'       =>  $this->user_id,
                           'status'         =>  $admin_status,
                           'approval_status'=>  $approval_status);
                $this->db->where('so_no',$so_no);
                $this->db->update('tbl_salesorder',$data1);
     }
    function Update_Approval_OnlineOrder($order_no,$status){
        if($status == 'APPROVED'){
            $data1 = array('sales'=>$this->user_id,
                           'sales_status'=>'PENDING');
            $this->db->where('order_no',$order_no);
            $this->db->update('tbl_cart_add',$data1);

            $data = array( 'sales'=>$this->user_id,
                           'status'=>'PENDING');
            $this->db->where('order_no',$order_no);
            $this->db->update('tbl_cart_address',$data);
        }     
     }
     function Update_Approval_Design($id,$status){
        $data = array('approver'     =>$this->user_id,
                      'status'       =>$status,
                      'date_approved'=>date('Y-m-d H:i:s'));
        $this->db->where('id',$this->encryption->decrypt($id));
        $this->db->update('tbl_project_color',$data);
        $row = $this->db->select('*,c.project_no')->from('tbl_project_color as c')
                ->join('tbl_project_design as d','d.id=c.project_no','LEFT')
                ->where('c.id',$this->encryption->decrypt($id))->get()->row();
        if(!$row->project_status){
            $this->db->where('id',$row->project_no);
            $this->db->update('tbl_project_design',array('project_status'=>'APPROVED'));
        }
     }
     function Update_Approval_Concern($id,$action){
        if($action == 'P'){
           $date = 'date_created';
           $user = 'created_by';
        }else{
           $date = 'latest_update';
           $user = 'update_by';
        }
        $data = array('status' => $action,
                      $date=>date('Y-m-d H:i:s'),
                      $user=>$this->user_id);
        $this->db->where('id',$id);
        $this->db->update('tbl_service_request',$data);
        return $action;
     }
     function Update_Design_Stocks($id,$title,$c_name,$image,$tmp,$path_image,$color_image,$color_tmp,$path_color,$docs,$docs_tmp,$path_docs,$image_previous,$color_previous,$docs_previous){
        if($image){$images = $this->move_to_folder1('STOCKS',$image,$tmp,$path_image);
            if($files1 == false){$images = false;
            }else{
               $images = $files1;
               unlink("./".$path_image.$image_previous);
            }
        }else{$images=$image_previous;}

        if($color_image){
            $files2 = $this->move_to_folder1('COLOR',$color_image,$color_tmp,$path_color);
            if($files2 == false){$color_images = false;}else{
                 $color_images = $files2;
                 unlink("./".$path_color.$color_previous);
            }
        }else{$color_images=$color_previous;}

        if($images == false || $color_images == false){
             $data_response = array('status'=> 'error');
        }else{
             if($docs){$docs_file = $this->move_to_folder3('DOCUMENTS'.$docs,$docs_tmp,$path_docs);
            unlink("./".$path_docs.$docs_previous);
            }else{$docs_file=$docs_previous;}
            $query = $this->db->select('*')->from('tbl_project_color')->where('id',$this->encryption->decrypt($id))->get();
            $row = $query->row();
            $color = array('c_name'        => $c_name,
                           'image'         => $images,
                           'docs'          => $docs_file,
                           'c_image'       => $color_images,
                           'latest_update' => date('Y-m-d H:i:s'),
                           'update_by'     => $this->user_id);
            $this->db->where('id',$this->encryption->decrypt($id));
            $this->db->update('tbl_project_color',$color);

            $project = array('title'=>$title);
            $this->db->where('id',$row->project_no);
            $this->db->update('tbl_project_design',$project);
            $data_response = array('status'=> 'update',
                               'title' => $title,
                               'c_name' => $c_name,
                               'image'=> $images,
                               'c_image'=> $color_images,
                               'docs' => $docs_file);
        }
        return $data_response;
    }
     function Update_Design_Project($id,$title,$image,$tmp,$path_image,$docs,$docs_tmp,$path_docs,$image_previous,$docs_previous){
       if($image){$images = $this->move_to_folder1('PROJECT',$image,$tmp,$path_image);
            if($files1 == false){$images = false;
            }else{
               $images = $files1;
               unlink("./".$path_image.$image_previous);
            }
        }else{
            $images = $image_previous;
        }
        if($images == false){
             $data_response = array('status'=> 'error');
        }else{
              if($docs){$docs_file = $this->move_to_folder3('DOCUMENTS'.$docs,$docs_tmp,$path_docs);
                unlink("./".$path_docs.$docs_previous);
                }else{$docs_file=$docs_previous;}
             $query = $this->db->select('*')->from('tbl_project_color')->where('id',$this->encryption->decrypt($id))->get();
             $row = $query->row();
             $color = array('image'         => $images,
                       'docs'          => $docs_file,
                       'latest_update' => date('Y-m-d H:i:s'),
                       'update_by'     => $this->user_id);
            $this->db->where('id',$this->encryption->decrypt($id));
            $this->db->update('tbl_project_color',$color);

            $project = array('title'=>$title);
            $this->db->where('id',$row->project_no);
            $this->db->update('tbl_project_design',$project);
            $data_response = array('status'=> 'update',
                                   'title' => $title,
                                   'image'=> $images,
                                   'docs' => $docs_file);
        }
        return $data_response;
    }
    function Update_Return_Item($id){
        $query = $this->db->select('*')->from('tbl_material_return_item')->where('id',$id)->get();
        $row = $query->row();

        $data = array('receiver' => $this->user_id,
                      'status'   => 'RECEIVED',
                      'date_received' => date('Y-m-d H:i:s'));
        
        $this->db->where('id',$id);
        $this->db->update('tbl_material_return_item',$data);
    }
    function Update_RawMaterial($id,$item,$status,$price,$unit){
      $data = array('item'     => $item,
                    'unit'     => $unit,
                    'price'    => $price,
                    'status'   => $status,
                    'date_lastupdate' => date('Y-m-d H:i:s'));
      $this->db->where('id',$id);
      $this->db->update('tbl_materials',$data);

    }
    function Update_Other_Materials($id,$item,$status){
         $data = array('item'     => $item,
                    'status'   => $status,
                    'latest_update' => date('Y-m-d H:i:s'),
                    'update_by'=>$this->user_id);
         $this->db->where('id',$id);
         $result = $this->db->update('tbl_other_materials',$data);
         if($result){
            return true;
         }else{
            return false;
         }
    }
   function Update_OfficeSupplies_Request($request_id,$item,$balance,$status,$id){
                $query1 = $this->db->select('*')->from('tbl_office_janitorial_request')->where('id',$id)->get();
                $row1 = $query1->row();
                $quantity_balance =   $row1->balance - $balance;
                $material = array(
                           'approver'         =>  $this->user_id,
                           'balance'          =>  $quantity_balance,
                           'status'           =>  $status,
                           'date_approved'     =>  date('Y-m-d H:i:s'));

                $release = array(
                           'receiver'       =>  $this->user_id,
                           'request_id'     =>  $request_id,
                           'item'           =>  $item,
                           'qty'            =>  $balance,
                           'status'         =>  $status,
                           'date_created'   =>  date('Y-m-d H:i:s'));
               
               $query = $this->db->select('*')->from('tbl_office_janitorial')->where('item',$item)->get();
               $row = $query->row();
               if($row->item == $item)
               {
                $quantity_deduct =  $row->stocks - $balance;
                $items = array('stocks' => $quantity_deduct);
                $this->db->where('item',$item);
                $this->db->update('tbl_office_janitorial',$items);
               }

               $this->db->where('id',$id);
               $this->db->update('tbl_office_janitorial_request',$material);
               $this->db->insert('tbl_office_janitorial_release',$release);
     }
     function Update_SpareParts_Request($request_id,$item,$balance,$status,$id){
                $query1 = $this->db->select('*')->from('tbl_spares_request')->where('id',$id)->get();
                $row1 = $query1->row();
                $quantity_balance =   $row1->balance - $balance;
                $material = array(
                           'approver'         =>  $this->user_id,
                           'balance'          =>  $quantity_balance,
                           'status'           =>  $status,
                           'date_approved'    =>  date('Y-m-d H:i:s'));

                $release = array(
                           'receiver'       =>  $this->user_id,
                           'request_id'     =>  $request_id,
                           'item'           =>  $item,
                           'qty'            =>  $balance,
                           'status'         =>  $status,
                           'date_created'   =>  date('Y-m-d H:i:s'));
               
               $query = $this->db->select('*')->from('tbl_spares')->where('item',$item)->get();
               $row = $query->row();
               if($row->item == $item)
               {
                $quantity_deduct =  $row->stocks - $balance;
                $items = array('stocks' => $quantity_deduct);
                $this->db->where('item',$item);
                $this->db->update('tbl_spares',$items);
               }

               $this->db->where('id',$id);
               $this->db->update('tbl_spares_request',$material);
               $this->db->insert('tbl_spares_release',$release);
     }
     function Update_Approval_Customization($id,$status){
        $data = array('designer'=> $this->user_id,
                      'status'  =>  $status);
        $this->db->where('so_no',$id);
        $this->db->update('tbl_salesorder',$data);
     }
     function Update_Material_Request_Approval($production_no,$status){
                if($status == 'IN PROGRESS'){
                    $date = 'date_approved1';
                }else if($status == 'REJECTED'){
                    $date = 'date_rejected';
                }
                $data = array(
                           'approver1'      =>  $this->user_id,
                           'status'         =>  $status,
                            $date           =>  date('Y-m-d H:i:s'));
               $this->db->where('production_no',$production_no);
               $this->db->update('tbl_material_project',$data);
    }

     function Update_Approval_Purchase($production_no,$status){
            if($status == 'IN PROGRESS'){
                $date = 'date_inprogress';
                $status1 = 'APPROVED';
            }else if($status == 'REJECTED'){
                $date = 'date_rejected';
                $status1 = 'REJECTED';
            }
            $data = array(
                       'approver2'      =>  $this->user_id,
                       'status'         =>  $status,
                       'admin_status'   =>  $status1,
                        $date           =>  date('Y-m-d H:i:s'),
                       'latest_update'  =>  date('Y-m-d H:i:s'));
           $this->db->where('production_no',$production_no);
           $this->db->update('tbl_purchasing_project',$data);

           $data_r = array('pur_status' => 'APPROVED');
           $this->db->where('production_no',$production_no);
           $this->db->where('tbl_project',$data_r);
    }
    function Update_Approval_Inspection($production_no,$status,$remarks){
        $value = $this->get_code('tbl_project_inspection','INSNO','-');
        $data = array('ins_no'=>$value,
                      'status'=>$status,
                      'remarks'=> $remarks,
                      'latest_update' => date('Y-m-d H:i:s'),
                      'update_by'=>$this->user_id);
       $this->db->where('production_no',$production_no);
       $this->db->where('ins_no',0);
       $result = $this->db->update('tbl_project_inspection',$data);
       if($result){
          if($status == 2){$status_log = '<span class="label label-lg label-primary label-inline">Approved</span>';}else{$status_log = '<span class="label label-lg label-danger label-inline">Rejected</span>';}
          $this->logs('approval-inspection-project','Admin Inspection Approval','tbl_project_inspection','JOB ORDER:'.$production_no.'<b>INSPECTION NO: '.$value.'<b> STATUS: '.$status_log);
          return $status;
        }else{
           return $this->db->_error_message(); 
        }
      
    }

    function Update_Accounting_Purchase_Request($id,$cash,$action){
        $query = $this->db->select('*')->from('tbl_pettycash')->where('fund_no',$id)->get()->row();
        if(!$query){
            if($action == 1){
                  $value = $this->get_code('tbl_pettycash','CNXID'.date('Ymd'));
                    $this->db->insert('tbl_pettycash',array('accounting'=> $this->user_id,
                                'fund_no'       => $value,
                                'pettycash'     => $cash,
                                'status'        => 1,
                                'type'          => 1,
                                'date_created'  => date('Y-m-d H:i:s'),
                                'created_by'    => $this->user_id));
                    $this->db->where('fund_no',$id);
                    $result = $this->db->update('tbl_purchasing_project',array('fund_no' => $value,
                                         'accounting'=> $this->user_id,
                                         'status'=> 4,
                                         'latest_update'=>date('Y-m-d H:i:s'),
                                         'update_by'=>$this->user_id));
                    if($result){
                        return array('type'=>'success','message'=>'Save Changes');
                    }else{
                        return array('type'=>'info','message'=>'error(002)');
                    }
            }else{
                $this->db->where('fund_no',$id);
                $result = $this->db->update('tbl_pettycash',array('pettycash'=> $cash));
                if($result){
                    return array('type'=>'success','message'=>'Save Changes');
                }else{
                    return array('type'=>'error','message'=>'Nothing Changes');
                }
            }                   
        }else{
            $this->db->where('fund_no',$id);
            $result = $this->db->update('tbl_pettycash',array('pettycash'=> $cash));
            if($result){
                return array('type'=>'success','message'=>'Save Changes');
            }else{
                return array('type'=>'error','message'=>'Nothing Changes');
            }
        }
    }
    function Update_Accounting_Purchase_Received($id,$change,$refund){
        $query = $this->db->select('*')->from('tbl_pettycash')->where('fund_no',$id)->get()->row();
        if($query){
            $row = $this->db->select('sum(amount) as amount')->from('tbl_purchase_received')->where('fund_no',$id)->get()->row();

            $this->db->where('fund_no',$id);
            $result = $this->db->update('tbl_pettycash',array('actual_change'=> $change,'refund'=>$refund,'total_amount'=>$row->amount,'status'=>2,'date_received'=>date('Y-m-d H:i:s')));
            if($result){
                $this->db->where('fund_no',$id);
                $this->db->update('tbl_purchase_received',array('status'=> 2));
                return array('type'=>'success','message'=>'Save Changes');
            }else{
                return array('type'=>'error','message'=>'Nothing Changes');
            }                
        }else{
           return array('type'=>'info','message'=>'error(001)');
        }
    }

     function Update_Accounting_Purchase_Inventory_Request($id,$cash,$action){
        $query = $this->db->select('*')->from('tbl_pettycash')->where('fund_no',$id)->get()->row();
        if(!$query){
            if($action == 1){
                  $value = $this->get_code('tbl_pettycash','CNXID'.date('Ymd'));
                    $this->db->insert('tbl_pettycash',array('accounting'=> $this->user_id,
                                'fund_no'       => $value,
                                'pettycash'     => $cash,
                                'status'        => 1,
                                'type'          => 3,
                                'date_created'  => date('Y-m-d H:i:s'),
                                'created_by'    => $this->user_id));
                    $this->db->where('request_no',$id);
                    $result = $this->db->update('tbl_other_material_p_header',array('fund_no' => $value,
                                         'accounting'=> $this->user_id,
                                         'status'=> 'APPROVED',
                                         'a_status'=>'PENDING',
                                         'latest_update'=>date('Y-m-d H:i:s')
                                     ));
                    if($result){
                        return array('type'=>'success','message'=>'Save Changes');
                    }else{
                        return array('type'=>'info','message'=>'error(002)');
                    }
            }else{
                $this->db->where('fund_no',$id);
                $result = $this->db->update('tbl_pettycash',array('pettycash'=> $cash));
                if($result){
                    return array('type'=>'success','message'=>'Save Changes');
                }else{
                    return array('type'=>'error','message'=>'Nothing Changes');
                }
            }                   
        }else{
            $this->db->where('fund_no',$id);
            $result = $this->db->update('tbl_pettycash',array('pettycash'=> $cash));
            if($result){
                return array('type'=>'success','message'=>'Save Changes');
            }else{
                return array('type'=>'error','message'=>'Nothing Changes');
            }
        }
    }
    function Update_Accounting_Purchase_Inventory_Received($id,$change,$refund){
        $query = $this->db->select('*')->from('tbl_other_material_p_header')->where('fund_no',$id)->get()->row();
        if($query){
            $row = $this->db->select('sum(amount) as amount')->from('tbl_other_material_p_received')->where('fund_no',$id)->get()->row();
            $result = $this->db->where('fund_no',$id)->update('tbl_pettycash',array('actual_change'=> $change,'refund'=>$refund,'total_amount'=>$row->amount,'status'=>2,'date_received'=>date('Y-m-d H:i:s')));
            if($result){
                $this->db->where('fund_no',$id)->update('tbl_other_material_p_header',array('a_status'=> 'COMPLETED'));
                return array('type'=>'success','message'=>'Save Changes');
            }else{
                return array('type'=>'error','message'=>'Nothing Changes');
            }                
        }else{
           return array('type'=>'info','message'=>'error(001)');
        }
    }
   

    //Web Modifier
      function Update_Web_Banner($id,$type,$image,$tmp,$path_image,$previous){
        if($image){
            $files = $this->move_to_folder5('BANNER',$image,$tmp,$path_image,1600,1200);
            if($files == false){
                $images = false;
            }else{
                $images = $files;
                unlink("./assets/images/banner/".$previous);
            }
        }else{$images=$previous;}

        if($images == false){
            $message = 'Image is incorrect format';
            $status = 'error';
        }else{
            if($type == 'none'){
            }else{
                $update = array('type' => 'none');
                $this->db->where('type',$type);
                $this->db->update('tbl_website_banner',$update);
            }
             $data = array('image'=> $images,
                    'type' => $type);
             $this->db->where('id',$id);
             $this->db->update('tbl_website_banner',$data); 
             $message = 'ok';
             $status = 'update';
        }
        $data_response =array('status'=> $status,'message'=> $message);
       return $data_response;
    }
    function Update_Web_Category($cat_id,$status){
        $data = array('status'=>$status);
        $this->db->where('id',$cat_id);
        $this->db->update('tbl_category',$data);
    }
      function Update_Web_SubCategory($cat_id,$sub_name,$sub_id){
          $sub_names = strtoupper($sub_name);
          $query = $this->db->select('*')->from('tbl_category_sub')->where('sub_name',$sub_names)->get();
            $row = $query->row();
            if($query !== FALSE && $query->num_rows() > 0){
                if($row->cat_id == $cat_id){
                    return 'nothing';
                }else{
                    $data = array('cat_id'      => $cat_id,
                                  'sub_name'    => $sub_names);
                    $this->db->where('id',$sub_id);    
                    $this->db->update('tbl_category_sub',$data);
                    return 'change'; 
                }
            }else{
                $data = array('cat_id'      => $cat_id,
                              'sub_name'    => $sub_names);
                $this->db->where('id',$sub_id);    
                $this->db->update('tbl_category_sub',$data);
                return 'change';
            }   
    }
    function Update_Web_ProductSub($cat_id,$project_no,$sub_id){
          $query = $this->db->select('*')->from('tbl_project_design')->where('id',$project_no)->get();
          $row = $query->row();
            if($query !== FALSE && $query->num_rows() > 0){
                if($row->cat_id == $cat_id || $row->sub_id == $sub_id){
                    if($row->sub_id == $sub_id){
                         return 'nothing';
                    }else{
                        $data = array('cat_id'      => $cat_id,
                                      'sub_id'      => $sub_id);
                        $this->db->where('id',$project_no);    
                        $this->db->update('tbl_project_design',$data);
                        return 'product_change';
                    }
                }else{
                    $data = array('cat_id'      => $cat_id,
                                  'sub_id'      => $sub_id);
                    $this->db->where('id',$project_no);    
                    $this->db->update('tbl_project_design',$data);
                    return 'product_change'; 
                }
            }else{
                $data = array('cat_id'      => $cat_id,
                              'sub_id'      => $sub_id);
                $this->db->where('id',$project_no);    
                $this->db->update('tbl_project_design',$data);
                return 'product_change';
            } 
    }
    function Update_Shipping_Range($id,$fee){
        $data = array('shipping_range'=>$fee);
        $this->db->where('id',$id);    
        $this->db->update('tbl_region_shipping',$data);
    }
    function Update_OnlineOrder($action,$downpayment,$order_no,$item_id,$price,$qty,$shipping_fee,$vat){
        if($action == 'vat'){
            $data = array('vat'=>$vat);
            $this->db->where('order_no',$order_no);
            $this->db->update('tbl_cart_address',$data);
        }else if($action == 'downpayment'){
            $data = array('downpayment'=>$downpayment);
            $this->db->where('order_no',$order_no);
            $this->db->update('tbl_cart_address',$data);
        }else if($action == 'shipping'){
            $data = array('shipping_fee'=>$shipping_fee);
            $this->db->where('order_no',$order_no);
            $this->db->update('tbl_cart_address',$data);
        }else if($action == 'SAVED'){
            $data = array('qty'  =>$qty,'price'=>$price);
            $this->db->where('id',$item_id);
            $this->db->update('tbl_cart_add',$data);

            $query1 = $this->db->select('sum(price) as price')->from('tbl_cart_add')->where('order_no',$order_no)->get();
            $row1 = $query1->row();

            $query = $this->db->select('*')->from('tbl_cart_address')->where('order_no',$order_no)->get();
            $row = $query->row();

            $subtotal = $row1->price;
            $disc = floatval($subtotal*$row->discount);
            $total = floatval($subtotal-$disc);

            $data1 = array('subtotal'=>$subtotal,
                           'total'   =>$total);
            $this->db->where('order_no',$order_no);
            $this->db->update('tbl_cart_address',$data1);
        }else if($action == 'REQUEST'){
            $data = array('type'=>'REQUEST');
            $this->db->where('id',$item_id);
            $this->db->update('tbl_cart_add',$data);
        }else if($action == 'In Stocks'){
            $data = array('type'=>'In Stocks');
            $this->db->where('id',$item_id);
            $this->db->update('tbl_cart_add',$data);
        }else if($action == 'CANCELLED'){
            $this->db->where('id',$item_id);
            $this->db->delete('tbl_cart_add');
            $query1 = $this->db->select('sum(price) as price')->from('tbl_cart_add')->where('order_no',$order_no)->get();
            $row1 = $query1->row();
            $query = $this->db->select('*')->from('tbl_cart_address')->where('order_no',$order_no)->get();
            $row = $query->row();

            $subtotal = $row1->price;
            $disc = floatval($subtotal*$row->discount);
            $total = floatval($subtotal-$disc);

            $data1 = array('subtotal'=>$subtotal,
                           'total'   =>$total);
            $this->db->where('order_no',$order_no);
            $this->db->update('tbl_cart_address',$data1);
        }else if($action == 'DESIGNER_APPROVED'){
            $data = array('type'=>'In Stocks',
                          'designer_status' => 'APPROVED');
            $this->db->where('id',$item_id);
            $this->db->update('tbl_cart_add',$data);
        }else if($action == 'READY'){
            $value = $this->get_code('tbl_salesorder','SO'.date('Ymd'));
            $data = array('so_no'  => $value,
                          'status' => 'COMPLETE',
                          'delivery_status' => 'READY TO DELIVER');
            $this->db->where('order_no',$order_no);
            $this->db->update('tbl_cart_address',$data);

          $sql1 =  $this->db->select('s.*,u.*,CONCAT(u.firstname, " ",u.lastname) AS customer,')->from('tbl_cart_address as s')->join('tbl_customer_online as u','u.id=s.customer','LEFT')->WHERE('s.order_no',$order_no)->get();
            $row1 = $sql1->row();
            $so_data = array('so_no'        => $value,
                             'sales_person' => $row1->sales,
                             'c_name'       => $row1->customer,
                             'email'        => $row1->email,
                             'mobile'       => $row1->mobile,
                             'b_address'    => $row1->b_address,
                             'b_city'       => $row1->b_city,
                             'b_province'   => $row1->b_province,
                             's_address'    => $row1->s_address,
                             's_city'       => $row1->s_city,
                             's_province'   => $row1->s_province,
                             'subtotal'     => $row1->subtotal,
                             'discount'     => $row1->discount,
                             'shipping_fee' => $row1->shipping_fee,
                             'downpayment'  => $row1->downpayment,
                             'total'        => $row1->total,
                             'vat'          => $row1->vat,
                             'type'         => 'On Stocks',
                             'status'       => 'APPROVED',
                             'date_order'   => $row1->date_order);
            $this->db->insert('tbl_salesorder',$so_data);

           $sql2 =  $this->db->select('*')->from('tbl_cart_add')->WHERE('order_no',$order_no)->get(); 
           foreach($sql2->result() as $row)  
            {
                $so_item = array('so_no'          => $value,
                                 'project_no'     => $row->project_no,
                                 'c_code'         => $row->c_code,
                                 'qty'            => $row->qty,
                                 'balance'        => $row->qty,
                                 'price'          => $row->price,
                                 'total_amount'   => $row->price,
                                 'balance_price'  => $row->price);
                $this->db->insert('tbl_salesorder_item',$so_item);
                $queryq = $this->db->select('*')->from('tbl_project_color')->where('project_no',$row->project_no)->where('c_code',$row->c_code)->get();
                $roww = $queryq->row();
                $balance = floatval($roww->stocks) - floatval($row->qty);
                $updates = array('stocks' => $balance);
                $this->db->where('project_no',$row->project_no);
                $this->db->where('c_code',$row->c_code);
                $this->db->update('tbl_project_color',$updates);
            } 

        }
    }
    function Update_Web_Voucher($voucher,$discount,$date_from,$date_to){
        error_reporting(0);
        $percent = str_replace('%', '', $discount);
        $dis =  floatval($percent / 100.00);
        $data = array('discount'   => $dis,
                      'date_from'  => date('Y-m-d',strtotime($date_from)),
                      'date_to'    => date('Y-m-d',strtotime($date_to)));
        $this->db->where('promo_code',$voucher);
        $this->db->update('tbl_code_promo',$data);
    }
    function Update_Vouncher_Customer($voucher,$id){
        $data = array('user_id'     =>  $this->user_id,
                      'customer'    =>  $id,
                      'promo_code'  =>  $voucher,
                      'status'      => 'not use',
                      'date_created' => date('Y-m-d H:i:s'));
        $result = $this->db->insert('tbl_customer_promo',$data);
        if($result){
             $query_user = $this->db->select('*,CONCAT(firstname, " ",lastname) AS user')->from('tbl_users')->where('id',$this->user_id)->get();
         $row_user = $query_user->row();
         return array('status'=>'success',
                       'id' => $id,
                       'username'=> $row_user->user);
        }
    }
    function Update_Web_Interior($title,$cat_id,$description,$id,$status,$banner_image,$banner_tmp,$bg_image,$bg_tmp,$path_image,$previous_banner,$previous_bg){
        if($banner_image){
            $files1 = $this->move_to_folder4('INTERIORBANNER',$banner_image,$banner_tmp,$path_image,1140,653);
            if($files1 == false){$banner = false;}else{$banner = $files1;unlink($path_image.$previous_banner);}
        }else{$banner=$previous_banner;}

        if($bg_image){$files2 = $this->move_to_folder5('INTERIORBG',$bg_image,$bg_tmp,$path_image,810,457);
            if($files2 == false){$bg = false;}else{$bg = $files2; unlink($path_image.$previous_bg);}
        }else{$bg=$previous_bg;}

        if($banner == false){
            $message == 'Banner is incorrect format';
            $status = 'error';
        }else if($bg == false){
            $message == 'Background is incorrect format';
            $status = 'error';
        }else{
            $data = array('project_name'=> $title,
                      'description'     => $description,
                      'image'           => $banner,
                      'bg'              => $bg,
                      'cat_id'          => $cat_id,
                      'status'          => $status);
             $this->db->where('id',$id);
             $this->db->update('tbl_interior_design',$data);  
            $message = 'ok';
            $status = 'update';
        }
        $data_response = array('status'=>$status,'message'=>$message);
        return $data_response;
    }
    function Update_Web_Events($title,$status,$description,$image,$id,$date_event,$time_event,$location){
        $data = array('title'           => $title,
                      'description'     => $description,
                      'location'        => $location,
                      'date_event'      => date('Y-m-d',strtotime($date_event)),
                      'time_event'      => $time_event,
                      'status'          => $status,
                      'image'           => $image);
         $this->db->where('id',$id);
         $this->db->update('tbl_events',$data);  
    }
    function Update_Deposit_Approved($id){
        $data = array('status' => 'A');
        $this->db->where('id',$id);
        $this->db->update('tbl_customer_deposite',$data);
        $data = array('status'=>'APPROVED');
        return $data;
    }
    function Update_Customer($id,$firstname,$lastname,$mobile,$email,$address,$city,$province,$region){
        $data = array('firstname' => $firstname,
                      'lastname'  => $lastname,
                      'mobile'    => $mobile,
                      'email'     => $email,
                      'address'   => $address,
                      'city'      => $city,
                      'province'  => $province,
                      'region'    => $region,
                      'latest_update' => date('Y-m-d H:i:s'),
                      'update_by'   => $this->user_id);
        $this->db->where('id',$id);
        $this->db->update('tbl_customer_online',$data);
        return 'update';
    }
    function Update_Material_Status_Request_Supervisor($id,$qty){
        $row = $this->db->select('*')->from('tbl_material_project')->where('id',$id)->get()->row();
        $balance = $row->quantity + $qty;
        $data = array('quantity'          => $balance,
                      'balance_quantity'  => $balance,
                      'status'            => 2,
                      'update_by'         => $this->user_id);
        $this->db->where('id',$id);
        $this->db->update('tbl_material_project',$data); 
        return $row->production_no;
    }
    function Update_Material_Used_Status_Request_Supervisor($id,$qty,$type){
         $row = $this->db->select('*')->from('tbl_material_project')->where('id',$id)->get()->row();
         $row_m = $this->db->select('*')->from('tbl_materials')->where('id',$row->item_no)->get()->row();
            if($type == 1){
                $qtymath = $row->production_quantity+$qty;
                $stocks = $row_m->production_stocks-$qty;
            }else{
                $qtymath = $row->production_quantity-$qty;
                $stocks = $row_m->production_stocks+$qty;
            }
            if($row->cost == 0){
                $this->db->where('id',$id);
                $this->db->update('tbl_material_project',array('cost' => $row_m->price));
            }
            $this->db->where('id',$id);
            $this->db->update('tbl_material_project',array('production_quantity' => $qtymath));

            $this->db->where('id',$row_m->id);
            $this->db->update('tbl_materials',array('production_stocks' => $stocks));
            
            $rows = $this->db->select('*')->from('tbl_material_project')->where('id',$id)->get()->row();
            if($rows->production_quantity > 0){
                $this->db->where('id',$id);
                $this->db->update('tbl_material_project',array('lock_status' => 1));
            }
           return $row->production_no;
    }
    function Update_Material_Used_Lock_Request_Supervisor($id){
        $row = $this->db->select('*')->from('tbl_material_project')->where('id',$id)->get()->row();
        if($row->lock_status == 0){
            $status = 1;
        }else if($row->lock_status == 1){
             $status = 0;
        }
        $this->db->where('id',$id);
        $result = $this->db->update('tbl_material_project',array('lock_status' => $status));
        if($result){return array('id'=>$row->production_no,'status'=>$status);}else{return false;}
    }
    function Update_Purchase_Status_Request_Supervisor($id){
        $this->db->where('id',$id);
        $result = $this->db->update('tbl_purchasing_project',array('status'=>2));
        if($result){
             $row = $this->db->select('*')->from('tbl_purchasing_project')->where('id',$id)->get()->row();
             return $row->production_no;
        }else{
            return false;
        }
    }
    function Update_Material_Request_Supervisor($id,$qty,$type){
        $row = $this->db->select('*')->from('tbl_material_project')->where('id',$id)->get()->row();
        $data = array('total_qty'=> $qty,'mat_type'=>$type);
        $this->db->where('id',$id);
        $this->db->update('tbl_material_project',$data); 
        return $row->production_no;
    }
    function Update_Purchase_Request_Supervisor($id,$qty,$remarks){
       $row = $this->db->select('*')->from('tbl_purchasing_project')->where('id',$id)->get()->row();
       $purchase_data = array('quantity'            =>  $qty,
                              'balance'             =>  $qty,
                              'remarks'             =>  $remarks);
        $this->db->where('id',$id);
        $this->db->update('tbl_purchasing_project',$purchase_data); 
        return $row->production_no;
    }
    function Update_Project_Monitoring($id,$data,$action,$start,$due){
        $query = $this->db->select('*')->from('tbl_project')->where('id',$id)->get();
        $row = $query->row();
        $status ='nothing';
        if($action == 'save-name'){
            if($row->customer != $data){$status='success';$update = array('customer'=>$data,'latest_update'=>date('Y-m-d H:i:s'),'update_by'=>$this->user_id);}
        }else if($action == 'save-address'){
            if($row->address != $data){$status='success';$update = array('address'=>$data,'latest_update'=>date('Y-m-d H:i:s'),'update_by'=>$this->user_id);}
        }else if($action == 'save-amount'){
            if($row->amount != str_replace(',', '',$data)){$status='success';$update = array('amount'=>str_replace(',', '',$data),'latest_update'=>date('Y-m-d H:i:s'),'update_by'=>$this->user_id);}
        }else if($action == 'save-labor'){
            if($row->labor != str_replace(',', '',$data)){$status='success';$update = array('labor'=>str_replace(',', '',$data),'latest_update'=>date('Y-m-d H:i:s'),'update_by' => $this->user_id);}
        }else if($action == 'save-date'){
            $status='success';
            $start_date =date('Y-m-d',strtotime($start));
            $due_date =date('Y-m-d',strtotime($due));
            if(!$start){
                $start_date = date('Y-m-d H:i:s');
            }
            if(!$due){
                 $due_date = date('Y-m-d H:i:s');
            }
            $update = array('start_date'=>$start_date,'due_date'=> $due_date,'latest_update'=>date('Y-m-d H:i:s'),'update_by' => $this->user_id);
        }
        if($status == 'success'){
            $this->db->where('id',$id);
            $this->db->update('tbl_project',$update);
        }
        $data_response = array('status'=>$status,
                               'action' => $action);
        return $data_response;
    }
    function Update_Cash_Position($id,$action,$data){
        $decrypt_id = $this->encryption->decrypt($id);
        $status = 'already';
        $query = $this->db->select('*')->from('tbl_cash_position')->where('id',$decrypt_id)->get();
        $row = $query->row();
        if($action == 'name' && $row->name != $data){
            $update = array('name' => $data); 
            $status ='update';
            $this->db->where('id',$decrypt_id);
            $this->db->update('tbl_cash_position',$update); 
        }
        if($action == 'amount' && $row->amount != floatval(str_replace(',', '', $data))){
            $update = array('amount' => floatval(str_replace(',', '', $data))); 
            $status ='update'; 
            $this->db->where('id',$decrypt_id);
            $this->db->update('tbl_cash_position',$update);
        }
        if($action == 'date_position' && $row->date_position != date('Y-m-d',strtotime($data))){
            $update = array('date_position' => date('Y-m-d',strtotime($data))); 
            $status ='update';
            $this->db->where('id',$decrypt_id);
            $this->db->update('tbl_cash_position',$update); 
        }
        if($action == 'category'){
            $update = array('cat_id' => $data); 
            $status ='update'; 
            $this->db->where('id',$decrypt_id);
            $this->db->update('tbl_cash_position',$update); 
        }
        if($action == 'type'){
            $update = array('type' => $data); 
            $status ='update'; 
            $this->db->where('id',$decrypt_id);
            $this->db->update('tbl_cash_position',$update);
        }
        return $status;
    }
    function Update_Web_Testimony($name,$description,$image,$tmp,$path_image,$previous,$id){
         if($image){$files = $this->move_to_folder4('TESTIMONY',$image,$tmp,$path_image,500,500);
            if($files == false){$images = false;}else{$images = $files;unlink('./'.$path_image.$previous);}
        }else{$images = $previous;}
            if($images == false){$status = 'image error';}else{
                $data = array('name'          => $name,
                              'description'    => $description,
                              'image'          => $images,
                              'latest_update'  => date('Y-m-d H:i:s'),
                              'update_by'      => $this->user_id);
                $this->db->where('id',$this->encryption->decrypt($id));
                $this->db->update('tbl_customer_testimony',$data);
                $status = 'update';
                
            }
         $data_response = array('status' => $status);
         return $data_response;  
    }
     function Update_Web_Company_Profile($data,$action){
        $query = $this->db->select('*')->from('tbl_company_profile')->where('id',1)->get();
        $row = $query->row();
         if($action == 'save_company'){
            if($row->company == $data){$status = 'error';}else{$update = array('company'=>$data);$status = 'success';}
         }else if($action == 'save_mobile'){
            if($row->mobile == $data){$status = 'error';}else{$update = array('mobile'=>$data);$status = 'success';}
        }else if($action == 'save_email'){
            if($row->email == $data){$status = 'error';}else{$update = array('email'=>$data);$status = 'success';}
        }else if($action == 'save_facebook'){
            if($row->facebook == $data){$status = 'error';}else{    $update = array('facebook'=>$data);$status = 'success';}
        }else if($action == 'save_instagram'){
            if($row->instagram == $data){$status = 'error';}else{   $update = array('instagram'=>$data);$status = 'success';}
        }else if($action == 'save_tweeter'){
            if($row->tweeter == $data){$status = 'error';}else{ $update = array('tweeter'=>$data);$status = 'success';}
        }else if($action == 'save_youtube'){
            if($row->youtube == $data){$status = 'error';}else{ $update = array('youtube'=>$data);$status = 'success';}
        }else if($action == 'save_address'){
            if($row->address == $data){$status = 'error';}else{ $update = array('address'=>$data);$status = 'success';}
        }else if($action == 'save_open'){
            if($row->store_open == $data){$status = 'error';}else{  $update = array('store_open'=>$data);$status = 'success';}
        }
         if($status == 'success'){
             $this->db->where('id',1);
             $this->db->update('tbl_company_profile',$update);
         }
         return $status;
    }
    function Update_Web_Company_Image($image,$tmp,$path_image){
          $status = 'no image';
          if($image){$images = $this->move_to_folder3('LOGO'.$image,$tmp,$path_image);
                unlink("./".$path_image.$row->images);
                    $data = array('logo' => $images);
                  $this->db->where('id',1);
                      $this->db->update('tbl_company_profile',$data);
                    $status = 'success';
            }
            return $status; 
    }
     function Update_Web_About_Us($data,$action){
            $query = $this->db->select('*')->from('tbl_company_owner')->where('id',1)->get();
            $row = $query->row();
             if($action == 'save_ownername'){
                    if($row->owner_name == $data){$status = 'error';}else{$update = array('owner_name'=>$data);$status = 'success';}
             }else if($action == 'save_about'){
                    if($row->about_owner == $data){$status = 'error';}else{$update = array('about_owner'=>$data);$status = 'success';}
             }else if($action == 'save_terms'){
                    if($row->terms == $data){$status = 'error';}else{$update = array('terms'=>$data);$status = 'success';}
             }else if($action == 'save_privacy'){
                    if($row->privacy == $data){$status = 'error';}else{$update = array('privacy'=>$data);$status = 'success';}
             }else if($action == 'save_return'){
                    if($row->return_exchange == $data){$status = 'error';}else{$update = array('return_exchange'=>$data);$status = 'success';}
             }else if($action == 'save_shipping'){
                    if($row->shipping_policy == $data){$status = 'error';}else{$update = array('shipping_policy'=>$data);$status = 'success';}
             }else if($action == 'save_ourstory'){
                 if($row->our_story == $data){$status = 'error';}else{$update = array('our_story'=>$data);$status = 'success';}
             }
             if($status == 'success'){
                     $this->db->where('id',1);
                     $this->db->update('tbl_company_owner',$update);
             }
             return $status;
    }
     function Update_Web_Owner_Image($image,$tmp,$path_image){
        $status = 'no image';
        $query = $this->db->select('*')->from('tbl_company_owner')->where('id',1)->get();
        $row = $query->row();
        if($image){
            $files = $this->move_to_folder4('OWNER',$image,$tmp,$path_image,500,500);
            if($files ==false){
                $status = 'error';
            }else{
                unlink($path_image.$row->image);    
                $data = array('image' => $files);
                $this->db->where('id',1);
                $this->db->update('tbl_company_owner',$data);
                $status = 'success';
            }
        }
        return $status;
    }
    function Update_Joborder_Status($production_no,$qty,$status,$type){
        $row = $this->db->select('*')->from('tbl_project')->where('production_no',$production_no)->get()->row();
        $insert = array('production_no'=>$production_no,
                        'assigned'=>$row->assigned,
                        'project_no'=> $row->project_no,
                        'c_code'=> $row->c_code,
                        'unit' =>$qty,
                        'status'=>$status,
                        'type' => $type,
                        'date_created'=>date('Y-m-d H:i:s'));
        $this->db->insert('tbl_project_finished',$insert);
        if($type == 1){
            $total = $row->unit - $qty;
            $data = array('unit' => $total,'latest_update'=> date('Y-m-d H:i:s'),'update_by' => $this->user_id);
            $this->db->where('production_no',$production_no);
            $result = $this->db->update('tbl_project',$data);
            if($result){
                if($status == 1){
                    $row_s = $this->db->select('*')->from('tbl_project_color')->where('id',$row->c_code)->get()->row();
                    $stocks = $row_s->stocks+$qty;
                    $this->db->where('id',$row_s->id)->update('tbl_project_color',array('stocks'=>$stocks));
                }
                $data_response = array('status'=>$status,'type'=>$type,'qty'=> $qty,'unit'=>$total);
            }else{
                $data_response = false;
            }
        }else{
            $status_update = 2;
            if($status == 2){
                $status_update == 3;
            }
            $this->db->where('production_no',$production_no);
            $result = $this->db->update('tbl_project',array('status'=>$status_update));
            if($result){
                $data_response = array('status'=>$status,'type'=>$type);
            }else{
                $data_response = false;
            }
        }
        return $data_response;
    }
    function Update_Joborder_Stocks($production_no,$mat_type,$mat_itemno,$mat_quantity,$mat_remarks,$pur_item,$pur_quantity,$pur_remarks,$pur_type){
                $pur_items = explode(',', $pur_item);
                $pur_quantitys = explode(',', $pur_quantity);
                $pur_remarkss = explode(',', $pur_remarks);
                $pur_types = explode(',', $pur_type);
                if($pur_items){
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
                        $purchase_data = array('production_no'=>$production_no,
                                'item_no'          =>  $item_no,
                                'quantity'         =>  $pur_quantitys[$i],
                                'balance'          =>  $pur_quantitys[$i],
                                'status'           =>  1,
                                'remarks'          =>  $pur_remarkss[$i],
                                'material_type'    =>  $pur_types[$i],
                                'date_created'     =>  date('Y-m-d H:i:s'));
                        $this->db->insert('tbl_purchasing_project',$purchase_data);
                    }
                }
                $data = array('status'=>1,'latest_update'=>date('Y-m-d H:i:s'),'update_by'=>$this->user_id);
                $this->db->where('production_no',$production_no);
                $this->db->update('tbl_project',$data);
                $mat_itemnos = explode(',', $mat_itemno);
                $mat_quantitys = explode(',', $mat_quantity);
                $mat_remarkss = explode(',', $mat_remarks);
                $mat_types = explode(',', $mat_type);   
                for($i=0; $i<count($mat_itemnos);$i++){
                    $material_data = array('production_no' =>  $production_no,
                                        'production'       =>  $this->user_id,
                                        'item_no'          =>  $mat_itemnos[$i],
                                        'total_qty'        =>  $mat_quantitys[$i],
                                        'status'           =>  1,
                                        'mat_type'         =>  $mat_types[$i],
                                        'remarks'          =>  $mat_remarkss[$i],
                                        'date_created'     =>  date('Y-m-d H:i:s'));
                     $this->db->insert('tbl_material_project',$material_data);
                }

     }
    function Update_Salesorder_Stock_Request($id,$status){
        $delivery = 0;if($status == 'A'){$delivery = 1;}
        $this->db->where('id',$this->encryption->decrypt($id));
        $result = $this->db->update('tbl_salesorder_stocks',array('status'=>$status,'delivery'=>$delivery,'latest_update'=> date('Y-m-d H:i:s'),
                          'update_by'=>$this->user_id));
        if($result){
            return $status;
        }else{
            return false;
        }
    }
    function Update_Salesorder_Project_Request($id,$status){
        $delivery = 0;if($status == 'A'){$delivery = 1;}
        $this->db->where('id',$this->encryption->decrypt($id));
        $result = $this->db->update('tbl_salesorder_project',array('status'=>$status,'delivery'=>$delivery,'latest_update'=> date('Y-m-d H:i:s'),'update_by'=>$this->user_id));
        if($result){
            return $status;
        }else{
            return false;
        }
    }
    function Update_Salesorder_Stock_Delivery($id,$si_no){
        $this->db->where('id',$this->encryption->decrypt($id));
        $result = $this->db->update('tbl_salesorder_stocks',array('si_no'=>$si_no,'delivery'=>2));
        if($result){
            return true;
        }else{
            return false;
        }
    }
    function Update_Salesorder_Project_Delivery($id,$si_no){
        $this->db->where('id',$this->encryption->decrypt($id));
        $result = $this->db->update('tbl_salesorder_project',array('si_no'=>$si_no,'delivery'=>2));
        if($result){
            return true;
        }else{
            return false;
        }
    }
    function Update_Request_Materials($id,$qty,$balance){
        $row = $this->db->select('*')->from('tbl_other_material_m_request')->where('id',$this->encryption->decrypt($id))->get()->row();
        if($row->type == 1){
            $table ='tbl_materials';         
         }else{
            $table ='tbl_other_materials';    
        }
         $row_mats = $this->db->select('*')->from($table)->where('id',$row->item_no)->get()->row();
         if($row_mats){
            if($row_mats->stocks == 0){
                return array('item'=>$row->item,'qty'=>$row->qty);
            }else{
                $this->db->where('id',$this->encryption->decrypt($id));
                $result = $this->db->update('tbl_other_material_m_request',array('qty'=>$balance,'latest_update'=>date('Y-m-d H:i:s'),'update_by'=>$this->user_id));
                if($result){
                    $this->db->insert('tbl_other_material_m_received',array('item_no'=>$row->item_no,'item'=>$row->item,'qty'=>$qty,'type'=>$row->type,'date_created'=>date('Y-m-d H:i:s'),'created_by'=>$this->user_id));

                    $this->db->insert('tbl_material_release',array('production_no'=>'MRXID'.date('YmdHis'),'item_no'=>$row->item_no,'quantity'=>$qty,'type'=>$row->type,'date_created'=>date('Y-m-d H:i:s'),'created_by'=>$this->user_id));

                    $stocks = floatval($row_mats->stocks - $qty);
                    $this->db->where('id',$row_mats->id);
                    $this->db->update($table,array('stocks'=>$stocks));
                    if($balance == 0){
                       $this->db->where('id',$row->id);
                       $this->db->update('tbl_other_material_m_request',array('status'=>2));         
                    }
                    return true;
                }else{
                     return false;
                }
            }
         }else{
            return false;
         }
    }
    function Update_Request_Materials_Cancelled($id){
        $this->db->where('id',$this->encryption->decrypt($id));
        $result =$this->db->update('tbl_other_material_m_request',array('status'=>3,'latest_update'=>date('Y-m-d H:i:s'),'update_by'=>$this->user_id));
        if($result){
            return true;
        }else{
            return false;
        }
    }
    function Update_Pre_Order_Request($id,$status){
        $this->db->where('id',$this->encryption->decrypt($id));
        $result =$this->db->update('tbl_cart_pre_order',array('status'=>$status,'latest_update'=>date('Y-m-d H:i:s'),'update_by'=>$this->user_id));
        if($result){
            $row = $this->db->select('*')->from('tbl_cart_pre_order')->where('id',$this->encryption->decrypt($id))->get()->row();
            ($status == 2)?$type ='In Stocks' : $type ='Cancelled';
           $this->db->where('order_no',$row->order_no);
           $this->db->where('c_code',$row->c_code);
           $this->db->update('tbl_cart_add',array('type'=>$type));
           return $status;
        }else{
            return false;
        }
    }
    function Update_Customized_Request($id,$subject,$description){
        $this->db->where('id',$this->encryption->decrypt($id));
        $result = $this->db->update('tbl_customized_request',$data = array('subject'=>$subject,'description'=>$description));
        if($result){
            return array('status'=>true,'type'=>'success','message'=>'Update Successfully');
        }else{
            return false;
        }
    }
    function Update_Customized_Approval_Request($id,$status){
        $this->db->where('id',$this->encryption->decrypt($id));
        $result =$this->db->update('tbl_customized_request',array('status'=>$status,'latest_update'=>date('Y-m-d H:i:s'),'update_by'=>$this->user_id));
        if($result){
            return $status;
        }else{
            return false;
        }
    }
    function Update_Approval_Inquiry($id,$status){
        $this->db->where('id',$this->encryption->decrypt($id));
        $result =$this->db->update('tbl_customer_inquiry',array('status'=>$status,'latest_update'=>date('Y-m-d H:i:s'),'update_by'=>$this->user_id));
        if($result){
            return $status;
        }else{
            return false;
        }
    }
    function Update_Salesorder_Stocks($id,$downpayment,$date_downpayment,$discount,$shipping_fee,$vat){
        $rows = $this->db->select('u.*,s.*,s.id,CONCAT(u.firstname, " ",u.lastname) AS name,CONCAT(s.b_address, " ",s.b_city, " ",s.b_province) AS billing_address')->from('tbl_cart_address as s')
        ->join('tbl_customer_online as u','u.id=s.customer','LEFT')->where('s.id',$this->encryption->decrypt($id))->get()->row();
        $so_no = $this->get_code('tbl_salesorder_stocks','SO-FS'.date('Ymd'));
        $row = $this->db->select('*')->from('tbl_salesorder_customer')->where('fullname',$rows->name)->get()->row();
        if(!$row){
            $c_no = $this->get_code('tbl_salesorder_customer','CN'.date('Ymd'));
            $this->db->insert('tbl_salesorder_customer',array('customer_no'=>$c_no,
                                                             'fullname'=>$rows->name,
                                                             'email'=>$rows->email,
                                                             'mobile'=>$rows->mobile,
                                                             'address'=>$rows->billing_address,
                                                             'date_created'=>date('Y-m-d H:i:s'),
                                                             'created_by'=>$this->user_id));
            $last_id = $this->db->insert_id();
        }else{
            $last_id = $row->id;
        }
        $result = $this->db->insert('tbl_salesorder_stocks',array('so_no'=>$so_no,
                      'customer'=>$last_id,
                      'email'=>$rows->email,
                      'mobile'=>$rows->mobile,
                      'address'=>$rows->billing_address,
                      'downpayment'=>$downpayment,
                      'discount'=>$discount,
                      'shipping_fee'=>$shipping_fee,
                      'vat'=>$vat,
                      'date_order'=>date('Y-m-d',strtotime($rows->date_order)),
                      'date_downpayment'=>date('Y-m-d',strtotime($date_downpayment)),
                      'date_created'=>date('Y-m-d H:i:s'),
                      'created_by'=>$this->user_id));
        $last_id_so = $this->db->insert_id();
        $query =  $this->db->select('*')
          ->from('tbl_cart_add')->where('type','In Stocks')->where('order_no',$rows->order_no)->get();
           if(!$query){return false;}else{  
               foreach($query->result() as $row){
                $this->db->insert('tbl_salesorder_stocks_item',
                      array('so_no'=>$last_id_so,
                      'c_code'=>$row->c_code,
                      'qty'=>$row->qty,
                      'unit'=>'PCS',
                      'amount'=>$row->price
                    ));
               } 
           }
        if($result){
            return true;
        }else{
            return false;   
        }
    }
    function Update_Supplier_Item($id,$supplier,$amount){
        $data = array('amount'         => $amount,
                      'latest_update'   => date('Y-m-d H:i:s'),
                      'update_by'     => $this->user_id);
        $this->db->where('id',$id);        
        $result = $this->db->update('tbl_supplier_item',$data);
        if($result){
            return $supplier;
        }else{
            return false;
        }
       
    }
     function Update_Supplier_Edit($id,$name,$mobile,$email,$address){
        $data = array('name'  => $name,
                     'mobile' =>$mobile,
                     'email'  =>$email,
                     'address'=>$address,
                     'latest_update' => date('Y-m-d H:i:s'),
                     'update_by'  => $this->user_id);
        $this->db->where('id',$id);        
        $result = $this->db->update('tbl_supplier',$data);

        $row = $this->db->select('*')->from('tbl_supplier')->where('id',$id)->get()->row();
        if($result){
            return $row;
        }else{
            return false;
        }
    }
    function Update_Supplier_Image($id,$image,$tmp,$path_image){
        $row = $this->db->select('*')->from('tbl_supplier')->where('id',$id)->get()->row();
        if($image){
            $files = $this->move_to_folder4('SUPPLIER',$image,$tmp,$path_image,300,300);
            if($files == false){
                return false;
            }else{
               $images = $files;
               if($row->image != 'default.jpg'){
                  unlink("./".$path_image.$row->image);
               }
                $this->db->where('id',$id);        
                $result = $this->db->update('tbl_supplier',array('image' => $images));
                if($result){
                    return $images;
                }else{
                    return false;
                }
            }
            
        }else{
            return false;
        }
    }
    function Update_Purchase_Estimate($id,$amount,$type){
        $pr_id = array_map('intval', explode(',', $id));
        $amounts = explode(',',$amount);
        $value = 'TN'.date('YmdHis');
        for($i=0;$i<count($pr_id);$i++){
            $data = array('fund_no'=> $value,
                          'purchaser'=>$this->user_id,
                          'amount' => $amounts[$i],
                          'status' => 3,
                          'type'=> $type,
                          'latest_update'=> date('Y-m-d H:i:s'),
                          'update_by'=> $this->user_id);
            $this->db->where('id',$pr_id[$i]);
            $this->db->update('tbl_purchasing_project',$data);
        }
        return true;
    }

     function Update_Purchased_Transaction($fund_no,$item,$supplier,$terms,$quantity,$amount,$terms_start,$terms_end){
        $data_item = false;
        $data = false;
        $row_b =  $this->db->select('*')->from('tbl_purchasing_project')->where('fund_no',$fund_no)->where('item_no',$item)->get()->row();
        if($row_b){
            if($quantity > $row_b->balance){
                $row_m =  $this->db->select('*')->from('tbl_materials')->where('id',$item)->get()->row();
               ($row_m->unit)?$unit = $row_m->unit.'(s)':$unit = "";

               if($row_b->balance == 0){
                  return array('type'=>'info','status'=>''.$row_m->item.' '.$unit.'</br> You exceeded the required quantity ('.$row_b->balance.')');
               }else{
                  return array('type'=>'info','status'=>''.$row_m->item.' '.$unit.'</br>Make sure the input quantity is less than or equal to request quantity ('.$row_b->balance.')');
               }
             
            }else{
                $balance = $row_b->balance - $quantity; 
                $this->db->where('id',$row_b->id);
                $this->db->update('tbl_purchasing_project',array('balance'=>$balance,'latest_update'=>date('Y-m-d H:i:s')));

                $row = $this->db->select('*')->from('tbl_purchase_transactions')->where('fund_no',$fund_no)->where('item_no',$item)->where('supplier',$supplier)->get()->row();
                if($row){
                    $balance_quantity = $row->quantity+$quantity;
                    $this->db->where('id',$row->id);
                    $this->db->update('tbl_purchase_transactions',array('payment'=>$terms,'quantity'=>$balance_quantity,'amount'=>$amount,'terms_start'=>$terms_start,'terms_end'=>$terms_end,'latest_update'=>date('Y-m-d H:i:s')));
                    $status = 'Save changes';
                }else{
                    $this->db->insert('tbl_purchase_transactions',array('fund_no'=>$fund_no,'item_no'=>$item,'supplier'=>$supplier,'payment'=>$terms,'quantity'=>$quantity,'amount'=>$amount,'terms_start'=>$terms_start,'terms_end'=>$terms_end,'latest_update'=>date('Y-m-d H:i:s')));
                    $status = 'Create Successfully';
                }
                
                 $query = $this->db->select('pr.*,pr.balance,m.id ,m.unit,m.item,pr.quantity,pr.remarks,pr.amount')->from('tbl_purchasing_project as pr')->join('tbl_materials as m','m.id=pr.item_no','LEFT')->where('pr.fund_no',$fund_no)->get();
                   if($query){  
                       foreach($query->result() as $row){
                            ($row->unit)?$unit = $row->unit.'(s)':$unit = "";
                              $data_item[] = array('id'=> $row->id,'item'=> $row->item.' '.$unit.' - '.$row->balance);
                       } 
                   }
               
                $query = $this->db->select('*,s.name,m.item,m.unit,t.payment,t.quantity,t.id')->from('tbl_purchase_transactions as t')->join('tbl_supplier as s','s.id=t.supplier','LEFT')->join('tbl_materials as m','m.id=t.item_no')->where('t.fund_no',$fund_no)->order_by('t.latest_update','DESC')->get();
                if($query){
                     foreach($query->result() as $row){
                         ($row->unit)?$unit = $row->unit.'(s)':$unit = "";
                         ($row->payment == 1)?$terms = 'Cash':$terms ='Terms';
                             $data[] = array('id'=>$row->id,
                                             'item'=> $row->item.' '.$unit,
                                             'supplier'=>$row->name,
                                             'payment'=>$terms,
                                             'quantity'=>$row->quantity,
                                             'amount'=>number_format($row->amount,2));
                       } 
                }
                return array('type'=>'success','status'=>$status,'row'=>$data,'material'=>$data_item);           
            }
        }else{
           return false;
        }
       
    }
    function Update_Purchase_Complete($fund_no,$joborder,$type){
        $query = $this->db->select('*')->from('tbl_purchase_transactions')->where('fund_no',$fund_no)->get();
        if($query){
           $this->db->where('fund_no',$fund_no);
           $result = $this->db->update('tbl_purchasing_project',array('status'=>5));
           if($result){
                $rows = $this->db->select('*')->from('tbl_purchasing_project')->where('fund_no',$fund_no)->get()->row();
                 foreach($query->result() as $row){
                    $this->db->insert('tbl_purchase_received',array('production_no'=>$joborder,
                                      'fund_no'=>$row->fund_no,
                                      'purchaser'=>$rows->purchaser,
                                      'supplier'=>$row->supplier,
                                      'item_no'=>$row->item_no,
                                      'payment'=>$row->payment,
                                      'terms_start'=>$row->terms_start,
                                      'terms_end'=>$row->terms_end,
                                      'quantity'=>$row->quantity,
                                      'amount'=>$row->amount,
                                      'type'=>$type,
                                      'date_created'=>date('Y-m-d H:i:s'),
                                      'created_by'=>$this->user_id));

                    $this->db->insert('tbl_material_new',array('fund_no'=>$fund_no,'supplier'=>$row->supplier,'item_no'=>$row->item_no,'qty'=>$row->quantity,'amount'=>$row->amount,'date_created'=>date('Y-m-d H:i:s'),'created_by'=>$rows->purchaser));
                }
                $this->db->where('fund_no',$fund_no);
                $result = $this->db->delete('tbl_purchase_transactions');
                if($result){
                    $q = $this->db->select('item_no,sum(quantity) as qty')->from('tbl_purchase_received')->where('fund_no',$fund_no)->group_by('item_no')->get();
                     foreach($q->result() as $row){
                         $row_mats = $this->db->select('*')->from('tbl_materials')->where('id',$row->item_no)->get()->row();
                         $stocks = $row_mats->stocks + $row->qty;
                         $this->db->where('id',$row_mats->id);
                         $this->db->update('tbl_materials',array('stocks'=>$stocks));
                     }
                    return 'Purchased item completed';
                }else{
                    return false;
                }
            }else{
                 return false;
            }
        }else{
            return false;
        }
    }
     function Update_Purchased_Other_Transaction($fund_no,$item,$supplier,$terms,$quantity,$amount,$terms_start,$terms_end,$type){
        $data_item = false;
        $data = false;
        $row_b =  $this->db->select('*')->from('tbl_other_material_p_header')->where('fund_no',$fund_no)->get()->row();
        if($row_b){
            $row_m =  $this->db->select('*')->from('tbl_other_material_p_request')->where('pr_id',$row_b->id)->where('item_no',$item)->where('type',$type)->get()->row();
            if($quantity > $row_m->balance){
               if($row_m->balance == 0){
                  return array('type'=>'info','status'=>''.$row_m->item.'</br> You exceeded the required quantity ('.$row_m->balance.')');
               }else{
                  return array('type'=>'info','status'=>''.$row_m->item.'</br>Make sure the input quantity is less than or equal to request quantity ('.$row_m->balance.')');
               }
             
            }else{
                $balance = $row_m->balance - $quantity; 
                $this->db->where('id',$row_m->id);
                $this->db->update('tbl_other_material_p_request',array('balance'=>$balance));

                $row = $this->db->select('*')->from('tbl_other_material_p_transaction')->where('fund_no',$fund_no)->where('item_no',$item)->where('supplier',$supplier)->where('type',$type)->get()->row();
                if($row){
                    $balance_quantity = $row->quantity+$quantity;
                    $this->db->where('id',$row->id);
                    $this->db->update('tbl_other_material_p_transaction',array('payment'=>$terms,'quantity'=>$balance_quantity,'amount'=>$amount,'terms_start'=>$terms_start,'terms_end'=>$terms_end,'latest_update'=>date('Y-m-d H:i:s')));
                    $status = 'Save changes';
                }else{
                    $this->db->insert('tbl_other_material_p_transaction',array('fund_no'=>$fund_no,'item_no'=>$item,'item'=>$row_m->item,'supplier'=>$supplier,'payment'=>$terms,'quantity'=>$quantity,'amount'=>$amount,'terms_start'=>$terms_start,'terms_end'=>$terms_end,'type'=>$type,'latest_update'=>date('Y-m-d H:i:s')));
                    $status = 'Create Successfully';
                }
                
                 $query = $this->db->select('*')->from('tbl_other_material_p_request')->where('pr_id',$row_b->id)->get();
                   if($query){  
                       foreach($query->result() as $row){
                              $data_item[] = array('id'=> $row->item_no,'item'=> $row->item.' - '.$row->balance);
                       } 
                   }
               
                $query = $this->db->select('*,s.name,t.item,t.payment,t.quantity,t.id')->from('tbl_other_material_p_transaction as t')->join('tbl_supplier as s','s.id=t.supplier','LEFT')->where('t.fund_no',$fund_no)->order_by('t.latest_update','DESC')->get();
                if($query){
                     foreach($query->result() as $row){
                         ($row->payment == 1)?$terms = 'Cash':$terms ='Terms';
                             $data[] = array('id'=>$row->id,
                                             'item'=> $row->item,
                                             'supplier'=>$row->name,
                                             'payment'=>$terms,
                                             'quantity'=>$row->quantity,
                                             'amount'=>number_format($row->amount,2));
                       } 
                }
                return array('type'=>'success','status'=>$status,'row'=>$data,'material'=>$data_item);           
            }
        }else{
           return false;
        }
       
    }
      function Update_Purchase_Other_Complete($fund_no){
        $query = $this->db->select('*')->from('tbl_other_material_p_transaction')->where('fund_no',$fund_no)->get();
        if($query){
                 foreach($query->result() as $row){
                    $this->db->insert('tbl_other_material_p_received',array(
                                      'fund_no'=>$fund_no,
                                      'supplier'=>$row->supplier,
                                      'item_no'=>$row->item_no,
                                      'item'=>$row->item,
                                      'payment'=>$row->payment,
                                      'terms_start'=>$row->terms_start,
                                      'terms_end'=>$row->terms_end,
                                      'quantity'=>$row->quantity,
                                      'amount'=>$row->amount,
                                      'type'=>$row->type,
                                      'date_created'=>date('Y-m-d H:i:s'),
                                      'created_by'=>$this->user_id));
                    if($row->type){
                          $this->db->insert('tbl_material_new',array('fund_no'=>$fund_no,'supplier'=>$row->supplier,'item_no'=>$row->item_no,'qty'=>$row->quantity,'amount'=>$row->amount,'date_created'=>date('Y-m-d H:i:s'),'created_by'=>$this->user_id));
                    }
                  
                }
                $this->db->where('fund_no',$fund_no);
                $result = $this->db->delete('tbl_other_material_p_transaction');
                if($result){
                    $this->db->where('fund_no',$fund_no)->update('tbl_other_material_p_header',array('status'=>'COMPLETED','a_status'=>'APPROVED'));
                    $q = $this->db->select('type,item_no,sum(quantity) as qty')->from('tbl_other_material_p_received')->where('fund_no',$fund_no)->group_by('item_no,type')->get();
                     foreach($q->result() as $row){
                        if($row->type == 1){
                            $row_mats = $this->db->select('*')->from('tbl_materials')->where('id',$row->item_no)->get()->row();
                             $stocks = $row_mats->stocks + $row->qty;
                             $this->db->where('id',$row_mats->id);
                             $this->db->update('tbl_materials',array('stocks'=>$stocks));

                        }else{
                            $row_mats = $this->db->select('*')->from('tbl_other_materials')->where('id',$row->item_no)->get()->row();
                             $stocks = $row_mats->stocks + $row->qty;
                             $this->db->where('id',$row_mats->id);
                             $this->db->update('tbl_other_materials',array('stocks'=>$stocks));

                        }
                        
                     }
                    return 'Purchased item completed';
                }else{
                    return false;
                }
        }else{
             return false;
        }

    }
    function Update_Approval_SalesOrder_Accounting($id,$status,$table){
        if($status == 'approve'){
            $status_update = 'A';
            $delivery=1;
        }else{
            $status_update ='C';
            $delivery = 0;
        }
        $result = $this->db->where('id',$this->encryption->decrypt($id))->update($table,array('status'=>$status_update,'delivery'=>$delivery,'latest_update'=>date('Y-m-d H:i:s'),'update_by'=>$this->user_id));
        if($result){
            if($status == 'approve'){
                 return array('type'=>'success','message'=>'SOA form approved');
            }else{
                 return array('type'=>'error','message'=>'SOA form canclled');
            }
        }else{
            return false;
        }
    }
    function Update_Sales_Delivery_Receipt_Superuser($id,$status,$remarks){
        $id = $this->encryption->decrypt($id);
        $row = $this->db->select('*')->from('tbl_sales_delivery_header')->where('id',$id)->get()->row();
        if($row){
            $result = $this->db->where('id',$id)->update('tbl_sales_delivery_header',array('status'=>$status,'remarks'=>$remarks,'latest_update'=>date('Y-m-d H:i:s'),'update_by'=>$this->user_id));
            if($result){
                if($status == 'TO-SHIP'){
                     return array('type'=>'success','message'=>'Move to ship','status'=>$status);
                }else if($status == 'CANCELLED'){
                     return array('type'=>'error','message'=>'D.R form canclled','status'=>$status);
                }else if($status == 'TO-RECEIVED'){
                     return array('type'=>'success','message'=>'Move to received','status'=>$status);
                }else if($status == 'COMPLETED'){
                    if($row->type == 1){
                        $row_p = $this->db->select('*,sum(quantity) as qty')->from('tbl_sales_delivery_item')->where('dr_no',$id)->get()->row();
                        if($row_p){
                            $row_s = $this->db->select('*')->from('tbl_project_color')->where('id',$row_p->c_code)->get()->row();
                            if($row_s){
                                $stocks = $row_s->stocks+$row_p->qty;
                                $this->db->where('id',$row_s->id)->update('tbl_project_color',array('stocks'=>$stocks));
                            }
                        }

                    }
                    return array('type'=>'success','message'=>'D.R is successfully delivered','status'=>$status);
                }else{
                    return false;
                }
            }else{
                    return false;
            }
        }else{
           return false; 
        }
    }

     function Update_Salesorder_Stocks_Accounting($id,$status,$remarks){
        $id = $this->encryption->decrypt($id);
        $row = $this->db->select('*')->from('tbl_salesorder_stocks')->where('id',$id)->get()->row();
        if($row){
            $result = $this->db->where('id',$id)->update('tbl_salesorder_stocks',array('status'=>$status,'remarks'=>$remarks,'latest_update'=>date('Y-m-d H:i:s'),'update_by'=>$this->user_id));
            if($result){
                if($status == 'APPROVED'){
                     return array('type'=>'success','message'=>'Move to approved','status'=>$status);
                }else if($status == 'CANCELLED'){
                     return array('type'=>'error','message'=>'S.O form canclled','status'=>$status);
                }else if($status == 'COMPLETED'){
                     $dis = 0;

                     $subtotal = $this->db->select('sum(amount) as amount')->from('tbl_salesorder_stocks_item')->where('so_no',$row->id)->get()->row();
                    if($row->discount !=0){
                        $dis = floatval($row->discount/100);
                    }
                    $discount = $subtotal->amount*$dis;
                    $subtotals = $subtotal->amount-$discount;
                    if($row->vat==1){
                        $vat = $subtotal->amount*0.12;
                        $total_amount = floatval($subtotals - $row->downpayment + $row->shipping_fee + $vat);
                    }else{
                        $vat = 0;
                        $total_amount = floatval($subtotals - $row->downpayment + $row->shipping_fee); 
                    }

                    $this->db->insert('tbl_salesorder_completed',array('so_no'=>$row->so_no,'customer'=>$row->customer,'discount'=>$row->discount,'downpayment'=>$row->downpayment,'shipping_fee'=>$row->shipping_fee,'vat'=>$vat,'subtotal'=>$subtotal->amount,'total_amount'=>$total_amount,'date_order'=>$row->date_order,'date_downpayment'=>$row->date_downpayment));
                    if($row->downpayment !=0){
                        $this->db->insert('tbl_sales_collection',array('so_no'=>$row->so_no,'customer'=>$row->customer,'amount'=>$row->downpayment,'date_collect'=>$row->date_downpayment));
                    }
                    return array('type'=>'success','message'=>'Move to completed','status'=>$status);
                }else{
                    return false;
                }
            }else{
                    return false;
            }
        }else{
           return false; 
        }
    }
     function Update_Salesorder_Project_Accounting($id,$status,$remarks){
        $id = $this->encryption->decrypt($id);
        $row = $this->db->select('*')->from('tbl_salesorder_project')->where('id',$id)->get()->row();
        if($row){
            $result = $this->db->where('id',$id)->update('tbl_salesorder_project',array('status'=>$status,'remarks'=>$remarks,'latest_update'=>date('Y-m-d H:i:s'),'update_by'=>$this->user_id));
            if($result){
                if($status == 'APPROVED'){
                     return array('type'=>'success','message'=>'Move to approved','status'=>$status);
                }else if($status == 'CANCELLED'){
                     return array('type'=>'error','message'=>'S.O form canclled','status'=>$status);
                }else if($status == 'COMPLETED'){
                    $dis=0;
                    $lineup = json_decode($row->item,true);
                    $data_array['item'] = $lineup;
                    $subtotal = array_sum(array_column($lineup,'amount'));
                    if($row->discount !=0){
                        $dis = floatval($row->discount/100);
                    }
                    $discount = $subtotal*$dis;
                    $subtotal_grand = $subtotal-$discount;
                    if($row->vat==1){
                        $vat = $subtotal*0.12;
                        $total_amount = floatval($subtotal_grand - $row->downpayment + $row->shipping_fee + $vat);
                    }else{
                        $vat = 0;
                        $total_amount = floatval($subtotal_grand - $row->downpayment + $row->shipping_fee); 
                    }

                     $this->db->insert('tbl_salesorder_completed',array('so_no'=>$row->so_no,'customer'=>$row->customer,'discount'=>$discount,'downpayment'=>$row->downpayment,'shipping_fee'=>$row->shipping_fee,'vat'=>$vat,'subtotal'=>$subtotal,'total_amount'=>$total_amount,'date_order'=>$row->date_order,'date_downpayment'=>$row->date_downpayment));
                     if($row->downpayment !=0){
                        $this->db->insert('tbl_sales_collection',array('so_no'=>$row->so_no,'customer'=>$row->customer,'amount'=>$row->downpayment,'date_collect'=>$row->date_downpayment));
                    }
                     return array('type'=>'success','message'=>'Move to completed','status'=>$status);
                }else{
                    return false;
                }
            }else{
                    return false;
            }
        }else{
           return false; 
        }
    }
    function Update_Cashposition_Category($id,$name){
        $id = $this->encryption->decrypt($id);
        $result = $this->db->where('id',$id)->update('tbl_category_income',array('name'=>$name));
        if($result){
            return array('type'=>'success','message'=>"Save Changes");
        }else{
            return array('type'=>'info','message'=>"Nothing Changes");
        }
    }
}
?>
