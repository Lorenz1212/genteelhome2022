<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Create_controller extends CI_Controller 
{ 
    public function __construct(){
      parent::__construct();
      $this->load->helper('url'); 
      $this->load->model('create_model');
      $this->load->library('session');
    }
    public function Create_Design_Stocks(){
        $user_id = $this->session->userdata('id');
        $title  = strtoupper( $this->input->post('title'));
        $c_name = strtoupper($this->input->post('c_name'));
        $image  =  isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"]: false;
        $tmp    =  isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"]:false;
        $path_image = "assets/images/design/project_request/images/";
        $color_image =  isset($_FILES["color"]["name"]) ? $_FILES["color"]["name"]: false;
        $color_tmp   =  isset($_FILES["color"]["tmp_name"]) ? $_FILES["color"]["tmp_name"]:false;
        $path_color  =  "assets/images/palettecolor/";
        $docs  =  isset($_FILES["docs"]["name"]) ? $_FILES["docs"]["name"]:false;
        $docs_tmp  =  isset($_FILES["docs"]["tmp_name"]) ? $_FILES["docs"]["tmp_name"]:false;
        $path_docs =  "assets/images/design/project_request/docx/";
        $data = $this->create_model->Create_Design_Stocks($user_id,$title,$c_name,$image,$tmp,$path_image,$color_image,$color_tmp,$path_color,$docs,$docs_tmp,$path_docs);
        echo json_encode($data);
     }
     public function Create_Design_Existing(){
        $user_id = $this->session->userdata('id');
        $project_no = $this->input->post('project_no');
        $c_name = strtoupper($this->input->post('c_name'));
        $image =  isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"]: false;
        $tmp   =  isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"]: false;
        $path_image = "assets/images/design/project_request/images/";
        $color_image =  isset($_FILES["color"]["name"]) ? $_FILES["color"]["name"]: false;
        $color_tmp   =  isset($_FILES["color"]["tmp_name"]) ? $_FILES["color"]["tmp_name"]: false;
        $path_color  =  "assets/images/palettecolor/";
        $docs   =  isset($_FILES["docs"]["name"]) ? $_FILES["docs"]["name"]: false;
        $docs_tmp =  isset($_FILES["docs"]["tmp_name"]) ? $_FILES["docs"]["tmp_name"]: false;
        $path_docs =  "assets/images/design/project_request/docx/";
        $data = $this->create_model->Create_Design_Existing($user_id,$project_no,$c_name,$image,$tmp,$path_image,$color_image,$color_tmp,$path_color,$docs,$docs_tmp,$path_docs);
        echo json_encode($data);
     }
     public function Create_Design_Project(){
        $user_id = $this->session->userdata('id');
        $title  = strtoupper( $this->input->post('title'));
        $image      =  isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"]: false;
        $tmp        =  isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"]:false;
        $path_image = "assets/images/design/project_request/images/";
        $docs       =  isset($_FILES["docs"]["name"]) ? $_FILES["docs"]["name"]:false;
        $docs_tmp   =  isset($_FILES["docs"]["tmp_name"]) ? $_FILES["docs"]["tmp_name"]:false;
        $path_docs  =  "assets/images/design/project_request/docx/";
        $data =$this->create_model->Create_Design_Project($user_id,$title,$image,$tmp,$path_image,$docs,$docs_tmp,$path_docs);
        echo json_encode($data);
     }
    public function Create_Joborder_Stocks(){
        $user_id = $this->session->userdata('id');
        $project_no = $this->input->post('project_no');
        $c_code = $this->input->post('c_code');
        $qty = $this->input->post('unit');
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
        $this->create_model->Create_Joborder_Stocks($user_id,$project_no,$c_code,$qty,$mat_type,$mat_itemno,$mat_quantity,$mat_remarks,$pur_item,$pur_quantity,$pur_remarks,$pur_type);
        $data = array('status' =>  'success');
        echo json_encode($data);
    }
    public function Create_Joborder_Project(){
        $user_id = $this->session->userdata('id');
        $project_no = $this->input->post('project_no');
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
        $this->create_model->Create_Joborder_Project($user_id,$project_no,$mat_type,$mat_itemno,$mat_quantity,$mat_remarks,$pur_item,$pur_quantity,$pur_remarks,$pur_type);
        $data = array('status' =>  'success');
        echo json_encode($data);
    }
     public function Create_Joborder_Request(){
        $user_id = $this->session->userdata('id');
        $project_no = $this->input->post('project_no');
        $assigned = $this->input->post('assigned');
        $c_code = $this->input->post('c_code');
        $unit = $this->input->post('unit');
        $type = $this->input->post('type');
        $data = $this->create_model->Create_Joborder_Request($user_id,$project_no,$c_code,$unit,$type);        
        echo json_encode($data); 
    }
    public function Create_Users(){
        $status = $this->input->post('status');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
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
        $profile_avatar  =  isset($_FILES["profile_avatar"]["name"]) ? $_FILES["profile_avatar"]["name"]: false;
        $profile_tmp   =  isset($_FILES["profile_avatar"]["tmp_name"]) ? $_FILES["profile_avatar"]["tmp_name"]: false;
        $profile_path  =  "assets/images/avatar/";
        $this->create_model->Create_Users($firstname,$lastname,$middlename,$username,$status,$designer,$production,$supervisor,$superuser,$admin,$password,$accounting,$webmodifier,$sales,$voucher,$profile_avatar,$profile_tmp,$profile_path);
        $data = array('status' => 'success');
        echo json_encode($data); 
     }
       public function Create_Purchase_Request(){
        $user_id = $this->session->userdata('id');
        $production_no = $this->input->post('production_no');
        $item = $this->input->post('item');
        $quantity = $this->input->post('quantity');
        $remarks = $this->input->post('remarks');
        $this->create_model->Create_Purchase_Request($user_id,$production_no,$item,$quantity,$remarks);
        $data = array('status' => 'success');
        echo json_encode($data);
    }
    public function Create_MaterialUsed(){
         $user_id = $this->session->userdata('id');
         $production_no = $this->input->post('production_no');
         $item = $this->input->post('item');
         $item_no = $this->input->post('item_no');
         $qty = $this->input->post('qty');
         $unit = $this->input->post('unit');
         $this->create_model->Create_MaterialUsed($user_id,$item_no,$production_no,$item,$qty,$unit);
         $data = array('status' => 'success');
         echo json_encode($data);
    }
    public function Create_RawMaterial(){
        $user_id = $this->session->userdata('id');
        $item = strtoupper($this->input->post('item'));
        $unit = $this->input->post('unit');
        $price = floatval(preg_replace('/[^\d.]/', '', $this->input->post('price')));
        $this->create_model->Create_RawMaterial($user_id,$item,$unit,$price);
        $data = array('status' => 'success');
        echo json_encode($data);
     }
      public function Create_Production(){
        $item_no = $this->input->post('item_no');
        $query = $this->db->select('*')->from('tbl_materials')->where('item_no',$item_no)->get();
        $row=$query->row();
        $item = $row->item;
        $stocks = $this->input->post('stocks');
        $this->create_model->Create_Production($item_no,$item,$stocks);
        $data = array('status' => 'success');
        echo json_encode($data);
     }
     public function Create_Other_Materials(){
        $user_id = $this->session->userdata('id');
        $item = strtoupper($this->input->post('item'));
        $type = $this->input->post('type');
        $data = $this->create_model->Create_Other_Materials($user_id,$item,$type);
        echo json_encode($data);
     }
     public function Create_Other_Matrials_Request(){
        $user_id = $this->session->userdata('id');
        $item = $this->input->post('item');
        $quantity = $this->input->post('quantity');
        $remarks = $this->input->post('remarks');
        $type = $this->input->post('type');
        $data = $this->create_model->Create_Other_Matrials_Request($user_id,$item,$quantity,$remarks,$type);
        echo json_encode($data);
     }
    public function Create_EM_Purchase_Request(){
        $user_id = $this->session->userdata('id');
        $production_no = $this->input->post('production_no');
        $item = $this->input->post('item');
        $unit = $this->input->post('unit');
        $quantity = $this->input->post('quantity');
        $remarks = $this->input->post('remarks');
        $this->create_model->Create_EM_Purchase_Request($user_id,$production_no,$item,$quantity,$remarks,$unit);
        $data = array('status' => 'success');
        echo json_encode($data);
    }
    public function Create_EM_Material_Request(){
        $user_id = $this->session->userdata('id');
        $production_no = $this->input->post('production_no');
        $item = $this->input->post('item');
        $mat_itemno = $this->input->post('mat_itemno');
        $unit = $this->input->post('unit');
        $quantity = $this->input->post('quantity');
        $remarks = $this->input->post('remarks');
        $requestor = $this->input->post('requestor');
        $mat_type = $this->input->post('mat_type');
        $mat_itemno = $this->input->post('mat_itemno');
        $this->create_model->Create_EM_Material_Request($user_id,$production_no,$item,$quantity,$remarks,$requestor,$unit,$mat_type,$mat_itemno);
        $data = array('status' => 'success');
        echo json_encode($data);
    }
      
      public function Create_Supplier(){
       $user_id = $this->session->userdata('id');
       $name = $this->input->post('name');
       $name = strtoupper($name);
       $mobile = $this->input->post('mobile');
       $email = $this->input->post('email');
       $facebook = $this->input->post('facebook');
       $website = $this->input->post('website');
       $address = $this->input->post('address');
       $data =  $this->create_model->Create_Supplier($user_id,$name,$mobile,$email,$facebook,$website,$address);
        echo json_encode($data);
     }
     public function Create_Purchase_Request_Stocks(){
        $user_id = $this->session->userdata('id');
        $item = $this->input->post('item');
        $quantity = $this->input->post('quantity');
        $remarks = $this->input->post('remarks');
        $amount = $this->input->post('amount');
        $unit = $this->input->post('unit');
        $this->create_model->Create_Purchase_Request_Stocks($user_id,$item,$quantity,$remarks,$amount,$unit);
        $data = array('status' => 'success');
        echo json_encode($data);
     }
       public function Create_Web_Banner(){
        $user_id = $this->session->userdata('id');
        $image  =  isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"]: false;
        $tmp    =  isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"]:false;
        $path_image =  "assets/images/banner/";
        $type = $this->input->post('type');
        $data = $this->create_model->Create_Web_Banner($user_id,$type,$image,$tmp,$path_image);
        echo json_encode($data);
     }
     public function Create_Web_Interior(){
        $user_id = $this->session->userdata('id');
        $banner_image  =  isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"]: false;
        $banner_tmp  =  isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"]:false;
        $bg_image =  isset($_FILES["bg_image"]["name"]) ? $_FILES["bg_image"]["name"]: false;
        $bg_tmp  =  isset($_FILES["bg_image"]["tmp_name"]) ? $_FILES["bg_image"]["tmp_name"]:false;
        $path_image =  "assets_website/images/";
        $title = $this->input->post('title');
        $cat_id = $this->input->post('cat_id');
        $status = $this->input->post('status');
        $description = $this->input->post('description');
        $data =$this->create_model->Create_Web_Interior($user_id,$title,$cat_id,$description,$status,$banner_image,$banner_tmp,$bg_image,$bg_tmp,$path_image);
        echo json_encode($data);
     }
      public function Create_Web_Events(){
        $title = $this->input->post('title');
        $date_event = $this->input->post('date_event');
        $time_event = $this->input->post('time_event');
        $location = $this->input->post('location');
        $status = $this->input->post('status');
        $description = $this->input->post('description');
        $image  = isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"]: false;
        $tmp    = isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"]: false;
        $path   = "assets_website/images/";
        $this->create_model->Create_Web_Events($user_id,$title,$status,$description,$id,$date_event,$time_event,$location,$image,$tmp,$path);
        $data = array('status' => 'success');
        echo json_encode($data);
     }
     public function Create_Web_SubCategory(){
        $cat_id = $this->input->post('cat_id');
        $sub_name = $this->input->post('sub_name');
        $data = $this->create_model->Create_Web_SubCategory($cat_id,$sub_name);
        $data = array('status' => $data);
        echo json_encode($data);
     }
     public function Create_ProductCategory(){
        $sub_id = $this->input->post('sub_id');
        $id = $this->input->post('id');
        $data = $this->create_model->Create_ProductCategory($sub_id,$id);
        $data = array('id' => $id);
        echo json_encode($data);
     }
     public function Create_Project_Status(){
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $data = $this->create_model->Create_Project_Status($id,$status);
        $data = array('status' => $status);
        echo json_encode($data);
     }
     public function Create_Project_Title(){
        $id = $this->input->post('id');
        $name = strtoupper($this->input->post('name'));
        $action = $this->input->post('action');
        $status = $this->create_model->Create_Project_Title($id,$name,$action);
        $data = array('status' => $status);
        echo json_encode($data);
     }
     public function Create_Web_Project_Image(){
        $id = $this->input->post('id'); 
        $image =  isset($_FILES["file"]["name"]) ? $_FILES["file"]["name"]: false;
        $tmp  =  isset($_FILES["file"]["tmp_name"]) ? $_FILES["file"]["tmp_name"]:false;
        $path_image = "assets/images/finishproduct/product/";
        $data = $this->create_model->Create_Web_Project_Image($id,$image,$tmp,$path_image);
        echo json_encode($data);
     }
     public function Create_Web_Project_Gallery(){
        error_reporting(0);
        $id = $this->input->post('id');    
        $data = $this->create_model->Create_Web_Project_Gallery($id);
        echo json_encode($data);
     }
     public function Create_Web_Project_Tearsheet(){
        $id = $this->input->post('id');
        $image      =  isset($_FILES["file"]["name"]) ? $_FILES["file"]["name"]: false;
        $tmp        =  isset($_FILES["file"]["tmp_name"]) ? $_FILES["file"]["tmp_name"]:false;
        $path_image =  "assets/images/tearsheet/";    
        $data = $this->create_model->Create_Web_Project_Tearsheet($id,$image,$tmp,$path_image);
        echo json_encode($data);
     }
     public function Create_Web_Project_Price(){
        $id = $this->input->post('id');    
        $c_price = floatval(str_replace(',', '', $this->input->post('c_price')));
        $data = $this->create_model->Create_Web_Project_Price($id,$c_price);
        echo json_encode($data);
     }
     public function Create_Web_Change_Pallet(){
        $id = $this->input->post('id');    
        $image =  isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"]: false;
        $tmp =  isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"]:false;
        $path_image = "assets/images/palettecolor/";
        $previous = $this->input->post('previous');
        $data = $this->create_model->Create_Web_Change_Pallet($id,$image,$tmp,$path_image,$previous);
        echo json_encode($data);
     }
     public function Create_Web_Project_Category(){
        $id = $this->input->post('id'); 
        $cat_id = $this->input->post('cat_id'); 
        $sub_id = $this->input->post('sub_id');    
        $data = $this->create_model->Create_Web_Project_Category($id,$cat_id,$sub_id);
        echo json_encode($data);
     }
     public function Create_Web_Finishproduct(){
        $user_id = $this->session->userdata('id');
        $title = strtoupper($this->input->post('title'));
        $c_name = strtoupper($this->input->post('c_name'));
        $amount = floatval(str_replace(',', '', $this->input->post('amount')));
        $cat_id = $this->input->post('cat_id');
        $sub_id = $this->input->post('sub_id');
        $image      =  isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"]: false;
        $tmp        =  isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"]:false;
        $path_image = "assets/images/design/project_request/images/";
        $color_image =  isset($_FILES["color"]["name"]) ? $_FILES["color"]["name"]: false;
        $color_tmp   =  isset($_FILES["color"]["tmp_name"]) ? $_FILES["color"]["tmp_name"]:false;
        $path_color  =  "assets/images/palettecolor/";
        $docs       =  isset($_FILES["docs"]["name"]) ? $_FILES["docs"]["name"]:false;
        $docs_tmp   =  isset($_FILES["docs"]["tmp_name"]) ? $_FILES["docs"]["tmp_name"]:false;
        $path_docs  =  "assets/images/tearsheet/";
        $this->create_model->Create_Web_Finishproduct($user_id,$title,$c_name,$amount,$cat_id,$sub_id,$image,$tmp,$path_image,$color_image,$color_tmp,$path_color,$docs,$docs_tmp,$path_docs);
        $data = array('status' => 'success');
        echo json_encode($data);
     }
     public function Create_Web_Finishproduct_Pallet(){
        $user_id = $this->session->userdata('id');
        $project_no = $this->input->post('project_no');
        $c_name = strtoupper($this->input->post('c_name'));
        $amount = floatval(str_replace(',', '', $this->input->post('amount')));
        $image      =  isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"]: false;
        $tmp        =  isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"]:false;
        $path_image = "assets/images/design/project_request/images/";
        $color_image =  isset($_FILES["color"]["name"]) ? $_FILES["color"]["name"]: false;
        $color_tmp   =  isset($_FILES["color"]["tmp_name"]) ? $_FILES["color"]["tmp_name"]:false;
        $path_color  =  "assets/images/palettecolor/";
        $this->create_model->Create_Web_Finishproduct_Pallet($user_id,$project_no,$c_name,$amount,$image,$tmp,$path_image,$color_image,$color_tmp,$path_color);
        $data = array('status' => 'success');
        echo json_encode($data);
     }
   
     public function Create_Web_Voucher(){
       $voucher = $this->input->post('voucher');
       $discount = $this->input->post('discount');
       $date_from = $this->input->post('date_from');
       $date_to = $this->input->post('date_to');
       $this->create_model->Create_Web_Voucher($voucher,$discount,$date_from,$date_to);
        $data = array('status'=>'success');
        echo json_encode($data);
     }
     public function Create_Interior_Status(){
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $data = $this->create_model->Create_Interior_Status($id,$status);
        $data = array('status' => $status);
        echo json_encode($data);
     }
     public function Create_Web_Interior_Image(){
        $id = $this->input->post('id');    
        $image      =  isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"]: false;
        $tmp        =  isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"]:false;
        $path_image =  "assets_website/images/";
        $data = $this->create_model->Create_Web_Interior_Image($id,$image,$tmp,$path_image);
        echo json_encode($data);
     }
      public function Create_Deposit(){
        $order_no  = $this->input->post('order_no');
        $firstname = strtoupper($this->input->post('firstname'));
        $lastname = strtoupper($this->input->post('lastname'));
        $mobile = $this->input->post('mobile');
        $email  = $this->input->post('email');
        $date_deposite  = $this->input->post('date_deposite');
        $bank   = $this->input->post('bank');
        $amount = floatval(str_replace(',', '', $this->input->post('amount')));
        $image  =  isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"]: false;
        $tmp    =  isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"]:false;
        $path_image =  "assets/images/deposit/";
        $data = $this->create_model->Create_Deposite($firstname,$lastname,$mobile,$email,$order_no,$date_deposite,$amount,$bank,$image,$tmp,$path_image);
        echo json_encode($data);
    }
    public function Create_Customer(){
       $user_id      = $this->session->userdata('id');
       $firstname    = isset($_POST['firstname'])? $this->input->post('firstname'): false;
       $lastname     = isset($_POST['lastname']) ? $this->input->post('lastname'): false;
       $mobile       = isset($_POST['mobile'])   ? $this->input->post('mobile'): false;
       $email        = isset($_POST['email'])    ? $this->input->post('email'): false;
       $address      = isset($_POST['address'])  ? $this->input->post('address'): false;
       $city         = isset($_POST['city'])     ? $this->input->post('city'): false;
       $province     = isset($_POST['province']) ? $this->input->post('province'): false;
       $region       = isset($_POST['region'])   ? $this->input->post('region'): false;
       $data         = $this->create_model->Create_Customer($user_id,$firstname,$lastname,$mobile,$email,$address,$city,$province,$region);
       $status       = array('status' => $data);
       echo json_encode($status);
    }
    public function Create_Cash_Position(){
       $user_id = $this->session->userdata('id');
       $name = isset($_POST['name'])? $this->input->post('name'): false;
       $amount = isset($_POST['amount'])? floatval(str_replace(',', '', $this->input->post('amount'))): false;
       $date_position = isset($_POST['date_position'])? date('Y-m-d',strtotime($this->input->post('date_position'))) : false;
       $type = isset($_POST['type'])? $this->input->post('type'): false;
       $cat_id = isset($_POST['cat_id'])? $this->input->post('cat_id'): false;
       $data = $this->create_model->Create_Cash_Position($user_id,$name,$amount,$date_position,$type,$cat_id);
       echo json_encode($data);
    }
    public function Create_Web_Testimony(){
       $user_id = $this->session->userdata('id');
       $name = isset($_POST['name'])? $this->input->post('name'): false;
       $description = isset($_POST['description'])? $this->input->post('description'): false;
       $image      =  isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"]: false;
       $tmp        =  isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"]:false;
       $path_image =  "assets/images/testimony/";
       $data = $this->create_model->Create_Web_Testimony($user_id,$name,$description,$image,$tmp,$path_image);
       echo json_encode($data);
    }
    public function Create_Joborder_Inpection_Project_Image(){
        $id = $this->session->userdata('id');
        $production_no = $this->input->post('production_no'); 
        $image =  isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"]: false;
        $tmp  =  isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"]:false;
        $path_image = "assets/images/inspection/";
        $data = $this->create_model->Create_Joborder_Inpection_Project_Image($id,$production_no,$image,$tmp,$path_image);
        echo json_encode($data);
    }
    public function Create_Joborder_Inpection_Stocks_Image(){
        $id = $this->session->userdata('id');
        $production_no = $this->input->post('production_no'); 
        $image =  isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"]: false;
        $tmp  =  isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"]:false;
        $path_image = "assets/images/inspection/";
        $data = $this->create_model->Create_Joborder_Inpection_Stocks_Image($id,$production_no,$image,$tmp,$path_image);
        echo json_encode($data);
    }
    public function Create_SupplierItem(){
        $user_id = $this->session->userdata('id');
        $id = $this->input->post('id');
        $item = $this->input->post('item');
        $amount = floatval(str_replace(',', '', $this->input->post('amount')));
        $data = $this->create_model->Create_SupplierItem($user_id,$id,$item,$amount);        
        echo json_encode($data); 
    }
    public function Create_Salesorder_Stocks(){
         $user_id = $this->session->userdata('id');
         $customer = $this->input->post('customer');
         $date_created = $this->input->post('date_created');
         $email = $this->input->post('email');
         $mobile = $this->input->post('mobile');
         $address = $this->input->post('address');
         $tin = $this->input->post('tin');
         $downpayment = floatval(str_replace(',', '', $this->input->post('downpayment')));
         $date_downpayment = $this->input->post('date_downpayment');
         $discount =  $this->input->post('discount');
         $shipping_fee = floatval(str_replace(',', '', $this->input->post('shipping_fee')));
         $vat =  $this->input->post('vat');
         $description = $this->input->post('description');
         $qty = $this->input->post('qty');
         $unit = $this->input->post('unit');
         $amount = $this->input->post('amount');
         $data = $this->create_model->Create_Salesorder_Stocks($user_id,$date_created,$customer,$email,$mobile,$address,$downpayment,$discount,$shipping_fee,$vat,$description,$qty,$unit,$amount,$date_downpayment,$tin);        
         echo json_encode($data); 
    }
    public function Create_Salesorder_Project(){
         $user_id = $this->session->userdata('id');
         $project_no = $this->input->post('project_no');
         $customer = $this->input->post('customer');
         $date_created = $this->input->post('date_created');
         $email = $this->input->post('email');
         $mobile = $this->input->post('mobile');
         $address = $this->input->post('address');
         $tin = $this->input->post('tin');
         $downpayment = floatval(str_replace(',', '', $this->input->post('downpayment')));
         $date_downpayment = $this->input->post('date_downpayment');
         $discount =  $this->input->post('discount');
         $shipping_fee = floatval(str_replace(',', '', $this->input->post('shipping_fee')));
         $vat =  $this->input->post('vat');
         $description = $this->input->post('description');
         $qty = $this->input->post('qty');
         $unit = $this->input->post('unit');
         $amount = $this->input->post('amount');
         $data = $this->create_model->Create_Salesorder_Project($user_id,$project_no,$date_created,$customer,$email,$mobile,$address,$downpayment,$discount,$shipping_fee,$vat,$description,$qty,$unit,$amount,$date_downpayment,$tin);        
         echo json_encode($data); 
    }
    public function Create_Return_Item_Warehouse(){
         $user_id = $this->session->userdata('id');
         $type = $this->input->post('type');
         $item_no = $this->input->post('item_no');
         $qty = $this->input->post('qty');
         $status = $this->input->post('status');
         $remarks = $this->input->post('remarks');
         $data = $this->create_model->Create_Return_Item_Warehouse($user_id,$type,$item_no,$qty,$status,$remarks);        
         echo json_encode($data); 
    }
    public function Create_Return_Item_Customer(){
         $user_id = $this->session->userdata('id');
         $so_no = $this->input->post('so_no');
         $item_no = $this->input->post('item_no');
         $item = $this->input->post('item');
         $qty = $this->input->post('qty');
         $status = $this->input->post('status');
         $remarks = $this->input->post('remarks');
         $data = $this->create_model->Create_Return_Item_Customer($user_id,$so_no,$item_no,$item,$qty,$status,$remarks);        
         echo json_encode($data); 
    }
    public function Create_Request_Material(){
         $user_id = $this->session->userdata('id');
         $type = $this->input->post('type');
         $item_no = $this->input->post('item_no');
         $item = $this->input->post('item');
         $qty = $this->input->post('qty');
         $data = $this->create_model->Create_Request_Material($user_id,$item_no,$item,$qty,$type);        
         echo json_encode($data); 
    }
    public function Create_Request_Pre_Order(){
        $user_id = $this->session->userdata('id');
        $id = $this->input->post('id');
        $data = $this->create_model->Create_Request_Pre_Order($user_id,$id);        
        echo json_encode($data); 
    }
    public function Create_Customized_Request(){
        $user_id = $this->session->userdata('id');
        $subject = $this->input->post('subject');
        $description = $this->input->post('description');
        $data = $this->create_model->Create_Customized_Request($user_id,$subject,$description);        
        echo json_encode($data); 
    }
    public function Create_Material_request_Supervisor(){
        $user_id = $this->session->userdata('id');
        $id = $this->input->post('id');
        $item = $this->input->post('item');
        $qty = $this->input->post('qty');
        $type = $this->input->post('type');
        $data = $this->create_model->Create_Material_request_Supervisor($user_id,$id,$item,$qty,$type);        
        echo json_encode($data); 
    
    }
    public function Create_Purchase_request_Supervisor(){
        $user_id = $this->session->userdata('id');
        $id = $this->input->post('id');
        $item = $this->input->post('item');
        $qty = $this->input->post('qty');
        $remarks = $this->input->post('remarks');
        $type = $this->input->post('type');
        $status = $this->input->post('status');
        $special = $this->input->post('special');
        $unit = $this->input->post('unit');
        $data = $this->create_model->Create_Purchase_request_Supervisor($user_id,$id,$item,$qty,$remarks,$type,$status,$special,$unit);        
        echo json_encode($data); 
    
    }
}
?>
