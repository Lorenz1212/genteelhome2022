<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update_controller extends CI_Controller 
{ 
    public function __construct(){
      parent::__construct();
      $this->load->model('update_model');
    }
    //Update Data
     public function Update_Rawmats_Stocks(){
        $status = $this->input->post('status');
        $id = $this->input->post('id');
        $stocks = $this->input->post('stocks');
        $stocks_alert = $this->input->post('stocks_alert');
        $data = $this->update_model->Update_Rawmats_Stocks($id,$stocks,$status,$stocks_alert);
        echo json_encode($data); 
     }
     public function Update_Other_Materials_Stocks(){
        $status = $this->input->post('status');
        $id = $this->input->post('id');
        $stocks = $this->input->post('stocks');
        $stocks_alert = $this->input->post('stocks_alert');
        $data = $this->update_model->Update_Other_Materials_Stocks($id,$stocks,$status,$stocks_alert);
        echo json_encode($data); 
     }
     public function Update_Release_SalesOrder(){
        $so_no = $this->input->post('so_no');
        $si_no = $this->input->post('si_no');
        $this->update_model->Update_Release_SalesOrder($so_no,$si_no);
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
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $this->update_model->Update_Approval_Design($id,$status);
        $data = array('status' => $status);
        echo json_encode($data); 
     }
    public function Update_Design_Stocks(){
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

       $data = $this->update_model->Update_Design_Stocks($id,$title,$c_name,$image,$tmp,$path_image,$color_image,$color_tmp,$path_color,$docs,$docs_tmp,$path_docs,$image_previous,$color_previous,$docs_previous);
        echo json_encode($data);
     }
     public function Update_Design_Project(){
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

       $data = $this->update_model->Update_Design_Project($id,$title,$image,$tmp,$path_image,$docs,$docs_tmp,$path_docs,$image_previous,$docs_previous);
        echo json_encode($data);
     }
    public function Update_Joborder_Pending(){
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
        $this->update_model->Update_Joborder_Pending($production_no,$production,$mat_type,$mat_itemno,$mat_item,$mat_quantity,$mat_unit,$mat_remarks,$pur_item,$pur_quantity,$pur_unit,$pur_remarks,$pur_type);
        $data = array(
            'status' => 'success'
        );
        echo json_encode($data);
    }
    public function Update_Return_Item(){

         $id = $this->input->post('id');
         $this->update_model->Update_Return_Item($id);
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
        $id = $this->input->post('id');
        $item = $this->input->post('item');
        $unit = $this->input->post('unit');
        $status = $this->input->post('status');
        $price = floatval(preg_replace('/[^\d.]/', '',  $this->input->post('price')));
        $this->update_model->Update_RawMaterial($id,$item,$status,$price,$unit);
        $data = array('status' => 'success');
        echo json_encode($data);
     }
     public function Update_Other_Materials(){
        $id = $this->input->post('id');
        $item = $this->input->post('item_update');
        $status = $this->input->post('status');
        $data = $this->update_model->Update_Other_Materials($id,$item,$status);
        echo json_encode($data);
     }
  
     public function Update_OfficeSupplies_Request(){
        $status = $this->input->post('status');
        $request_id = $this->input->post('request_id');
        $item = $this->input->post('item');
        $balance = $this->input->post('balance');
        $id = $this->input->post('id');
        $this->update_model->Update_OfficeSupplies_Request($request_id,$item,$balance,$status,$id);
        $data = array('status' => 'success');
        echo json_encode($data);    
     }
     public function Update_SpareParts_Request(){
        $status = $this->input->post('status');
        $request_id = $this->input->post('request_id');
        $item = $this->input->post('item');
        $balance = $this->input->post('balance');
        $id = $this->input->post('id');
        $this->update_model->Update_SpareParts_Request($request_id,$item,$balance,$status,$id);
        $data = array('status' => 'success');
        echo json_encode($data);    
     }
    public function Update_Purchase_Delivery(){

          $id = $this->input->post('id');
          $deliver_no = $this->input->post('deliver_no');
          $status = $this->input->post('status');
          $item = $this->input->post('item');
          $balance_quanity = $this->input->post('balance_quanity');
          $received = $this->input->post('received');
          $this->update_model->Update_Purchase_Delivery_Material($id,$deliver_no,$status,$item,$balance_quanity,$received);
          $data = array('status' => 'success');
          echo json_encode($data);  
     }

    public function Update_Material_Request_Process(){
        $id = $this->input->post('id');
        $total = $this->input->post('total');
        $request = $this->input->post('request');
        $type = $this->input->post('type');
        $data = $this->update_model->Update_Material_Request_Process($id,$total,$request,$type);
        echo json_encode($data);    
     }
     public function Update_Material_Request_Process_Status(){
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $data = $this->update_model->Update_Material_Request_Process_Status($id,$status);
        echo json_encode($data);    
     }

     //APPROVAL
    public function Update_Approval_Customization(){
        $status = $this->input->post('status');
        $id = $this->input->post('id');
        $this->update_model->Update_Approval_Customization($id,$status);
        $data = array(
            'status' => 'success'
        );
        echo json_encode($data);
    }
    public function Update_Material_Request_Approval(){
        $status = $this->input->post('status');
        $production_no = $this->input->post('production_no');
        $this->update_model->Update_Material_Request_Approval($production_no,$status);
        $data = array('status' => $status);
        echo json_encode($data);    
     }
     public function Update_Approval_Purchase(){
        $status =  $this->input->post('status');
        $production_no = $this->input->post('production_no');
        $this->update_model->Update_Approval_Purchase($production_no,$status);
        $data = array('status' => $status);
        echo json_encode($data);    
     }
      public function Update_Approval_Inspection(){
        $status = $this->input->post('status');
        $production_no = $this->input->post('production_no');
        $remarks = $this->input->post('remarks');
        $return = $this->update_model->Update_Approval_Inspection($production_no,$status,$remarks);
        $data = array('status' => $return);
        echo json_encode($data);    
     }
     public function Update_Approval_SalesOrder(){
        $status = $this->input->post('status');
        $so_no = $this->input->post('so_no');
        $this->update_model->Update_Approval_SalesOrder($so_no,$status);
        $data = array('status' => $status);
        echo json_encode($data);    
     }
    public function Update_Approval_Users(){
      $status = $this->input->post('status');
      $id = $this->input->post('id');
      $this->update_model->Update_Approval_Users($status,$id);
      $data = array('status' => $status);
       echo json_encode($data); 
     }
    public function Update_Approval_OnlineOrder(){
        $status = $this->input->post('status');
        $order_no = $this->input->post('order_no');
        $this->update_model->Update_Approval_OnlineOrder($order_no,$status);
        $data = array('status' => $status);
        echo json_encode($data);    
     }
     public function Update_Approval_Concern(){

         $id = $this->input->post('id');
         $action = $this->input->post('action');
         $data = $this->update_model->Update_Approval_Concern($id,$action);
         echo json_encode($data); 
     }

     public function Update_Approval_SalesOrder_Accounting(){

         $id = $this->input->post('id');
         $status = $this->input->post('status');
         $table = $this->input->post('table');
         $data = $this->update_model->Update_Approval_SalesOrder_Accounting($id,$status,$table);
         echo json_encode($data); 
     }

     //ACCOUNTING
     public function Update_Accounting_Purchase_Request(){
         $id = $this->input->post('id');
         $cash = floatval(str_replace(',', '', $this->input->post('cash_fund')));
         $action =$this->input->post('action');
         $data = $this->update_model->Update_Accounting_Purchase_Request($id,$cash,$action);
         echo json_encode($data); 
     }
     public function Update_Accounting_Purchase_Received(){
         $fund_no = $this->input->post('id');
         $change  = floatval(str_replace(',', '', $this->input->post('actual_change')));
         $refund  = floatval(str_replace(',', '', $this->input->post('refund')));
         $data  = $this->update_model->Update_Accounting_Purchase_Received($fund_no,$change,$refund);
         echo json_encode($data); 
     }
     public function Update_Accounting_Purchase_Inventory_Request(){
         $id = $this->input->post('id');
         $cash = floatval(str_replace(',', '', $this->input->post('cash_fund')));
         $action =$this->input->post('action');
         $data = $this->update_model->Update_Accounting_Purchase_Inventory_Request($id,$cash,$action);
         echo json_encode($data); 
     }
     public function Update_Accounting_Purchase_Inventory_Received(){
         $fund_no = $this->input->post('id');
         $change  = floatval(str_replace(',', '', $this->input->post('actual_change')));
         $refund  = floatval(str_replace(',', '', $this->input->post('refund')));
         $data  = $this->update_model->Update_Accounting_Purchase_Inventory_Received($fund_no,$change,$refund);
         echo json_encode($data); 
     }

     //Web Modifier
    public function Update_Web_Banner(){
        $id = isset($_POST['id']) ? $this->input->post('id'):false; 
        $image =  isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"]: false;
        $tmp   = isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"]:false;
        $path_image =  "assets/images/banner/";
        $previous =  isset($_POST['previous_image']) ? $this->input->post('previous_image'):false;
        $type = isset($_POST['type']) ? $this->input->post('type'):false;
        $data = $this->update_model->Update_Web_Banner($id,$type,$image,$tmp,$path_image,$previous);
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
        $id = $this->input->post('id');
        $title = $this->input->post('title');
        $titles = str_replace(' ','',$title);
        $cat_id = $this->input->post('cat_id');
        $description = $this->input->post('description');
        $status = $this->input->post('status');
        $data = $this->update_model->Update_Web_Interior($title,$cat_id,$description,$id,$status,$banner_image,$banner_tmp,$bg_image,$bg_tmp,$path_image,$previous_banner,$previous_bg);
        echo json_encode($data);
     }
     public function Update_Web_Events(){
        error_reporting(0);
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
        $this->update_model->Update_Web_Events($title,$status,$description,$image,$id,$date_event,$time_event,$location);
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
         $voucher = $this->input->post('voucher');
         $id = $this->input->post('id');
         $data = $this->update_model->Update_Vouncher_Customer($voucher,$id);
         echo json_encode($data);
     }
     public function Update_Deposit_Approved(){
        $id = $this->input->post('id');
        $data= $this->update_model->Update_Deposit_Approved($id);
        echo json_encode($data);
     }
    public function Update_Customer(){
       $id    = isset($_POST['id'])    ? $this->input->post('id'): false;
       $firstname    = isset($_POST['firstname'])    ? $this->input->post('firstname'): false;
       $lastname     = isset($_POST['lastname'])    ? $this->input->post('lastname'): false;
       $mobile       = isset($_POST['mobile'])    ? $this->input->post('mobile'): false;
       $email        = isset($_POST['email'])    ? $this->input->post('email'): false;
       $address      = isset($_POST['address'])    ? $this->input->post('address'): false;
       $city         = isset($_POST['city'])    ? $this->input->post('city'): false;
       $province     = isset($_POST['province'])    ? $this->input->post('province'): false;
       $region       = isset($_POST['region'])    ? $this->input->post('region'): false;
       $data         = $this->update_model->Update_Customer($id,$firstname,$lastname,$mobile,$email,$address,$city,$province,$region);
       $status       = array('status' => $data);
       echo json_encode($status);
    }
    public function Update_Purchase_Status_Request_Supervisor(){
        $id = $this->input->post('id');
        $data = $this->update_model->Update_Purchase_Status_Request_Supervisor($id);
        echo json_encode($data);
    }
    public function Update_Material_Status_Request_Supervisor(){
        $id = $this->input->post('id');
        $qty = $this->input->post('qty');
        $data = $this->update_model->Update_Material_Status_Request_Supervisor($id,$qty);
        echo json_encode($data);
    }
    public function Update_Material_Used_Lock_Request_Supervisor(){
        $id = $this->input->post('id');
        $data = $this->update_model->Update_Material_Used_Lock_Request_Supervisor($id);
        echo json_encode($data);
    }
    public function Update_Material_Used_Status_Request_Supervisor(){
        $id = $this->input->post('id');
        $qty = $this->input->post('qty');
        $type = $this->input->post('type');
        $data = $this->update_model->Update_Material_Used_Status_Request_Supervisor($id,$qty,$type);
        echo json_encode($data);
    }
    public function Update_Material_Request_Supervisor(){
        $id = $this->input->post('id');
        $qty = $this->input->post('qty');
        $type = $this->input->post('type');
        $data = $this->update_model->Update_Material_Request_Supervisor($id,$qty,$type);
        echo json_encode($data);
    }
    public function Update_Purchase_Request_Supervisor(){
        $id = $this->input->post('id');
        $qty = $this->input->post('qty');
        $remarks = $this->input->post('remarks');
        $data = $this->update_model->Update_Purchase_Request_Supervisor($id,$qty,$remarks);
        echo json_encode($data);
    }



    public function Update_Project_Monitoring(){
        $id = isset($_POST['id'])  ? $this->input->post('id'): false;
        $data = isset($_POST['data'])  ? $this->input->post('data'): false;
        $action = isset($_POST['action'])  ? $this->input->post('action'): false;
        $start = isset($_POST['start'])  ? $this->input->post('start'): false;
        $due = isset($_POST['due'])  ? $this->input->post('due'): false;
        $data = $this->update_model->Update_Project_Monitoring($id,$data,$action,$start,$due);
        echo json_encode($data);
    }
    public function Update_Cash_Position(){
       $id = isset($_POST['id'])? $this->input->post('id'): false;
       $data = isset($_POST['data'])?$this->input->post('data'): false;
       $action = isset($_POST['action'])? $this->input->post('action'): false;
       if($action == 'category' || $action == 'type'){
            $data_response = $this->update_model->Update_Cash_Position($id,$action,$data);
            echo json_encode($data_response);
       }else{
           $row = isset($_POST['row'])? $this->input->post('row'): false;
           $col = isset($_POST['col'])? $this->input->post('col'): false;
           $data_response = $this->update_model->Update_Cash_Position($id,$action,$data);
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
       $id = isset($_POST['id'])? $this->input->post('id'): false;
       $name = isset($_POST['name'])? $this->input->post('name'): false;
       $description = isset($_POST['description'])? $this->input->post('description'): false;
       $image      =  isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"]: false;
       $tmp        =  isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"]:false;
       $path_image =  "assets/images/testimony/";
       $previous = isset($_POST['previous'])? $this->input->post('previous'): false;
       $data = $this->update_model->Update_Web_Testimony($name,$description,$image,$tmp,$path_image,$previous,$id);
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
        $production_no = $this->input->post('production_no');
        $qty = $this->input->post('qty');
        $status = $this->input->post('status');
        $type = $this->input->post('type');
        $data = $this->update_model->Update_Joborder_Status($production_no,$qty,$status,$type);
        echo json_encode($data);
     }
     public function Update_Purchase_Estimate(){
        $id = $this->input->post('id');
        $amount = $this->input->post('amount');
        $type = $this->input->post('type');
        $data = $this->update_model->Update_Purchase_Estimate($id,$amount,$type);
        echo json_encode($data);
     }
    public function Update_Purchase_Stocks_Process(){
        $joborder = $this->input->post('joborder');
        $pr_id = $this->input->post('pr_id');
        $item_id = $this->input->post('item_id');
        $quantity =$this->input->post('quantity');
        $amount = $this->input->post('amount');
        $supplier = $this->input->post('supplier');  
        $terms = $this->input->post('terms');   
        $type = $this->input->post('type');   
        $data = $this->update_model->Update_Purchase_Stocks_Process($joborder,$pr_id,$item_id,$quantity,$amount,$supplier,$terms,$type);
        echo json_encode($data);  
     }
     public function Update_Joborder_Stocks(){
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
        $this->update_model->Update_Joborder_Stocks($production_no,$mat_type,$mat_itemno,$mat_quantity,$mat_remarks,$pur_item,$pur_quantity,$pur_remarks,$pur_type);
        $data = array('status' =>  'success');
        echo json_encode($data);
     }
     public function Update_Salesorder_Stock_Request(){

         $id = $this->input->post('id');
         $status = $this->input->post('status');
         $data = $this->update_model->Update_Salesorder_Stock_Request($id,$status);
         echo json_encode($data);
     }
     public function Update_Salesorder_Project_Request(){

         $id = $this->input->post('id');
         $status = $this->input->post('status');
         $data = $this->update_model->Update_Salesorder_Project_Request($id,$status);
         echo json_encode($data);
     }
     public function Update_Salesorder_Stock_Delivery(){

         $id = $this->input->post('id');
         $si_no = $this->input->post('si_no');
         $data = $this->update_model->Update_Salesorder_Stock_Delivery($id,$si_no);
         echo json_encode($data);
     }
     public function Update_Salesorder_Project_Delivery(){

         $id = $this->input->post('id');
         $si_no = $this->input->post('si_no');
         $data = $this->update_model->Update_Salesorder_Project_Delivery($id,$si_no);
         echo json_encode($data);
     }
     public function Update_Request_Materials(){

         $id = $this->input->post('id');
         $qty = $this->input->post('qty');
         $balance = $this->input->post('balance');
         $data = $this->update_model->Update_Request_Materials($id,$qty,$balance);
         echo json_encode($data);
     }
     public function Update_Request_Materials_Cancelled(){
        $id = $this->input->post('id');
        $data = $this->update_model->Update_Request_Materials_Cancelled($id);
        echo json_encode($data);
     }
     public function Update_Pre_Order_Request(){
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $data = $this->update_model->Update_Pre_Order_Request($id,$status);
        echo json_encode($data);
     }
     public function Update_Customized_Request(){
        $id = $this->input->post('id');
        $subject = $this->input->post('subject');
        $description = $this->input->post('description');
        $data = $this->update_model->Update_Customized_Request($id,$subject,$description);        
        echo json_encode($data); 
    }
    public function Update_Customized_Approval_Request(){
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $data = $this->update_model->Update_Customized_Approval_Request($id,$status);
        echo json_encode($data);
     }
     public function Update_Approval_Inquiry(){
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $data = $this->update_model->Update_Approval_Inquiry($id,$status);
        echo json_encode($data);
     }
     public function Update_Salesorder_Stocks(){
        $id = $this->input->post('id');
        $downpayment = floatval(str_replace(',', '', $this->input->post('downpayment')));
        $date_downpayment = $this->input->post('date_downpayment');
        $discount =  $this->input->post('discount');
        $shipping_fee = floatval(str_replace(',', '', $this->input->post('shipping_fee')));
        $vat =  $this->input->post('vat');
        $data = $this->update_model->Update_Salesorder_Stocks($id,$downpayment,$date_downpayment,$discount,$shipping_fee,$vat);
        echo json_encode($data);
     }
     public function Update_Supplier_Item(){
        $id = $this->input->post('id');
        $supplier = $this->input->post('supplier');
        $amount = floatval(str_replace(',', '', $this->input->post('amount')));
        $data = $this->update_model->Update_Supplier_Item($id,$supplier,$amount);
        echo json_encode($data);
     }
     public function Update_Supplier_Edit(){
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $mobile = $this->input->post('mobile');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $data = $this->update_model->Update_Supplier_Edit($id,$name,$mobile,$email,$address);
        echo json_encode($data);
     }
     public function Update_Supplier_Image(){
        $id = $this->input->post('id');
        $image      =  isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"]: false;
        $tmp        =  isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"]:false;
        $path_image =  "assets/images/supplier/";  
        $data = $this->update_model->Update_Supplier_Image($id,$image,$tmp,$path_image);
        echo json_encode($data);
     }
     public function Update_Purchased_Transaction(){
        $fund_no = $this->input->post('fund_no');
        $item = $this->input->post('item');
        $supplier = $this->input->post('supplier');
        $terms = $this->input->post('terms');
        $quantity = $this->input->post('quantity');
        $amount = floatval(str_replace(',', '', $this->input->post('amount_process')));
        $terms_start  = isset($_POST["terms_start"]) ? date('Y-m-d',strtotime($this->input->post('terms_start'))): false;
        $terms_end  = isset($_POST["terms_end"]) ? date('Y-m-d',strtotime($this->input->post('terms_end'))): false;
        $data = $this->update_model->Update_Purchased_Transaction($fund_no,$item,$supplier,$terms,$quantity,$amount,$terms_start,$terms_end);
        echo json_encode($data);
     }
     public function Update_Purchase_Complete(){
        $fund_no = $this->input->post('fund_no');
        $joborder = $this->input->post('joborder');
        $type = $this->input->post('type');
        $data = $this->update_model->Update_Purchase_Complete($fund_no,$joborder,$type);
        echo json_encode($data);
     }
     public function Update_Purchased_Other_Transaction(){
        $fund_no = $this->input->post('fund_no');
        $item = $this->input->post('item');
        $supplier = $this->input->post('supplier');
        $terms = $this->input->post('terms');
        $quantity = $this->input->post('quantity');
        $type = $this->input->post('type');
        $amount = floatval(str_replace(',', '', $this->input->post('amount_process')));
        $terms_start  = isset($_POST["terms_start"]) ? date('Y-m-d',strtotime($this->input->post('terms_start'))): false;
        $terms_end  = isset($_POST["terms_end"]) ? date('Y-m-d',strtotime($this->input->post('terms_end'))): false;
        $data = $this->update_model->Update_Purchased_Other_Transaction($fund_no,$item,$supplier,$terms,$quantity,$amount,$terms_start,$terms_end,$type);
        echo json_encode($data);
     }
     public function Update_Purchase_Other_Complete(){
        $fund_no = $this->input->post('fund_no');
        $data = $this->update_model->Update_Purchase_Other_Complete($fund_no);
        echo json_encode($data);
     }
     public function Update_Sales_Delivery_Receipt_Superuser(){
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $remarks = $this->input->post('remarks')??" ";
        $data = $this->update_model->Update_Sales_Delivery_Receipt_Superuser($id,$status,$remarks);
        echo json_encode($data);
     }
      public function Update_Salesorder_Stocks_Accounting(){
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $remarks = $this->input->post('remarks')??" ";
        $data = $this->update_model->Update_Salesorder_Stocks_Accounting($id,$status,$remarks);
        echo json_encode($data);
     }
     public function Update_Salesorder_Project_Accounting(){
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $remarks = $this->input->post('remarks')??" ";
        $data = $this->update_model->Update_Salesorder_Project_Accounting($id,$status,$remarks);
        echo json_encode($data);
     }
     public function Update_Cashposition_Category(){
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $data = $this->update_model->Update_Cashposition_Category($id,$name);
        echo json_encode($data);
     }

}
?>
