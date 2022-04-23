<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update_controller extends CI_Controller 
{ 
    public function __construct()
    {
      parent::__construct();
      $this->load->model('update_model');
    }

    //Update Data
    public function Update_SalesOrder(){
      $so_no        = $this->input->post('so_no');
      $project_no   = $this->input->post('project_no');
      $c_code       = $this->input->post('c_code');
      $price        = $this->input->post('price');
      $qty          = $this->input->post('quantity');
      $b_address    = $this->input->post('b_address');
      $b_city       = $this->input->post('b_city');
      $b_province   = $this->input->post('b_province');
      $b_zipcode    = $this->input->post('b_zipcode');
      $s_address    = $this->input->post('s_address');
      $s_city       = $this->input->post('s_city');
      $s_province   = $this->input->post('s_province');
      $s_zipcode    = $this->input->post('s_zipcode');

      $b_address = strtoupper($b_address);
      $b_city = strtoupper($b_city);
      $b_province = strtoupper($b_province);

      $s_address = strtoupper($s_address);
      $s_city = strtoupper($s_city);
      $s_province = strtoupper($s_province);
      $this->update_model->Update_SalesOrder($so_no,$project_no,$c_code,$price,$qty,$b_address,$b_city,$b_province,$b_zipcode,$s_address,$s_city,$s_province,$s_zipcode);
      $data = array('status' => 'success');
      echo json_encode($data); 
    }

     public function Update_Rawmats_Stocks(){
        $status = $this->input->post('status');
        $id = $this->input->post('id');
        $stocks = $this->input->post('stocks');
        $stocks_alert = $this->input->post('stocks_alert');
        $data = $this->update_model->Update_Rawmats_Stocks($id,$stocks,$status,$stocks_alert);
        echo json_encode($data); 
     }
     public function Update_Other_Materials_Stocks(){
        $user_id = $this->session->userdata('id');
        $status = $this->input->post('status');
        $id = $this->input->post('id');
        $stocks = $this->input->post('stocks');
        $stocks_alert = $this->input->post('stocks_alert');
        $data = $this->update_model->Update_Other_Materials_Stocks($user_id,$id,$stocks,$status,$stocks_alert);
        echo json_encode($data); 
     }
     public function Update_Release_SalesOrder(){
        $user_id = $this->session->userdata('id');
        $so_no = $this->input->post('so_no');
        $si_no = $this->input->post('si_no');
        $this->update_model->Update_Release_SalesOrder($user_id,$so_no,$si_no);
        $data = array('status' => 'success');
        echo json_encode($data); 
     }
     public function Update_Users(){
        $status = $this->input->post('status');
        $id = $this->input->post('id');
        $username = $this->input->post('username');
        $firstname = strtoupper($this->input->post('firstname'));
        $lastname = strtoupper($this->input->post('lastname'));
        $middlename = strtoupper($this->input->post('middlename'));
        $voucher = $this->input->post('voucher');
        $designer = $this->input->post('designer');
        $production = $this->input->post('production');
        $supervisor = $this->input->post('supervisor');
        $superuser = $this->input->post('superuser');
        $admin = $this->input->post('admin');
        $accounting = $this->input->post('accounting');
        $webmodifier = $this->input->post('webmodifier');
        $sales = $this->input->post('sales');
        $this->update_model->Update_Users($id,$firstname,$lastname,$middlename,$username,$status,$designer,$production,$supervisor,$superuser,$admin,$accounting,$webmodifier,$sales,$voucher);
        $data = array('status' => 'success');
        echo json_encode($data); 
     }
    public function Update_Profile(){
        error_reporting(0);
        $id = $this->session->userdata('id');
        $data = $this->input->post('data');
        $action = $this->input->post('action');
        $data = $this->update_model->Update_Profile($id,$data,$action);
        echo json_encode($data); 
     }
     public function Update_ChangePassword(){
        $id = $this->session->userdata('id');
        $password = $this->input->post('password');
        $this->update_model->Update_ChangePassword($id,$password);
     }
     public function Update_Approval_Design(){
        $user_id = $this->session->userdata('id');
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $this->update_model->Update_Approval_Design($user_id,$id,$status);
        $data = array('status' => $status);
        echo json_encode($data); 
     }
    public function Update_Design_Stocks(){
       $user_id = $this->session->userdata('id');
       $id = isset($_POST['id'])? $this->input->post('id'): false;
       $title = isset($_POST['title'])? $this->input->post('title'): false;
       $c_name = isset($_POST['c_name'])? $this->input->post('c_name'): false;
       $image  =  isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"]: false;
       $tmp    =  isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"]:false;
       $image      =  isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"]: false;
       $tmp        =  isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"]:false;
       $path_image = "assets/images/design/project_request/images/";
       $color_image =  isset($_FILES["color"]["name"]) ? $_FILES["color"]["name"]: false;
       $color_tmp   =  isset($_FILES["color"]["tmp_name"]) ? $_FILES["color"]["tmp_name"]:false;
       $path_color  =  "assets/images/palettecolor/";
       $docs       =  isset($_FILES["docs"]["name"]) ? $_FILES["docs"]["name"]:false;
       $docs_tmp   =  isset($_FILES["docs"]["tmp_name"]) ? $_FILES["docs"]["tmp_name"]:false;
       $path_docs  =  "assets/images/design/project_request/docx/";

       $image_previous = isset($_POST['image_previous'])? $this->input->post('image_previous'): false;
       $color_previous = isset($_POST['color_previous'])? $this->input->post('color_previous'): false;
       $docs_previous = isset($_POST['docs_previous'])? $this->input->post('docs_previous'): false;

       $data = $this->update_model->Update_Design_Stocks($user_id,$id,$title,$c_name,$image,$tmp,$path_image,$color_image,$color_tmp,$path_color,$docs,$docs_tmp,$path_docs,$image_previous,$color_previous,$docs_previous);
        echo json_encode($data);
     }
     public function Update_Design_Project(){
       $user_id = $this->session->userdata('id');
       $id = isset($_POST['id'])? $this->input->post('id'): false;
       $title = isset($_POST['title'])? $this->input->post('title'): false;
       $image  =  isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"]: false;
       $tmp    =  isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"]:false;
       $image      =  isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"]: false;
       $tmp        =  isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"]:false;
       $path_image = "assets/images/design/project_request/images/";
       $docs       =  isset($_FILES["docs"]["name"]) ? $_FILES["docs"]["name"]:false;
       $docs_tmp   =  isset($_FILES["docs"]["tmp_name"]) ? $_FILES["docs"]["tmp_name"]:false;
       $path_docs  =  "assets/images/design/project_request/docx/";

       $image_previous = isset($_POST['image_previous'])? $this->input->post('image_previous'): false;
       $docs_previous = isset($_POST['docs_previous'])? $this->input->post('docs_previous'): false;

       $data = $this->update_model->Update_Design_Project($user_id,$id,$title,$image,$tmp,$path_image,$docs,$docs_tmp,$path_docs,$image_previous,$docs_previous);
        echo json_encode($data);
     }
    public function Update_Joborder_Pending(){
        $user_id = $this->session->userdata('id');
        $production_no = $this->input->post('production_no');
        $production = $this->input->post('production');
        $mat_item = $this->input->post('mat_item');            
        $mat_quantity = $this->input->post('mat_quantity');
        $mat_unit = $this->input->post('mat_unit');
        $mat_remarks = $this->input->post('mat_remarks');
        $mat_type = $this->input->post('mat_type');
        $mat_itemno = $this->input->post('mat_itemno');
        $pur_item = $this->input->post('pur_item');
        $pur_quantity = $this->input->post('pur_quantity');
        $pur_unit = $this->input->post('pur_unit');
        $pur_remarks = $this->input->post('pur_remarks');
        $pur_type = $this->input->post('pur_type');
        $this->update_model->Update_Joborder_Pending($user_id,$production_no,$production,$mat_type,$mat_itemno,$mat_item,$mat_quantity,$mat_unit,$mat_remarks,$pur_item,$pur_quantity,$pur_unit,$pur_remarks,$pur_type);
        $data = array(
            'status' => 'success'
        );
        echo json_encode($data);
    }
    public function Update_Return_Item(){
         $user_id = $this->session->userdata('id');
         $id = $this->input->post('id');
         $this->update_model->Update_Return_Item($user_id,$id);
         $data = array('id' => $id,'status' => 'success');
         echo json_encode($data);
    }

     public function Update_Production(){
        $id = $this->input->post('id');
        $stocks = $this->input->post('stocks');
        $data = $this->update_model->Update_Production($id,$stocks);
        echo json_encode($data);
     }
     public function Update_RawMaterial(){
        $user_id = $this->session->userdata('id');
        $id = $this->input->post('id');
        $item = strtoupper($this->input->post('item_update'));
        $unit = $this->input->post('unit');
        $status = $this->input->post('status');
        $price = floatval(preg_replace('/[^\d.]/', '',  $this->input->post('price')));
        $this->update_model->Update_RawMaterial($user_id,$id,$item,$status,$price,$unit);
        $data = array('status' => 'success');
        echo json_encode($data);
     }
     public function Update_Other_Materials(){
        $user_id = $this->session->userdata('id');
        $id = $this->input->post('id');
        $item = strtoupper($this->input->post('item_update'));
        $status = $this->input->post('status');
        $data = $this->update_model->Update_Other_Materials($user_id,$id,$item,$status);
        echo json_encode($data);
     }
  
     public function Update_OfficeSupplies_Request(){
        $user_id = $this->session->userdata('id');
        $status = $this->input->post('status');
        $request_id = $this->input->post('request_id');
        $item = $this->input->post('item');
        $balance = $this->input->post('balance');
        $id = $this->input->post('id');
        $this->update_model->Update_OfficeSupplies_Request($user_id,$request_id,$item,$balance,$status,$id);
        $data = array('status' => 'success');
        echo json_encode($data);    
     }
     public function Update_SpareParts_Request(){
        $user_id = $this->session->userdata('id');
        $status = $this->input->post('status');
        $request_id = $this->input->post('request_id');
        $item = $this->input->post('item');
        $balance = $this->input->post('balance');
        $id = $this->input->post('id');
        $this->update_model->Update_SpareParts_Request($user_id,$request_id,$item,$balance,$status,$id);
        $data = array('status' => 'success');
        echo json_encode($data);    
     }
    public function Update_Purchase_Delivery(){
          $user_id = $this->session->userdata('id');
          $id = $this->input->post('id');
          $deliver_no = $this->input->post('deliver_no');
          $status = $this->input->post('status');
          $item = $this->input->post('item');
          $balance_quanity = $this->input->post('balance_quanity');
          $received = $this->input->post('received');
          $this->update_model->Update_Purchase_Delivery_Material($user_id,$id,$deliver_no,$status,$item,$balance_quanity,$received);
          $data = array('status' => 'success');
          echo json_encode($data);  
     }
     public function Update_Purchase_Delivery_Stocks(){
          $user_id = $this->session->userdata('id');
          $id = $this->input->post('id');
          $deliver_no = $this->input->post('deliver_no');
          $status = $this->input->post('status');
          $item = $this->input->post('item');
          $balance_quanity = $this->input->post('balance_quanity');
          $received = $this->input->post('received');
          $query = $this->db->select('*')->from('tbl_purchase_stocks_delivery')->where('id',$id)->get();
          $row = $query->row(); 
          if($row->type == 'rawmats'){
             $this->update_model->Update_Purchase_Delivery_Rawmat($user_id,$id,$deliver_no,$status,$item,$balance_quanity,$received);
          }else if($row->type == 'office'){
            $this->update_model->Update_Purchase_Delivery_Office($user_id,$id,$deliver_no,$status,$item,$balance_quanity,$received);
          }else if($row->type == 'production'){
            $this->update_model->Update_Purchase_Delivery_Spare($user_id,$id,$deliver_no,$status,$item,$balance_quanity,$received);
          }
          $data = array('status' => 'success');
          echo json_encode($data);  
     }
      public function Update_SupplierItem(){
        $user_id = $this->session->userdata('id');
        $id = $this->input->post('id');
        $price = $this->input->post('price');
        $status = $this->input->post('status');
        $data = $this->update_model->Update_SupplierItem($user_id,$id,$price,$status);         
        echo json_encode($data); 
     }
    public function Update_Supplier(){  
        $user_id = $this->session->userdata('id');
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $mobile = $this->input->post('mobile');
        $email = $this->input->post('email');
        $facebook = $this->input->post('facebook');
        $website = $this->input->post('website');
        $address = $this->input->post('address');
        $status = $this->input->post('status');
        $data = $this->update_model->Update_Supplier($user_id,$id,$name,$mobile,$email,$facebook,$website,$address,$status);
        echo json_encode($data);
     }
    public function Update_Material_Request_Process(){
        $user_id = $this->session->userdata('id');
        $id = $this->input->post('id');
        $total = $this->input->post('total');
        $request = $this->input->post('request');
        $type = $this->input->post('type');
        $data = $this->update_model->Update_Material_Request_Process($user_id,$id,$total,$request,$type);
        echo json_encode($data);    
     }
     public function Update_Material_Request_Process_Status(){
        $user_id = $this->session->userdata('id');
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $data = $this->update_model->Update_Material_Request_Process_Status($user_id,$id,$status);
        echo json_encode($data);    
     }

     //APPROVAL
    public function Update_Approval_Customization(){
        $user_id = $this->session->userdata('id');
        $status = $this->input->post('status');
        $id = $this->input->post('id');
        $this->update_model->Update_Approval_Customization($user_id,$id,$status);
        $data = array(
            'status' => 'success'
        );
        echo json_encode($data);
    }
    public function Update_Material_Request_Approval(){
        $user_id = $this->session->userdata('id');
        $status = $this->input->post('status');
        $production_no = $this->input->post('production_no');
        $this->update_model->Update_Material_Request_Approval($user_id,$production_no,$status);
        $data = array('status' => $status);
        echo json_encode($data);    
     }
     public function Update_Approval_Purchase(){
        $user_id = $this->session->userdata('id');
        $status =  $this->input->post('status');
        $production_no = $this->input->post('production_no');
        $this->update_model->Update_Approval_Purchase($user_id,$production_no,$status);
        $data = array(
            'status' => $status
        );
        echo json_encode($data);    
     }
      public function Update_Approval_Inspection(){
        $user_id = $this->session->userdata('id');
        $status = $this->input->post('status');
        $production_no = $this->input->post('production_no');
        $remarks = $this->input->post('remarks');
        $return = $this->update_model->Update_Approval_Inspection($user_id,$production_no,$status,$remarks);
        $data = array('status' => $return);
        echo json_encode($data);    
     }
     public function Update_Approval_SalesOrder(){
        $user_id = $this->session->userdata('id');
        $status = $this->input->post('status');
        $so_no = $this->input->post('so_no');
        $this->update_model->Update_Approval_SalesOrder($user_id,$so_no,$status);
        $data = array(
            'status' => $status
        );
        echo json_encode($data);    
     }
     public function Update_Approval_Users(){
      $user_id = $this->session->userdata('id');
      $status = $this->input->post('status');
      $id = $this->input->post('id');
      $this->update_model->Update_Approval_Users($user_id,$status,$id);
      $data = array('status' => $status);
       echo json_encode($data); 
     }
       public function Update_Approval_OnlineOrder(){
        $user_id = $this->session->userdata('id');
        $status = $this->input->post('status');
        $order_no = $this->input->post('order_no');
        $this->update_model->Update_Approval_OnlineOrder($user_id,$order_no,$status);
        $data = array('status' => $status);
        echo json_encode($data);    
     }
     public function Update_Approval_Concern(){
         $user_id = $this->session->userdata('id');
         $id = $this->input->post('id');
         $action = $this->input->post('action');
         $data = $this->update_model->Update_Approval_Concern($user_id,$id,$action);
         echo json_encode($data); 
     }

     //ACCOUNTING
     public function Update_Accounting_Purchase_Stocks_Request(){
         $user_id = $this->session->userdata('id');
         $fund_no = $this->input->post('fund_no');
         $cash = floatval(str_replace(',', '', $this->input->post('cash')));
         $data = $this->update_model->Update_Accounting_Purchase_Stocks_Request($user_id,$fund_no,$cash);
         echo json_encode($data); 
     }
     public function Update_Accounting_Purchase_Material_Stocks_Approved(){
         $user_id   = $this->session->userdata('id');
         $fund_no   = $this->input->post('fund_no');
         $previous  = $this->input->post('previous');
         $cash      = floatval(str_replace(',', '', $this->input->post('cash')));
         $status = $this->update_model->Update_Accounting_Purchase_Material_Stocks_Approved($user_id,$fund_no,$cash);
         $data = array(
            'previous' => $previous,
            'cash'     => $this->input->post('cash'),
            'fund_no'  => $fund_no,
            'status'   => $status);
         echo json_encode($data); 
     }
     public function Update_Accounting_Purchase_Stocks_Received(){
         $user_id = $this->session->userdata('id');
         $fund_no = $this->input->post('fund_no');
         $refund  = floatval(str_replace(',', '', $this->input->post('refund')));
         $change  = floatval(str_replace(',', '', $this->input->post('change')));
         $total   = floatval(str_replace(',', '', $this->input->post('total')));
         $status  = $this->update_model->Update_Accounting_Purchase_Stocks_Received($user_id,$fund_no,$change,$refund,$total);
         $data = array(
            'refund'   => number_format($refund,2),
            'change'   => number_format($change,2),
            'fund_no'  => $fund_no,
            'status'   => $status);
         echo json_encode($data); 
     }


     //Web Modifier
    public function Update_Web_Banner(){
        $user_id = $this->session->userdata('id');
        $id = isset($_POST['id']) ? $this->input->post('id'):false; 
        $image =  isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"]: false;
        $tmp   = isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"]:false;
        $path_image =  "assets/images/banner/";
        $previous =  isset($_POST['previous_image']) ? $this->input->post('previous_image'):false;
        $type = isset($_POST['type']) ? $this->input->post('type'):false;
        $data = $this->update_model->Update_Web_Banner($user_id,$id,$type,$image,$tmp,$path_image,$previous);
        echo json_encode($data);
     }
     public function Update_Web_Category(){
        $cat_id = $this->input->post('cat_id');
        $status = $this->input->post('status');
        $this->update_model->Update_Web_Category($cat_id,$status);
        $data = array('status'=>'success');
        echo json_encode($data);
     }
     public function Update_Web_SubCategory(){
        $cat_id = $this->input->post('cat_id');
        $sub_id = $this->input->post('sub_id');
        $sub_name = $this->input->post('sub_name');
        $data = $this->update_model->Update_Web_SubCategory($cat_id,$sub_name,$sub_id);
        $data = array('status' => $data);
        echo json_encode($data);
     }
     public function Update_Web_ProductSub(){
        $cat_id = $this->input->post('cat_id');
        $sub_id = $this->input->post('sub_id');
        $project_no = $this->input->post('project_no');
        $data = $this->update_model->Update_Web_ProductSub($cat_id,$project_no,$sub_id);
        $data = array('status' => $data,
                      'id'     => $project_no);
        echo json_encode($data);
     }
     public function Update_Shipping_Range(){
        $id = $this->input->post('id');
        $fee = $this->input->post('fee');
        $this->update_model->Update_Shipping_Range($id,$fee);
        $data = array('status' => 'success','id' => $id,'fee'=>$fee);
        echo json_encode($data);
     }
      public function Update_Web_Interior(){
        $banner_image =  isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"]: false;
        $banner_tmp  =  isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"]:false;
        $bg_image  =  isset($_FILES["bg_image"]["name"]) ? $_FILES["bg_image"]["name"]: false;
        $bg_tmp    =  isset($_FILES["bg_image"]["tmp_name"]) ? $_FILES["bg_image"]["tmp_name"]:false;
        $path_image = "assets_website/images/";
        $previous_banner = $this->input->post('previous_image');
        $previous_bg = $this->input->post('previous_bg');
        $user_id = $this->session->userdata('id');
        $id = $this->input->post('id');
        $title = $this->input->post('title');
        $titles = str_replace(' ','',$title);
        $cat_id = $this->input->post('cat_id');
        $description = $this->input->post('description');
        $status = $this->input->post('status');
        $data = $this->update_model->Update_Web_Interior($user_id,$title,$cat_id,$description,$id,$status,$banner_image,$banner_tmp,$bg_image,$bg_tmp,$path_image,$previous_banner,$previous_bg);
        echo json_encode($data);
     }
     public function Update_Web_Events(){
        error_reporting(0);
        $user_id = $this->session->userdata('id');
        $id = $this->input->post('id');
        $title = $this->input->post('title');
        $titles = str_replace(' ','',$title);
        $date_event = $this->input->post('date_event');
        $time_event = $this->input->post('time_event');
        $location = $this->input->post('location');
        $status = $this->input->post('status');
        $description = $this->input->post('description');

        if($_FILES['image']['size']>0){
          $filename=$_FILES["image"]["name"];
          $extension=end(explode(".", $filename));
          $newfilename=$titles.".".$extension;
          $destination = $_FILES['image']['tmp_name'];
          $destination2 = "assets_website/images/".$newfilename;
          copy($destination, $destination2);
          $image=$newfilename;
        }else{
          $image=$this->input->post('previous_image');
        }
        $this->update_model->Update_Web_Events($user_id,$title,$status,$description,$image,$id,$date_event,$time_event,$location);
        $data = array('status' => 'success');
        echo json_encode($data);
     }

     //sales
     public function Update_OnlineOrder(){
        $action         = $this->input->post('action');
        $order_no       = isset($_POST['order_no']) ? $this->input->post('order_no'): false;
        $item_id        = isset($_POST['item_id']) ? $this->input->post('item_id'): false;
        $qty            = isset($_POST['qty']) ? $this->input->post('qty'): false;
        $type           = isset($_POST['type']) ? $this->input->post('type'): false;
        $vat            = isset($_POST['vat']) ? $this->input->post('vat'): false;
        $downpayment    = isset($_POST['downpayment']) ? floatval(str_replace(',', '', $this->input->post('downpayment'))): false;
        $shipping_fee   = isset($_POST['shipping_fee']) ? floatval(str_replace(',', '', $this->input->post('shipping_fee'))): false;
        $price          = isset($_POST['price']) ? floatval(str_replace(',', '', $this->input->post('price'))): false;
        if($action =='vat'){
            $data = array('status' => 'success');
        }else if($action == 'downpayment'){
            $data = array('status' => 'success');
        }else if($action == 'shipping'){
            $data = array('status' => 'success');
        }else if($action == 'SAVED'){
            $data = array('status'  => 'success1','item_id'=> $item_id,'price'=> $this->input->post('price'),'qty' => $qty,'type'=> $type);
        }else if($action == 'REQUEST'){
            $data = array('status'  => 'REQUEST','item_id'  => $item_id,'type' => 'REQUEST');
        }else if($action == 'CANCELLED'){
            $data = array('status'  => 'CANCELLED','item_id'  => $item_id,'type' => 'CANCELLED');
        }else if($action == 'DESIGNER_APPROVED'){
            $data = array('status'  => 'APPROVED');
        }else if($action == 'READY'){
            $data = array('status'  => 'APPROVED');
        }else if($action == 'In Stocks'){
            $data = array('status'  => 'REQUEST','item_id'  => $item_id,'type' => 'In Stocks');
        }
        $this->update_model->Update_OnlineOrder($action,$downpayment,$order_no,$item_id,$price,$qty,$shipping_fee,$vat);
        echo json_encode($data);
     }
      public function Update_Web_Voucher(){
       $voucher = $this->input->post('voucher');
       $discount = $this->input->post('discount');
       $date_from = $this->input->post('date_from');
       $date_to = $this->input->post('date_to');
       $this->update_model->Update_Web_Voucher($voucher,$discount,$date_from,$date_to);
        $data = array('status'=>'success');
        echo json_encode($data);
     }
     public function Update_Vouncher_Customer(){
         $user_id = $this->session->userdata('id');
         $voucher = $this->input->post('voucher');
         $id = $this->input->post('id');
         $this->update_model->Update_Vouncher_Customer($voucher,$id,$user_id);
         $query_user = $this->db->select('*,CONCAT(firstname, " ",lastname) AS user')->from('tbl_users')->where('id',$user_id)->get();
         $row_user = $query_user->row();
         $data = array('status'=>'success',
                       'id' => $id,
                       'username'=> $row_user->user);
         echo json_encode($data);
     }
     public function Update_Deposit_Approved(){
        $id = $this->input->post('id');
        $data= $this->update_model->Update_Deposit_Approved($id);
        echo json_encode($data);
     }
    public function Update_Customer(){
       $user_id      = $this->session->userdata('id');
       $id    = isset($_POST['id'])    ? $this->input->post('id'): false;
       $firstname    = isset($_POST['firstname'])    ? $this->input->post('firstname'): false;
       $lastname     = isset($_POST['lastname'])    ? $this->input->post('lastname'): false;
       $mobile       = isset($_POST['mobile'])    ? $this->input->post('mobile'): false;
       $email        = isset($_POST['email'])    ? $this->input->post('email'): false;
       $address      = isset($_POST['address'])    ? $this->input->post('address'): false;
       $city         = isset($_POST['city'])    ? $this->input->post('city'): false;
       $province     = isset($_POST['province'])    ? $this->input->post('province'): false;
       $region       = isset($_POST['region'])    ? $this->input->post('region'): false;
       $data         = $this->update_model->Update_Customer($user_id,$id,$firstname,$lastname,$mobile,$email,$address,$city,$province,$region);
       $status       = array('status' => $data);
       echo json_encode($status);
    }
    public function Update_Purchase_Status_Request_Supervisor(){
        $user_id  = $this->session->userdata('id');
        $id = $this->input->post('id');
        $data = $this->update_model->Update_Purchase_Status_Request_Supervisor($user_id,$id);
        echo json_encode($data);
    }
    public function Update_Material_Status_Request_Supervisor(){
        $user_id  = $this->session->userdata('id');
        $id = $this->input->post('id');
        $qty = $this->input->post('qty');
        $data = $this->update_model->Update_Material_Status_Request_Supervisor($user_id,$id,$qty);
        echo json_encode($data);
    }
    public function Update_Material_Used_Lock_Request_Supervisor(){
        $user_id  = $this->session->userdata('id');
        $id = $this->input->post('id');
        $data = $this->update_model->Update_Material_Used_Lock_Request_Supervisor($user_id,$id);
        echo json_encode($data);
    }
    public function Update_Material_Used_Status_Request_Supervisor(){
        $user_id  = $this->session->userdata('id');
        $id = $this->input->post('id');
        $qty = $this->input->post('qty');
        $type = $this->input->post('type');
        $data = $this->update_model->Update_Material_Used_Status_Request_Supervisor($user_id,$id,$qty,$type);
        echo json_encode($data);
    }
    public function Update_Material_Request_Supervisor(){
        $user_id  = $this->session->userdata('id');
        $id = $this->input->post('id');
        $qty = $this->input->post('qty');
        $type = $this->input->post('type');
        $data = $this->update_model->Update_Material_Request_Supervisor($user_id,$id,$qty,$type);
        echo json_encode($data);
    }
    public function Update_Purchase_Request_Supervisor(){
        $user_id  = $this->session->userdata('id');
        $id = $this->input->post('id');
        $qty = $this->input->post('qty');
        $remarks = $this->input->post('remarks');
        $data = $this->update_model->Update_Purchase_Request_Supervisor($user_id,$id,$qty,$remarks);
        echo json_encode($data);
    }



    public function Update_Project_Monitoring(){
        $user_id  = $this->session->userdata('id');
        $id = isset($_POST['id'])  ? $this->input->post('id'): false;
        $data = isset($_POST['data'])  ? $this->input->post('data'): false;
        $action = isset($_POST['action'])  ? $this->input->post('action'): false;
        $start = isset($_POST['start'])  ? $this->input->post('start'): false;
        $due = isset($_POST['due'])  ? $this->input->post('due'): false;
        $data = $this->update_model->Update_Project_Monitoring($user_id,$id,$data,$action,$start,$due);
        echo json_encode($data);
    }
    public function Update_Cash_Position(){
       $user_id = $this->session->userdata('id');
       $id = isset($_POST['id'])? $this->input->post('id'): false;
       $data = isset($_POST['data'])?$this->input->post('data'): false;
       $action = isset($_POST['action'])? $this->input->post('action'): false;
       if($action == 'category' || $action == 'type'){
            $data_response = $this->update_model->Update_Cash_Position($user_id,$id,$action,$data);
            echo json_encode($data_response);
       }else{
           $row = isset($_POST['row'])? $this->input->post('row'): false;
           $col = isset($_POST['col'])? $this->input->post('col'): false;
           $data_response = $this->update_model->Update_Cash_Position($user_id,$id,$action,$data);
           if($action == 'date_position'){
              $message = date('M - j',strtotime($data));
              $date = date('m/d/Y',strtotime($data));
           }else if($action == 'amount'){
              $message = number_format(floatval(str_replace(',', '', $data)),2);
           }else{
              $message = $data;
           }
           $data_message = array('status' => $data_response,
                                 'action' => $action,
                                 'message'=> $message,
                                 'date'   => $date,
                                 'col'    => $col+1,
                                 'row'    => $row+1);
           echo json_encode($data_message);
       }

      
    }
     public function Update_Web_Testimony(){
       $user_id = $this->session->userdata('id');
       $id = isset($_POST['id'])? $this->input->post('id'): false;
       $name = isset($_POST['name'])? $this->input->post('name'): false;
       $description = isset($_POST['description'])? $this->input->post('description'): false;
       $image      =  isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"]: false;
       $tmp        =  isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"]:false;
       $path_image =  "assets/images/testimony/";
       $previous = isset($_POST['previous'])? $this->input->post('previous'): false;
       $data = $this->update_model->Update_Web_Testimony($user_id,$name,$description,$image,$tmp,$path_image,$previous,$id);
       echo json_encode($data);
    }
      public function Update_Web_Company_Profile(){
        $data = $this->input->post('data');
        $action = $this->input->post('action');
        $data = $this->update_model->Update_Web_Company_Profile($data,$action);
        echo json_encode($data);

     }
        public function Update_Web_Company_Image(){
        $image      =  isset($_FILES["file"]["name"]) ? $_FILES["file"]["name"]: false;
        $tmp        =  isset($_FILES["file"]["tmp_name"]) ? $_FILES["file"]["tmp_name"]:false;
        $path_image =  "assets/images/logo/";    
        $data = $this->update_model->Update_Web_Company_Image($image,$tmp,$path_image);
        echo json_encode($data);
     }
     public function Update_Web_About_Us(){
        $data = $this->input->post('data');
        $action = $this->input->post('action');
        $data = $this->update_model->Update_Web_About_Us($data,$action);
        echo json_encode($data);
     }
     public function Update_Web_Owner_Image(){
        $image      =  isset($_FILES["file"]["name"]) ? $_FILES["file"]["name"]: false;
        $tmp        =  isset($_FILES["file"]["tmp_name"]) ? $_FILES["file"]["tmp_name"]:false;
        $path_image =  "assets/images/avatar/";  
        $data = $this->update_model->Update_Web_Owner_Image($image,$tmp,$path_image);
        echo json_encode($data);
     }
     public function Update_Joborder_Status(){
        $user_id = $this->session->userdata('id');
        $production_no = $this->input->post('production_no');
        $qty = $this->input->post('qty');
        $status = $this->input->post('status');
        $type = $this->input->post('type');
        $data = $this->update_model->Update_Joborder_Status($user_id,$production_no,$qty,$status,$type);
        echo json_encode($data);
     }
     public function Update_Purchase_Stocks_Estimate(){
        $user_id = $this->session->userdata('id');
        $id = $this->input->post('id');
        $amount = $this->input->post('amount');
        $type = $this->input->post('type');
        $data = $this->update_model->Update_Purchase_Stocks_Estimate($user_id,$id,$amount,$type);
        echo json_encode($data);
     }
    public function Update_Purchase_Stocks_Process(){
        $user_id = $this->session->userdata('id');
        $joborder = $this->input->post('joborder');
        $pr_id = $this->input->post('pr_id');
        $item_id = $this->input->post('item_id');
        $quantity =$this->input->post('quantity');
        $amount = $this->input->post('amount');
        $supplier = $this->input->post('supplier');  
        $terms = $this->input->post('terms');   
        $type = $this->input->post('type');   
        $data = $this->update_model->Update_Purchase_Stocks_Process($user_id,$joborder,$pr_id,$item_id,$quantity,$amount,$supplier,$terms,$type);
        echo json_encode($data);  
     }
     public function Update_Joborder_Stocks(){
        $user_id = $this->session->userdata('id');
        $production_no = $this->input->post('production_no');
        $mat_itemno = $this->input->post('mat_itemno');            
        $mat_quantity = $this->input->post('mat_quantity');
        $mat_remarks = $this->input->post('mat_remarks');
        $mat_type = $this->input->post('mat_type');
        $mat_itemno = $this->input->post('mat_itemno');
        $pur_item = $this->input->post('pur_itemno');
        $pur_quantity = $this->input->post('pur_quantity');
        $pur_unit = $this->input->post('pur_unit');
        $pur_remarks = $this->input->post('pur_remarks');
        $pur_type = $this->input->post('pur_type');
        $this->update_model->Update_Joborder_Stocks($user_id,$production_no,$mat_type,$mat_itemno,$mat_quantity,$mat_remarks,$pur_item,$pur_quantity,$pur_remarks,$pur_type);
        $data = array('status' =>  'success');
        echo json_encode($data);
     }
     public function Update_Salesorder_Stock_Request(){
         $user_id = $this->session->userdata('id');
         $id = $this->input->post('id');
         $status = $this->input->post('status');
         $data = $this->update_model->Update_Salesorder_Stock_Request($user_id,$id,$status);
         echo json_encode($data);
     }
     public function Update_Salesorder_Project_Request(){
         $user_id = $this->session->userdata('id');
         $id = $this->input->post('id');
         $status = $this->input->post('status');
         $data = $this->update_model->Update_Salesorder_Project_Request($user_id,$id,$status);
         echo json_encode($data);
     }
     public function Update_Salesorder_Stock_Delivery(){
         $user_id = $this->session->userdata('id');
         $id = $this->input->post('id');
         $si_no = $this->input->post('si_no');
         $data = $this->update_model->Update_Salesorder_Stock_Delivery($user_id,$id,$si_no);
         echo json_encode($data);
     }
     public function Update_Salesorder_Project_Delivery(){
         $user_id = $this->session->userdata('id');
         $id = $this->input->post('id');
         $si_no = $this->input->post('si_no');
         $data = $this->update_model->Update_Salesorder_Project_Delivery($user_id,$id,$si_no);
         echo json_encode($data);
     }
     public function Update_Request_Materials(){
         $user_id = $this->session->userdata('id');
         $id = $this->input->post('id');
         $qty = $this->input->post('qty');
         $balance = $this->input->post('balance');
         $data = $this->update_model->Update_Request_Materials($user_id,$id,$qty,$balance);
         echo json_encode($data);
     }
     public function Update_Request_Materials_Cancelled(){
        $user_id = $this->session->userdata('id');
        $id = $this->input->post('id');
        $data = $this->update_model->Update_Request_Materials_Cancelled($user_id,$id);
        echo json_encode($data);
     }
     public function Update_Pre_Order_Request(){
        $user_id = $this->session->userdata('id');
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $data = $this->update_model->Update_Pre_Order_Request($user_id,$id,$status);
        echo json_encode($data);
     }
     public function Update_Customized_Request(){
        $user_id = $this->session->userdata('id');
        $id = $this->input->post('id');
        $subject = $this->input->post('subject');
        $description = $this->input->post('description');
        $data = $this->update_model->Update_Customized_Request($user_id,$id,$subject,$description);        
        echo json_encode($data); 
    }
    public function Update_Customized_Approval_Request(){
        $user_id = $this->session->userdata('id');
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $data = $this->update_model->Update_Customized_Approval_Request($user_id,$id,$status);
        echo json_encode($data);
     }
     public function Update_Approval_Inquiry(){
        $user_id = $this->session->userdata('id');
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $data = $this->update_model->Update_Approval_Inquiry($user_id,$id,$status);
        echo json_encode($data);
     }
     public function Update_Salesorder_Stocks(){
        $user_id = $this->session->userdata('id');
        $id = $this->input->post('id');
        $downpayment = floatval(str_replace(',', '', $this->input->post('downpayment')));
        $date_downpayment = $this->input->post('date_downpayment');
        $discount =  $this->input->post('discount');
        $shipping_fee = floatval(str_replace(',', '', $this->input->post('shipping_fee')));
        $vat =  $this->input->post('vat');
        $data = $this->update_model->Update_Salesorder_Stocks($user_id,$id,$downpayment,$date_downpayment,$discount,$shipping_fee,$vat);
        echo json_encode($data);
     }

}
?>
